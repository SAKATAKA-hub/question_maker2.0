@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','ログイン')


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
    <div class="card shadow w-100 p-3">

        <div class="card-body">
            <h3 class="text-secondary fw-bold">{{ __('ログイン') }}</h3>

            @if ( session('login_error') )
                <div class="alert alert-danger" role="alert">※エラー：{{ session('login_error') }}</div>
            @endif
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('user_auth.login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('ログイン状態を維持する') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-8 offset-sm-2">
                        <button type="submit" class="btn rounded-pill btn-success text-white w-100">
                            {{ __('ログイン') }}
                        </button>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="col-md-8 offset-md-2 text-center">
                        <a class="btn btn-link"  style="text-decoration:none;"
                        href="{{ route('user_auth.reset_pass_form') }}">
                            {{ __('パスワードをお忘れの方はこちら') }}
                        </a>
                    </div>
                    <div class="col-md-8 offset-md-2 text-center">
                        <a class="btn btn-link"  style="text-decoration:none;"
                        href="{{ route('user_auth.register_form') }}" style="text-decoration:none;">
                            {{ __('無料会員登録はこちら') }}
                        </a>
                    </div>
                </div>



            </form>
        </div>
    </div>
@endsection
