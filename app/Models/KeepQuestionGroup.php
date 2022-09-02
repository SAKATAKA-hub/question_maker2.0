<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集のキープ
 * ===============================
 */
class KeepQuestionGroup extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','question_group_id','keep',
    ];


    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # QuestionGroupテーブルとのリレーション
        public function question_group(){
            return $this->belongsTo(QuestionGroup::class);
        }

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
        public function ScopeIsKeep($query, $user_id, $question_group_id)
        {
            // user_idが''のとき、0
            $user_id = $user_id=='' ? 0 : $user_id ;


            //対象データをすべて取得( first()が利用できないため )
            $keeps = $query->where('user_id',$user_id)->where('question_group_id',$question_group_id)->get();


            //対象のデータが無ければ、空文字を返す
            return $keeps->count() ? $keeps[0]->keep : '';
        }

}
