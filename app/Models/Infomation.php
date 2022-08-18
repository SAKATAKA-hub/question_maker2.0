<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  ユーザーへのお知らせ
 * ===============================
 */
class Infomation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'title', 'body', 'subject',
    ];
}
