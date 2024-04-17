<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| 問題集を作る　処理　MakeQuestionGroupController
|--------------------------------------------------------------------------
*/
Route::middleware(['user_auth'])->group(function () {

    # 問題集の一覧ページの表示(list)
    Route::get('/make_question_group/list',
    [Controllers\MakeQuestionGroupController::class, 'list'])
    ->name('make_question_group.list');

    # 問題集の詳細表示(detail)
    Route::get('/make_question_group/detail/{question_group}',
    [Controllers\MakeQuestionGroupController::class, 'detail'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.detail');

    # 問題集の新規作成ページの表示(create)
    Route::get('/make_question_group/create',
    [Controllers\MakeQuestionGroupController::class, 'create'])
    ->name('make_question_group.create');

    # 新規作成問題集の保存(store)
    Route::post('/make_question_group/store',
    [Controllers\MakeQuestionGroupController::class, 'store'])
    ->name('make_question_group.store');

    # 問題集の編集ヶ所選択ページの表示(select_edit)
    Route::get('/make_question_group/select_edit/{question_group}/{tab_menu?}',
    [Controllers\MakeQuestionGroupController::class, 'select_edit'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.select_edit');

    # 問題集基本情報の新規作成・編集ページの表示(edit)
    Route::get('/make_question_group/edit/{question_group}',
    [Controllers\MakeQuestionGroupController::class, 'edit'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.edit');


    # 問題集基本情報の更新(update)
    Route::patch('/make_question_group/update/{question_group}',
    [Controllers\MakeQuestionGroupController::class, 'update'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.update');

    # 問題集の削除(destroy)
    Route::delete('/make_question_group/destroy/{question_group}',
    [Controllers\MakeQuestionGroupController::class, 'destroy'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.destroy');

    # 問題のコピー処理(copy)
    Route::post('/make_question_group/copy/{question_group}',
    [Controllers\MakeQuestionGroupController::class, 'copy'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.copy');





    # 公開設定の更新(update_published)
    Route::patch('/make_question_group/update_published/{question_group}',
    [Controllers\MakeQuestionGroupController::class, 'update_published'])
    ->middleware(['question_group_auth'])
    ->name('make_question_group.update_published');


    # CSVファイルから問題集の新規作成ページの表示(read_csv_create)
    Route::get('/make_question_group/read_csv_create',
    function(){ return view('MakeQuestionGroup.read_csv_create'); })
    ->name('make_question_group.read_csv_create');

    # CSVファイルから問題集の新規作成(read_csv_post)
    Route::post('/make_question_group/read_csv_post',
    [Controllers\MakeQuestionGroupController::class, 'read_csv_post'])
    ->name('make_question_group.read_csv_post');

    # CSVテンプレートファイルのダウンロード(download_csv_file)
    Route::get('/make_question_group/download_csv_file',
    function(){ return Storage::download('site/csv/create_questions.csv', 'create_questions');
    })->name('make_question_group.download_csv_file');


});//end middleware
//
