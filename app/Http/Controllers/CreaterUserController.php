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

    /**
     * クリエータページのトップへリダイレクト
     * @param mixed \App\Models\User $creater_user
    */
    public function creater_top( \App\Models\User $creater_user)
    {
        $param = [
            'creater_user' => $creater_user,
            'key'          => $creater_user->key,
        ];
        return redirect()->route('creater.questin_group_list', $param );

    }



    /**
     * 公開中問題集一覧[クリエーターページトップ](questin_group_list)
     * @param  \App\Models\User $creater_user
     * @param  String $key //認証キー
     * @return \Illuminate\View\View
    */
    public function questin_group_list( \App\Models\User $creater_user, $key )
    {

        # クリエーターのキー認証
        if( $key != $creater_user->key ){ return \App::abort(404); }


        # クリエイターの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::where('user_id',$creater_user->id)
        ->where('published_at', '<>', null) //非公開は除く
        ->orderBy('published_at','desc')
        ->paginate(env('APP_PAGENATE_COUNT'));


        return view('CreaterUser.questin_group_list',compact('creater_user','question_groups'));
    }



    /**
     * フォロワー一覧(follower_list)
     * @param  \App\Models\User $creater_user
     * @param  String $key //認証キー
     * @return \Illuminate\View\View
    */
    public function follower_list( \App\Models\User $creater_user, $key )
    {
        # クリエーターのキー認証
        if( $key != $creater_user->key ){ return \App::abort(404); }


        return view('CreaterUser.follower_list',compact('creater_user'));
    }



    /**
     * フォロー中一覧(follow_creater_list)
     * @param  \App\Models\User $creater_user
     * @param  String $key //認証キー
     * @return \Illuminate\View\View
    */
    public function follow_creater_list( \App\Models\User $creater_user, $key )
    {
        # クリエーターのキー認証
        if( $key != $creater_user->key ){ return \App::abort(404); }

        return view('CreaterUser.follow_creater_list',compact('creater_user'));
    }




    # クリエーター検索(search_creater_list)
    public function search_creater_list( Request $request )
    {

        return view('CreaterUser.search_creater_list');
    }


}
