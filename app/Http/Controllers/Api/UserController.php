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


    public function weather(){
        $city=$_GET['city'];
        // https://free-api.heweather.com/s6/weather/forecast?location=CN101010100&key=XXXXXXXX";
        $url='https://free-api.heweather.com/s6/weather/forecast?location='.$city.'&key=b7866e916696476b8e04239d77e6a008';
        $weather=file_get_contents($url);
        $arr=json_decode($weather,true);
        dd($arr);


    }
}
