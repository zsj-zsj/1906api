<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AliController extends Controller
{
    public function alitest(){
        $url='https://openapi.alipaydev.com/gateway.do';

        $common_param=[
            'out_trade_no'=>'1906ali_'.rand('1111',9999),
            'product_code'=>'FAST_INSTANT_TRADE_PAY',
            'total_amount'=>'88.88',
            'subject'=>'测试支付'.rand(11111,99999)
        ];

        $pub_param=[
            'app_id'=>'2016101300673073',
            'method'=>'alipay.trade.page.pay',
            'charset'=>'utf-8',
            'sign_type'=>'RSA2',
            'timestamp'=>date('Y-m-d H:i:s'),
            'version'=>'1.0',
            'biz_content'=>json_encode($common_param,JSON_UNESCAPED_UNICODE) 
        ];
        $param=array_merge($common_param,$pub_param);  //合并数组
        // 1.将签名  ASCII码递增排序
        ksort($param);   //字典顺序排序

        // 2 拼接 url
        $str='';
        foreach ($param as $k=>$v){
            $str.=$k.'='.$v.'&';
        }
        $str=rtrim($str,'&');
        $request_url=$url.'?'.$str;

        // 3. 算签名
        // $keys=openssl_pkey_get_private('file://'.storage_path('keys/priv_alime.key'));
        $keys=file_get_contents(storage_path('keys/priv_alime.key'));

        $res = openssl_get_privatekey($keys);

        openssl_sign($str,$sign,$res,OPENSSL_ALGO_SHA256);
        $sign=base64_encode($sign);

        $urls=$request_url.'&sign='.urlencode($sign);
        // echo $urls;
        
        header('Location:'.$urls);
        

    }
}
