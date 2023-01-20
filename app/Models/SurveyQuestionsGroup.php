<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * =========================================
 *  *  [ アンケート調査( 質問項目 ) ]　model
 * =========================================
 *  **/
class SurveyQuestionsGroup extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title',      //タイトル
        'access_key', //アクセスキー
    ];




    /*
    |--------------------------------------------------------------------------
    | リレーション設定
    |--------------------------------------------------------------------------
    |
    |
    */
    /**
     * survey_questionテーブルとのリレーション($survey_group->survey_questions)
     */
    public function survey_questions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }


    /**
     * survey_answers_groupsテーブルとのリレーション($survey_group->survey_answers_groups)
     */
    public function survey_answers_groups()
    {
        return $this->hasMany(SurveyAnswersGroup::class);
    }

}


