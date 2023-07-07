<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * ----------------------------------
 *  Admin アンケート　コントローラー
 * ----------------------------------
*/
class AdminSurveyController extends Controller
{
    /**
     * アンケート[一覧]  (list_api)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function list_api(Request $request)
    {
        # APP_KEY認証チェック
        if( $request->api_key != config('app.api_key')){ return \App::abort(404); }


        # アンケートデータの取得と加工
        $survey_groups = \App\Models\SurveyQuestionsGroup::get();
        for ($i=0; $i < $survey_groups->count(); $i++) {

            // アンケートのURL（$survey_groups[$i]->url）
            $param = [ 'survey_group'=>$survey_groups[$i]->id,'access_key'=>$survey_groups[$i]->access_key ];
            $survey_groups[$i]->url = route('survey.input', $param );
        }

        # JSONを返す(アンケート一覧データ)
        return response()->json([ 'survey_groups' => $survey_groups ]);
    }




    /**
     * アンケート解答[一覧]  (answer_list_api)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function answer_list_api(Request $request)
    {
        # APP_KEY認証チェック
        if( $request->api_key != config('app.api_key')){ return \App::abort(404); }

        # 解答一覧の取得
        $answers_groups =
        \App\Models\SurveyAnswersGroup::where('survey_questions_group_id',$request->answers_id)
        ->orderBy('id','desc')->get();
        for ($i=0; $i < $answers_groups->count(); $i++) {

            // 回答日テキスト（$answers_groups[$i]->date）
            $answers_groups[$i]->date =
            \Carbon\Carbon::parse( $answers_groups[$i]->created_at)->format('Y年m月d日 H:i:s');
        }


        # JSONを返す(アンケート一覧データ)
        return response()->json([ 'answers_groups' => $answers_groups ]);
    }




    /**
     * アンケート回(answer_api)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function answer_api(Request $request)
    {
        // return response()->json(['data_list' => 'hogehoge' ]);

        # APP_KEY認証チェック
        if( $request->api_key != config('app.api_key')){ return \App::abort(404); }

        # 解答グループの取得と加工
        $answers = \App\Models\SurveyAnswersGroup::apiAnswerDataList($request->answers_id);


        # JSONを返す(アンケート一覧データ)
        return response()->json([ 'answers' => $answers ]);
    }


    /**
     * アンケート回[削除](answer_destory_api)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function answer_destory_api(Request $request)
    {
        # APP_KEY認証チェック
        if( $request->api_key != config('app.api_key')){ return \App::abort(404); }


        # 解答グループの取得
        $answer_group = \App\Models\SurveyAnswersGroup::find($request->answers_id);

        #
        $survey_questions_group_id = $answer_group->survey_questions_group_id;

        # ストレージファイルの削除
        foreach ($answer_group->survey_answers as $answer){
            Method::deleteStorageText($answer->value);
        }

        # アンケート情報の削除
        $answer_group->delete();


        # 解答一覧の取得
        $answers_groups =
        \App\Models\SurveyAnswersGroup::where('survey_questions_group_id',$survey_questions_group_id)
        ->orderBy('id','desc')->get();
        for ($i=0; $i < $answers_groups->count(); $i++) {

            // 回答日テキスト（$answers_groups[$i]->date）
            $answers_groups[$i]->date =
            \Carbon\Carbon::parse( $answers_groups[$i]->created_at)->format('Y年m月d日 H:i:s');
        }


        # JSONを返す(アンケート一覧データ)
        return response()->json([ 'answers_groups' => $answers_groups ]);
    }

}
