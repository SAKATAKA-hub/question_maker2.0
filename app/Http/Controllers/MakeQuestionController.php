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
|  問題を作る　処理
| =================================
*/
class MakeQuestionController extends Controller
{

    /**
     * 問題の新規作成ページの表示(create)
     * @param QuestionGroup $question_group //問題集グループ
     * @return \Illuminate\View\View
    */
    public function create(QuestionGroup $question_group)
    {
        return view('MakeQuestion.edit', compact('question_group') );
    }


    /**
     * 新規作成問題の保存(store)
     * @param \Illuminate\Http\Request $request
     * @param QuestionGroup $question_group //問題集グループ
     * @return \Illuminate\View\View
    */
    public function store(Request $request, QuestionGroup $question_group)
    {
        # 問題順の入替え
        MakeQuestionInput::ChangeOrder( $request,$question_group );


        # 問題情報の保存
        $inputs = MakeQuestionInput::Index( $request, $question_group );
        $question = new Question($inputs);
        $question->save();


        # 解答選択肢の新規作成

            /* 0.基本情報 */
            $answer_booleans = $inputs['answer_booleans']; //「正解」の選択肢のkey番号を保存
            $answer_texts    = $inputs['answer_texts'];    //選択肢のテキストを順に保存する配列


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

                    $question_option = new QuestionOption( $data );
                    $question_option->save();

                }else{ /* DBデータ無し、テキストの入力なし => 処理なし*/ }


            }//end for

        //


        # 基本情報更新日時の更新
        $question_group->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $question_group->save();

        $request->session()->regenerateToken(); //二重投稿防止

        # 問題集の編集ヶ所選択ページへリダイレクト
        $param = ['question_group'=> $question_group->id, 'tab_menu'=>'tab02',];
        return redirect()->route('make_question_group.select_edit', $param)
        ->with('alert-info','問題を1件登録しました。');
    }




    /**
     * 問題の編集ページの表示(edit)
     * @param \Illuminate\Http\Request $request
     * @param Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function edit( Request $request, Question $question )
    {
        # 問題集の取得
        $question_group = QuestionGroup::find($question->question_group_id);
        return view('MakeQuestion.edit', compact( 'question_group', 'question' ) );
    }




    /**
     * 問題選択肢情報のAPI取得(question_options_api)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function question_options_api( Request $request )
    {
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
        $question_options = Question::find($request->question_id)->question_options;
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
     * @param Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function update( Request $request, Question $question )
    {
        # 問題集データ
        $question_group = $question->question_group;

        # 問題順の入替え
        MakeQuestionInput::ChangeOrder( $request,$question_group, $question );


        # 問題情報の保存
        $inputs = MakeQuestionInput::Index( $request, $question_group, $question );
        $question->update($inputs);
        $question->save();


        # 解答選択肢の更新

            /* 0.基本情報 */
            $option_ids      = $inputs['option_ids'];      //更新する選択肢IDを順に保存する配列（新規作成はnull）
            $answer_booleans = $inputs['answer_booleans']; //「正解」の選択肢のkey番号を保存
            $answer_texts    = $inputs['answer_texts'];    //選択肢のテキストを順に保存する配列


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

                        $question_option = new QuestionOption( $data );
                        $question_option->save();

                    }else{ /* DBデータ無し、テキストの入力なし => 処理なし*/ }

                }
                /* 3.DBデータあり、テキストの入力あり => DBデータの更新 */
                else if( $answer_texts[ $key ] )
                {
                    $question_option = QuestionOption::find( $option_ids[ $key ] );
                    $question_option->update( $data );

                }
                /* 4.DBデータあり、テキストの入力無し => DBデータの削除 */
                else
                {
                    $question_option = QuestionOption::find( $option_ids[ $key ] );
                    $question_option->delete();

                }

            }//end for

        //


        # 基本情報更新日時の更新
        $question_group->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $question_group->save();

        $request->session()->regenerateToken(); //二重投稿防止

        # 問題集の編集ヶ所選択ページへリダイレクト
        $param = ['question_group'=> $question_group->id, 'tab_menu'=>'tab02',];
        return redirect()->route('make_question_group.select_edit', $param)
        ->with('alert-warning','問題を1件修正しました。');
    }




    /**
     * 問題の削除(destroy)
     * @param \Illuminate\Http\Request $request
     * @param Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function destroy( Request $request, Question $question )
    {
        # 問題集データ
        $question_group = $question->question_group;


        # アップロードファイルを削除(問題画像)
        $delete_path = $question->image;
        if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }
        # アップロードファイルを削除(解説画像)
        $delete_path = $question->commentary_image;
        if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }


        # ストレージテキストの削除(問題文)
        $delete_path = $question->text;
        Method::deleteStorageText( $delete_path );
        # ストレージテキストの削除(解説文)
        $delete_path = $question->commentary_text;
        Method::deleteStorageText( $delete_path );



        # 問題順の入替え

            // 指定番号($question->order)以上の問題をすべて取得
            $order_questions = Question::where('question_group_id',$question_group->id)
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


        # 問題数が0のとき、問題集を非公開に設定
        if( $question_group->questions->count() < 1 ){
            $question_group->update([ 'published_at' => null , ]);
        }


        # 基本情報更新日時の更新
        $question_group->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $question_group->save();


        # 問題集の編集ヶ所選択ページへリダイレクト
        $param = ['question_group'=> $question_group->id, 'tab_menu'=>'tab02',];
        return redirect()->route('make_question_group.select_edit', $param)
        ->with('alert-danger','問題を1件削除しました。');

    }




    /**
     * 問題のコピー(copy)
     * @param \Illuminate\Http\Request $request
     * @param Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function copy( Request $request, Question $question )
    {
        # 問題集の取得
        $question_group = QuestionGroup::find($question->question_group_id);

        # ユーザー情報
        $user = Auth::user();

        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::where('user_id',$user->id)
        ->orderBy('created_at','desc')
        ->get();

        return view('MakeQuestion.copy', compact( 'question_group','question_groups', 'question' ) );
    }




    /**
     * 問題のコピーの処理(copy_post)
     * @param \Illuminate\Http\Request $request
     * @param Question $question //問題集グループ
     * @return \Illuminate\View\View
    */
    public function copy_post( Request $request, Question $question )
    {
        $question_group = QuestionGroup::find($request->question_group_id);
        dd($question_group->toArray());
    }

}
