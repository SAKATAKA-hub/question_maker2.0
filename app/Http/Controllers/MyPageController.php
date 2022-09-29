<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|  マイページ　処理　
| =================================
*/
class MyPageController extends Controller
{
    # いいねした問題集(like_list)
    public function like_list()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        $keep_question_groups = $user->keep_question_groups;

        $question_groups = [];
        foreach( $keep_question_groups as $keep_question_group )
        {
            $question_groups[] = \App\Models\QuestionGroup::find( $keep_question_group->question_group_id );

        }


        return view('Mypage.like_list',compact('keep_question_groups','question_groups'));
    }


    # 通知(infomation_list)
    public function infomation_list()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('Mypage.infomation_list',compact('user'));
    }


}
