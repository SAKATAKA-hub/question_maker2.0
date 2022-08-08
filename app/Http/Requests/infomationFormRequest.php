<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfomationFormRequest extends FormRequest
{
    public function authorize(){ return true;}

    public function rules()
    {
        $rules = [
            'publication_at' => 'required',
            'bage' => 'required',
            'title' => 'required',
            // 'body' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'publication_at.required' => '※掲載日が入力されていません。',
            'bage.required' => '※関連部署が入力されていません。',
            'title.required' => '※タイトルが入力されていません。',
            // 'body.required' => '※本文が入力されていません。',
        ];
    }

}
