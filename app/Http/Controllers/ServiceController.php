<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
/*
| =================================
|  その他サービス
| =================================
*/
class ServiceController extends Controller
{
    /*
    | ------------------------------------------------
    |  キープ( お気に入り・フォロー・評価 )
    | ------------------------------------------------
    */

        /**
         * 問題集のキープ[お気に入り](keep_question_group_api)
         * @param \Illuminate\Http\Request $request
         *  ['user_id'=>'ユーザーID', 'question_group_id'=>'問題集ID', 'keep'=>'キープの可否', ]
         * @return JSON
        */
        public function keep_question_group_api(Request $request)
        {
            $keep =
            \App\Models\KeepQuestionGroup::where('user_id',$request->user_id)
            ->where('question_group_id',$request->question_group_id)->first();
            // dd($keep);


            #1.キープの新規登録
            if( !$keep ){

                $new_keep = new \App\Models\KeepQuestionGroup([
                    'user_id'           => $request->user_id,
                    'question_group_id' => $request->question_group_id
                ]);
                $new_keep->save();
            }
            #2.キープの更新
            else{
                $keep->update(['keep' => $request->keep]);
            }


            # JSONを返す
            return response()->json(['comment' => 'ok',]);
        }


        /**
         * クリエーターユーザーのキープ[フォロー](keep_creator_user_api)
         * @param \Illuminate\Http\Request $request
         *  ['user_id'=>'ユーザーID', 'creater_user_id'=>'問題集ID', 'keep'=>'キープの可否', ]
         * @return JSON
        */
        public function keep_creator_user_api(Request $request)
        {
            $keep =
            \App\Models\KeepCreatorUser::where('user_id',$request->user_id)
            ->where('creater_user_id',$request->creater_user_id)->first();
            // dd($keep);


            #1.キープの新規登録
            if( !$keep ){

                $new_keep = new \App\Models\KeepCreatorUser([
                    'user_id'           => $request->user_id,
                    'creater_user_id' => $request->creater_user_id
                ]);
                $new_keep->save();
            }
            #2.キープの更新
            else{
                $keep->update(['keep' => $request->keep]);
            }


            # JSONを返す
            return response()->json(['comment' => 'ok',]);
        }


        # 問題集の評価(question_group_evaluation_api)
        // ~




    /*
    | ------------------------------------------------
    |  問題集へのコメント
    | ------------------------------------------------
    */

        /**
         * 問題集へのコメント[投稿](comment_post_api)
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function comment_post_api(Request $request)
        {
            # 入力内容の修正
            $input = $request->only([
                'user_id','gest_name','gest_email','question_group_id','body',
            ]);

            # 投稿内容をDBに保存
            $comment = new \App\Models\QuestionGroupComment($input);
            $comment->save();


            # JSONを返す
            return response()->json(['comment' => 'ok',]);
        }
        # 問題集へのコメント[一覧](comment_list_api)
        # 問題集へのコメント[削除](comment_destroy_api)


    /*
    | ------------------------------------------------
    |  規約違反問題集の通報
    | ------------------------------------------------
    */
        /**
         * 規約違反問題集の通報[投稿]  (violation_report_post_api)
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function violation_report_post_api(Request $request)
        {
            # 入力内容の修正
            $input = $request->only([
                'user_id','gest_name','gest_email','question_group_id','body',
            ]);
            // dd($input);

            # 通報内容をDBに保存
            $violation_report = new \App\Models\QuestionGroupViolationReport($input);
            $violation_report->save();


            # JSONを返す
            return response()->json(['comment' => 'ok',]);
        }


        # 規約違反問題集の通報[一覧]  (violation_report_list_api)
        # 規約違反問題集の通報[対応済](violation_report_responsed_api)


    /*
    | ------------------------------------------------
    |  お問い合わせ
    | ------------------------------------------------
    */
        /**
         * お問い合わせ[投稿](contact_post_api)
         * @param \Illuminate\Http\Request $request
         * @return JSON
        */
        public function contact_post_api(Request $request)
        {
            # 入力内容の修正
            $input = $request->only([
                'user_id','gest_name','gest_email','body',
            ]);
            // dd($input);

            # お問い合わせ内容をDBに保存
            $contact = new \App\Models\Contact($input);
            $contact->save();


            # JSONを返す
            return response()->json(['comment' => 'ok',]);
        }


        # お問い合わせ[一覧](contact_list_api)
        # お問い合わせ[削除](contact_destroy_api)

    //
}
