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
     * アンケート一覧の表示(form_list)
     *
     * @return \Illuminate\View\View
    */
    public function form_list()
    {
        $survey_groups = \App\Models\SurveyQuestionsGroup::get();
        return view('Admin.survey.form_list', compact( 'survey_groups' ) );
    }


    /**
     * アンケート解答一覧の表示(answer_listlist)
     *
     * @param \App\Models\SurveyQuestionsGroup $survey_question_group (アンケート情報)
     * @param String $column_name
     * @param String $order
     * @return \Illuminate\View\View
    */
    public function answer_list(
        \App\Models\SurveyQuestionsGroup $survey_question_group, $column_name='', $order=''
    ){

        # 並び替え
        switch ($column_name) {
            //1. 解答日順
            case 'date':
                $answers_groups =
                \App\Models\SurveyAnswersGroup::where('survey_questions_group_id',$survey_question_group->id)
                ->orderBy('created_at', $order)->get();
                break;

            default:
                $answers_groups =
                \App\Models\SurveyAnswersGroup::where('survey_questions_group_id',$survey_question_group->id)
                ->orderBy('id','desc')->get();
            //
        }


        return view('Admin.survey.answer_list', compact(
            'survey_question_group', 'answers_groups',
        ) );
    }




    /**
     * アンケート解答詳細情報の表示(answers_ditail)
     *
     * @param \App\Models\SurveyAnswersGroup $answers_group (顧客情報)
     * @return \Illuminate\View\View
    */
    public function answer_ditail(\App\Models\SurveyAnswersGroup $answer_group)
    {
        return view( 'Admin.survey.answers_ditail', compact( 'answer_group' ) );
    }




    /**
     * アンケート情報の削除(destroy)
     *
     * @param \App\Models\SurveyAnswersGroup $answers_group (アンケート情報)
     * @return \Illuminate\View\View
    */
    public function answer_destroy(\App\Models\SurveyAnswersGroup $answers_group)
    {
        dd($answers_group);

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
     * アンケート情報の新規作成(store)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function store(Request $request)
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
