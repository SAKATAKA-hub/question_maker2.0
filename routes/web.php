<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

# Home
Route::get('/', function(){ return redirect()->route('questions_list'); })
->name('home');

// Route::get('/', function(){ return 'question maker'; })
// ->name('home');


/*
|--------------------------------------------------------------------------
| 問題集を解く　処理　PlayQuestionController
|--------------------------------------------------------------------------
*/
    # 全ての問題集一覧ページの表示(list)
    Route::get('/questions_list', [Controllers\PlayQuestionController::class, 'list'])
    ->name('questions_list');

    # 検索結果一覧の表示(questions_search_list)
    Route::get('questions_search_list', [Controllers\PlayQuestionController::class, 'questions_search_list'])
    ->name('questions_search_list');

    # 自分で作成した問題集一覧ページの表示(my_list)
    # 他者が作成した問題集一覧ページの表示(others_list)
    # 問題集の一覧表示・キーワード検索(seached_list)

    # 問題開始の準備(befor_play_question)
    // Route::post('/befor_play_question', [Controllers\PlayQuestionController::class, 'befor_play_question'])
    // ->name('befor_play_question');

    # 問題を解く(play_question)
    Route::get('/play_question/{question_group}',
    function( \App\Models\QuestionGroup $question_group ){ return view('PlayQuestion.play_question', compact('question_group')); })
    ->name('play_question');

    # 問題情報の取得(get_questions_api)
    Route::post('/get_questions_api', [Controllers\PlayQuestionController::class, 'get_questions_api'])
    ->name('get_questions_api');

    # 問題の採点(scoring)
    Route::post('/scoring', [Controllers\PlayQuestionController::class, 'scoring'])
    ->name('scoring');


/*
|--------------------------------------------------------------------------
| 問題集を作る　処理　MakeQuestionGroupController
|--------------------------------------------------------------------------
*/
Route::middleware(['user_auth'])->group(function () {

    # 問題集の一覧ページの表示(list)
    Route::get('/make_question_group/list', [Controllers\MakeQuestionGroupController::class, 'list'])
    ->name('make_question_group.list');

    # 問題集の新規作成ページの表示(create)
    Route::get('/make_question_group/create', [Controllers\MakeQuestionGroupController::class, 'create'])
    ->name('make_question_group.create');

    # 新規作成問題集の保存(store)
    Route::post('/make_question_group/store', [Controllers\MakeQuestionGroupController::class, 'store'])
    ->name('make_question_group.store');

    # 問題集の編集ヶ所選択ページの表示(select_edit)
    Route::get('/make_question_group/select_edit/{question_group}', [Controllers\MakeQuestionGroupController::class, 'select_edit'])
    ->name('make_question_group.select_edit');

    # 問題集基本情報の新規作成・編集ページの表示(edit)
    Route::get('/make_question_group/edit/{question_group}', [Controllers\MakeQuestionGroupController::class, 'edit'])
    ->name('make_question_group.edit');


    # 問題集基本情報の更新(update)
    Route::patch('/make_question_group/update/{question_group}', [Controllers\MakeQuestionGroupController::class, 'update'])
    ->name('make_question_group.update');


    # 問題集の削除(destroy)
    Route::delete('/make_question_group/destroy/{question_group}', [Controllers\MakeQuestionGroupController::class, 'destroy'])
    ->name('make_question_group.destroy');


});//end middleware
/*
|--------------------------------------------------------------------------
| 問題集を作る　処理　MakeQuestionController
|--------------------------------------------------------------------------
*/
Route::middleware(['user_auth'])->group(function () {

    # 問題の新規作成ページの表示(create)
    Route::get('/make_question/create/{question_group}', [Controllers\MakeQuestionController::class, 'create'])
    ->name('make_question.create');

    # 新規作成問題の保存(store)
    Route::post('/make_question/store/{question_group}', [Controllers\MakeQuestionController::class, 'store'])
    ->name('make_question.store');


    # 問題の編集ページの表示(edit)
    Route::get('/make_question/edit/{question}', [Controllers\MakeQuestionController::class, 'edit'])
    ->name('make_question.edit');

    # 問題選択肢情報のAPI取得(question_options_api)
    Route::post('/make_question/question_options_api', [Controllers\MakeQuestionController::class, 'question_options_api'])
    ->name('make_question.question_options_api');

    # 編集問題の保存(update)
    Route::patch('/make_question/update/{question}', [Controllers\MakeQuestionController::class, 'update'])
    ->name('make_question.update');


    # 問題の削除(destroy)
    Route::delete('/make_question/destroy/{question}', [Controllers\MakeQuestionController::class, 'destroy'])
    ->name('make_question.destroy');

});//end middleware
/*
|--------------------------------------------------------------------------
| 成績　処理　ResultsController
|--------------------------------------------------------------------------
*/
    Route::middleware(['user_auth'])->group(function () {

        # 成績一覧ページの表示(list)
        Route::get('/results/list', [Controllers\ResultsController::class, 'list'])
        ->name('results.list');

    });//end middleware


    # 詳細成績ページの表示(detail)
    Route::get('/results/detail/{answer_group}', [Controllers\ResultsController::class, 'detail'])
    ->name('results.detail');
    // ゲストユーザーの採点表示も行うため、'user_auth'ミドルウェアにかけない。


/*
|--------------------------------------------------------------------------
| 各種設定　処理　SettingsController
|--------------------------------------------------------------------------
*/
    # 名前変更
    # 画像変更
    # パスワード変更
    # 退会処理



/*
|--------------------------------------------------------------------------
| フッターメニュー (footer_menu)
|--------------------------------------------------------------------------
*/
    # 利用規約(trems)
    Route::get('/trems', function () { view('footer_menu.trems'); })
    ->name('footer_menu.trems');

    # プライバシーポリシー(privacy_policy)
    Route::get('/privacy_policy', function () { view('footer_menu.privacy_policy'); })
    ->name('footer_menu.privacy_policy');

    # お問い合わせ(contact)
    Route::get('/contact', function () { view('footer_menu.contact'); })
    ->name('footer_menu.contact');

    # よくある質問(q_and_a)
    Route::get('/q_and_a', function () { view('footer_menu.q_and_a'); })
    ->name('footer_menu.q_and_a');



/*
|--------------------------------------------------------------------------
| 認証・登録・パスワード変更　(UserAuthController)
|--------------------------------------------------------------------------
*/
    /* ユーザー認証 */

        # ログイン画面の表示(login_form)
        Route::get('/user_auth/login_form', function () { return view('user_auth.login_form'); })
        ->name('user_auth.login_form');

        # ログイン処理(login)
        Route::post('/user_auth/login', [Controllers\UserAuthController::class, 'login'])
        ->name('user_auth.login');

        # ログアウト処理(logout)
        Route::get('/user_auth/logout', [Controllers\UserAuthController::class, 'logout'])
        ->name('user_auth.logout');

        # ログインが必要ですページ(require_login)　※ログイン前にログインが必要なページにアクセスした際に表示されるページ
        Route::get('/user_auth/require_login', function () { return view('user_auth.require_login'); })
        ->name('user_auth.require_login');


    /* ユーザー登録 */

        # ユーザー登録画面の表示(register_form)
        Route::get('/user_auth/register_form', function(){ return view('user_auth.register_form' ); })
        ->name('user_auth.register_form');

        # ユーザー登録API(register_api)
        Route::post('/user_auth/register_api', [Controllers\UserAuthController::class, 'register_api'])
        ->name('user_auth.register_api');

        # 登録済メールアドレスか確認するAPI(email_unique_api)
        Route::post('/user_auth/email_unique_api', [Controllers\UserAuthController::class, 'email_unique_api'])
        ->name('user_auth.email_unique_api');


    /* パスワードリセット */

        # パスワードリセット画面の表示(reset_pass_form)
        Route::get('/user_auth/reset_pass_form', function () { return view('user_auth.reset_pass_form'); })
        ->name('user_auth.reset_pass_form');

        # パスワードリセット ステップ01(reset_pass_step01_api)
        Route::patch('/user_auth/reset_pass_step01_api', [Controllers\UserAuthController::class, 'reset_pass_step01_api'])
        ->name('user_auth.reset_pass_step01_api');

        # パスワードリセット ステップ02(reset_pass_step02_api)
        Route::patch('/user_auth/reset_pass_step02_api', [Controllers\UserAuthController::class, 'reset_pass_step02_api'])
        ->name('user_auth.reset_pass_step02_api');

    //

    # 退会処理(destroy)
    Route::get('/user_auth/destroy', function () { return view('user_auth.destroy'); })
    ->name('user_auth.destroy');

//




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

// Route::get('test/{page}', function ($page) {
//     return view('test.'.$page);
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
