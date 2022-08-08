<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題の選択肢 QuestionsOptions
 * ===============================
 */
class QuestionOption extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'answer_text','answer_boolean','question_id'
    ];
}
