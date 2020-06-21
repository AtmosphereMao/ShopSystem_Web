<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:54
 */

//namespace app\Http\Controller;

use handler\Handler;
use App\Http\Model\Trends;
use App\Http\Model\Cart;
use App\Http\Model\Users;
use App\Http\Model\Order;

class CartController extends Handler
{
    public function __construct()
    {
        if(auth()){
            self::redirect('login');
        }
    }

    /**
     * 购物车
     */
    public function index()
    {
        $carts = Cart::query()->where('`create_user` = ?', Auth::user()['id'])
                                     ->fetch();
        $trends_id = array_column($carts, 'trends_id');  // 将trends_id分出来
        $trends = Trends::query()->whereIn('id',$trends_id)->fetch(); // 根据carts中的保存的id，丢进Trends进行查询与trends_id相符的数据
        return view('cart/cart', ['trends'=>$trends, 'cart'=>$carts]);
    }

    public function cartDelete()
    {
        $cart = Cart::query()->where('`create_user` = ? and `id` = ?',[Auth::user()['id'], self::POST('id')])
                             ->fetch();
        if(empty($cart))
        {
            $data = [
                'status' => 1,
                'msg' => k('trend_null'),
            ];
        }else{
            $cart = $cart[0];
            if($cart['quantity'] == 1)
            {
                $result = Cart::delete('`create_user` = ? and `id` = ?',[Auth::user()['id'], self::POST('id')]);
            }else if($cart['quantity'] > 1)
            {
                $data = [
                    'quantity' => $cart['quantity']-1
                ];
                $result = Cart::update($data, '`create_user` = ? and `id` = ?', [Auth::user()['id'], self::POST('id')]);
            }
            if(!$result)
            {
                $data = [
                    'status' => 0,
                    'msg' => k('delete_succeeded'),
                ];
            }else{
                $data = [
                    'status' => 1,
                    'msg' => k('delete_failed'),
                ];
            }
        }

        echo json_encode($data);
    }

    public function cartSubmit()
    {
        $carts = Cart::query()->where('`create_user` = ?', Auth::user()['id'])
            ->fetch();
        if(empty($carts))
        {
            $msg = [
                'status'=>'1',
                'msg'=>k('cart_null')
            ];echo json_encode($msg);return;
        }
        $trends_id = array_column($carts, 'trends_id');
        $trends = Trends::query()->whereIn('id',$trends_id)->whereAnd('`status` = ?', '0')->fetch();
        if(empty($trends))
        {
            $msg = [
                'status'=>'1',
                'msg'=>k('cart_buy_error')
            ];echo json_encode($msg);return;
        }
        $price_sum = 0;

        // 计算总价格and总数量
        for($i = 0;$i<count($trends);$i++)
        {   $price_sum += $trends[$i]['price'] * $carts[$i]['quantity'];}

        // 判断金额是否足够
        if(Auth::user()['balance'] <$price_sum)
        { $msg = ['status'=>'1','msg'=>k('buy_error_balance')];echo json_encode($msg);return;}

        // 判断订单数量是否足够
        for($i = 0;$i<count($trends);$i++)
        {
            if($carts[$i]['quantity'] > $carts[$i]['quantity'])
            { $msg = ['status'=>'1','msg'=>k('buy_error').' '.$trends[$i]['title'].' '.k('buy_trend_no')];echo json_encode($msg);return;}
        }

        // 清库存
        for($i = 0;$i<count($trends);$i++)
        {
            $data = [
                'quantity'=>$trends[$i]['quantity'] - $trends[$i]['quantity'],
                'updated_at' => date('y-m-d h:i:s')
            ];
            $result = Trends::update($data, '`id` = ?',$trends[$i]['id']);
            if($result){
                $msg = ['status'=>'1','msg'=>$msg = ['status'=>'1','msg'=>k('buy_error').' '.$trends[$i]['title'].' '.k('buy_trend_no')]];
                echo json_encode($msg);return;
            }
        }

        // 清余额
        $data = ['balance'=>Auth::user()['balance'] - $price_sum];
        $result = Users::update($data, '`id` = ?', Auth::user()['id']);
        if($result)
        { $msg = ['status'=>'1','msg'=>k('500')];echo json_encode($msg);return;}

        // 上传订单
        for($i = 0;$i<count($trends);$i++)
        {
            $data = [
                'trends_id'=>$trends[$i]['id'],
                'quantity'=>$carts[$i]['quantity'],
                'finished_quantity'=>0,
                'create_user'=>Auth::user()['id'],
                'owner_user'=>$trends[$i]['create_user'],
                'status'=>'0',
                'created_at' => date('y-m-d h:i:s'),
                'updated_at' => date('y-m-d h:i:s')
            ];
            $result = Order::create($data);
            if($result)
            {
                $data = [
                    'balance'=>Auth::user()['balance'] + $price_sum,
                    'updated_at' => date('y-m-d h:i:s')
                ];
                Users::update($data, '`id` = ?', Auth::user()['id']);
                $msg = ['status'=>'1','msg'=>k('500')];
            }else{
                Cart::delete('`create_user` = ?',Auth::user()['id']);
                $msg = [
                    'status'=>'0',
                    'msg'=>k('buy_success')
                ];

            }
        }

        echo json_encode($msg);
        return;

    }




}