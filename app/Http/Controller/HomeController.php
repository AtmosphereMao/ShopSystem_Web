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

class HomeController extends Handler
{
    public function index()
    {
        return self::redirect('/home');
    }

    /**
     *  首页
     * @GET search
     * @GET page
     */
    public function home()
    {
        $trends = Trends::query()->where('`status` = ? and `title` like ?', [0, '%'.self::GET('search').'%'])
            ->orderBy('id','desc')
            ->page(self::GET('page') ? (self::GET('page')-1) * 6 : 0 ,6)
            ->fetch();
        if(self::GET('page') > 1)
            if(!empty($trends))
                return view('index_more', ['trends'=>$trends, 'i'=>self::GET('page')]);
            else
                return '';
        return view('index', ['trends'=>$trends]);
    }

    public function trendShow()
    {
        if(self::GET('page_id') == '')
            abort(404);
        $trend = Trends::query()->where('`status` = ? and `page_id` = ?', [0, self::GET('page_id')])
            ->fetch();
        if(empty($trend))
            abort(404);
        $trend = $trend[0];
        echo json_encode($trend);
    }

    public function trendBuy()
    {
        if(auth()){
            echo json_encode([
                'status' => 1,
                'msg' => k('deny')
            ]);
            return;
        }
        $id = self::POST('trend_id');
        $trend = Trends::query()->where('`status` = ? and `id` = ?', [0, $id])
            ->fetch();
        if(empty($trend))
        {
            $msg  =[
                'status' => 1,
                'msg' => k('500')
            ];
        }else{
            $trend = $trend[0];
            $cart = Cart::query()->where('`trends_id` = ? and `create_user` = ?',[$trend['id'], Auth::user()['id']])
                ->fetch();
            if(empty($cart))
            {
                $data = [
                    'trends_id'=>$trend['id'],
                    'quantity'=>1,
                    'create_user'=>Auth::user()['id'],
                    'created_at' => date('y-m-d h:i:s'),
                    'updated_at' => date('y-m-d h:i:s')
                ];
                $result = Cart::getModel()->insert(Cart::TABLE, $data);

            }else{
                $cart = $cart[0];
                $data = [
                    'quantity'=>$cart['quantity']+1,
                    'updated_at' => date('y-m-d h:i:s')
                ];
                $result = Cart::getModel()->update(Cart::TABLE, $data)
                                          ->where('`trends_id` = ? and `create_user` = ?',[$trend['id'], Auth::user()['id']])
                                          ->end();
            }
            if(!$result){
                $data  =[
                    'status' => 0,
                    'msg' => k('add_cart_success')
                ];
            }else
                abort('500');
        }
        echo json_encode($data);
    }


}