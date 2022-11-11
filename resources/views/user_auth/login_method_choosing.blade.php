@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','ログイン方法選択')


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')

@endsection


<!----- contents ----->
@section('contents')
    <div class="my-5">
        <div class="col-md-8 offset-md-2 text-center">
            <a class="btn d-flex border w-100 mb-4"  style="text-decoration:none;"
            href="{{ route('user_auth.google.redirect') }}">
                <div class="col-auto"><img src="{{asset('storage/site/image/g-logo.png')}}"
                alt="googleロゴ" class="d-block" style="height:1.5rem;"></div>
                <div class="col">Googleでログイン</div>
            </a>

            <a class="btn btn-success text-white w-100 mb-4"  style="text-decoration:none;"
            href="{{ route('user_auth.login_form') }}">
                {{ __('メールアドレスから　ログイン') }}
            </a>

            <a class="btn btn-warning text-white w-100 mb-4"  style="text-decoration:none;"
            href="{{ route('user_auth.register_form') }}">
                {{ __('メールアドレスから　無料会員登録') }}
            </a>
        </div>
    </div>
@endsection
