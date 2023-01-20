<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * ----------------------------------
 *  お知らせメール　コントローラー
 * ----------------------------------
*/
class AdminInfoController extends Controller
{
    /**
     * お知らせメール送信処理(info_mail_send)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function info_mail_send( Request $request )
    {
        # ユーザーの指定が無ければ、戻る
        if( !$request->user_ids ){
            return redirect()->route('admin.info_mail.form')
            ->with('alert-warning',"ユーザーが指定されていません。");
        }

        # お知らせメールを送信するユーザー情報
        $users = \App\Models\user::find($request->user_ids );
        // dd($users);

        # メールの送信

            // お知らせメール番号
            $mail_num = $request->mail_num; //YYYYmmdd
            // 件名
            $subject = $request->subject;

            foreach ($users as $user) {

                // 送信メールアドレス
                $email = $user->email;

                \Illuminate\Support\Facades\Mail::to( $email ) //宛先
                ->send(new \App\Mail\SendMailMailable([
                    'subject' => $subject  , //件名
                    'view' => 'emails.info.html'.$mail_num , //HTMLテンプレート
                    // 'view' => 'emails.info.text'.$mail_num , //Textテンプレート
                    'inputs' => ['subject' => $subject]
                ]) );
            }
        //


        # お知らせメール送信フォームページへリダイレクト
        return redirect()->route('admin.info_mail.form')
        ->with('alert-success',"お知らせメールを送信しました。");
    }
}
