<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| 認証・登録・パスワード変更　(UserAuthController)
|--------------------------------------------------------------------------
*/

    /* ユーザー認証 */

        # ログイン方法選択ページ(login_form)
        Route::get('/user_auth/login_method_choosing', function () { return view('user_auth.login_method_choosing'); })
        ->name('user_auth.login_method_choosing');


        # ログイン画面の表示(login_form)
        Route::get('/user_auth/login_form', function () { return view('user_auth.login_form'); })
        ->name('user_auth.login_form');

        # ログイン処理(login)
        Route::post('/user_auth/login', [Controllers\UserAuthController::class, 'login'])
        ->name('user_auth.login');

        # ログアウト処理(logout)
        Route::get('/user_auth/logout', [Controllers\UserAuthController::class, 'logout'])
        ->name('user_auth.logout');

        # ログインが必要ですページ(require_login)　※ログイン前にログインが必要なページにアクセスした際に表示されるページ
        Route::get('/user_auth/require_login', function () { return view('user_auth.require_login'); })
        ->name('user_auth.require_login');



    /* google ユーザー認証 */

        # テスト
        Route::get('/user_auth/google', function(){ return view('test.sns_auth'); })
        ->name('user_auth.google');

        # Googleログインページリダイレクト(google_redirect)
        Route::get('/user_auth/google/redirect',
        [ \App\Http\Controllers\UserSnsAuthController::class, 'google_redirect'])
        ->name('user_auth.google.redirect');

        # Googleログイン処理(google_callback)
        Route::get('/user_auth/google/callback',
        [ \App\Http\Controllers\UserSnsAuthController::class, 'google_callback'])
        ->name('user_auth.google.callback');



    /* ユーザー登録 */

        # ユーザー登録画面の表示(register_form)
        Route::get('/user_auth/register_form', function(){ return view('user_auth.register_form' ); })
        ->name('user_auth.register_form');

        # ユーザー登録API(register_api)
        Route::post('/user_auth/register_api', [Controllers\UserAuthController::class, 'register_api'])
        ->name('user_auth.register_api');

        # 登録済メールアドレスか確認するAPI(email_unique_api)
        Route::post('/user_auth/email_unique_api', [Controllers\UserAuthController::class, 'email_unique_api'])
        ->name('user_auth.email_unique_api');


    /* パスワードリセット */

        # パスワードリセット画面の表示(reset_pass_form)
        Route::get('/user_auth/reset_pass_form', function () { return view('user_auth.reset_pass_form'); })
        ->name('user_auth.reset_pass_form');

        # パスワードリセット ステップ01(reset_pass_step01_api)
        Route::patch('/user_auth/reset_pass_step01_api', [Controllers\UserAuthController::class, 'reset_pass_step01_api'])
        ->name('user_auth.reset_pass_step01_api');

        # パスワードリセット ステップ02(reset_pass_step02_api)
        Route::patch('/user_auth/reset_pass_step02_api', [Controllers\UserAuthController::class, 'reset_pass_step02_api'])
        ->name('user_auth.reset_pass_step02_api');

    //

    # 退会処理(destroy)
    Route::delete('/user_auth/destroy', [Controllers\UserAuthController::class, 'destroy'])
    ->name('user_auth.destroy');



//
