<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:54
 */

//namespace app\Http\Controller;

use handler\Handler;
use core\Auth;

class HomeController extends Handler
{
    public function index()
    {
        view('layouts/header');
//        view('index');
    }
}