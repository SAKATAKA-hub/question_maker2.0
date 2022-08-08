<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    public function authorize(){ return true;}

    public function rules()
    {
        $rules = [
            'name' => 'max:100',
            'email' => 'email|unique:users',
            'password' => 'regex:/\A[a-z\d]{8,100}+\z/i|confirmed',
        ];


        # フォームの入力値をすべて取得
        $request = $this->all();

        # 管理者修正、メールアドレスの重複登録不可を解除
        if( isset($request['user_id']) )
        {
            $user = \App\Models\User::find($request['user_id']);
            if( isset($request['email']) && ($user->email === $request['email']) )
            {
                $rules['email'] = 'email';
            }
        }


        return $rules;
    }

    public function messages()
    {
        return [
            'name.max' => '255文字以内で入力してください。',

            'email.email' => 'メールアドレスは、メールの記述形式になるように入力してください。',
            'email.unique' => '別ユーザーが登録したメールアドレスは利用できません。',

            'password.regex' => 'パスワードは、8文字以上の半角英数字のみで入力してください。',
            'password.confirmed' => '入力したパスワードが確認用と異なります。',
        ];
    }

}
