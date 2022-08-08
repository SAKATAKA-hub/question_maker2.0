<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  回答グループ AnswerGroups
 * ===============================
 */
class AnswerGroup extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'score','elapsed_time','user_id','question_group_id',
    ];



    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # QuestionGroupテーブルとのリレーション
        public function question_group()
        {
            return $this->belongsTo(QuestionGroup::class);
        }




        # Answerテーブルとのリレーション
        public function answers()
        {
            return $this->hasMany(Answer::class);
        }





}
