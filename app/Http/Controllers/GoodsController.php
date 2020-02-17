<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsStatic;

use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function index(){
        $goods=GoodsModel::get();
        return view('goods/index',['goods'=>$goods]);
    }


    public function goodslist(Request $request){
        $goods_id=$request->goods_id;
        $goods=GoodsModel::where('goods_id','=',$goods_id)->get();
        
        $ip=$_SERVER['REMOTE_ADDR'];
        $ua=$_SERVER['HTTP_USER_AGENT'];
        // $host=$_SERVER['HTTP_HOST'];
        // $url=$_SERVER['REQUEST_URI'];     
        // $http=$_SERVER['REQUEST_SCHEME'];
        // $a=$http.'://'.$host.$url;
        // echo $a;die;
        $data=[
            'ip'=>$ip,       //ip
            'ua'=>$ua,         //浏览器标识
            'goods_id'=>$goods_id    //商品id
        ];
        // dd($data);
        // print_r($_SERVER);die;
        GoodsStatic::insert($data);

        $pv=GoodsStatic::where('goods_id','=',$goods_id)->count();
        echo "pv：".$pv;
        echo "<br>";
        $uv=GoodsStatic::where('goods_id','=',$goods_id)->distinct('ua')->count('ua');  //去重
        echo "pv：".$uv;

        return view('goods/goodslist',['goods'=>$goods]);
    }


    public function brand(Request $request){
        $key="incr";
        Redis::incr($key);  //存
        $get=Redis::get($key);   //取
        echo "刷新次数：".$get;echo "<br>";
        // $time=Redis::ttl($key);
        if($get>=10){
            echo "禁止频繁刷新";
            Redis::expire($key,10);die;  //过期时间
        }

        $goods_id=$request->goods_id;

        $goods_key='str:goods:info:'.$goods_id;
        echo "redis的key：".$goods_key;echo "<br>";

        $cache=Redis::get($goods_key);    //取值

        if($cache){
            echo "有缓存";echo "<br>";
            $cache_goods=json_decode($cache,true);
            echo "<pre>";print_r($cache_goods); echo "</pre>";
        }else{
            echo "无缓存";
            $goods=GoodsModel::where('goods_id','=',$goods_id)->first()->toArray();
            $goods_json=json_encode($goods);
            Redis::set($goods_key,$goods_json); //存
            Redis::expire($goods_key,60);              //过期时间   
            echo "<pre>";print_r($goods);echo "</pre>";
        }
    }
}
