<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ApiFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //浏览器标识
        $ua=substr(md5($_SERVER['HTTP_USER_AGENT']),0,7);

        // //uri 路由
        $uri=substr(md5($_SERVER['REQUEST_URI']),0,5);

        $redis_key="count:uri:".$uri.$ua;

        $key=Redis::get($redis_key);
        // echo $key;
        if($key>=env('MaxCount')){
            echo "接着刷";
            Redis::expire($redis_key,10);
            die;
        }

        Redis::incr($redis_key);

        return $next($request);
    }

            // //浏览器标识
            // $ua=substr(md5($_SERVER['HTTP_USER_AGENT']),0,7);

            // // //uri 路由
            // $uri=substr(md5($_SERVER['REQUEST_URI']),0,5);
    
            // $redis_key="count:uri:".$uri.$ua;
            
            // Redis::expire($redis_key,20);
            // $key=Redis::get($redis_key);
            // // echo $key;
            // if($key<=env('MaxCount')){
            //     Redis::incr($redis_key);
            // }else{
            //     echo "接着刷";die;
            // }
}
