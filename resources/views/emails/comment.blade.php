@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[
            'user_name' =>'山田花子',
            'question_group_title'=>'コメントされた問題集',
            'body'=>"テキストテキストテキスト\nテキストテキストテキスト\nテキストテキストテキスト",
        ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】公開中の問題集にコメントが届きました' }}</h2>
@endif

<div>
    公開中の問題集にコメントが届きました。<br>
    詳細は下のURLよりご確認ください。<br>
</div><br>

<div>
    ----------------------------------------------------<br>
    [問題集タイトル]<br>
    {{ $inputs['question_group_title'] }}<br><br>

    [コメントユーザー]<br>
    {{ $inputs['user_name'] }}　さん<br><br>

    [コメント内容]<br>
    {!! nl2br( e( $inputs['body'] ) ) !!}<br><br>

    [マイページURL]<br>
    <a href="{{ route('mypage') }}">{{ route('mypage') }}</a><br>
    ----------------------------------------------------<br>
</div><br>
<div>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</div><br>
<br>
<!-- 共通署名 -->
@include('emails._signature')
