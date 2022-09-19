@extends('layouts.base')


<!----- title ----->
@section('title', '公開中の問題集' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('creater',$creater_user->id)}}" class="text-success">
    クリエイターページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '公開中の問題集' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token"                  content="{{ csrf_token() }}">
<meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
<meta name="route_scoring"           content="{{ route('scoring') }}">
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <!--
        // Please Login Modal //
        利用：フォローボタン・いいねボタン・通報ボタン・コメントコンポーネント
    -->
    <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
    ></please-login-modal-component>
    @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


    <section>
        <div class="container-1200 my-5">
            <div class="d-md-flex">


                <!-- サイドコンテンツ -->
                <!--PC-->
                <div class="d-none d-md-block pe-3" style="width:300px;">
                    @include('_parts.creater_info')
                </div>
                <!--movile-->
                <div class="d-md-none mb-5 w-100">
                    @include('_parts.creater_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="flex-fill">


                    @if ( $question_groups->count() )

                        <!-- 問題集リスト・ページネーション use_param[$question_groups] -->
                        @include('_parts.question_group_card_list')

                    @else

                        <h2 class="text-secondary text-center py-5">
                            現在、公開中の問題はありません。
                        </h2>

                    @endif



                </div>
            </div>
        </div>
    </section>
@endsection



