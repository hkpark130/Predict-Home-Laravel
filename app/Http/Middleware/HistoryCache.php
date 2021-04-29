<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class HistoryCache
{
    public function handle($request, Closure $next)
    {
        $md5_key = md5(json_encode($request->all()));
        $res = $next($request); // 컨트롤러 먼저 실행 (레디스 셋하기위해)

        $transition_url = $request->getPathInfo();
        $post_data = $request->all();
        $date = date("Y-m-d_H:i:s");

        if($transition_url == '/house') {
            $history = array(
                'md5_key' => $md5_key,
                'value' => $post_data["value"],
                'date' => $date,
            );

            Redis::hmSet($history['md5_key'], $history);
            Redis::expire($history['md5_key'], 500);
        }
        // else if ('/bot'){ ~ }

        return $res;
    }
}
