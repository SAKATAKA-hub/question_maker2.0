<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| コントローラー内で利用する　メソッドクラス
|--------------------------------------------------------------------------
*/
class Method
{
    /**
     * ストレージファイルの更新
     *
     * @param String $dir         //保存先ディレクトリ
     * @param String $new_text    //新しい入力テキスト
     * @param String $old_text    //更新前のファイルパステキスト
     * @param String $st_count    //最大文字数
     *
     * @return String $file_path  //ファイルパス、または$st_count文字以下のテキスト
     */
    public static function uploadStorageText( $dir, $new_text, $old_text='', $st_count=150)
    {

        //1. $st_countより多い文字数・ストレージを利用中
        $file_path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $old_text);
        if(
            ( mb_strlen( $new_text ) > $st_count ) &&
            Storage::exists( $file_path )
        ){
            // ストレージファイルの更新
            storage::put( $file_path, $new_text  );
            $new_text = $file_path;
        }

        //2. $st_countより多い文字数・ストレージ保存無し
        elseif(
            ( mb_strlen( $new_text ) > $st_count ) &&
            !Storage::exists( $file_path )
        ){
            // ストレージファイルの新規作成
            // $dir = 'upload/worker/info/job_description/';

            // 採番の取得($num)
            $num_file = $dir.'file_num.txt';
            $num = Storage::exists($num_file) ? (int) Storage::get($num_file) : 0;
            $num = $num + 1;
            storage::put( $num_file, $num );


            // ストレージにファイル保存・DBにパスの値を渡す
            $file_path = $dir.sprintf('%06d.txt', $num);
            storage::put( $file_path, $new_text );
            $new_text = $file_path;
        }

        //3. $st_count文字以下・ストレージを利用中
        elseif(
            ( mb_strlen( $new_text ) <= $st_count ) &&
            Storage::exists( $file_path )
        ){
            //ストレージファイルの削除
            storage::delete( $file_path );
        }


        //ファイルパス、または$st_count文字以下のテキストを返す。
        return $new_text;
    }


    /**
     * ストレージファイルの削除
     *
     * @param String $text    //ファイルパステキスト
     */
    public static function deleteStorageText($text)
    {
        $file_path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $text);
        if( Storage::exists( $file_path ) ){ storage::delete( $file_path ); }
    }


}
