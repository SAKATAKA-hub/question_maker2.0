<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * ======================================
 *  [ アンケート調査( 回答グループ ) ]　model
 * ======================================
 **/
class SurveyAnswersGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',      //質問のタイトル
        'respondent', //送信者
        'company',    //企業名

        'survey_questions_group_id', //質問グループID
    ];




    /*
    |--------------------------------------------------------------------------
    | リレーション設定
    |--------------------------------------------------------------------------
    |
    |
    */


        /**
         * survey_answerテーブルとのリレーション($group->survey_answers)
         */
        public function survey_answers()
        {
            return $this->hasMany(SurveyAnswer::class);
        }




        /**
         * survey_questions_groupテーブルとのリレーション($group->survey_questions_group)
         */
        public function survey_questions_group()
        {
            return $this->belongsTo( SurveyQuestionsGroup::class);
        }


    /*
    |--------------------------------------------------------------------------
    | スコープ
    |--------------------------------------------------------------------------
    |
    |
    */

        /**
         * APIデータリスト（::apiAnswerDataList)
         * @return Array
        */
        public function scopeApiAnswerDataList( $query, $survey_answer_group_id )
        {
            # 報告一覧データの取得
            $survey_answer_group = $this->find($survey_answer_group_id);

            # 解答一覧
            $survey_answers = $survey_answer_group->survey_answers;
            for ($i=0; $i < $survey_answers->count(); $i++) {

                //質問文（question）
                $survey_answers[$i]->question = $survey_answers[$i]->survey_question->text;

                //回答文（value_text）
                $survey_answers[$i]->value_text = $survey_answers[$i]->storage_value;
            }


            return $survey_answers;
        }

}
