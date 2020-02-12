<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    public function testredis(){
        $key ="1906";
        // $val="hello world";
        $val=time();
        Redis::set($key,$val);    //set 设置一个 键 并赋值
        $value=Redis::get($key);  //获取 key 的值
        echo 'value:'.$value;     //  展示  这个值
    }
}
