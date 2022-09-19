<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/*
| =================================
|  各種設定　処理
| =================================
*/
class SettingsController extends Controller
{
    # プロフィール・設定変更　表示(settings)
    public function settings()
    {
        return view('Mypage.settings');
    }


    # プロフィールの変更(update_user_profile)
    public function update_user_profile(Request $request)
    {

        $user = \Illuminate\Support\Facades\Auth::user();


        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/user/image/'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $old_image_path = $user->image;
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

        //end 画像のアップロード


        # テキストのストレージ保存
        $dir = 'upload/user/profile/';
        $request->profile =
        Method::uploadStorageText( $dir, $new_text=$request->profile, $old_text=$user->profile );


        # DBの更新
        $user->update([
            'name'    => $request->name,
            'image'   => $image_path,
            'profile' => $request->profile,
        ]);


        return redirect()->route('settings')
        ->with('alert-success','プロフィールを変更しました。');
    }


    # メールアドレスの変更(update_user_email)
    public function update_user_email(Request $request)
    {
        # DBの更新
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->update(['email'=>$request->email]);

        return redirect()->route('settings')
        ->with('alert-success','メールアドレスを変更しました。');
    }


    # メール受信設定の変更(email_setting)
    public function email_setting(Request $request){

        # メール受信設定の更新
        $mail_setting = \App\Models\MailSetting::find( $request->mail_setting_id );
        $mail_setting->update([
            'keep_question_group' => $request['keep_question_group'] ? 1 : 0,
            'keep_creator_user'   => $request['keep_creator_user']   ? 1 : 0,
            'comment'             => $request['comment']             ? 1 : 0,
            'infomation'          => $request['infomation']          ? 1 : 0,
        ]);


        return redirect()->route('settings')
        ->with('alert-success','メール受信設定を変更しました。');
    }

}
