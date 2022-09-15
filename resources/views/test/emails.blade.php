@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','送信メール一覧')

<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <h2>送信メール一覧</h2>
    <div class="list-group">
        <a href="{{route('test.emails.mail','user_register_completion')}}" class="list-group-item list-group-item-action">
            会員登録完了
        </a>
        <a href="{{route('test.emails.mail','reset_pass01_verification')}}" class="list-group-item list-group-item-action">
            パスワード変更確認
        </a>
        <a href="{{route('test.emails.mail','reset_pass02_completion')}}" class="list-group-item list-group-item-action">
            パスワード変更完了
        </a>
        <a href="{{route('test.emails.mail','contact')}}" class="list-group-item list-group-item-action">
            お問い合わせ完了
        </a>
        <a href="{{route('test.emails.mail','violation_report')}}" class="list-group-item list-group-item-action">
            『規約違反報告』を送信しました。
        </a>
        <a href="{{route('test.emails.mail','keep_question_group')}}" class="list-group-item list-group-item-action">
            公開中の問題集が『いいね』されました。
        </a>
        <a href="{{route('test.emails.mail','keep_creator_user')}}" class="list-group-item list-group-item-action">
            あなたのアカウントが『フォロー』されました
        </a>
        <a href="{{route('test.emails.mail','comment')}}" class="list-group-item list-group-item-action">
            公開中の問題集に『コメント』が届きました。
        </a>
        <a href="{{route('test.emails.mail','user_destroy')}}" class="list-group-item list-group-item-action">
            退会手続き完了のお知らせ
        </a>
        <a href="{{route('test.emails.mail','infomation')}}" class="list-group-item list-group-item-action">
            運営事務局からのお知らせ
        </a>


    </div>
@endsection
