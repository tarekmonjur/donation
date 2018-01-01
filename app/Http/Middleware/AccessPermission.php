<?php

namespace App\Http\Middleware;

use Closure;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $url = \Request::segment(1);
        $url2 =\Request::segment(2);
        if($url2){
            if($url2 == "show" || $url2 == "add" || $url2 == "edit" || $url2 == "delete") {
                $url .= '/' . $url2;
            }
        }

        if(!canAccess($url)){
            return response()->view('errors.500');
        }
        return $next($request);
    }
}
