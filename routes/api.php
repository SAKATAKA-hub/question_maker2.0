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
| その他のサービス　ServiceController
|--------------------------------------------------------------------------
*/
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

    //
//

