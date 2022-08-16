<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集の評価
 * ===============================
 */
class QuestionGroupEvaluation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','question_group_id','point',
    ];
}
