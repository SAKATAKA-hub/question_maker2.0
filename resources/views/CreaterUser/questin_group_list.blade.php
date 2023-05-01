@extends('layouts.base_02col_createruser')


<!----- title ----->
@php $creater_user_name = mb_strlen($creater_user->name ) > 8 ? mb_substr($creater_user->name,0,8).'...' : $creater_user->name; @endphp
@section('title', $creater_user_name.'さん　公開中' )


<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('creater',$creater_user->id)}}" class="text-success">
    {{$creater_user_name.'さん'}}
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '公開中' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
 <meta name="csrf_token"                  content="{{ csrf_token() }}">
 <meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
 <meta name="route_scoring"           content="{{ route('scoring') }}">

 @php $description = mb_strlen($creater_user->profile_text ) > 140 ? mb_substr($creater_user->profile_text,0,140).'...' : $creater_user->profile_text; @endphp
 <meta  name="description" content="{{$description}}">
 <meta property="og:title" content="{{$creater_user->name.'さん 公開中'}}" />
 <meta property="og:description" content="{{$description}}" />
 <meta property="og:type" content="website" />
 <meta property="og:url" content=" {{url()->current()}}" />
 <meta property="og:image" content="{{ asset('storage/'.$creater_user->image_puth) }}" />
 <meta property="og:site_name" content="もんだいDIY" />
 <meta property="og:locale" content="ja_JP"  />
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')

    <section class="w-100">
        @if ( $question_groups->count() )


            <!-- Please Login Modal -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


            <!-- 問題集リスト -->
            @foreach ($question_groups as $question_group)

                <div class="">

                    @include('_parts.question_group_card_list')

                </div>

            @endforeach


            <!-- ページネーション -->
            <div class="my-5 d-flex justify-content-center">
                {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
            </div>


        @else

            <h2 class="text-secondary text-center py-5">
                現在、公開中の問題はありません。
            </h2>

        @endif

    </section>
@endsection



