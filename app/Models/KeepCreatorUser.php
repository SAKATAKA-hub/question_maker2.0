<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  クリエーターのキープ
 * ===============================
 */
class KeepCreatorUser extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','creater_user_id','keep',
    ];


    /*
    |--------------------------------------------------------------------------
    | スコープ
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * お気に入り状態の取得
         * 指定した'$user_id'と'$question_group_id'のkeep状態を返す
         * @return String
        */
        public function ScopeIsKeep($query, $user_id, $creater_user_id)
        {
            // user_idが''のとき、0
            $user_id = $user_id=='' ? 0 : $user_id ;


            //対象データをすべて取得( first()が利用できないため )
            $keeps = $query->where('user_id',$user_id)->where('creater_user_id',$creater_user_id)->get();


            //対象のデータが無ければ、空文字を返す
            return $keeps->count() ? $keeps[0]->keep : '';
        }

}
