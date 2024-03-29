<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

        // 解答情報
        $answers = $answer_group->answers;

        // 問題集情報
        $question_group = $answer_group->question_group;

        // 問題情報
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

}
