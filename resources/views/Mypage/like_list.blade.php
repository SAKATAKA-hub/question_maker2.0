@extends('layouts.base_02col')


<!----- title ----->
@section('title', 'いいねした問題集' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ 'いいねした問題集' }}
</li>
@endsection


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



<!----- side_contents ----->
@section('side_contents')

    @include('_parts.user_info')

@endsection


<!----- contents ----->
@section('contents')

    @if ( count( $keep_question_groups ) )
        <div class="">

            <!-- Please Login Modal -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp

            <!-- 問題集リスト -->
            @foreach ($keep_question_groups as $keep_question_group)
                @php $question_group = $keep_question_group->question_group @endphp

                @include('_parts.question_group_card_list')

            @endforeach

        </div>
    @else

        <div class="h2 text-secondary text-center py-5">
            いいねした問題集はありません。
        </div>

    @endif
    <div class="form-text text-centerrr mt-5">
        *非公開になった問題集は、表示されなくなります。
    </div>

@endsection


