<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 * ===============================================================
 *  [ アンケート調査( 質問内容登録用の入力フォームの種類 ) ]　model
 * ===============================================================
 **/
class SurveyInputType extends Model
{
    use HasFactory;

    public $timestamps = false; //タイムスタンプを利用しない

    protected $fillable = [
        'code',       //入力フォームコード番号
        'input_text', //表示用の名前
        'input_name', //登録用の名前
    ];
}
