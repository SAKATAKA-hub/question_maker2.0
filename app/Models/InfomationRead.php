<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  ユーザーへのお知らせ　既読管理
 * ===============================
 */
class InfomationRead extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'infomation_id', 'user_id', 'read',
    ];
}
