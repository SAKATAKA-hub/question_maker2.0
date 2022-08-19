<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|  クリエーターページ　処理
| =================================
*/

class CreaterUserController extends Controller
{
    # 公開中問題集一覧[クリエーターページトップ](questin_group_list)
    public function questin_group_list( $creater_user_id )
    {
        $creater_user = \App\Models\User::find( $creater_user_id );

        dd($creater_user);
        return view('CreaterUser.questin_group_list',compact('creater_user'));
    }


    # フォロワー一覧(follower_list)
    public function follower_list( $creater_user_id )
    {
        $creater_user = \App\Models\User::find( $creater_user_id );

        dd($creater_user);
        return view('CreaterUser.follower_list',compact('creater_user'));
    }


    # フォロー中一覧(follow_creater_list)
    public function follow_creater_list( $creater_user_id )
    {
        $creater_user = \App\Models\User::find( $creater_user_id );

        dd($creater_user);
        return view('CreaterUser.follow_creater_list',compact('creater_user'));
    }


    # クリエーター検索(search_creater_list)
    public function search_creater_list( Request $request )
    {

        return view('CreaterUser.search_creater_list');
    }


}
