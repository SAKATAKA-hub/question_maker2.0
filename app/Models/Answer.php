<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  回答 Answers
 * ===============================
 */
class Answer extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'text','is_correct','answer_group_id','question_id',
    ];
}
