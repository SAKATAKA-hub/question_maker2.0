<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
/**
 * =========================================
 *  管理者画面　コントローラー
 * =========================================
*/
class AdminController extends Controller
{
    /**
     * ----------------------------------
     *  お問い合わせ　処理
     * ----------------------------------
    */

        /**
         * お問い合わせ一覧の表示(contact_list)
         *
         * @return \Illuminate\View\View
        */
        public function contact_list()
        {
            //お問い合わせ情報の取得
            $contacts = \App\Models\Contact::orderBy('id','desc')->get();
            return view('admin.contact_list', compact( 'contacts' ) );
        }




        /**
         * お問い合わせ詳細情報の表示(contact_ditails)
         *
         * @param \App\Models\Contact $contact (顧客情報)
         * @return \Illuminate\View\View
        */
        public function contact_ditails(\App\Models\Contact $contact)
        {
            return view( 'admin.contact_ditails', compact( 'contact' ) );
        }




        /**
         * お問い合わせ情報の削除(contact_destroy)
         *
         * @param \App\Models\Contact $contact (お問い合わせ情報)
         * @return \Illuminate\View\View
        */
        public function contact_destroy(\App\Models\Contact $contact)
        {
            # ストレージファイルの削除
            $path = str_replace(["\r\n", "\r", "\n"], '', $contact->text);
            if( \Illuminate\Support\Facades\Storage::exists($path) ){
                \Illuminate\Support\Facades\Storage::delete($path);
            }


            # お問い合わせ情報の削除
            $contact->delete();

            # お問い合わせ一覧へリダイレクト
            return redirect()->route('admin.contact_list')
            ->with('alert-danger','お問い合わせ情報を1件削除しました。');
        }

    //
    /**
     * ----------------------------------
     *  管理者登録　処理
     * ----------------------------------
    */
        /**
         * 管理者一覧の表示(register_list)
         *
         * @return \Illuminate\View\View
        */
        public function register_list()
        {
            //全顧客情報の取得
            $users = \App\Models\User::all();


            return view('admin.register_list', compact( 'users' ) );
        }




        /**
         * 管理者登録処理(register_post)
         *
         * @param \App\Http\Requests\RegisterFormRequest $request (バリデーション)
         * @return \Illuminate\View\View
        */
        public function register_post(\App\Http\Requests\RegisterFormRequest $request)
        {
            // ユーザー情報の保存
            $user = new \App\Models\User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'master' => $request->master ? 1 : 0
            ]);
            $user->save();


            # 管理者一覧へリダイレクト
            return redirect()->route('admin.register_list')
            ->with('alert-success','新規管理者を1名登録しました。');
        }





        /**
         * 管理者情報編集ページの表示(register_edit)
         *
         * @param \App\Models\User $user
         * @return \Illuminate\View\View
        */
        public function register_edit(\App\Models\User $user)
        {
            return view( 'admin.register_edit',compact('user') );
        }




        /**
         * 管理者情報の更新(register_update)
         *
         * @param \App\Http\Requests\RegisterFormRequest $request (バリデーション)
         * @return \Illuminate\View\View
        */
        public function register_update(\App\Http\Requests\RegisterFormRequest $request)
        {
            // dd($request->all());


            # 管理者情報更新
            if( isset($request->name) )
            {
                \App\Models\User::find($request->user_id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                return redirect()->route('admin.register_edit', $request->user_id )
                ->with('alert-success','管理者情報を更新しました。');
            }


            # パスワード更新
            if( isset($request->password) )
            {
                \App\Models\User::find($request->user_id)->update([
                    'password' => \Illuminate\Support\Facades\Hash::make( $request->password ),
                ]);

                return redirect()->route('admin.register_edit', $request->user_id )
                ->with('alert-success','パスワードを更新しました。');
            }


            # その他設定更新(スイッチによる設定の更新)
            if( isset( $request['form-switch'] ) )
            {
                \App\Models\User::find($request->user_id)->update([
                    'get_mail' => isset( $request->get_mail ) ? 1 :0 ,
                    'master' => isset( $request->master ) ? 1 :0,
                ]);

                return redirect()->route('admin.register_edit', $request->user_id )
                ->with('alert-success','その他設定を更新しました。');
            }



            return redirect()->route('admin.register_edit', $request->user_id );
        }




        /**
         * 管理者情報の削除(register_destroy)
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\View\View
        */
        public function register_destroy(Request $request)
        {
            # 管理者の削除
            \App\Models\User::find($request->user_id)->delete();


            # リダイレクト
            return redirect()->route('admin.register_list')
            ->with('alert-danger', '管理者情報を1件削除しました。');
        }




    /**
     * ----------------------------------
     *  ログイン履歴
     * ----------------------------------
    */
        /**
         * ログイン履歴の表示(login_record_list)
         *
         * @return \Illuminate\View\View
        */
        public function login_record_list()
        {
            $login_records = \App\Models\LoginRecord::orderBy('id','desc')->get();

            return view( 'admin.login_record_list', compact('login_records') );
        }




    //
}
