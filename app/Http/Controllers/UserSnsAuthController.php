<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/*
| =================================
|  ユーザー SNS認証
| =================================
*/
class UserSnsAuthController extends Controller
{

    /**
     * ログインページリダイレクト(google_redirect)
     *
     * @return Redirect
    */
    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();

        return 'google_redirect';
    }


    /**
     * Googleログイン処理(google_callback)
     *
     * @return Redirect
    */
    public function google_callback(Request $request)
    {
        # 設定（ログイン後にリダイレクトするルーティング名）
        $route_after_login = 'mypage';


        # ログイン情報の取得
        $google_user = Socialite::driver('google')->user();
        $google_id = $google_user->id;


        # user2(メールアドレス登録済み・GoogleID未登録)
        $update_user = \App\Models\User::where('email',$google_user->email)->first();

        # user1(GoogleID登録済み)
        $user = \App\Models\User::where('google_id',$google_id)->first();


        #1 GoogleID登録済み
        if($user){
            // dd($user);
            /* 処理なし */
        }
        #2 [更新登録] メールアドレス登録済み・GoogleID未登録
        elseif($update_user){

            // dd('更新');
            $update_user->update([ 'google_id' => $google_id ]);
            $user = $update_user;
        }
        #3 [新規登録] メール・GoogleID未登録
        else{

            // dd('新規登録');
            // ユーザー情報[新規登録]
            $user = new \App\Models\User([
                'google_id'=> $google_id,
                'name'     => $google_user->name,
                'email'    => $google_user->email,
                'password' => Hash::make( Str::random(10) ),
                'key'      => Str::random(40)
            ]);
            $user->save();
            $request->session()->regenerateToken(); //二重投稿防止


            // ユーザー設定[新規登録]
            $mail_setting = new  \App\Models\MailSetting([ 'user_id' => $user->id]);
            $mail_setting->save();


            # メールの送信
            Mail::to( $user->email ) //宛先
            ->send(new \App\Mail\SendMailMailable([
                'inputs' => $user , //入力変数
                'view' => 'emails.user_register_completion' , //テンプレート
                'subject' => '【'.env('APP_NAME').'】会員登録ありがとうございます' , //件名
            ]) );

        }


        # ログイン
        Auth::Login($user);


        # リダイレクト
        if(session('before_url'))
        {
            # ログイン前に訪れたページがある場合、前のページに戻る
            return redirect( session('before_url') );
        }
        else{
            # マイページTOPへリダイレクト
            return redirect()->route( $route_after_login )
            ->with('alert-success','ログインしました。');
        }











        dd($user);
        return 'google_callback';

        // $user = new \App\Models\User([
        //     'name'     => 'さかい　たかひろ',
        //     'email'    => 'aek1214@yahoo.co.jp',
        //     'password' => Hash::make('password'),
        //     'image'    => 'site/image/sakai.png',
        //     'key'      =>\Illuminate\Support\Str::random(40)
        // ]);
        // $user->save();
        // $mail_setting = new  \App\Models\MailSetting([ 'user_id' => $user->id]);
        // $mail_setting->save();

    }

}
