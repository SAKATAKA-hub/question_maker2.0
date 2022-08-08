<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
| =============================================
|  ログイン履歴 モデル
| =============================================
*/

class LoginRecord extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
    ];




    /*
    |--------------------------------------------------------------------------
    | リレーション設定
    |--------------------------------------------------------------------------
    |
    |
    */


    /**
     * usersテーブルとのリレーション($login_record->user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
