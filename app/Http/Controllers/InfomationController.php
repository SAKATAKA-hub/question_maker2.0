<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * =========================================
 *  Infomation　コントローラー
 * =========================================
*/
class InfomationController extends Controller
{
    /**
     * インフォメーション一覧(list)
     *
     * @return \Illuminate\View\View
    */
    public function list()
    {
        $infomation_data = \App\Models\Infomation::orderBy('publication_at','desc')
        ->where( 'publication_at', '<=', \Carbon\Carbon::parse('today') )
        ->get();
        return view( 'infomation_page.list',compact('infomation_data') );
    }


    /**
     * インフォメーション詳細(post)
     *
     * @param \App\Models\Infomation $infomation
     * @return \Illuminate\View\View
    */
    public function post(\App\Models\Infomation $infomation)
    {
        return view( 'infomation_page.post',compact('infomation') );
    }







    /**
    * お知らせ一覧の表示(admin_infomation_list)
    *
    * @return \Illuminate\View\View
    */
    public function admin_infomation_list()
    {
        $infomation_data = \App\Models\Infomation::orderBy('publication_at','desc')->get();
        return view( 'admin.infomation_list',compact('infomation_data') );
    }


    /**
     * お知らせの表示(admin_infomation_post)
     *
     * @param \App\Models\Infomation $infomation
     * @return \Illuminate\View\View
    */
    public function admin_infomation_post(\App\Models\Infomation $infomation)
    {
        return redirect()->route('infomation_post',$infomation);
    }


    /**
     * 新規お知らせの作成(admin_infomation_create)
     *
     * @return \Illuminate\View\View
    */
    public function admin_infomation_create()
    {
        return view( 'admin.infomation_create' );
    }


    /**
     * 新規お知らせの保存(admin_infomation_store)
     *
     * @param \App\Http\Requests\InfomationFormRequest $request
     * @return \Illuminate\View\View
    */
    public function admin_infomation_store(Request $request)
    // public function admin_infomation_store(\App\Http\Requests\InfomationFormRequest $request)
    {

        $inputs = $request->all();
        unset($inputs["_token"]); //配列からtoken情報を除去


        # 本文が150文字以上の時、ストレージへ保存
        if(
            isset($inputs["body"]) &&
            ( mb_strlen($inputs["body"]) > 150 )
        )
        {
            $dir = 'upload/infomation/';

            // 採番の取得($num)
            $num_file = $dir.'file_num.txt';
            $num = Storage::exists($num_file) ? (int) Storage::get($num_file) : 0;
            $num = $num + 1;
            storage::put( $num_file, $num );


            // ストレージにファイル保存・DBにパスの値を渡す
            $file = $dir.sprintf('%06d.txt', $num);
            storage::put( $file, $inputs["body"] );
            $inputs["body"] = $file;
        }

        $infomation = new \App\Models\Infomation($inputs);
        $infomation->save();

        return redirect()->route( 'admin.infomation_list' )
        ->with('alert-success','記事を1件登録しました。');
    }


    /**
     * お知らせの修正(admin_infomation_edit)
     *
     * @param \App\Models\Infomation $infomation
     * @return \Illuminate\View\View
    */
    public function admin_infomation_edit(\App\Models\Infomation $infomation)
    {
        return view( 'admin.infomation_create',compact('infomation') );
    }


    /**
     * お知らせの修正保存(admin_infomation_update)
     *
     * @param \App\Http\Requests\InfomationFormRequest $request
     * @param \App\Models\Infomation $infomation
     * @return \Illuminate\View\View
    */
    public function admin_infomation_update(Request $request, \App\Models\Infomation $infomation)
    // public function admin_infomation_update(\App\Http\Requests\InfomationFormRequest $request, \App\Models\Infomation $infomation)
    {
        $inputs = $request->all();
        unset($inputs["_token"]); //配列からtoken情報を除去
        unset($inputs["_method"]); //配列からmethod情報を除去


        # 本文が150文字以上の時、ストレージへ保存
        if(
            isset($inputs["body"]) &&
            ( mb_strlen($inputs["body"]) > 150 )
        )
        {
            $dir = 'upload/infomation/';

            // 古いファイルがあれば、古いファイルへ保存
            $old_file = str_replace(["\r\n", "\r", "\n"], '', $infomation->body);
            if( Storage::exists($old_file) )
            {
                // ストレージにファイル保存・DBにパスの値を渡す
                $file = $old_file;
                storage::put( $file, $inputs["body"] );
                $inputs["body"] = $file;
            }
            // 新しいストレージファイルの作成
            else
            {
                // 採番の取得($num)
                $num_file = $dir.'file_num.txt';
                $num = Storage::exists($num_file) ? (int) Storage::get($num_file) : 0;
                $num = $num + 1;
                storage::put( $num_file, $num );


                // ストレージにファイル保存・DBにパスの値を渡す
                $file = $dir.sprintf('%06d.txt', $num);
                storage::put( $file, $inputs["body"] );
                $inputs["body"] = $file;
            }
        }


        # データベースの更新
        $infomation->update($inputs);

        # リダイレクト
        return redirect()->route( 'admin.infomation_list' )
        ->with('alert-info','記事を1件更新しました。');

    }


    /**
     * お知らせの削除(admin_infomation_destroy)
     *
     * @param Illuminate\Http\Request $request
     * @param \App\Models\Infomation $infomation
     * @return \Illuminate\View\View
    */
    public function admin_infomation_destroy(Request $request, \App\Models\Infomation $infomation)
    {

        # ストレージファイルの削除
        $path = str_replace(["\r\n", "\r", "\n"], '', $infomation->body);
        if( \Illuminate\Support\Facades\Storage::exists($path) ){
            \Illuminate\Support\Facades\Storage::delete($path);
        }


        # お問い合わせ情報の削除
        $infomation->delete();


        # リダイレクト
        return redirect()->route( 'admin.infomation_list' )
        ->with('alert-danger', '記事を1件削除しました。');
    }

}
