<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集へのコメント
 * ===============================
 */
class QuestionGroupComment extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','question_group_id','body','read',
    ];
}
