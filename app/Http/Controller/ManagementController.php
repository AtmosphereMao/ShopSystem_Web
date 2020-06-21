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

class ManagementController extends Handler
{
    public function index()
    {
        $orders = Order::query()->where('`create_user` = ?', Auth::user()['id'])
            ->orderBy('status','desc')
            ->page(self::GET('page') ? (self::GET('page')-1) * 6 : 0 ,6)
            ->fetch();
        if(self::GET('page') > 1)
            if(!empty($orders))
                return view('order/order_more', ['orders'=>$orders, 'count'=>self::GET('page')]);
            else
                return '';
        return view('order/order', ['orders'=>$orders]);
    }

}