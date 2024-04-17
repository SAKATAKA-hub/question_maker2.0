<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| クリエーターページ　処理　CreaterUserController
|--------------------------------------------------------------------------
*/
    # クリエーターページ トップ(creater) *SNSボタンへの使用不可
    Route::get('/creater/{creater_user}',
    [Controllers\CreaterUserController::class, 'creater_top'])
    ->name('creater');


    # 公開中問題集一覧[クリエーターページトップ](questin_group_list)
    Route::get('/creater/questin_group_list/{creater_user}/{key}',
    [Controllers\CreaterUserController::class, 'questin_group_list'])
    ->name('creater.questin_group_list');

    # フォロワー一覧(follower_list)
    Route::get('/creater/follower_list/{creater_user}/{key}',
    [Controllers\CreaterUserController::class, 'follower_list'])
    ->name('creater.follower_list');

    # フォロー中一覧(follow_creater_list)
    Route::get('/creater/follow_creater_list/{creater_user}/{key}',
    [Controllers\CreaterUserController::class, 'follow_creater_list'])
    ->name('creater.follow_creater_list');

    # クリエーター検索(search_creater_list)
    Route::post('/creater/search_creater_list',
    [Controllers\CreaterUserController::class, 'search_creater_list'])
    ->name('creater.search_creater_list');

//
