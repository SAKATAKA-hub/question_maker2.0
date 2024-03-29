<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * ======================================
 *  [ アンケート調査( 回答内容 ) ]　model
 * ======================================
 **/
class SurveyAnswer extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'value', //質問の回答

        'survey_answers_group_id', //回答グループID
        'survey_question_id',      //質問ID
    ];





    /*
    |--------------------------------------------------------------------------
    | リレーション設定
    |--------------------------------------------------------------------------
    |
    |
    */

        /**
         * survey_questionテーブルとのリレーション($answer->survey_question)
         */

        public function survey_question()
        {
            return $this->belongsTo(SurveyQuestion::class);
        }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */

        /**
         * ストレージ保存された文章を含む'回答'($answer->storage_value)
         * @return String
         */
        public function getStorageValueAttribute()
        {
            $text = $this->value;
            $path = $this->value;

            //余計な記号をを除去
            preg_match_all('/[a-zA-Z0-9\/._-]+/', $path, $matches);
            $path = implode('', $matches[0]);

            // パスから改行を取り除く
            $path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $path);

            return \Illuminate\Support\Facades\Storage::exists($path) ?
            \Illuminate\Support\Facades\Storage::get($this->value) : $this->value;
        }




}
