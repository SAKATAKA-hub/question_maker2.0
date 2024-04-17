<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| 問題集を解く　処理　PlayQuestionController
|--------------------------------------------------------------------------
*/
    # 全ての問題集一覧ページの表示(list)
    Route::get('/questions_list',
    [Controllers\PlayQuestionController::class, 'list'])
    ->name('questions_list');

    # 検索結果一覧の表示(questions_search_list)
    Route::get('questions_search_list',
    [Controllers\PlayQuestionController::class, 'questions_search_list'])
    ->name('questions_search_list');

    # 問題を解く(play_question)
    Route::get('/play_question/{question_group}/{key}',
    [Controllers\PlayQuestionController::class, 'play_question'])
    ->name('play_question');

    # 問題情報の取得(get_questions_api)
    Route::post('/get_questions_api',
    [Controllers\PlayQuestionController::class, 'get_questions_api'])
    ->name('get_questions_api');

    # 問題の採点(scoring)
    Route::post('/scoring',
    [Controllers\PlayQuestionController::class, 'scoring'])
    ->name('scoring');


//
