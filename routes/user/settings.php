<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| 各種設定　処理　SettingsController
|--------------------------------------------------------------------------
*/
Route::middleware(['user_auth'])->group(function () {

    # プロフィール・設定変更 表示(settings)
    Route::get('/mypage/settings', [Controllers\SettingsController::class, 'settings'])
    ->name('settings');


    # プロフィールの変更(update_user_profile)
    Route::post('/mypage/settings/update_user_profile', [Controllers\SettingsController::class,'update_user_profile'])
    ->name('update_user_profile');


    # メールアドレスの変更(update_user_email)
    Route::post('/mypage/settings/update_user_email', [Controllers\SettingsController::class,'update_user_email'])
    ->name('update_user_email');

    # メール受信設定の変更(email_setting)
    Route::post('/mypage/settings/email_setting', [Controllers\SettingsController::class,'email_setting'])
    ->name('email_setting');


    # 退会前アンケートフォーム(withdrawal_form)
    Route::get('/mypage/withdrawal_form', function(){ return view('user_auth.withdrawal_form'); })
    ->name('withdrawal_form');


});//end middleware
//
