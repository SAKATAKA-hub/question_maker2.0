@php

    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =[
            'post_user_name' =>'山田花子',
            'question_group_title'=>'コメントされた問題集',
            'body'=>"テキストテキストテキスト\nテキストテキストテキスト\nテキストテキストテキスト",
            'mypage_url'=>route('mypage'),
        ];
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】公開中の問題集にコメントが届きました' }}</h2>
@endif

<p>
    公開中の問題集にコメントが届きました。<br>
    詳細は下のURLよりご確認ください。
</p>

<p>
    ----------------------------------------------------<br>
    [問題集タイトル]<br>
    {{ $inputs['question_group_title'] }}<br><br>

    [コメントユーザー]<br>
    {{ $inputs['post_user_name'] }}　さん<br><br>

    [コメント内容]<br>
    {!! nl2br( e( $inputs['body'] ) ) !!}<br><br>

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
