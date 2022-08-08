@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','ログインが必要です')


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
.btn-outline-primary:hover {
    background-color: hsl(192deg, 100%, 45%);
    border-color: hsl(192deg, 100%, 45%);
    color: #fff;
}
</style>
@endsection


<!----- script ----->
@section('script')

@endsection


<!----- contents ----->
@section('contents')

    <div class="card card-body text-secondary mb-5">
        <h5 class="fw-bold">こちらのページはログイン後にご利用いただけます。</h5>
        <p>会員登録がお済みでない方は、
            <strong class="text-success">会員登録（無料）</strong>
            を行ってください。</p>
    </div>
    <div class="row mb-3">
        <div class="col-sm-8 offset-sm-2">
            <a href="{{ route('user_auth.register_form') }}" class="btn btn-lg rounded-pill btn-warning w-100">
                {{ __('会員登録（無料）') }}
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-8 offset-sm-2">
            <a href="{{ route('user_auth.login_form') }}" class="btn btn-lg rounded-pill btn-outline-success w-100">
                {{ __('ログイン') }}
            </a>
        </div>
    </div>


@endsection
