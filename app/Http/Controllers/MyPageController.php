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

        # クリエイターの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::where('user_id',$user->id)
        ->where('published_at', '<>', null) //非公開は除く
        ->orderBy('published_at','desc')
        ->paginate(10);

        return view('Mypage.like_list',compact('user','question_groups'));
    }


    # 通知(infomation_list)
    public function infomation_list()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('Mypage.infomation_list',compact('user'));
    }


}
