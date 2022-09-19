<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  メールの受信設定
 * ===============================
 */
class MailSetting extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'keep_question_group', 'keep_creator_user','comment','infomation'
    ];

}
