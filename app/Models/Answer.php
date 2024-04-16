<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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


    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */

        # Questionテーブルとのリレーション
        public function question(){
            return $this->belongsTo(Question::class);
        }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */


        /**
         * ストレージ保存された文章（説明文） text_text
         * @return String
         */
        public function getTextTextAttribute()
        {
            // パスから改行を取り除く
            $text = $this->text;
            $path = str_replace(["\r\n", "\r", "\n"], '', $text);

            return Storage::exists($path) ? Storage::get($path) : $text;
        }

    //


}
