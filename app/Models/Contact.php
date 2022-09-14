<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  お問い合わせ
 * ===============================
 */
class Contact extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','email','body','responsed','type_text'
    ];


    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * ストレージ保存された文章（経歴要約） $contact->body_text
         * @return String
         */
        public function getBodyTextAttribute()
        {
            // パスから改行を取り除く
            $text = $this->body;
            $path = str_replace(["\r\n", "\r", "\n"], '', $text);

            return \Illuminate\Support\Facades\Storage::exists($path) ?
            \Illuminate\Support\Facades\Storage::get($path) : $text;
        }

    /*
    |--------------------------------------------------------------------------
    | スコープ
    |--------------------------------------------------------------------------
    |
    |
    */

        /**
         * 一覧表示用データリスト（data_list)
         * @return Array
        */
        public function scopeDataList( $query )
        {
            # 報告一覧データの取得
            $contacts =  $query->orderBy('created_at','desc')->get();

            # データの加工
            $data_list = [];
            for ($i=0; $i < $contacts->count(); $i++) {

                $contact = $contacts[$i];
                $contact->body_text = $contact->body_text; //ストレージテキスト

                $data = [
                    // 日時
                    'date' => \Carbon\Carbon::parse( $contacts[$i]->created_at )->format('Y年m月d日 H:i'),
                    // 報告情報
                    'contact' => $contact,
                ];
                $data_list[] = $data;
            }


            return $data_list;
        }
    //

}
