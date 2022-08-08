<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

/**
 * =========================================
 *  お問い合わせ　コントローラー
 * =========================================
*/
class ContactController extends Controller
{
    /**
     * お問い合わせ[入力](input)
     *
     * @return String $type_code //お問い合わせの種類コード
     * @return \Illuminate\View\View
    */
    public function input( $type_code=null )
    {
        $contact_types = \App\Models\ContactType::all();
        return view('contact_page.01', compact('contact_types', 'type_code') );
    }




    /**
     * お問い合わせ[確認](confirmation)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function confirmation(Request $request)
    {
        $inputs = $request->all();
        return view('contact_page.02', compact('inputs'));
    }





    /**
     * お問い合わせ[完了](completion)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function completion(Request $request)
    {
        $inputs = $request->all();
        unset($inputs["_token"]); //配列からtoken情報を除去
        unset($inputs["agree"]); //配列からプライバシーポリシー承諾を除去





        // dd($inputs);
        // #　送信メール内容の確認
        // return view('emails.admin_contact') //テンプレートファイルの読み込み
        // ->with(['inputs' => $inputs,]);





        # 管理者へメールの自動送信
        $users = \App\Models\User::where('get_mail',1)->get(); // メール受取り設定の管理者ユーザーの取得
        foreach ($users as $user)
        {
            Mail::to( $user->email )
            ->send(new \App\Mail\AdminContactMailable($inputs));
        }

        # 顧客へメールの自動送信
        Mail::to( $inputs["email"] )
        ->send(new \App\Mail\ContactMailable($inputs));




        # text入力値が150文字以上の時、ストレージへファイル保存する
        if( mb_strlen($inputs["text"]) > 150 )
        {
            $dir = 'upload/contact/';

            // 採番の取得($num)
            $num_file = $dir.'file_num.txt';
            $num = Storage::exists($num_file) ? (int) Storage::get($num_file) : 0;
            $num = $num + 1;
            storage::put( $num_file, $num );


            // ストレージにファイル保存・DBにパスの値を渡す
            $file = $dir.sprintf('%06d.txt', $num);
            storage::put( $file, $inputs["text"] );
            $inputs["text"] = $file;
        }


        # DB保存
        $contact = new \App\Models\Contact( $inputs );
        $contact->save();


        return view('contact_page.03');
    }


}
