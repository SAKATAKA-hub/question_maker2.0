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
     * 公開中問題集一覧API[(api_questin_group_list)
     * @param  \App\Models\User $creater_user
     * @param  String $key //認証キー
     * @return \Illuminate\View\View
    */
    public function api_questin_group_list( \App\Models\User $creater_user, $key )
    {

        # クリエーターのキー認証
            if( $key != $creater_user->key ){ return response()->json([],500); }


        # 送信用クリエーター情報($creater)の編集
            $creater = [
                'url'          => route( 'creater.questin_group_list',
                ['creater_user'=>$creater_user->id,'key'=>$creater_user->key] ),

                'id'           => $creater_user->id,
                'name'         => $creater_user->name,
                'key'          => $creater_user->key,
                'image_puth'   => asset( 'storage/'. $creater_user->image_puth ),
                'profile_text' => $creater_user->profile_text,
            ];


        # クリエイターの問題集情報の取得
            $question_groups = \App\Models\QuestionGroup::where('user_id',$creater_user->id)
            ->where('published_at', '<>', null) //非公開は除く
            ->orderByDesc('id')
            ->get();


            $array = [];
            foreach ($question_groups as $question_group) {
                $array[] = [
                    'url' =>
                    route( 'play_question', ['question_group'=>$question_group->id,'key'=>$question_group->key] ),

                    'title'               => $question_group->title,
                    'tags'                => $question_group->tags,
                    'time_limit'          => $question_group->time_limit,
                    'published_at'        => $question_group->published_at,
                    'accessed_count'      => $question_group->accessed_count,
                    'evaluation_points'   => $question_group->evaluation_points,
                    'average_score'       => $question_group->average_score,
                    'image_puth'          => asset( 'storage/'.$question_group->image_puth),
                    'discription'         => $question_group->resume_text_truncate, //ディスクリプション

                    'esume_text'          => $question_group->esume_text,
                    'befor_datetime_text' => $question_group->befor_datetime_text,
                    'question_count'      => $question_group->question_count,
                    'time_limit_text'     => $question_group->time_limit_text,
                ];
            }
            $question_groups = $array;

        #
        // dd( $question_groups[0] );
        // dd( $creater );


        return response()->json( compact( 'creater', 'question_groups', ) );
    }




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
