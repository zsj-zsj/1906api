<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller
{
    //获取用户信息
    public function info(){
        $user_info=[
            'name'=>'张三',
            'age'=>10,
            'sex'=>1,
            'time'=>date('Y-m-d H:i:s'),
        ];
        return $user_info;
    }

    //注册入库 
    public function reg(Request $request){
        $user_info=[
            'user_name'=>$request->input('user_name'),
            'email'=>$request->input('email'),
            'pass'=>$request->input('pass')
        ];

        // $res=UserModel::create($user_info)->toArray();
        // print_r($res);

        $res=UserModel::insertGetId($user_info);
        echo "自增___".$res;
        

    }
}
