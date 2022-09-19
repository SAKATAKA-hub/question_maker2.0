@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[
            'user_name' =>'山田花子',
        ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】フォローされました' }}</h2>
@endif

<div>
    <strong>{{$inputs['user_name']}}</strong>さんがあなたを『フォロー』しました。<br>
    詳細は下のURLよりご確認ください。
</div><br>

<div>
    [マイページURL]<br>
    <a href="{{ route('mypage') }}">{{ route('mypage') }}</a><br>
</div><br>

<div>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</div><br>
<br>
<!-- 共通署名 -->
@include('emails._signature')
