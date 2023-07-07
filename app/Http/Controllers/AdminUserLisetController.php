<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|   Admin 登録会員一覧　コントローラー
| =================================
*/

class AdminUserLisetController extends Controller
{

    /**
     * 登録会員リスト(list)
     * @return \Illuminate\View\View
    */
    public function list()
    {
        # ユーザー情報の取得
        $users = \App\Models\User::getApiData();

        return view('Admin.user_list.list', compact('users') );
    }




    /**
     * 問題集リスト(question_groups)
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
    */
    public function question_groups( \App\Models\User $user )
    {
        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::where('user_id',$user->id)
        ->orderBy('created_at','desc')
        ->paginate(10);

        $creater_user = $user;

        return view('Admin.user_list.question_groups', compact( 'user','creater_user','question_groups',) );
    }





    /**
     * 登録会員 問題集情報(question_group_ditail)
     * @param \App\Models\User $user
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function question_group_ditail( \App\Models\User $user, \App\Models\QuestionGroup $question_group)
    {
        $creater_user = $user;
        $tab_menu='tab01';

        return view('Admin.user_list.question_group_ditail', compact( 'user','creater_user','question_group','tab_menu') );
    }



    /**
     * 登録会員 問題集情報(question_group_array)
     * @param \App\Models\User $user
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function question_group_array( \App\Models\User $user, \App\Models\QuestionGroup $question_group)
    {
        $question_group = \App\Models\QuestionGroup::with('questions')->find( $question_group->id );
        dd($question_group->toArray());
    }


}
