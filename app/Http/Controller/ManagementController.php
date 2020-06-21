<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/21
 * Time: 15:14
 */


use handler\Handler;
use App\Http\Model\Trends;
use App\Http\Model\Cart;
use App\Http\Model\Order;
use App\Http\Model\Users;

class ManagementController extends Handler
{
    public function index()
    {
        $orders = Order::query()->where('`owner_user` = ?', Auth::user()['id'])
            ->orderBy('status','desc')
            ->page(self::GET('page') ? (self::GET('page')-1) * 6 : 0 ,6)
            ->fetch();
        if(self::GET('page') > 1)
            if(!empty($orders))
                return view('management/management_more', ['orders'=>$orders, 'count'=>self::GET('page')]);
            else
                return '';
        return view('management/management', ['orders'=>$orders]);
    }

    public function orderComplete()
    {
        $order = Order::query()->where('`owner_user` = ? and `id` = ? and `status` = ?',[Auth::user()['id'], self::POST('order_id'), 0])
                               ->fetch();
        if(empty($order))
        {
            $msg = [
                'status' => 1,
                'msg'    => k('complete_error_success')
            ];
        }else{
            $order = $order[0];
            $data = [
                'finished_quantity' => $order['finished_quantity'] +1,
                'updated_at' => date('y-m-d h:i:s')
            ];
            $result = Order::update($data, '`owner_user` = ? and `id` = ? and `status` = ?',[Auth::user()['id'], self::POST('order_id'), 0]);
            if(!$result)
            {
                $msg = [
                    'status' => 0,
                    'msg'    => k('complete_success')
                ];
            }else{
                $msg = [
                    'status' => 1,
                    'msg'    => k('complete_error')
                ];
            }
            $data = [
                'balance' => Auth::user()['balance'] + getTrends($order['trends_id'])['price'],
                'updated_at' => date('y-m-d h:i:s')
            ];
            $result = Users::update($data, '`id` = ?', Auth::user()['id']);
            if($order['finished_quantity']+1 == $order['quantity'])
            {
                $data = [
                    'status' => 1,
                    'updated_at' => date('y-m-d h:i:s')
                ];
                $result = Order::update($data, '`owner_user` = ? and `id` = ? and `status` = ?',[Auth::user()['id'], self::POST('order_id'), 0]);
            }
        }
        echo json_encode($msg);
    }

}