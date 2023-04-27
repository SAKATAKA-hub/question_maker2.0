@extends('layouts.base_02col_createruser')


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

    <section class="w-100">
        @if ( $question_groups->count() )


            <!-- Please Login Modal -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


            <!-- 問題集リスト -->
            @foreach ($question_groups as $question_group)

                <div class="m-">
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
    {{-- <section>
        <div class="container-1200 my-5">
            <div class="d-md-flex">


                <!-- サイドコンテンツ -->
                <!--PC-->
                <div class="d-none d-md-block pe-3" style="min-width:300px; width:300px;">
                    @include('_parts.creater_info')
                </div>
                <!--movile-->
                <div class="d-md-none mb-5 w-100">
                    @include('_parts.creater_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="flex-fill overflow-hidden px-3">



                    <section class="w-100">
                    @if ( $question_groups->count() )


                    <!-- Please Login Modal -->
                    <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
                    ></please-login-modal-component>
                    @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


                    <!-- 問題集リスト -->
                    @foreach ($question_groups as $question_group)

                        <div class="m-3">
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


                </div>
            </div>
        </div>
    </section> --}}
@endsection



