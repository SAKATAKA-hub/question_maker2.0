@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[
            'title'=>"運営事務局からのお知らせ",
            'body'=>"infomation.0001",
        ];

    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】'.$inputs['title'] }}</h2>
@endif

@include($inputs['body'])

{{-- {!! nl2br( e( $inputs['body'] ) ) !!}<br> --}}
<br>

<!-- 共通署名 -->
@include('emails._signature')
