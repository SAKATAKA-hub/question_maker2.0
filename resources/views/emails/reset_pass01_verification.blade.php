@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[ 'reset_pass_code' => 'xxxxxx' ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】パスワード変更認証コード' }}</h2>
@endif

<div>
    いつも≪{{ env('APP_NAME') }}≫のサービスをご利用いただきありがとうございます。<br>
    パスワード変更で入力されたメールアドレスが登録されたアドレスであることを<br>
    確認致しました。<br>
    パスワード変更に必要な認証番号をお送りいたします。
</div>

<br>
<strong>
    認証番号{{ $inputs['reset_pass_code'] }}<br>
</strong>
<br>

<div>
    引き続き、パスワード変更の手続きをお進めください<br><br>
</div>
<!-- 共通署名 -->
@include('emails._signature')
