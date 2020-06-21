<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:54
 */

//namespace app\Http\Controller;

use handler\Handler;
use App\Http\Model\Trends;
use App\Http\Model\Users;

class MyTrendsController extends Handler
{
    public function __construct()
    {
        if(auth()){
            self::redirect('login');
        }
    }
    public function trendsDelete()
    {
        $id = json_decode(self::POST('id'));
        if(is_array($id))
        {
            //是数组
            $success = 0;
            $fail = 0;
            foreach ($id as $value)
            {
                if(Trends::deleteT($value))
                {
                    $success++;
                }else{
                    $fail++;
                }
            }
            $data  =[
                'status' => 0,
                'msg' => '删除成功 '.$success.' 个，删除失败 '.$fail.' 个。'
            ];
        }else{
            $trends = Trends::query()->where('`id` = ?', $id)->fetch();
            if(Trends::deleteT($id))
            {
                $data = [
                    'status' => 0,
                    'msg' => '内容删除成功!',
                ];
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '内容删除失败!',
                ];
            }
        }
        echo json_encode($data);
    }


}