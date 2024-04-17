<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| マイページ　処理　MyPageController
|--------------------------------------------------------------------------
*/

Route::middleware(['user_auth'])->group(function () {

    # マイページ[問題一覧](mypage) //->name('make_question_group.list');
    Route::get('/mypage',function(){ return redirect()->route('make_question_group.list'); })
    ->name('mypage');

    # 問題集を作る //->name('make_question_group.create');

    # いいねした問題集(like_list)
    Route::get('/mypage/like_list',[Controllers\MyPageController::class, 'like_list'])
    ->name('like_list');

    # 受検成績 //->name('results.list');

    # 通知(infomation_list)
    Route::get('/mypage/infomation_list',[Controllers\MyPageController::class, 'infomation_list'])
    ->name('infomation_list');

    # プロフィール・設定変更(settings) //->name('settings');

    # ログアウト//->name('user_auth.logout');

});//end middleware

//
