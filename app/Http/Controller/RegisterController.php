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

class RegisterController extends Handler
{
    public function index()
    {
        return view('auth/register');
    }

    public function register()
    {
        $errors = [];
        if(self::POST('email') == '' || !is_email(self::POST('email')) || strlen(self::POST('email'))>50)
        {
            array_push($errors, k('email_error_format'));
        }else{
            if(self::POST('name') == '' || strlen(self::POST('name')) > 15)
            {
                array_push($errors, k('name_error_format'));
            }else{
                if(self::POST('password') != '' && self::POST('confirm_password') != ''
                    && (self::POST('confirm_password') === self::POST('password')))
                {
                    if(Auth::create(self::POST('email'), self::POST('name'), self::POST('password')))
                    {
                        array_push($errors, k('register_complete'));
                    }else{
                        array_push($errors, k('register_error'));
                    }
                }else{
                    array_push($errors, k('name_error_format'));
                }

            }
        }
        return view('auth/register', ['errors' => $errors]);
    }
}