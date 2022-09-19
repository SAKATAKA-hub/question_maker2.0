@php
// dd($inputs);


    # 表示確認用パラメーター
    $test = false;
    if( !isset($inputs) ){
        $test = true;
        $inputs =\App\Models\ViolationReport::first();
    }
@endphp

<!-- 件名 -->
@if ($test)
    <h2>件名：{{'【'.env('APP_NAME').'】『規約違反報告』を受付けました' }}</h2>
@endif

<div>
    ≪{{ env('APP_NAME') }}≫の規約違反に関するご報告を頂き、ありがとうございます。
</div><br>
<div>
    以下の内容で報告内容を受け付けいたしました。<br>
    内容を確認し、対応させていただきます。
</div><br>
<div>
    {{-- ----------------------------------------------------<br>
    ◇報告されたお客様情報◇<br>
    <div>
        [氏　名]<br>
        {{ $inputs->user->name }}<br>
    </div><br>
    <div>
        [メールアドレス]<br>
        {{ $inputs->user->email }}<br>
    </div><br> --}}
    ----------------------------------------------------<br>
    ◇規約違反報告内容◇<br>
    <div>
        [問題集タイトル]<br>
        {{ $inputs->question_group->title }}<br>
    </div><br>
    <div>
        [クリエーター名]<br>
        {{ $inputs->question_group->user->name }}<br>
    </div><br>
    <div>
        [本文]<br>
        {!! nl2br( e( $inputs->body ) ) !!}<br>
    </div><br>
----------------------------------------------------<br>
</div><br>
<div>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</div><br>
<br>
<!-- 共通署名 -->
@include('emails._signature')
