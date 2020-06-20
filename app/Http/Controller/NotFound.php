<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 22:01
 */

class NotFound
{
    public function index()
    {
        abort('404');
    }
}