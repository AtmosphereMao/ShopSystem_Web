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

class MyInfoController extends Handler
{
    public function index()
    {
        return view('myinfo/myinfo');
    }
    public function edit()
    {
        return view('myinfo/edit');
    }
    public function save()
    {
        $msg = [];
        if(self::POST('name') == '' || strlen(self::POST('name')) > 15)
        {
            array_push($msg, k('name_error_format'));
        }else {
            $data = [
                'name' => self::POST('name')
            ];
            $result = Users::getModel()->update(Users::TABLE, $data)->where('`id` = ?', Auth::user()['id'])->end();
            if (!$result) {
                array_push($msg, k('save_complete'));
            } else {
                array_push($msg, k('save_error'));
            }
        }
        return view('myinfo/edit', ['msg' => $msg]);
    }

    public function reset()
    {
        return view('myinfo/reset');
    }

    public function resetPassword()
    {
        $msg = [];
        /* 表单判断 */
        if(password_verify(self::POST('password_old'), Auth::user()['password'])
            || self::POST('password') === self::POST('password_confirmation'))
        {
            $data = [
                'password' => password_hash(self::POST('password'),PASSWORD_DEFAULT)
            ];
            $result = Users::getModel()->update(Users::TABLE, $data)->where('`id` = ?', Auth::user()['id'])->end();
            if (!$result) {
                array_push($msg, k('save_complete'));
            } else {
                array_push($msg, k('save_error'));
            }
        }else{
            array_push($msg, k('reset_error'));
        }
        return view('myinfo/reset', ['msg' => $msg]);

    }

}