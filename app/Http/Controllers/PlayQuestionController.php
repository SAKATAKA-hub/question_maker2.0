<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
| =================================
|  問題集を解く　処理
| =================================
*/
class PlayQuestionController extends Controller
{
    /**
     * 全ての問題集一覧ページの表示(list)
     * @return \Illuminate\View\View
    */
    public function list()
    {

        # 人気な問題集トップ５
        $popular_question_groups =
        \App\Models\QuestionGroup::orderBy('accessed_count','desc') //アクセス数が高い順
        ->orderBy('published_at','desc') //公開順
        ->where('published_at', '<>', null) //非公開は除く
        ->limit(5)->get();


        # 新着問題集トップ１０
        $new_question_groups =
        \App\Models\QuestionGroup::orderBy('published_at','desc') //公開順
        ->where('published_at', '<>', null) //非公開は除く
        ->limit(10)->get();



        # ページの表示
        return view('PlayQuestion.questions_list', compact(
            'popular_question_groups','new_question_groups',
        ));
    }


    /**
     * 検索結果一覧の表示(questions_search_list)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function questions_search_list( Request $request )
    {


        # キーワード
        $keywords = str_replace( '　',' ',$request->seach_keywords );

        # 並び順（デフォルト=>公開新着順）
        $order = isset($request->order) ?  explode(',',$request->order) : ['published_at','desc'];


        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::search( $keywords )
        ->where('published_at', '<>', null) //非公開は除く
        ->orderBy( $order[0], $order[1])
        ->paginate(env('APP_PAGENATE_COUNT'));


        $order = implode(',',$order);

        # ページの表示
        return view('PlayQuestion.questions_search_list', compact('question_groups', 'keywords','order'));

    }



    /**
     * 問題を解く(play_question)
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @param String $key //認証キー
     * @return JSON
    */
    public function play_question(\App\Models\QuestionGroup $question_group, $key=null)
    {

        # キー認証
        if( $key != $question_group->key ){
            return \App::abort(404);
        }

        # 問題数が0のとき、前ページへ戻る
        if( $question_group->questions->count() < 1 ){
            return redirect()->back()->with('alert-danger',"問題が登録されていません。\n問題を1問以上登録してください。");
        }


        return view('PlayQuestion.play_question', compact('question_group'));
    }


    /**
     * 問題情報の取得(get_questions_api)
     * @param \Illuminate\Http\Request $request
     * @return JSON
    */
    public function get_questions_api( Request $request )
    {
        // 問題集情報
        $question_group = \App\Models\QuestionGroup::find( $request->question_group_id );
        // 問題情報
        $questions = $question_group->questions;

        for ($i=0; $i < $questions->count(); $i++) {
            $question = $questions[ $i ];

            // 画像パス
            $questions[ $i ][ 'image' ] = $question->image ? asset('storage/'.$question->image_puth) : null;

            // 問題文（ストレージ保存）
            $questions[ $i ][ 'text' ] = $question->text_text;

            // 解答選択肢（または正解テキスト）をランダムで取得
            $questions[ $i ][ 'option_answer_texts' ] = $question->option_answer_texts;
        }

        return response()->json([
            'question_group' => $question_group,
            'questions' => $question_group->questions,
            'time_limit' => $question_group->time_limit,
            // 'time_limit' => null,
        ]);
    }




    /**
     * 問題の採点(scoring)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function scoring( Request $request )
    {
        // 問題集情報
        $question_group = \App\Models\QuestionGroup::find( $request->question_group_id );

        // 問題情報
        $questions = $question_group->questions;

        // ゲストユーザーアカウント
        $gest_user = \App\Models\User::where('email', env('GEST_MAIL_ADDRESS') )->first();

        // 利用者（ログイン中でなければ、ゲストユーザーとして保存）
        $user = Auth::check() ? Auth::user() : $gest_user;


        # 解答グループのDB保存（ログイン中）
        $answer_group = new \App\Models\AnswerGroup([
            'score'             => 0,
            'user_id'           => $user->id,
            'question_group_id' => $question_group->id,
            'elapsed_time'      => $request->elapsed_time
        ]);
        $answer_group->save();


        # 解答の添削とDB保存
            $correct_count = 0;  //正解数
            for ($q_num=0; $q_num < $questions->count(); $q_num++) {
                $question = $questions[ $q_num ];


                // 解答選択内容と答えが一致するかチェック
                $input_answer_text = $request['answer_'.$q_num]; //選択した答え
                switch ( $question->answer_type ) {
                    /* 解答選択肢が複数の時 */
                    case '2':
                        $question_answer_array = explode(' ',$question->answer); //テキストの答えを配列に変換
                        if ($input_answer_text ){

                            $is_correct = 1;
                            foreach ($input_answer_text as $value) {
                                $is_correct =
                                in_array($value, $question_answer_array) ? $is_correct : 0 ;
                                $is_correct =
                                count( $input_answer_text ) == count( $question_answer_array ) ? $is_correct : 0 ;

                            }
                            //配列から文字列へ変換
                            $input_answer_text = implode(' ',$input_answer_text);

                        } else {
                            $is_correct = 0;
                            $input_answer_text = '';
                        }
                        break;

                    /* それ以外の時 */
                    default:
                        $is_correct = $input_answer_text == $question->answer ? 1 : 0 ;
                        break;

                    //
                }
                $correct_count += $is_correct ? 1 : 0 ; //正解数の加算


                // 解答データ
                $input_aswer = [
                    // 選択内容
                    'text'            => $is_correct ? $question->answer : $input_answer_text,
                    // 正解か否か
                    'is_correct'      => $is_correct,
                    'answer_group_id' => $answer_group->id,
                    'question_id'     => $question->id,
                ];

                // 解答データをDBへ保存
                $answer = new \App\Models\Answer($input_aswer);
                $answer->save();

            }//end for

        //


        # 解答の採点・解答時間

            $score = round( ( $correct_count / $questions->count() )*100 );
            $answer_group->score = $score;
            $answer_group->save();

        //


        # 平均点の計算
        $score_answer_groups =
        \App\Models\AnswerGroup::where('question_group_id',$question_group->id)->get();
        $question_group->average_score = round( $score_answer_groups->sum('score') / $score_answer_groups->count() ,1 );
        $question_group->save();



        # 受検者数の登録
        $question_group->update(['accessed_coun' => $question_group->accessed_count ++]);



        # 成績詳細ページへリダイレクト
        $param = [ 'answer_group'=>$answer_group, 'key'=>$user->key ];
        return redirect()->route( 'results.detail', $param);
    }


}
