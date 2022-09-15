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

<p>
    ≪{{ env('APP_NAME') }}≫にお問い合わせいただきありがとうございました。
</p>
<p>
    以下の内容でお問い合わせを受け付けいたしました。<br>
    一週間以内にご連絡差し上げますので、今しばらくお待ちくださいませ。
</p>
<p>
    ----------------------------------------------------<br>
    ◇お問い合わせ内容◇<br>
    <p>[氏　名]　{{ $inputs['name'] }}</p>
    <p>[メールアドレス]　{{ $inputs['email'] }}</p>
    <p>
        [本文]<br>
        {!! nl2br( e( $inputs['body'] ) ) !!}
    </p>
    ----------------------------------------------------<br>
</p>
<p>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</p>
<br>
<!-- 共通署名 -->
@include('emails._signature')
