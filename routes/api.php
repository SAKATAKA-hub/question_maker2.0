<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| 登録ユーザー　UserListAPIController
|--------------------------------------------------------------------------
*/
    # 登録ユーザー[一覧](user/list/api)
    Route::post('/user/list/api', [Controllers\UserListAPIController::class, 'user_list_api'])
    ->name('user.list.api');


/*
|--------------------------------------------------------------------------
| クリエーター　CreaterUserController
|--------------------------------------------------------------------------
*/

    # 公開中問題集一覧API[(api_questin_group_list)
    Route::get('/creater/questin_group_list/{creater_user}/{key}',
    [Controllers\CreaterUserController::class, 'api_questin_group_list'])
    ->name('api.creater.questin_group_list');


/*
|--------------------------------------------------------------------------
| その他のサービス　ServiceController
|--------------------------------------------------------------------------
*/
    # アンケート

        # アンケート[一覧]  (list_api)
        Route::post('/survey/list/api', [Controllers\AdminSurveyController::class, 'list_api'])
        ->name('survey.list.api');

        # アンケート回答[一覧]  (answer_list_api)
        Route::post('/survey/answer_list/api', [Controllers\AdminSurveyController::class, 'answer_list_api'])
        ->name('survey.answer_list.api');

        # アンケート回(answer_api)
        Route::post('/survey/answer/api', [Controllers\AdminSurveyController::class, 'answer_api'])
        ->name('survey.answer.api');

        # アンケート回[削除](answer_destory_api)
        Route::delete('/survey/answer/destory/api', [Controllers\AdminSurveyController::class, 'answer_destory_api'])
        ->name('survey.answer.destory.api');


    # 規約違反問題集の通報

        # 規約違反問題集の通報[一覧]  (violation_report/list/api)
        Route::post('/violation_report/list/api', [Controllers\ServiceController::class, 'violation_report_list_api'])
        ->name('violation_report.list.api');

        # 規約違反問題集の通報[対応済変更](violation_report/responsed/api)
        Route::patch('/violation_report/responsed/api', [Controllers\ServiceController::class, 'violation_report_responsed_api'])
        ->name('violation_report.responsed.api');

        # 規約違反問題集の通報[削除](violation_report/destory/api)
        Route::delete('/violation_report/destory/api', [Controllers\ServiceController::class, 'violation_report_destory_api'])
        ->name('violation_report.destory.api');


    # お問い合わせ

        # お問い合わせ[一覧](contact/list/api)
        Route::post('/contact/list/api', [Controllers\ServiceController::class, 'contact_list_api'])
        ->name('contact.list.api');

        # お問い合わせ[対応済変更](contact/responsed/api)
        Route::patch('/contact/responsed/api', [Controllers\ServiceController::class, 'contact_responsed_api'])
        ->name('contact.responsed.api');

        # お問い合わせ[削除](contact/destory/api)
        Route::delete('/contact/destory/api', [Controllers\ServiceController::class, 'contact_destory_api'])
        ->name('contact.destory.api');


    //

//

