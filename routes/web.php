<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

# Home
Route::get('/', [Controllers\PlayQuestionController::class, 'list'])
->name('home');


# 月額サービス
Route::get('/premium', function(){ return view('premium.index');})
->name('premium');

/*
|--------------------------------------------------------------------------
| 問題集を解く　処理　PlayJobQuestionController
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| マイページ　処理　MyPageController
|--------------------------------------------------------------------------
*/

    Route::middleware(['user_auth'])->group(function () {

        # マイページ[問題一覧](mypage) //->name('make_question_group.list');
        Route::get('/mypage',function(){ return redirect()->route('make_question_group.list'); })
        ->name('mypage');

        # 問題集を作る //->name('make_question_group.create');

        # いいねした問題集(like_list)
        Route::get('/mypage/like_list',[Controllers\MyPageController::class, 'like_list'])
        ->name('like_list');

        # 受検成績 //->name('results.list');

        # 通知(infomation_list)
        Route::get('/mypage/infomation_list',[Controllers\MyPageController::class, 'infomation_list'])
        ->name('infomation_list');

        # プロフィール・設定変更(settings) //->name('settings');

        # ログアウト//->name('user_auth.logout');

    });//end middleware
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

/*
|--------------------------------------------------------------------------
| 各種設定　処理　SettingsController
|--------------------------------------------------------------------------
*/
    Route::middleware(['user_auth'])->group(function () {

        # プロフィール・設定変更 表示(settings)
        Route::get('/mypage/settings', [Controllers\SettingsController::class, 'settings'])
        ->name('settings');


        # プロフィールの変更(update_user_profile)
        Route::post('/mypage/settings/update_user_profile', [Controllers\SettingsController::class,'update_user_profile'])
        ->name('update_user_profile');


        # メールアドレスの変更(update_user_email)
        Route::post('/mypage/settings/update_user_email', [Controllers\SettingsController::class,'update_user_email'])
        ->name('update_user_email');

        # メール受信設定の変更(email_setting)
        Route::post('/mypage/settings/email_setting', [Controllers\SettingsController::class,'email_setting'])
        ->name('email_setting');


        # 退会前アンケートフォーム(withdrawal_form)
        Route::get('/mypage/withdrawal_form', function(){ return view('user_auth.withdrawal_form'); })
        ->name('withdrawal_form');


    });//end middleware
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

/*
|--------------------------------------------------------------------------
| フッターメニュー (footer_menu)
|--------------------------------------------------------------------------
*/
    # このサイトの使い方(how_use)
    Route::get('/how_use', function () { return view('footer_menu.how_use'); })
    ->name('footer_menu.how_use');

    # 問題集公開時の注意点(important)
    // Route::get('/important', function () { return view('footer_menu.important'); })
    // ->name('footer_menu.important');

    # プライバシーポリシー(privacy_policy)
    //$revision_date 改定日
    Route::get('/privacy_policy/{revision_date?}',
    // function ($revision_date='2022-12-12') { return view('footer_menu.privacy_policy.'.$revision_date); })
    // ->name('footer_menu.privacy_policy');
    function ($revision_date='2023-09-12') { return view('footer_menu.privacy_policy.'.$revision_date); })
    ->name('footer_menu.privacy_policy');

    # 利用規約(trems)
    Route::get('/trems', function () { return view('footer_menu.trems'); })
    ->name('footer_menu.trems');

    # お問い合わせ(contact)
    Route::get('/contact', function () { return view('footer_menu.contact'); })
    ->name('footer_menu.contact');

    # お知らせ(news)
    Route::get('/news', function () { return view('footer_menu.news'); })
    ->name('footer_menu.news');

    # よくある質問(faq)
    Route::get('/faq', function () { return view('footer_menu.faq'); })
    ->name('footer_menu.faq');

    # 運営会社について(operating_companiy)
    Route::get('/operating_companiy', function () { return redirect( env('COMPANY_URL') ); })
    ->name('footer_menu.operating_companiy');


/*
|--------------------------------------------------------------------------
| 認証・登録・パスワード変更　(UserAuthController)
|--------------------------------------------------------------------------
*/

    /* ユーザー認証 */

        # ログイン方法選択ページ(login_form)
        Route::get('/user_auth/login_method_choosing', function () { return view('user_auth.login_method_choosing'); })
        ->name('user_auth.login_method_choosing');


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



    /* google ユーザー認証 */

        # テスト
        Route::get('/user_auth/google', function(){ return view('test.sns_auth'); })
        ->name('user_auth.google');

        # Googleログインページリダイレクト(google_redirect)
        Route::get('/user_auth/google/redirect',
        [ \App\Http\Controllers\UserSnsAuthController::class, 'google_redirect'])
        ->name('user_auth.google.redirect');

        # Googleログイン処理(google_callback)
        Route::get('/user_auth/google/callback',
        [ \App\Http\Controllers\UserSnsAuthController::class, 'google_callback'])
        ->name('user_auth.google.callback');



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
    Route::delete('/user_auth/destroy', [Controllers\UserAuthController::class, 'destroy'])
    ->name('user_auth.destroy');



//
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
