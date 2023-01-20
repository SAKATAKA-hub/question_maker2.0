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
     * survey_answerテーブルとのリレーション($group->survey_questions_group)
     */
    public function survey_questions_group()
    {
        return $this->belongsTo( SurveyQuestionsGroup::class);
    }

}
