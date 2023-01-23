<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

/**
 * =========================================
 *  アンケート調査関係　コントローラー
 * =========================================
*/
class SurveyController extends Controller
{


    /**
     * アンケート調査入力ページ表示(01input)
     *
     * @param \App\Models\SurveyQuestionsGroup $survey (質問グループ)
     * @param String $access_key
     * @return \Illuminate\View\View
    */
    public function input(\App\Models\SurveyQuestionsGroup $survey_group, $access_key)
    {
        # access_keyチェック
        if( $access_key !== $survey_group->access_key ){ return \App::abort(404); }

        # アンケート入力ページの表示
        return view('Survey.01input',compact('survey_group') );
    }




    /**
     * アンケート調査確認ページ表示(02confirmation)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SurveyQuestionsGroup $survey (質問グループ)
     * @return \Illuminate\View\View
    */
    public function confirmation(Request $request, \App\Models\SurveyQuestionsGroup $survey_group)
    {
        # 入力情報の取得
        $inputs = $request->all();

        # アンケート内容の取得
        $questions = $survey_group->survey_questions;

        # 未入力の処理
        for ($i=1; $i <= $questions->count(); $i++)
        {
            $inputs['question'.$i] = isset( $inputs['question'.$i] ) ? $inputs['question'.$i] : NULL ;
        }




        //　アンケートに回答内容を保存( $question->input )
        for ($i=0; $i < $questions->count(); $i++)
        {
            $questions[$i]->input  =  $inputs[ 'question'. $questions[$i]->id ];

            // 配列データを文字列に変更
            if(
                ($questions[$i]->survey_input_type->input_text === 'チェック') && isset(  $questions[$i]->input )
            )
            {
                // $questions[$i]->input = implode('、 ',$questions[$i]->input);
                $questions[$i]->input = implode(" \n", $questions[$i]->input);
            }
        }
        $survey_group->survey_questions = $questions;


        # アンケートページの表示
        return view('Survey.02confirmation',compact( 'survey_group' ) );
    }




    /**
     * アンケート調査完了ページ表示(03completion)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SurveyQuestionsGroup $survey (質問グループ)
     * @return \Illuminate\View\View
    */
    public function completion(Request $request, \App\Models\SurveyQuestionsGroup $survey_group)
    {

        # 入力情報の取得
        $inputs = $request->all();
        unset($inputs["_token"]); //配列からtoken情報を除去


        # アンケート内容の取得
        $questions = $survey_group->survey_questions;

        // 　アンケートに回答内容を保存
        for ($i=0; $i < $questions->count(); $i++)
        {
            $questions[$i]->input  =   $inputs[ $questions[$i]->id ];

        }


        # DBに[アンケートの回答グループ] を作成
        $answer_group = new \App\Models\SurveyAnswersGroup([
            'client_id' => 1, //顧客ID ※未使用
            'survey_questions_group_id' => $survey_group->id, //質問グループID
            'title' => $survey_group->title, //質問のタイトル
            'respondent' => current(array_slice($inputs, 0, 1, true) ), //回答者名
            'company' => current(array_slice($inputs, 1, 1, true) ), //企業名
        ]);
        $answer_group->save();


        # DBに[アンケートの回答内容] を保存
        foreach ($inputs as $survey_question_id => $value)
        {

            # テキストのストレージ保存
            $dir = 'upload/survey/';
            $value = Method::uploadStorageText( $dir, $value );


            // DB保存
            $answer = new \App\Models\SurveyAnswer([
                'survey_answers_group_id' => $answer_group->id, //回答グループID
                'survey_question_id' => $survey_question_id, //質問ID
                'value' => $value, //回答内容
            ]);
            $answer->save();
            // 二重送信防止
            $request->session()->regenerateToken();

        }


        # 管理者へメールの自動送信
        // メール受取り設定の管理者ユーザーの取得
        $emails = explode(',', env('SEND_ADMIN_EMAILS'), );
        $subject = $survey_group->title.'を受け付けました'; //件名
        foreach ($emails as $email)
        {
            Mail::to( $email )
            ->send( new \App\Mail\SurveyAdminMailable( compact( 'subject', 'questions' ) ) );
        }


        # アンケートページの表示
        return view('Survey.03completion');
    }
}
