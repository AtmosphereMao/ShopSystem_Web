<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/20
 * Time: 13:04
 */


use handler\Handler;
use core\Model;


class Auth extends Handler
{
    private static $users;
    public function __construct()
    {
        parent::__construct();
        static::$users = Model::getModel('users');
    }

    /**
     * 获取 Users
     * @return Model
     */
    public static function getUserModel()
    {
        return Model::getModel('users');
    }

    /**
     * 获取当前用户
     * @return mixed
     */
    public static function user()
    {
        return static::getUserModel()->where('`id` = ?', $_SESSION['loginsession'])->fetch()[0];
    }
}
