<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * =========================================
 *  *  [ アンケート調査( 質問項目の選択肢 ) ]　model
 * =========================================
 *  **/

class SurveyQuestionItem extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'value',              //質問の選択肢
        'survey_question_id', //質問ID
    ];
}
