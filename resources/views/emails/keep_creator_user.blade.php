@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[
            'keeper_name' =>'山田花子',
            'mypage_url'=>route('mypage'),
        ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】フォローされました' }}</h2>
@endif

<p>
    {{$inputs['keeper_name']}}があなたを『フォロー』しました。<br>
    詳細は下のURLよりご確認ください。
</p>
<p>
    ----------------------------------------------------<br>
    [マイページURL]<br>
    {{ $inputs['mypage_url'] }}<br>
    ----------------------------------------------------<br>
</p>
<p>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</p>
<br>
<!-- 共通署名 -->
@include('emails._signature')
