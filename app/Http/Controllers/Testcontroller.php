<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    //redis 测试
    public function testredis(){
        $key ="1906";
        // $val="hello world";
        $val=time();
        Redis::set($key,$val);    //set 设置一个 键 并赋值
        $value=Redis::get($key);  //获取 key 的值
        echo 'value:'.$value;     //  展示  这个值
    }

    //file_get_contents   GET方式
    public  function file_get_contents(){
        $Appid='wx8bc80f5949fda528';
        $appsecret='f4852897a0b441624d7c845c878f2548';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$Appid.'&secret='.$appsecret;
        // echo $url;
        $json=file_get_contents($url);
        $arr=json_decode($json,true);
        dd($arr);
    }

    //CURL   get
    public function curl(){
        $Appid='wx8bc80f5949fda528';
        $appsecret='f4852897a0b441624d7c845c878f2548';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$Appid.'&secret='.$appsecret;

        $ch = curl_init($url);  //初始化
        curl_setopt($ch, CURLOPT_HEADER, 0);  //设置参数选项
        curl_exec($ch);     //执行会话
        curl_close($ch);    //关闭会话

    }

    //Guzzle
    public function Guzzle(){
        $Appid='wx8bc80f5949fda528';
        $appsecret='f4852897a0b441624d7c845c878f2548';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$Appid.'&secret='.$appsecret;

        $client = new Client();
        $response =$client->request('GET',$url);
        $data =$response->getBody();

        $arr=json_decode($data,true);
        dd($arr);
        // echo $data;

    }
}
