<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AnswerGroup;
use App\Models\Answer;
use App\Models\QuestionGroup;
/*
| =================================
|  成績　処理
| =================================
*/
class ResultsController extends Controller
{

    /**
     * 成績一覧ページの表示(list)
     * @return \Illuminate\View\View
    */
    public function list()
    {
        # ユーザー情報
        $user = Auth::user();

        # ユーザーの問題集情報の取得
        $answer_groups = \App\Models\AnswerGroup::where('user_id',$user->id)
        ->orderBy('created_at','desc')->paginate(10);


        # ページの表示
        return view('Results.list', compact('answer_groups'));
    }




    /**
     * 詳細成績ページの表示(detail)
     *  ※ログインしていない人用の成績表示法に合わせる。
     *
     * @param \App\Models\AnswerGroup $answer_group
     * @return \Illuminate\View\View
    */
    public function detail( \App\Models\AnswerGroup $answer_group ,$key=null)
    {
        if( $answer_group->user->key != $key )
        {
          return \App::abort(404);
        }

        # 採点
        $answer_group = self::Scoring( $answer_group );

        # 解答情報
        $answers = $answer_group->answers;

        # 問題集情報
        $question_group = $answer_group->question_group;

        # 問題情報
        $questions = $question_group->questions;

        # 新着問題集トップ５
        $new_question_groups =
        \App\Models\QuestionGroup::orderBy('published_at','desc') //公開順
        ->where('published_at', '<>', null) //非公開は除く
        ->limit(5)->get();


        # ページの表示
        return view('Results.detail',
            compact('answer_group', 'answers','question_group','questions','new_question_groups')
        );
    }




    /**
     * 問題の採点
     * @param \Illuminate\Http\Request $request
     * @return AnswerGroup $answer_group
    */
    public static function Scoring( $answer_group )
    {
        # 変数

            $answers = $answer_group->answers;// 解答情報
            $question_group = $answer_group->question_group;// 問題集情報
            $questions = $question_group->questions;// 問題情報


        #　各解答の採点
        foreach ($answers as $answer)
        {
            $question    = $answer->question;
            $answer_text = $answer->text_text;

            switch ( $question->answer_type ) {
                /* 解答選択肢が複数の時 */
                case '2':
                    $question_answer_text = implode(', ',$question->answer); //テキストの答え(配列)を取得
                    $is_correct = ( trim($question_answer_text) == trim($answer_text) ) ? 1 : 0 ;

                    break;

                /* それ以外の時 */
                default:
                    $is_correct = trim($answer_text) == trim($question->answer) ? 1 : 0 ;
                    break;

                //
            }

            ## 合皮の保存
            if($answer->is_correct != $is_correct){
                $answer->update(['is_correct'=>$is_correct]);
            }


        }
        # 合計点の計算
        // 問題作成時の問題数で合計点を計算

            $answer_count  = Answer::where('answer_group_id',$answer_group->id)->get()->count();
            $correct_count = Answer::where('answer_group_id',$answer_group->id)
            ->where('is_correct',1)->get()->count();

            // $score = round( ( $correct_count / $questions->count() )*100 );
            $score = round( ( $correct_count / $answer_count )*100 );
            $answer_group->update(['score'=>$score]);


        /*
        |  平均点の計算
        | { (平均点×アクセス数)＋今回の点数 } ÷ アクセス数+1
        */

            $question_group = QuestionGroup::find($question_group->id);
            $accessed_count = $question_group->answer_groups->count();
            $total_score    = $question_group->answer_groups->sum('score');
            $question_group->update([
                'accessed_count' => $accessed_count,
                'average_score'  => $total_score / $accessed_count,
            ]);


        return AnswerGroup::find($answer_group->id);
    }

}
