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
    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
        static::$users = Model::getModel($this->table);
    }

    /**
     * 获取 Users
     * @return Model
     */
    public static function getUserModel()
    {
        return Model::getModel()->select('users');
    }

    /**
     * 获取当前用户
     * @return mixed
     */
    public static function user()
    {
        return static::getUserModel()->where('`id` = ?', $_SESSION['loginsession'])->fetch()[0];
    }

    /**
     * 用户登录
     * @param $email
     * @param $password
     * @return bool
     */
    public static function verify($email, $password)
    {
        $users = static::getUserModel()->where('`email` = ?', $email)->fetch();
        if(empty($users)){
            return false;
        }else{
            $users = $users[0];
        }
        /* 密码hash对比 */
        if(!password_verify($password, $users['password']))
        {
            return false;
        }
        setcookie('logincookie',$users['name']);
        $_SESSION["loginsession"]=$users['id'];
        return true;

    }

    public static function create($email, $name, $password)
    {
        $users = static::getUserModel()->where('`email` = ?', $email)->fetch();
        if(!empty($users)){
            return false;
        }
        $password = password_hash($password,PASSWORD_DEFAULT);
        $data = [
            'email' => $email,
            'name'  => $name,
            'password' => $password,
            'created_at' => date('y-m-d h:i:s'),
            'updated_at' => date('y-m-d h:i:s'),
            'balance'   => 0
        ];
        $result = Model::getModel()->insert('users', $data);
        return !$result ? true : abort('500');

    }

}
