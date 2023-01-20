<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * =========================================
 *  *  [ アンケート調査( 質問項目 ) ]　model
 * =========================================
 *  **/
class SurveyQuestion extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'text',        //質問内容
        'input_text',  //入力テキスト
        'placeholder', //補足
        'required',    //入力必須か否か
        'survey_input_type_id',      //入力フォームの種類ID
        'survey_questions_group_id', //質問グループテーブルの種類ID
    ];








    /*
    |--------------------------------------------------------------------------
    | リレーション設定
    |--------------------------------------------------------------------------
    |
    |
    */


    /**
     * survey_input_typesテーブルとのリレーション($question->survey_input_type)
     */
    public function survey_input_type()
    {
        return $this->belongsTo(SurveyInputType::class);
    }


    /**
     * survey_question_itemテーブルとのリレーション($question->items)
     */

    public function items()
    {
        return $this->hasMany(SurveyQuestionItem::class);
    }





}
