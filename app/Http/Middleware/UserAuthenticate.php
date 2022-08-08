<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| 求職者(worker)認証チェックミドルウェア―
|--------------------------------------------------------------------------
*/

class UserAuthenticate
{
    /**
     * ログインしていないとき、「ログインが必要です」ページへリダイレクト
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        {
            if ( !Auth::check() )
            {
                # 前ページのURLをセッションに保存
                $before_url = $request->path();
                $request->session()->put( 'before_url', $before_url);


                # 「ログインが必要です」ページへリダイレクト
                return redirect()->route('user_auth.require_login');
            }


            return $next($request);
        }
        }
}
