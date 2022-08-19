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

        return view('Mypage.like_list',compact('user'));
    }


    # 未読コメント(unread_comment_list)
    public function unread_comment_list()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('Mypage.unread_comment_list',compact('user'));
    }


}
