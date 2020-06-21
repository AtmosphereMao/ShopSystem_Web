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

    public function publish()
    {
        return view('myinfo/publish', ['msg'=>[]]);
    }

    public function trendsPublish()
    {
        $input = [
            'title' => self::POST('title'),
            'content' => self::POST('content_summernote'),
            'backbone' => self::POST('backbone'),
            'price'   => self::POST('price'),
            'quantity' => self::POST('quantity'),
            'create_user' => Auth::user()['id'],
            'status' => 0,
            'created_at' => date('y-m-d h:i:s'),
            'updated_at' => date('y-m-d h:i:s')
        ];
        $pass = true;
        $msg = [];
        // 简易粗糙验证器
        if($input['title']== ''){array_push($msg, k('title.required'));$pass = false;}
        if($input['content']== ''){array_push($msg,k('content.required'));$pass = false;}
        if($input['backbone']== ''){array_push($msg,k('backbone.required'));$pass = false;}
        if($input['price']== ''){array_push($msg,k('price.required'));$pass = false;}
        if($input['quantity']== ''){array_push($msg,k('quantity.required'));$pass = false;}
        if(strlen($input['title']) > 25){array_push($msg,k('title.max'));$pass = false;}
        if(strlen($input['backbone']) > 60){array_push($msg,k('backbone.max'));$pass = false;}
        if(strlen($input['price']) > 11){array_push($msg,k('price.max'));$pass = false;}
        if(strlen($input['quantity']) > 4){array_push($msg,k('quantity.max'));$pass = false;}

        /* 生成页面ID */
        if($pass)
        {
            do{
                $page_id = rand(10000000, 99999999);
                $trends = Trends::query()->where('`page_id` = ?', $page_id)->fetch();
            }while (!empty($trends));
            $input['page_id'] = $page_id;
            $result = Trends::create($input);
            if(!$result)
                array_push($msg, k('publish_success'));
            else
                array_push($msg, k('publish_error'));
        }
        return view('myinfo/publish', ['msg' => $msg]);

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

    public function edit(){
        $trend = Trends::query()->where('`page_id` = ? and `create_user` = ?', [self::GET('page_id'),Auth::user()['id']])->fetch();
        if(empty($trend))
            abort('404');
        return view('myinfo/update', ['trend' => $trend[0], 'msg' => [], 'redirect' => false]);
    }

    public function trendsEdit(){
        $trend = Trends::query()->where('`page_id` = ? and `create_user` = ?', [self::GET('page_id'), Auth::user()['id']])->fetch();
        if(empty($trend))
            abort('404');
        $input = [
            'title' => self::POST('title'),
            'content' => self::POST('content_summernote'),
            'backbone' => self::POST('backbone'),
            'quantity' => self::POST('quantity'),
            'create_user' => Auth::user()['id'],
            'updated_at' => date('y-m-d h:i:s')
        ];
        $pass = true;
        $msg = [];
        // 简易粗糙验证器
        if($input['title']== ''){array_push($msg, k('title.required'));$pass = false;}
        if($input['content']== ''){array_push($msg,k('content.required'));$pass = false;}
        if($input['backbone']== ''){array_push($msg,k('backbone.required'));$pass = false;}
        if($input['quantity']== ''){array_push($msg,k('quantity.required'));$pass = false;}
        if(strlen($input['title']) > 25){array_push($msg,k('title.max'));$pass = false;}
        if(strlen($input['backbone']) > 60){array_push($msg,k('backbone.max'));$pass = false;}
        if(strlen($input['quantity']) > 4){array_push($msg,k('quantity.max'));$pass = false;}

        if($pass)
        {
            $result = Trends::update($input, '`page_id` = ? and `create_user` = ?', [self::GET('page_id'), Auth::user()['id']]);
            if(!$result)
            {
                array_push($msg, k('save_complete'));
                $pass = true;
            }
            else
                array_push($msg, k('save_error'));

            $trend = Trends::query()->where('`page_id` = ? and `create_user` = ?', [self::GET('page_id'), Auth::user()['id']])->fetch();
        }
        return view('myinfo/update', ['msg' => $msg, 'trend'=>$trend[0], 'redirect'=>$pass]);

    }

    public function imageUpload() {
        $file =  $_FILES['fileData'];
        if ($file == null) {
            return "Error";
        }
        if ($file['error'] == 0) {
//                $realPath = $file->getRealPath();
            $entension = explode(".", $file["name"])[1];//文件名后缀
//                $originalName = $file->getClientOriginalName(); // 文件原名
            $path_part = date('YmdHis').mt_rand(100,999);
            move_uploaded_file($file['tmp_name'], "uploads/information/" . $path_part.".".$entension);

            echo json_encode([
                'filename' => asset('uploads/information/'.$path_part.".".$entension)]);
            return;
        }
        echo "Error";
    }

}