@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[ 'name'=>'山田　太郎', 'email'=>'yamada@emai.co.jp', ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】会員登録ありがとうございます' }}</h2>
@endif

<div>
≪{{ env('APP_NAME') }}≫にご登録いただきまして誠にありがとうございました。<br>
お客様の登録が完了いたしましたのでご連絡申し上げます。<br>
</div>


<div>
----------------------------------------------------<br>
◇登録内容◇<br>
[氏　名]　{{ $inputs['name'] }}<br>
[メールアドレス]　{{ $inputs['email'] }}<br>
----------------------------------------------------<br>
</div>

<div>
ログイン情報は、お忘れになったり、他人に知られたりすることのないよう、<br>
厳重な管理をお願いします。<br>
</div>


<div>
≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</div>
<br>
<!-- 共通署名 -->
@include('emails._signature')
