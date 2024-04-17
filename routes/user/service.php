<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| その他のサービス　ServiceController
|--------------------------------------------------------------------------
*/
    # 問題集のキープ[お気に入り](keep_question_group/api)
    Route::post('/keep_question_group/api', [Controllers\ServiceController::class, 'keep_question_group_api'])
    ->name('keep_question_group.api');

    # クリエーターユーザーのキープ[フォロー](keep_creator_user/api)
    Route::post('/keep_creator_user/api', [Controllers\ServiceController::class, 'keep_creator_user_api'])
    ->name('keep_creator_user.api');

    # 問題集の評価(question_group_evaluation/api)
    // ~


    # 問題集へのコメント

        # 問題集へのコメント[一覧・投稿](comment/api)
        Route::post('/comment/api', [Controllers\ServiceController::class, 'comment_api'])
        ->name('comment.api');

        # 問題集へのコメント[削除(非表示)](comment/destroy/api)
        Route::patch('/comment/destroy/api', [Controllers\ServiceController::class, 'comment_destroy_api'])
        ->name('comment.destroy.api');


    # 規約違反問題集の通報

        # 規約違反問題集の通報[投稿]  (violation_report/post/api)
        Route::post('/violation_report/post/api', [Controllers\ServiceController::class, 'violation_report_post_api'])
        ->name('violation_report.post.api');


    # お問い合わせ

        # お問い合わせ[投稿](contact/post/api)
        Route::post('/contact/post/api', [Controllers\ServiceController::class, 'contact_post_api'])
        ->name('contact.post.api');

        # お問い合わせ[一覧](contact/list/api)
        # お問い合わせ[削除](contact/destroy/api)

    //

//
