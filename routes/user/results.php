<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| 成績　処理　ResultsController
|--------------------------------------------------------------------------
*/
Route::middleware(['user_auth'])->group(function () {

    # 成績一覧ページの表示(list)
    Route::get('/mypage/results/list', [Controllers\ResultsController::class, 'list'])
    ->name('results.list');

});//end middleware


# 詳細成績ページの表示(detail)
Route::get('/results/detail/{answer_group}/{key?}', [Controllers\ResultsController::class, 'detail'])
->name('results.detail');
// ゲストユーザーの採点表示も行うため、'user_auth'ミドルウェアにかけない。
