<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|  ユーザー情報API
| =================================
*/

class UserListAPIController extends Controller
{
    public function user_list_api(Request $request)
    {
        # API_KEY認証チェック
        if( $request->api_key != config('app.api_key') ){
            return \App::abort(404);
        }


        # 求職者情報の取得
        $users = \App\Models\User::all();


        # JSONレスポンス
        return response()->json([
            'users' => $users,
        ]);
    }
}
