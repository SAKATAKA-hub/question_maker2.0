<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| 問題を作る　処理　MakeQuestionController
|--------------------------------------------------------------------------
*/
Route::middleware(['user_auth'])->group(function () {

    # 問題の新規作成ページの表示(create)
    Route::get('/make_question/create/{question_group}', [Controllers\MakeQuestionController::class, 'create'])
    ->middleware(['question_group_auth'])
    ->name('make_question.create');

    # 新規作成問題の保存(store)
    Route::post('/make_question/store/{question_group}', [Controllers\MakeQuestionController::class, 'store'])
    ->middleware(['question_group_auth'])
    ->name('make_question.store');


    # 問題の編集ページの表示(edit)
    Route::get('/make_question/edit/{question}',
    [Controllers\MakeQuestionController::class, 'edit'])
    ->middleware(['question_auth'])
    ->name('make_question.edit');

    # 問題選択肢情報のAPI取得(question_options_api)
    Route::post('/make_question/question_options_api',
    [Controllers\MakeQuestionController::class, 'question_options_api'])
    ->name('make_question.question_options_api');

    # 編集問題の保存(update)
    Route::patch('/make_question/update/{question}',
    [Controllers\MakeQuestionController::class, 'update'])
    ->middleware(['question_auth'])
    ->name('make_question.update');


    # 問題の削除(destroy)
    Route::delete('/make_question/destroy/{question}',
    [Controllers\MakeQuestionController::class, 'destroy'])
    ->middleware(['question_auth'])
    ->name('make_question.destroy');


    # 問題のコピー(copy)
    Route::get('/make_question/copy/{question}',
    [Controllers\MakeQuestionController::class, 'copy'])
    ->middleware(['question_auth'])
    ->name('make_question.copy');


    # 問題のコピー処理(copy)
    Route::post('/make_question/copy_post/{question}',
    [Controllers\MakeQuestionController::class, 'copy_post'])
    ->middleware(['question_auth'])
    ->name('make_question.copy_post');


});//end middleware
//
