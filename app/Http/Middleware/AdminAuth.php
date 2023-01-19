<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| 管理者(admin)認証チェックミドルウェア―
|--------------------------------------------------------------------------
*/
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            # 管理者アカウントでログイン中ではないとき
            !( Auth::check() && Auth::user()->email === env('APP_ADMIN_EMAIL') )
        )
        {
            return \App::abort(404);
        }


        return $next($request);
    }
}
