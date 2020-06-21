<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/21
 * Time: 14:31
 */


use handler\Handler;
use App\Http\Model\Trends;
use App\Http\Model\Cart;

class OrderController extends Handler
{
    public function index()
    {
        return self::redirect('/home');
    }

}