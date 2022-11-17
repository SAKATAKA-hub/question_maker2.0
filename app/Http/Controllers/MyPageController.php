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


        $keep_question_groups =
        \App\Models\KeepQuestionGroup::where('user_id', $user->id)
        ->where('keep',1)
        ->orderBy('created_at','desc') //いいねが新しい順
        ->paginate( env('APP_PAGENATE_COUNT') );



        return view('Mypage.like_list',compact('keep_question_groups'));
    }


    # 通知(infomation_list)
    public function infomation_list()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('Mypage.infomation_list',compact('user'));
    }


}
