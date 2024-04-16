<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;
use App\Models\QuestionGroup;
use App\Models\Question;
use App\Models\QuestionOption;
/*
| =================================
|  問題集を作る　入力メソッド
| =================================
*/
class MakeQuestionGroupInput extends Controller
{
    /**
     * 入力データの加工 MakeQuestionInput::Index( $request, $question )
     *
     * @param \App\Models\QuestionGroup $question_group
     * @param \App\Models\Question $question //新規登録のとき===null
     *
     * @return Array
     */
    public static function Index( $request, $question_group=null )
    {
        # ユーザー情報
        $user = Auth::user();

        # 入力情報の保存
        $inputs = [
            'user_id'    => $user->id,
            'title'      => $request->title,//
            'resume'     => $request->resume,//
            'image'      => $request->image,//
            'time_limit' => implode(':',$request->time_limit),
            'tags'       => str_replace(' ','　',$request->tags),//タグの空文字を大文字に統一
            'key'        => Str::random(40),
        ];


        # 画像のアップロード
        $dir = 'upload/user/question_group/image/'; //保存先ディレクトリ
        $request_file    = $request->file('image');     //画像のリクエスト
        $old_image_path  = $question_group? $question_group->image : null; //更新前の画像パス
        $image_dalete    = $request->image_dalete;      //画像を削除するか否か
        $inputs['image']= Method::uploadStorageImage( $dir, $request_file, $old_image_path, $image_dalete );


        # テキストのストレージ保存
        $dir = 'upload/user/question_group/resume/';
        $new_text = $inputs['resume'];
        $old_text = $question_group ?  $question_group['resume'] : null;
        $inputs['resume'] = Method::uploadStorageText( $dir, $new_text, $old_text );




        return $inputs;

    }


}
