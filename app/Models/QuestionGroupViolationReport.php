<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集の違反通報
 * ===============================
 */
class QuestionGroupViolationReport extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','question_group_id','body','responded',
    ];
}
