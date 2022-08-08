<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/*
| =================================
|  問題を作る　処理
| =================================
*/
class MakeQuestionController extends Controller
{

    /**
     * 問題の新規作成ページの表示(create)
     * @param \App\Models\QuestionGroup $question_group //問題集グループ
     * @return \Illuminate\View\View
    */
    public function create(\App\Models\QuestionGroup $question_group)
    {
        return view('MakeQuestion.edit', compact('question_group') );
    }


    /**
     * 新規作成問題の保存(store)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group //問題集グループ
     * @return \Illuminate\View\View
    */
    public function store(Request $request, \App\Models\QuestionGroup $question_group)
    {
        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/images/questions'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $image_path = null;

            /* アップロードする画像があるとき、画像のアップロード*/
            if( $request_file = $request->file( $input_file_name ) )
            {
                $image_path =  $request->file( $input_file_name )->store($dir);
            }//end if

        //end 画像のアップロード


        # 問題順の入替え

            // 指定番号($request->order)以上の問題をすべて取得
            $order_questions = \App\Models\Question::where('question_group_id',$question_group->id)
            ->where( 'order', '>=', $request->order )
            ->orderBy('order','asc')->get();

            // 順番IDの更新
            $order = $request->order + 1;
            foreach ($order_questions as$order_queston) {
               $order_queston->update(['order'=>$order]);
                $order ++;
            }

        //end 問題順の入替え


        # 問題情報の保存
        $question = new \App\Models\Question([
            'question_group_id' => $question_group->id,
            'text' => $request->text,
            'answer_type' => $request->answer_type,
            'order' => $request->order,
            'image' => $image_path,
        ]);
        $question->save();





        # 解答選択肢の新規作成

            /* 0.基本情報 */
            $answer_booleans = $request->answer_booleans; //「正解」の選択肢のkey番号を保存
            $answer_texts    = $request->answer_texts   ; //選択肢のテキストを順に保存する配列

            for ( $key=0; $key < count( $answer_texts ); $key++ )
            {
                // 保存データ
                $data = [
                    'question_id'    => $question->id,
                    'answer_text'    => $answer_texts[ $key ],
                    'answer_boolean'
                    => in_array( $key ,$answer_booleans  ) ? 1 : 0, //keyが存在すれば、正解:1
                ];


                /* テキストの入力あり => DBデータの新規作成 */
                if( $answer_texts[ $key ] ){

                    $question_option = new \App\Models\QuestionOption( $data );
                    $question_option->save();

                }else{ /* DBデータ無し、テキストの入力なし => 処理なし*/ }


            }//end for

        //


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-success','問題を1件登録しました。');
    }


    /**
     * 問題の編集ページの表示(edit)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function edit( Request $request, \App\Models\Question $question )
    {
        # 問題集の取得
        $question_group = \App\Models\QuestionGroup::find($question->question_group_id);
        return view('MakeQuestion.edit', compact( 'question_group', 'question' ) );
    }


    /**
     * 問題選択肢情報のAPI取得(question_options_api)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function question_options_api( Request $request )
    {

        // dd( $request->all());
        /*
            送信データ形式
            options: [
                { answer_text: '', only: true , button_text: '正　解', id: null},
                { answer_text: '', only: false, button_text: '不正解', id: null},
                { answer_text: '', only: false, button_text: '不正解', id: null},
                { answer_text: '', only: false, button_text: '不正解', id: null},
            ],

            answer_booleans: [0,],
        */
        $options = [];
        $answer_booleans = [];


        # 問題選択肢データの加工
        $question_options = \App\Models\Question::find($request->question_id)->question_options;
        foreach ($question_options as $n => $question_option)
        {
            $options[] = [
                'answer_text' => $question_option->answer_text ,
                'only'        => $n == 0 ? true : false ,
                'button_text' => $question_option->answer_boolean ? '正　解' : '不正解' ,
                'id'          => $question_option->id
            ];

            if( $question_option->answer_boolean ){
                $answer_booleans[] = $n;
            }
        }

        # JSONレスポンス
        return response()->json( compact( 'options', 'answer_booleans' )  );

    }


    /**
     * 編集問題の保存(update)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function update( Request $request, \App\Models\Question $question )
    {
        # 問題集データ
        $question_group = $question->question_group;


        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/images/questions'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $old_image_path = $question->image;
            $image_path = null;

            /* アップロードする画像があるとき、画像のアップロード*/
            if( $request_file = $request->file( $input_file_name ) )
            {
                // ファイルのアップロード
                $image_path =  $request->file( $input_file_name )->store($dir);

                // 更新前のアップロードファイルを削除
                $delete_path = $old_image_path;
                if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }

            }else{
                $image_path = $old_image_path;
            }

        //end 画像のアップロード


        # 問題順の入替え

            // 順番変更の方向 [+]後ろに移動、[-]:前に移動
            $up_down = $request->order - $question->order; //[ 変更後順位 ]-[ 変更前順位 ]

            // 最初の順番変更箇所
            $first_change_order = $up_down > 0 ? $question->order +1 : $request->order;
            // 最後の順番変更箇所
            $last_change_order  = $up_down > 0 ? $request->order     : $question->order -1;

            // dd($up_down);
            $order_questions = \App\Models\Question::where('question_group_id',$question_group->id)
            ->where( 'order', '>=', $first_change_order )
            ->where( 'order', '<=', $last_change_order )
            ->orderBy('order','asc')->get();

            // dd( $questions );
            // dd( $first_change_order +1 );

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

        //end 問題順の入替え



        # 問題情報の保存
        $question->update([
            'question_group_id' => $question_group->id,
            'text' => $request->text,
            'answer_type' => $request->answer_type,
            'order' => $request->order,
            'image' => $image_path,
        ]);
        $question->save();


        # 解答選択肢の更新

            /* 0.基本情報 */
            $option_ids      = $request->option_ids     ; //更新する選択肢IDを順に保存する配列（新規作成はnull）
            $answer_booleans = $request->answer_booleans; //「正解」の選択肢のkey番号を保存
            $answer_texts    = $request->answer_texts   ; //選択肢のテキストを順に保存する配列


            /* 1.DBデータの削除指示 => DBデータの削除 */
            $question_options = $question->question_options;
            $count = $question->question_options->count();
            for ($i=0; $i < $count; $i++)
            {
                //$option_ids配列の中に、IDが存在しないとき => DBデータの削除
                $question_option = $question->question_options[ $i ];
                if( !in_array( $question_option->id, $option_ids ) ){
                    $question_option->delete();
                }
            }


            for ( $key=0; $key < count( $option_ids ); $key++ )
            {
                // 保存データ
                $data = [
                    'question_id'    => $question->id,
                    'answer_text'    => $answer_texts[ $key ],
                    'answer_boolean'
                    => in_array( $key ,$answer_booleans  ) ? 1 : 0, //keyが存在すれば、正解:1
                ];


                /* 2.DBデータ無し、テキストの入力あり => DBデータの新規作成 */
                if ( $option_ids[ $key ] === null )
                {
                    if( $answer_texts[ $key ] ){

                        $question_option = new \App\Models\QuestionOption( $data );
                        $question_option->save();

                    }else{ /* DBデータ無し、テキストの入力なし => 処理なし*/ }

                }
                /* 3.DBデータあり、テキストの入力あり => DBデータの更新 */
                else if( $answer_texts[ $key ] )
                {
                    $question_option = \App\Models\QuestionOption::find( $option_ids[ $key ] );
                    $question_option->update( $data );

                }
                /* 4.DBデータあり、テキストの入力無し => DBデータの削除 */
                else
                {
                    $question_option = \App\Models\QuestionOption::find( $option_ids[ $key ] );
                    $question_option->delete();

                }

            }//end for

        //


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-warning','問題を1件修正しました。');
    }




    /**
     * 問題の削除(destroy)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function destroy( Request $request, \App\Models\Question $question )
    {
        # 問題集データ
        $question_group = $question->question_group;


        # アップロードファイルを削除
        $delete_path = $question->image;
        if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }


        # 問題順の入替え

            // 指定番号($question->order)以上の問題をすべて取得
            $order_questions = \App\Models\Question::where('question_group_id',$question_group->id)
            ->where( 'order', '>', $question->order )
            ->orderBy('order','asc')->get();

            // 順番IDの更新
            $order = $question->order ;
            foreach ($order_questions as$order_queston) {
               $order_queston->update(['order'=>$order]);
                $order ++;
            }

        //end 問題順の入替え


        # 問題の削除
        $question->delete();


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-danger','問題を1件削除しました。');
    }




}
