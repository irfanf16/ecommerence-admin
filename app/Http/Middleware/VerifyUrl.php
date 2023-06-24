<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(config('url')){
            $url = explode( ':/',config('url') );

            if(env('APP_ENV') != 'local'){
                if($url[0] == 'https'){
                    return response()->json([
                        'status'    => 500,
                        'message'   => 'Api URL Protocol Mis-match'
                    ]);
                }

            }
        }


        return $next($request);
    }
}