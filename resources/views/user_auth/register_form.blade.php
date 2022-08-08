@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','会員登録')


<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
<meta name="rote_email_unique_api" content="{{ route('user_auth.email_unique_api') }}"> <!-- 登録済メールアドレスか確認するAPI -->
<meta name="rote_register_api"     content="{{ route('user_auth.register_api') }}"> <!-- 会員登録API -->
<meta name="route_login"           content="{{ route('user_auth.login') }}">
<meta name="route_privacy_policy"  content="{{ route('footer_menu.privacy_policy') }}">
@endsection



<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
<!-- フォームのページ離脱防止アラート -->
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')

    <div id="app">
        <register-component
        {{-- csrf_token="{{ csrf_token() }}"
        rote_register_api="{{   route('user_auth.register_api') }}"
        rote_login="{{          route('user_auth.login') }}"
        rote_privacy_policy="{{ route('footer_menu.privacy_policy') }}" --}}
        ></register-component>
    </div>


@endsection
