<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
/*
| =================================
|  問題集を作る　処理
| =================================
*/
class MakeQuestionGroupController extends Controller
{
    /**
     * 問題集の一覧表示(list)
     * @return \Illuminate\View\View
    */
    public function list()
    {
        # ユーザー情報
        $user = Auth::user();

        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::where('user_id',$user->id)
        ->orderBy('created_at','desc')->get();

        # ページの表示
        return view('MakeQuestionGroup.list', compact('question_groups'));
    }




    /**
     * 問題集の新規作成表示(create)
     * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('MakeQuestionGroup.edit');
    }



    /**
     * 新規作成問題集の保存(store)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function store(Request $request)
    {

        # ユーザー情報
        $user = Auth::user();


        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/images/question_groups'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $image_path = null;

            /* アップロードする画像があるとき、画像のアップロード*/
            if( $request_file = $request->file( $input_file_name ) )
            {
                $image_path =  $request->file( $input_file_name )->store($dir);
            }//end if

        //end 画像のアップロード



        # 問題集基本情報の保存
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title' => $request->title,
            'resume' => $request->resume,
            'image' => $image_path,
            'tags' => str_replace(' ','　',$request->tags),//タグの空文字を大文字に統一
        ]);
        $question_group->save();


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-success','問題集の基本情報を登録しました。');
    }




    /**
     * 問題集の編集ヶ所選択ページの表示(select_edit)
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function select_edit(\App\Models\QuestionGroup $question_group)
    {
        return view('MakeQuestionGroup.select_edit', compact('question_group') );
    }




    /**
     * 問題集の編集表示(edit)
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function edit(\App\Models\QuestionGroup $question_group)
    {
        return view('MakeQuestionGroup.edit', compact('question_group') );
    }




    /**
     * 編集問題集の保存(update)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function update(Request $request, \App\Models\QuestionGroup $question_group)
    {
        # 入力内容の加工
        $input = $request->all();
        $input['tags'] = str_replace(' ','　',$request->tags);//タグの空文字を大文字に統一
        unset($input['_token'], $input['_method']);


        # 公開日の登録
        $input['published_at'] = null;
        if( $request->is_public ){
            $input['published_at'] = \Carbon\Carbon::parse('now')->format('Y-m-d H:i:s');
        }


        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/images/question_groups'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $old_image_path = $question_group->image;
            $image_path = null;

            /* アップロードする画像があるとき、画像のアップロード*/
            if( $request_file = $request->file( $input_file_name ) )
            {
                // ファイルのアップロード
                $image_path =  $request->file( $input_file_name )->store($dir);

                // 更新前のアップロードファイルを削除
                $delete_path = $old_image_path;
                if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }

            }else{
                $image_path = $old_image_path;
            }

            /* 画像パスを入力内容に追加*/
            $input['image'] = $image_path;

        //end 画像のアップロード


        # 入力内容をDBへ保存
        $question_group->update( $input );


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-warning','問題集の基本情報を更新しました。');
    }


    /**
     * 問題集の削除(destroy)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function destroy(Request $request, \App\Models\QuestionGroup $question_group)
    {

        # 各問題のアップロード画像の削除
        foreach ($question_group->questions as $question) {
            $delete_path = $question->image;
            if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }
        }


        # 問題集のサムネ画像の削除
        $delete_path = $question_group->image;
        if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }


        # 問題集の削除
        $question_group->delete();



        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.list')
        ->with('alert-danger','問題集の基本情報を削除しました。');
    }

}
