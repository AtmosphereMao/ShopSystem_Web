<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:54
 */

//namespace app\Http\Controller;

use handler\Handler;
use App\Http\Model\Users;

class LoginController extends Handler
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $errors = [];
        if(self::POST('email') == '' || !is_email(self::POST('email')) || strlen(self::POST('email'))>50)
        {
            array_push($errors, k('email_error_format'));
        }else{
            if(Auth::verify(self::POST('email'), self::POST('password')))
                self::redirect(asset(''));  /* 登录成功 */
            else
                array_push($errors, k('login_error'));
        }

        return view('auth/login', ['errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['loginsession']);
        setcookie('logincookie',"");
        self::redirect(asset(''));
    }
}