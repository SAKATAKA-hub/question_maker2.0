@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[
            'name'=>'山田　太郎',
            'email'=>'yamada@emai.co.jp',
            'body'=>"テキストテキストテキスト\nテキストテキストテキスト\nテキストテキストテキスト",
        ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】お問い合わせいただきありがとうございます。' }}</h2>
@endif

<div>
    ≪{{ env('APP_NAME') }}≫にお問い合わせいただきありがとうございました。
</div><br>
<div>
    以下の内容でお問い合わせを受け付けいたしました。<br>
    一週間以内にご連絡差し上げますので、今しばらくお待ちくださいませ。
</div><br>
<div>
    ----------------------------------------------------<br>
    ◇お問い合わせ内容◇<br>
    <div>
        [氏　名]<br>
        {{ $inputs['name'] }}
    </div><br>
    <div>
        [メールアドレス]<br>
        {{ $inputs['email'] }}
    </div><br>
    <div>
        [本文]<br>
        {!! nl2br( e( $inputs['body'] ) ) !!}<br>
    </div>
    ----------------------------------------------------<br>
</div><br>
<div>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</div>
<br>
<!-- 共通署名 -->
@include('emails._signature')
