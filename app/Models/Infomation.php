<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * ===================================
 *  Infomation
 * ===================================
 **/
class Infomation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title','bage','body','blade_file','publication_at',
    ];




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * ストレージ保存された文章を含む'回答'($infomation->storage_body)
     * @return String
     */
    public function getStorageBodyAttribute()
    {
        // パスから改行を取り除く
        $path = str_replace(["\r\n", "\r", "\n"], '', $this->body);


        return \Illuminate\Support\Facades\Storage::exists($path) ?
        \Illuminate\Support\Facades\Storage::get($this->body) //ストレージ　
        : $this->body; //DB

    }

}
