<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsStatic;

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

        $data=[
            'ip'=>$ip,       //ip
            'ua'=>$ua,         //浏览器标识
            'goods_id'=>$goods_id    //商品id
        ];
        // dd($data);

        GoodsStatic::insert($data);

        return view('goods/goodslist',['goods'=>$goods]);
    }
}
