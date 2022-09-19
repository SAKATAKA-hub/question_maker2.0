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
        ->orderBy('created_at','desc')
        ->paginate(10);


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
            $dir = 'upload/user/question_group/image/'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $image_path = null;

            /* アップロードする画像があるとき、画像のアップロード*/
            if( $request_file = $request->file( $input_file_name ) )
            {
                $image_path =  $request->file( $input_file_name )->store($dir);
            }//end if

        //end 画像のアップロード


        # テキストのストレージ保存
        $dir = 'upload/user/question_group/resume/';
        $request->resume = Method::uploadStorageText( $dir, $request->resume );


        # 問題集基本情報の保存
        $question_group = new \App\Models\QuestionGroup([
            'user_id'    => $user->id,
            'title'      => $request->title,
            'resume'     => $request->resume,
            'time_limit' => implode(':',$request->time_limit),
            'image'      => $image_path,
            'tags'       => str_replace(' ','　',$request->tags),//タグの空文字を大文字に統一
            'key'      =>\Illuminate\Support\Str::random(40),
        ]);
        $question_group->save();


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question.create', $question_group)
        ->with('alert-success',"問題集の基本情報を登録しました！\n続けて問題の１問目を作成しましょう。");
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
     * 編集問題集の更新(update)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function update(Request $request, \App\Models\QuestionGroup $question_group )
    {
        # 入力内容の加工
        $input = $request->all();
        $input['tags'] = str_replace(' ','　',$request->tags);//タグの空文字を大文字に統一
        unset($input['_token'], $input['_method']);


        # 公開日の登録
        $input['published_at'] =  $question_group->published_at;
        if( $request->is_public && empty(  $question_group->published_at ) ){
            $input['published_at'] = \Carbon\Carbon::parse('now')->format('Y-m-d H:i:s');
        }


        # 制限時間の登録
        $input['time_limit'] = implode(':',$request->time_limit);


        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/user/question_group/image/'; //保存先ディレクトリ
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


        # テキストのストレージ保存
        $dir = 'upload/user/question_group/resume/';
        $input['resume'] =
        Method::uploadStorageText( $dir, $new_text=$input['resume'] , $old_text=$question_group->resume);


        # 入力内容をDBへ保存
        $question_group->update( $input );


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group )
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

        # ストレージ保存ファイルの削除
        foreach ($question_group->questions as $question) {

            # アップロードファイルを削除
            $delete_path = $question->image;
            if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }

            # ストレージテキストの削除
            $delete_path = $question->text;
            Method::deleteStorageText( $delete_path );

        }


        # 問題集のサムネ画像の削除
        $delete_path = $question_group->image;
        if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }

        # 問題集の説明文を削除
        $delete_path = $question_group->resume;
        Method::deleteStorageText( $delete_path );


        # 問題集のDB情報を削除
        $question_group->delete();


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.list')
        ->with('alert-danger','問題集の基本情報を削除しました。');
    }



    /**
     * 公開設定の更新(update_published)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group //選択した問題集グループ
     * @return \Illuminate\View\View
    */
    public function update_published(Request $request, \App\Models\QuestionGroup $question_group)
    {

        # 公開日の登録
        $request->published_at =  $question_group->published_at;
        if( $request->is_public && empty(  $question_group->published_at ) ){
            $request->published_at = \Carbon\Carbon::parse('now')->format('Y-m-d H:i:s');
        }
        # 非公開の登録
        if( !$request->is_public ){ $request->published_at = null; }


        $question_group->update([
            'published_at'      => $request->published_at,     //公開日
        ]);


        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-primary','問題集の公開設公開設定を更新しました。');
    }





    /**
     * CSVファイルから問題集の新規作成(read_csv_post)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function read_csv_post(Request $request)
    {


        # ユーザー情報
        $user = Auth::user();

        # 解答選択肢のタイプ
        $answer_types = ['テキストで答えを入力する','ひとつの答えを選ぶ','複数の答えを選ぶ'];


        #1.CSVファイルの保存
            $dir = 'upload/csv/questions'; //保存先ディレクトリ
            $csv_path =  $request->file( 'csv' )->store($dir);


        #2.CSVファイルの読み込み=>配列に変換
            $content = trim( Storage::get($csv_path) ); //ファイルの読み込み
            $content = str_replace("\n",'',$content);   //CSVデータを連想配列に変換
            $array1 = explode("\r",$content);
            $array2 = [];
            foreach ($array1 as $line) {
                $array2[] = explode(',',$line);
            }
            storage::delete($csv_path );//CSVファイルの削除


        #3.CSV配列を保存形式データに変換

            //[1]問題集基本情報
            $input_question_group = [
                'user_id'    => $user->id,
                'title'      => $array2[0][1],
                'time_limit' => strlen($array2[1][1]) <= 8 ? '0'.$array2[1][1] : $array2[1][1],
                'resume'     => $array2[2][1],
                'tags'       => str_replace(' ','　',$array2[3][1]),//タグの空文字を大文字に統一
            ];




            //各問題データ

                $array3 = array_slice( $array2, 5 );

                $input_questions = [];
                foreach ($array3 as $num => $line) {
                    $input_question = $line;
                    array_shift( $input_question );//問題の順番を削除
                    $array4 = array_splice( $input_question, 3 );//選択礒情報の移動


                    //[2]問題情報

                        //解答選択肢タイプ番号
                        $answer_type_num = array_search( $input_question[1], $answer_types );
                        // 選択肢の正解数
                        $correct_count = $answer_type_num==2 ? $input_question[2] : 1 ;


                        $input_question = [
                            'question_group_id' => null,
                            'text'              => $input_question[0],
                            'answer_type'       => $answer_type_num,
                            'order'             => $num + 1,
                            'options' => [],
                        ];


                    //[3]問題の選択肢情報

                        # 空要素の削除
                        $key = true;
                        while ($key) {
                            if( $key = array_search( '', $array4 )){ array_splice( $array4 ,$key ,1 ); }
                        }

                        # 選択礒情報
                        $input_options = [];
                        foreach ($array4 as $opt_num => $answer_text) {
                            $input_option = [
                                'question_id'    => null,
                                'answer_text'    => $answer_text,
                                'answer_boolean' => $opt_num < $correct_count ? 1 : 0,
                            ];
                            $input_options[] = $input_option;
                        }


                    // 問題情報に選択肢情報を保存
                    $input_question['options'] = $input_options;
                    $input_questions[] = $input_question;


                }//end foreach
            //


        #4.入力内容のバリデーション
        // ~


        #5.問題集情報をＤＢへ保存


            //[1]問題集基本情報の保存
            $question_group = new \App\Models\QuestionGroup($input_question_group);
            $question_group->save();


            //[2]問題情報の保存
            foreach ($input_questions as $input_question) {

                $question = new \App\Models\Question([
                    'question_group_id' => $question_group->id,
                    'text'              => $input_question['text'],
                    'answer_type'       => $input_question['answer_type'],
                    'order'             => $input_question['order'],
                ]);
                $question->save();


                //[3]問題の選択肢情報の保存
                foreach ($input_question['options'] as $option) {
                    $question_option = new \App\Models\QuestionOption([
                        'question_id'    => $question->id,
                        'answer_text'    => $option['answer_text'],
                        'answer_boolean' => $option['answer_boolean'],
                    ]);
                    $question_option->save();
                }
                // dd($question_option);


            }//end foreach 問題情報の保存




        # 問題集の一覧表示ページへリダイレクト
        return redirect()->route('make_question_group.list')
        ->with('alert-success','CSVファイルから問題集を登録しました。');
    }

}
