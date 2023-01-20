<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * ----------------------------------
 *  アンケート　コントローラー
 * ----------------------------------
*/
class AdminSurveyController extends Controller
{
    /**
     * アンケート一覧の表示(survey_form_list)
     *
     * @return \Illuminate\View\View
    */
    public function survey_form_list()
    {
        $survey_groups = [];

        // $survey_groups = \App\Models\SurveyQuestionsGroup::get();
        return view('Admin.survey.form_list', compact( 'survey_groups' ) );
    }


    /**
     * アンケート回答一覧の表示(survey_list)
     *
     * @return \Illuminate\View\View
    */
    public function survey_list( $column_name='', $order='' )
    {
        //全顧客情報の取得
        $surveys = \App\Models\SurveyAnswersGroup::orderBy('id','desc')->get();


        # 並び替え
        switch ($column_name) {
            //1. 回答日順
            case 'date':
                $surveys = \App\Models\SurveyAnswersGroup::orderBy('created_at', $order)->get();
                break;

            //2. タイトル順
            case 'title':
                $surveys = \App\Models\SurveyAnswersGroup::orderBy('title', $order)
                ->orderBy('created_at', 'desc' )->get();;
                break;

            //3. 回答者名
            case 'respondent':
                $surveys = \App\Models\SurveyAnswersGroup::orderBy('respondent', $order)
                ->orderBy('created_at', 'desc' )->get();;
                break;

            //4. 会社名
            case 'company':
                $surveys = \App\Models\SurveyAnswersGroup::orderBy('company', $order)
                ->orderBy('created_at', 'desc' )->get();;
                break;

            //

        }


        return view('admin.survey_list', compact( 'surveys' ) );
    }




    /**
     * アンケート回答詳細情報の表示(survey_ditails)
     *
     * @param \App\Models\SurveyAnswersGroup $survey (顧客情報)
     * @return \Illuminate\View\View
    */
    public function survey_ditails(\App\Models\SurveyAnswersGroup $survey)
    {
        // dd($survey->survey_answers[0]->survey_question);


        return view( 'admin.survey_ditails', compact( 'survey' ) );
    }




    /**
     * アンケート情報の削除(survey_destroy)
     *
     * @param \App\Models\SurveyAnswersGroup $survey (アンケート情報)
     * @return \Illuminate\View\View
    */
    public function survey_destroy(\App\Models\SurveyAnswersGroup $survey)
    {

        # ストレージファイルの削除
        foreach ($survey->survey_answers as $answer)
        {
            $path = str_replace(["\r\n", "\r", "\n"], '', $answer->value );
            if( \Illuminate\Support\Facades\Storage::exists($path) ){
                \Illuminate\Support\Facades\Storage::delete($path);
            }
        }



        # アンケート情報の削除
        $survey->delete();

        # アンケート一覧へリダイレクト
        return redirect()->route('admin.survey_list')
        ->with('alert-danger','アンケート情報を1件削除しました。');
    }



    /**
     * アンケート情報の新規作成(survey_store)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function survey_store(Request $request)
    {
        // return \Database\Seeders\SurveyQuestionsTableSeeder03::test();
        # アンケートの挿入
        \Database\Seeders\SurveyQuestionsTableSeeder03::run();


        # アクセスキーの更新
        $survey_groups = \App\Models\SurveyQuestionsGroup::get();
        foreach ($survey_groups as $survey_group) {

            if ( $survey_group->access_key===null ) {
                $survey_group->update([ 'access_key' => \Illuminate\Support\Str::random(40), ]);
            }
        }

        return 'アンケートを追加しました。';
    }
}
