@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','パスワード変更')


<!----- meta ----->
@section('meta')

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="api_route_step01" content="{{ route('user_auth.reset_pass_step01_api') }}">
    <meta name="api_route_step02" content="{{ route('user_auth.reset_pass_step02_api') }}">
    <meta name="route_login" content="{{ route('user_auth.login') }}">
    {{-- <meta name="route_login_form" content="{{ route('user_auth.login_form') }}"> --}}

@endsection


<!----- style ----->
@section('style')
<style>
    .anima-fadein-bottom{
        animation: anima-fadein-bottom 1s forwards;
    }
    @keyframes anima-fadein-bottom {
        from {
            opacity: 0;
            transform: translateY(1rem);
        }
        to {
            opacity: 1;
            transform: translateY(0rem);
        }
    }
</style>
@endsection


<!----- script ----->
@section('script')
<!-- フォームのページ離脱防止アラート -->
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')

    <div id="app">


        <reset-pass-component></reset-pass-component>


    </div>

@endsection
