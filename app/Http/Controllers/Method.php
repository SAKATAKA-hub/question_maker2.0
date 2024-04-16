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
    public static function uploadStorageText( $dir, $new_text, $old_text='', $st_count=140)
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
        $file_path = $text;

        //余計な記号をを除去
        preg_match_all('/[a-zA-Z0-9\/._-]+/', $file_path, $matches);
        $file_path = implode('', $matches[0]);

        // パスから改行を取り除く
        $file_path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $file_path);


        if( Storage::exists( $file_path ) ){ storage::delete( $file_path ); }
    }




    /**
     * ストレージ画像ファイルの更新
     *
     * @param  String $dir             //保存先ディレクトリ
     * @param  String $request_file    //画像のリクエスト
     * @param  String $old_image_path  //更新前の画像パス
     * @param  String $image_dalete    //画像を削除するか否か
     * @param  String $copy_image_puth //コピー用画像パス
     * @return String $file_path       //ファイルパス
     */
    public static function uploadStorageImage( $dir, $request_file, $old_image_path='', $image_dalete=null, $copy_image_puth=null )
    {

        /* 画像削除なら、保存パスをNULLにする */
        $image_path = !$image_dalete ? $old_image_path : null;


        /* アップロードする画像があるとき */
        if( $request_file )
        {
            //1. 画像のアップロード
            $image_path =  $request_file->store($dir);

            //2. 更新前のファイルを削除
            if( $old_image_path && Storage::exists( $old_image_path ) ){ storage::delete( $old_image_path ); }

        }

        /* インスタンスコピーのとき(コピーパスがあり、新規インスタンスのとき) */
        else if( $copy_image_puth && !$old_image_path  )
        {
            //ストレージファイルのコピー
            $image_path = self::copyStorageFile( $dir, $copy_image_puth );
        }
        return $image_path;
    }





    /**
     * ストレージファイルのコピー
     *
     * @param String $dir         //保存先ディレクトリ
     * @param String $path        //コピー元のファイルパス
     *
     * @return String $file_path  //ファイルパス、または$st_count文字以下のテキスト
     */
    public static function copyStorageFile( $dir, $path )
    {
        $old_path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '',$path);

        $new_path = '';
        if( Storage::exists( $old_path ) ){

            // 採番の取得($num)
            $num_file = $dir.'file_num.txt';
            $num = Storage::exists($num_file) ? (int) Storage::get($num_file) : 0;
            $num = $num + 1;
            storage::put( $num_file, $num );

            //コピーするファイルの拡張子
            $ext = substr( $old_path, strrpos($old_path, ".") );

            //新しいファイルパス
            $new_path = $dir.sprintf('%06d', $num).$ext;

            // ストレージファイルのコピー・DBにパスの値を渡す
            storage::copy( $old_path, $new_path );
        }


        return $new_path;
    }
}
