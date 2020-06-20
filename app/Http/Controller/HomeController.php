<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:54
 */

//namespace app\Http\Controller;

use handler\Handler;

class HomeController extends Handler
{
    public function index()
    {

        return self::redirect('/home');
    }

    public function home()
    {
        return view('index');
    }
}