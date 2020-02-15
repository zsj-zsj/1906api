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

        $ch = curl_init($url);  //初始化   1
        curl_setopt($ch, CURLOPT_HEADER, 0);  //设置参数选项  2
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  //  2
        $response=curl_exec($ch);     //执行会话   3
        curl_close($ch);    //关闭会话   4
        
        $arr=json_decode($response,true);
        dd($arr);

    }

    //curl  POST
    public function curlPost(){
        
        $token='30_XCg_HQ7KEHZwL32a3IeeCSscd9Yon0pzcfVEGREV6lU_qJ4m_LnGt9R2z3835iK9AiLSvdR0l-H3lIjyFey0pnc2QFl0WfIil-5d1i80sbUajvL2dkSL8AbePc-bENg_zKA5GLPSqZZXYV_2XBEaACAKOR';
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
        $ticket=[
            'expire_seconds'=>'604800',
            'action_name'=>'QR_STR_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_str'=>'test'
                ]
            ]
        ];

        $ch=curl_init($url);    //初始化
        curl_setopt($ch, CURLOPT_HEADER, 0);  //设置参数选项  2
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); //0启用浏览器输出 1 关闭浏览器输出，可用变量接收响应
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($ticket));

        $response=curl_exec($ch);   //执行

        //处理报错
        // $errno=curl_errno($ch);    //错误码
        // $error=curl_error($ch);    //错误信息

        curl_close($ch);  //关闭

        $arr=json_decode($response,true);
        // dd($arr);

        //转二维码
        $tickets=UrlEncode($arr['ticket']);
        $urls='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tickets;
        // $file=file_get_contents($urls);
        return redirect($urls);
        
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

    //Guzzle  post
    public function GuzzlePost(){
        $token='30_XCg_HQ7KEHZwL32a3IeeCSscd9Yon0pzcfVEGREV6lU_qJ4m_LnGt9R2z3835iK9AiLSvdR0l-H3lIjyFey0pnc2QFl0WfIil-5d1i80sbUajvL2dkSL8AbePc-bENg_zKA5GLPSqZZXYV_2XBEaACAKOR';
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
        $ticket=[
            'expire_seconds'=>'604800',
            'action_name'=>'QR_STR_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_str'=>'test'
                ]
            ]
        ];


        $client = new Client();
        $response =$client->request('POST',$url,[
            'body'=>json_encode($ticket,JSON_UNESCAPED_UNICODE),
        ]);
        $t=$response->getBody();
        $arr=json_decode($t,true);
        // dd($arr);
        
        //转二维码
        $tickets=UrlEncode($arr['ticket']);
        $urls='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tickets;
        // $file=file_get_contents($urls);
        return redirect($urls);

    }



    public function post1(){
        dump($_POST);
    }

    public function post2(){
        print_r($_POST);
    }

    public function post3(){
        echo "aaaa";  
        $data=file_get_contents("php://input");
        $arr=json_decode($data,true);
        dump($arr);
        echo "aaaa";   
    }

    public function upload(){
        print_r($_POST);
        echo "<br>";
        print_r($_FILES);
    }

    public function guzzleget(){
        print_r($_GET);
    }

    public function guzzlepost1(){
        print_r($_POST);
    }

    public function guzzleupload(){
        print_r($_POST);

        print_r($_FILES);
    }

    public function guzzlejson(){
        $data=file_get_contents("php://input");
        $arr=json_decode($data,true);
        dump($arr);
    }
}
