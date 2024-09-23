<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatusUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check() ){
            flash()->error('Vui lòng đăng nhập hệ thống');
            return redirect()->route('index');
        }elseif(Auth::user()->status==0 && Auth::user()->role==0){
            Auth::logout();
            flash()->error('Tài khoản chưa được kích hoạt');
            return redirect()->route('index');
        }
        return $next($request);
    }

}
