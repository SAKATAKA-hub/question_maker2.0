<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

# Home
Route::get('/', [Controllers\PlayQuestionController::class, 'list'])
->name('home');


# 月額サービス
Route::get('/premium', function(){ return view('premium.index');})
->name('premium');


# 問題集を解く
include('user/play_question.php');

# 問題集を作る
include('user/make_question_grooup.php');

# 問題を作る
include('user/make_question.php');

# 成績
include('user/results.php');

# マイページ
include('user/my_page.php');

# クリエーターページ
include('user/creater_user.php');

# 各種設定
include('user/settings.php');

# その他のサービス
include('user/service.php');

# フッターメニュー
include('user/footer_menu.php');

# 認証・登録・パスワード変更
include('user/auth.php');

/*
|--------------------------------------------------------
| アンケート調査 SurveyController
|--------------------------------------------------------
*/
    # アンケート調査入力ページ表示(01input)
    Route::get('survey/input/{survey_group}/{access_key}', [Controllers\SurveyController::class, 'input'])
    ->name('survey.input');


    # アンケート調査確認ページ表示(02confirmation)
    Route::post('survey/confirmation/{survey_group}', [Controllers\SurveyController::class, 'confirmation'])
    ->name('survey.confirmation');


    # アンケート調査完了ページ表示(03completion)
    Route::post('survey/completion/{survey_group}', [Controllers\SurveyController::class, 'completion'])
    ->name('survey.completion');



/*
|--------------------------------------------------------------------------
| 管理者(admin) メニュー
|--------------------------------------------------------------------------
*/
Route::middleware(['admin_auth'])->group(function () {

    # 管理者トップ
    Route::get('/admin', function(){ return view('Admin.top'); })
    ->name('admin.top');

    # 登録会員リスト(user_list)
    Route::get('admin/user_list',
    [Controllers\AdminUserLisetController::class, 'list'] )
    ->name('admin.user_list');

        # 登録会員 問題集リスト(question_groups)
        Route::get('admin/user_list/{user}/question_groups',
        [Controllers\AdminUserLisetController::class, 'question_groups'] )
        ->name('admin.user_list.question_groups');

        # 登録会員 問題集情報(question_group_ditail)
        Route::get('admin/user_list/{user}/question_group_ditail/{question_group}',
        [Controllers\AdminUserLisetController::class, 'question_group_ditail'] )
        ->name('admin.user_list.question_group_ditail');

        # 登録会員 問題集情報(question_group_array)
        Route::get('admin/user_list/{user}/question_group_ditail/{question_group}/array',
        [Controllers\AdminUserLisetController::class, 'question_group_array'] )
        ->name('admin.user_list.question_group_array');


    # お問い合わせ一覧の表示(contact)
    Route::get('admin/contact',function(){ return view('Admin.contact'); } )
    ->name('admin.contact');


    # 規約違反報告一覧の表示(violation_report)
    Route::get('admin/violation_report',  function(){ return view('Admin.violation_report'); } )
    ->name('admin.violation_report');


    # 削除リスト
    Route::get('admin/delete_answers_list/{question_group}',  function( \App\Models\QuestionGroup $question_group){


        $answer_groups = \App\Models\AnswerGroup::where('user_id',Auth::user()->id)
        ->where('question_group_id',$question_group->id)
        ->orderBy('created_at','desc')->get();

        return view('Admin.delete_answers_list',compact('answer_groups','question_group')); }


    )
    ->name('admin.delete_answers_list');
    Route::delete('admin/delete_answers_list/destory',  function( \Illuminate\Http\Request $request){

        foreach ($request->answer_group_ids as $id) {

            $answer_group = \App\Models\AnswerGroup::find($id);
            $answer_group->delete();
        }

        return redirect()->route( 'admin.delete_answers_list', $request->question_group_id);
    })
    ->name('admin.delete_answers_list.destory');


    /**
     * ----------------------------------
     *  お知らせメール　処理
     * ----------------------------------
    */

        # お知らせメール送信フォーム(info_mail_form)
        Route::get('/admin/info_mail', function(){ return view('Admin.info_mail.form'); })
        ->name('admin.info_mail.form');


        # お知らせメール送信処理(info_mail_send)
        Route::post('/admin/info_mail/send', [Controllers\AdminInfoController::class, 'info_mail_send'])
        ->name('admin.info_mail.send');


        # お知らせメール内容の確認
        Route::get('/admin/info_mail/preview/{mail}', function($mail_num){ return view( 'emails.info.html'.$mail_num ); })
        ->name('admin.info_mail.preview');


    /**
     * ----------------------------------
     *  アンケート　処理
     * ----------------------------------
    */
        # アンケートフォーム一覧の表示
        Route::get('admin/survey', function(){ return view('Admin.survey'); })
        ->name('admin.survey');


        #アンケートの新規作成ページ(create)
        Route::get('admin/survey/create', function(){ return view('Admin.survey.create'); })
        ->name('admin.survey.create');


        #アンケートの新規作成(store)
        Route::post('admin/survey/store', [Controllers\AdminSurveyController::class, 'survey_store'])
        ->name('admin.survey.store');

});//end middleware

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if( env('APP_DEBUG') ){


    # 問題一覧
    Route::get('/test/', function () { return view('test.questions_list'); })
    ->name('test.questions_list');

    # 問題
    Route::get('/test/question/{id}/{num}', function ($id,$num) { return view( 'test.question.'.$num,compact('id','num') ); })
    ->name('question');

    # フォームのページ離脱防止アラート
    Route::get('/test/page_exit_prevention_alert', function(){ return view( 'test.page_exit_prevention_alert' ); })
    ->name('test.page_exit_prevention_alert');


    # カウントアップタイマー
    Route::get('/test/timer', function(){ return view( 'test.timer' ); })
    ->name('test.timer');


    # 問題の詳細
    Route::get('/test/question_detail', function(){ return view( 'test.question_detail' ); })
    ->name('test.question_detail');

    # その他サービスのテスト
    Route::get('/test/service_form', function(){
        return view( 'test.service_form');
    })->name('test.service_form');

    # 問題一覧
    Route::get('/test/question_group_card', function () {
        return view('test.question_group_card');
    })
    ->name('test.question_group_card');


    # 送信メール一覧
    Route::get('/test/emails', function () { return view('test.emails');})
    ->name('test.emails');

    # メール内容の確認
    Route::get('/test/emails/{mail}', function($mail){ return view( 'emails.'.$mail ); })
    ->name('test.emails.mail');

        # パスワード変更確認メール /test/emails/reset_pass01_verification
        # パスワード変更完了メール /test/emails/reset_pass02_completion
        // /test/emails/info.html2023123
    //


}
