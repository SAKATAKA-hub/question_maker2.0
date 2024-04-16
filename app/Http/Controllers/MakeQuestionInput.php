<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestionGroup;
use App\Models\Question;
use App\Models\QuestionOption;
/*
| =================================
|  問題を作る　入力メソッド
| =================================
*/
class MakeQuestionInput extends Controller
{
    /**
     * 入力データの加工 MakeQuestionInput::Index( $request, $question )
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group
     * @param \App\Models\Question $question //新規登録のとき===null
     *
     * @return Array
     */
    public static function Index( $request, $question_group, $question=null )
    {


        # 入力情報の保存
        $inputs = [
            'question_group_id' => $question_group->id,

            "order"           => $request->order,
            "text"            => $request->text,
            "answer_type"     => $request->answer_type,
            "answer_booleans" => $request->answer_booleans,
            "option_ids"      => $request->option_ids,
            "answer_texts"    => $request->answer_texts,
            "image_dalete"    => $request->image_dalete,
            "commentary_image_dalete" => $request->commentary_image_dalete,
            "commentary_text" => $request->commentary_text,
        ];


        # 入力情報のデコード処理
        $inputs['text']           = urldecode($request->text);
        $inputs['commentary_text']= urldecode($request->commentary_text);
        $answer_texts = $request->answer_texts;
        for ($i=0; $i < count( $answer_texts ); $i++) {
            $answer_texts[$i] = urldecode( $answer_texts[$i] );
        }
        $inputs['answer_texts'] = $answer_texts;

        // dd($inputs['text']   ) ;




        # 画像のアップロード
        $dir = 'upload/user/question/image/'; //保存先ディレクトリ
        $request_file    = $request->file('image');     //画像のリクエスト
        $old_image_path  = $question? $question->image: null; //更新前の画像パス
        $image_dalete    = $request->image_dalete;      //画像を削除するか否か
        $inputs['image']  = Method::uploadStorageImage( $dir, $request_file, $old_image_path, $image_dalete );
        // dd($request->file('image'));
        // dd($inputs['image']);


        # テキストのストレージ保存
        $dir = 'upload/user/question/text/';
        $new_text = $inputs['text'];
        $old_text = $question ? $question['text'] : null;
        $inputs['text'] = Method::uploadStorageText( $dir, $new_text, $old_text );



        # 解説画像のアップロード
        $dir = 'upload/user/question/commentary_image/'; //保存先ディレクトリ
        $request_file    = $request->file('commentary_image');     //画像のリクエスト
        $old_image_path  = $question? $question->commentary_image : null; //更新前の画像パス
        $image_dalete    = $request->commentary_image_dalete;      //画像を削除するか否か
        $inputs['commentary_image']= Method::uploadStorageImage( $dir, $request_file, $old_image_path, $image_dalete );


        # 解説テキストのストレージ保存
        $dir = 'upload/user/question/commentary_text/';
        $new_text = $inputs['commentary_text'];
        $old_text = $question ?  $question['commentary_text'] : null;
        $inputs['commentary_text'] = Method::uploadStorageText( $dir, $new_text, $old_text );




        return $inputs;
    }



    /**
     * 問題順の入替え
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group
     * @param \App\Models\Question $question //新規登録のとき===null
     * @return Void
     */
    public static function ChangeOrder( $request, $question_group, $question=null )
    {


        # 順番変更の方向 [+]後ろに移動、[-]:前に移動
        $up_down = $question
        ? $request->order - $question->order //[ 変更後順位 ]-[ 変更前順位 ]
        : -1;


        // データの呼び出し $order_questions = []
        if( $question ){

            // 最初の順番変更箇所
            $first_change_order = $up_down > 0 ? $question->order +1 : $request->order;

            // 最後の順番変更箇所
            $last_change_order  = $up_down > 0 ? $request->order     : $question->order-1;

            $order_questions =  Question::where('question_group_id', $question_group->id)
            ->where( 'order', '>=', $first_change_order )
            ->where( 'order', '<=', $last_change_order )
            ->orderBy('order','asc')->get();


        }else{
            $first_change_order = $request->order;

            $order_questions =  Question::where('question_group_id',$question_group->id)
            ->where( 'order', '>=', $request->order )
            ->orderBy('order','asc')->get();

        }
        // dd($request->order);
        // dd($up_down);
        // dd($order_questions->toArray());



        /* 順位が上がる */
        if( $up_down > 0 )
        {
            $order = $first_change_order - 1;
            foreach ($order_questions as $order_question) {
                $order_question->update(['order'=>$order]);
                $order ++;
            }
        }
        /* 順位が下がる */
        if( $up_down < 0)
        {
            $order = $first_change_order + 1;
            foreach ($order_questions as $order_question) {
                $order_question->update(['order'=>$order]);
                $order ++;
            }

        }

    }
}
