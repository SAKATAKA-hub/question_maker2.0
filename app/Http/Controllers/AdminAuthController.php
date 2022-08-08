<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * =========================================
 *  管理者ログイン機能　コントローラー
 * =========================================
*/
class AdminAuthController extends Controller
{
    /**
     * ログイン処理(login)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function login(Request $request)
    {
        // dd( $request->all() );

        // ログイン成功の処理
        $credentials = $request->only('email','password');


        if (Auth::attempt($credentials)) { //ログイン成功のチェック

            # ユーザー情報をセッションに保存
            $user = Auth::user()->id;
            $request->session()->regenerate();

            # ログイン記録の保存
            $login_record = new \App\Models\LoginRecord(['user_id' => Auth::user()->id,]);
            $login_record->save();



            return redirect()->route('admin.top');
        }

        // ログイン失敗の処理
        return back()->with('login_error','メールアドレスかパスワードが違います。');

    }




    /**
     * ログアウト処理(logout)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout(); //ユーザーセッションの削除

        $request->session()->invalidate(); //全セッションの削除

        $request->session()->regenerateToken(); //セッションの再作成(二重送信の防止)


        return redirect()->route('login_form',$user);
    }




}
