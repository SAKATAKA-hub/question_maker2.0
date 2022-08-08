<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 * ===================================
 *  お問い合わせ　
 * ===================================
 **/

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes; //論理削除の利用

    public $timestamps = true;

    protected $fillable = [
        'contact_type','name','company','email','tell','text',
    ];




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * ストレージ保存された文章を含む'回答'($inqury->storage_text)
     * @return String
     */
    public function getStorageTextAttribute()
    {
        // パスから改行を取り除く
        $path = str_replace(["\r\n", "\r", "\n"], '', $this->text);


        return \Illuminate\Support\Facades\Storage::exists($path) ?
        \Illuminate\Support\Facades\Storage::get($this->text) //ストレージ　
        : $this->text; //DB

    }
}
