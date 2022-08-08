<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
/*
| =================================
|  認証・登録・パスワード変更
| =================================
*/
class UserAuthController extends Controller
{
    /*
    | ---------------------------------
    |   ユーザー認証
    | ---------------------------------
    */
        /**
         * ログイン処理(login)
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\View\View
        */
        public function login( Request $request )
        {

            # 設定（ログイン後にリダイレクトするルーティング名）
            $route_after_login = 'home';


            # [ アカウントとパスワードの照合チェック ] -------

                # エラーカウントのチェック
                $max_count = 3; //エラーの最大値
                $frozen_min = 15; //アクセス停止時間
                if(
                    $user = \App\Models\User::where('email',$request->email)->first()
                ){

                    //. $frozen_min分後であれば、カウントリセット
                    $date_ob01 = \Carbon\Carbon::parse($user->updated_at); //最終ログイン入力時間
                    $date_ob02 = \Carbon\Carbon::parse('now');
                    $diff_min = $date_ob01->diffInMinutes($date_ob02); //現在時刻との時間差異
                    if( $diff_min > $frozen_min ){ $user->update(['error_count' => 0]); } //カウントリセット


                    //. エラーカウントの最大値を超える時、ログインフォームへリダイレクト
                    if( $user->error_count >= $max_count ){
                        return back()->with('login_error','アカウントにロックがかかりました。約15分後にロックが解除されます。');
                    }
                }


                # ログイン成功処理（求職者のアカウントが照合された時）
                Auth::attempt( $request->only('email','password'), $request->remember );



                if( Auth::check() )
                {
                    # ユーザー情報をセッションに保存
                    $request->session()->regenerate();

                    # ログイン履歴の保存
                    $login_record = new \App\Models\LoginRecord(['user_id' => Auth::user()->id,]);
                    $login_record->save();

                    # ログインエラーカウントのリセット
                    $user->update(['error_count' => 0]);

                    # ログイン前に訪れたページがある場合、前のページに戻る
                    if(session('before_url'))
                    {
                        return redirect( session('before_url') );
                    }


                    // マイページTOPへリダイレクト
                    return redirect()->route( $route_after_login )
                    ->with('alert-success','ログインしました。');

                }


            # [ ログイン失敗の処理 ] -------

                // エラーカウントの加算
                if( isset($user) ){$user->update(['error_count' => $user->error_count + 1]);}

                // エラーメッセージの作成
                $message = '';
                if( Auth::check() ){
                    $message = 'このメールアドレスは利用できません。';//管理者アカウント
                }
                if( \App\Models\User::where('email',$request->email)->first() ){
                    $message = 'パスワードが間違っています。3回入力に失敗すると、しばらくログインできなくなります。';
                }
                else{
                    $message = 'このメールアドレスは登録されていません。';
                }

                // ログインフォームへ戻る
                return back()->with('login_error',$message);

            //
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


            # ログアウト完了ページへリダイレクト
            return view('user_auth.completed_logout');

            # 前のページへリダイレクト
            return back()->with('alert-warning','ログアウトしました。');
        }


    /*
    | ---------------------------------
    |   ユーザー登録
    | ---------------------------------
    */
        /**
         *  登録済メールアドレスか確認するAPI(email_unique_api)
         *
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function email_unique_api( Request $request)
        {
            $user = \App\Models\User::where( 'email', $request->email )->first();

            # JSONレスポンス
            return response()->json([
                'email_ique' => $user ? true : false,
            ]);
        }



        /**
         * ユーザー登録API(register_api)
         *
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function register_api( Request $request)
        {
            # ユーザー登録
            $user = new \App\Models\User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make( $request->password ),
            ]);
            $user->save();


            # JSONレスポンス
            return response()->json([
                'message' => 'register ok!',
                // 'inputs' => $request->all(),
            ]);
        }


    /*
    | ---------------------------------
    |   パスワード変更
    | ---------------------------------
    */
        #
        /**
         * パスワードリセット ステップ01(reset_pass_step01_api)
         *
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function reset_pass_step01_api( Request $request)
        {
            /* 求職者として登録されているメールアカウントが存在するとき */
            $user = \App\Models\User::where('email', $request->email)->first();

            if( $user )
            {
                # 認証コードの保存
                $reset_pass_code = '';
                for ($i=0; $i < 6; $i++) {
                    $rand = mt_rand(1,9);
                    $reset_pass_code = $reset_pass_code.$rand;
                }
                $user->reset_pass_code = $reset_pass_code;
                $user->save();//DBへ保存


                # 認証コードのメール送信
                Mail::to( $request->email ) //宛先
                ->send(new \App\Mail\SendMailMailable([
                    'inputs' => ['reset_pass_code' => $reset_pass_code] , //入力変数
                    'view' => 'emails.worker_reset_pass01_verification' , //テンプレート
                    'subject' => '【'.env('APP_NAME').'】パスワード変更認証コード' , //件名
                ]) );



                # バリデーション成功レスポンス
                return response()->json([
                    'message' => 'validation ok!',
                ]);

            }

            /* アカウントが存在しないとき */
            # エラーJSONデータを返す
            return response()->json([
                // 'input'  => $request->all(),
                'errors' => ['email' => 'このメールアドレスは登録されておりません。'], 400
            ]);

        }


        #
        /**
         * パスワードリセット ステップ02(reset_pass_step02_api)
         *
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function reset_pass_step02_api( Request $request)
        {
            # 入力データに、DBへ保存した認証コードを追加
            $user = \App\Models\User::where('email', $request->email)->first();
            $request_all = $request->all();
            $request_all['reset_pass_code_confirmation']  = $user->reset_pass_code;


            # 入力内容のバリデーション
            $rules = [
                'reset_pass_code' => ['required','confirmed'],
                'password' => ['required','confirmed','regex:/^[0-9a-zA-Z]{8,20}/','max:20'],
            ];
            $messages = [
                '*.required' => '入力されていません。',
                'reset_pass_code.confirmed' => '認証コードが正しくありません。',
                'password.confirmed' => '確認用パスワードと入力が異なります。',
                'password.regex' => '8文字以上20文字以下の半角英数字で入力して下さい。',
                'password.max' => '8文字以上20文字以下の半角英数字で入力して下さい。',
            ];
            $validator = Validator::make($request_all, $rules, $messages,);


            # バリデーションエラーレスポンス
            if( $validator->fails() )
            {
                return response()->json([
                    'input'  => $request->all(),
                    'errors' => $validator->errors(), 400
                ]);
            }


            # (バリデーション成功なら)パスワードを保存
            $user->update([ 'password' => Hash::make( $request->password ) ]);


            # 完了メールの送信
            Mail::to( $request->email ) //宛先
            ->send(new \App\Mail\SendMailMailable([
                'inputs' => $request , //入力変数
                'view' => 'emails.worker_reset_pass02_completion' , //テンプレート
                'subject' => '【'.env('APP_NAME').'】パスワード変更が完了いたしました' , //件名
            ]) );


            # バリデーション成功レスポンス
            return response()->json([
                'message' => 'validation ok!',
            ]);


        }


    //
    /**
     * 退会処理(destroy)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function destroy( Request $request)
    {

    }
}
