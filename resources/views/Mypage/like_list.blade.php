@extends('layouts.base')


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


<!----- contents ----->
@section('contents')
    <section>
        <div class="container-1200 my-5">
            <div class="d-md-flex">

                <!-- サイドコンテンツ[pc] -->
                <div class="d-none d-md-block  pe-3" style="width:300px;">
                    @include('_parts.user_info')
                </div>




                <!-- 中央コンテンツ -->
                <div class="flex-fill">

                    @if ( $keep_question_groups->count() )

                        <!-- 問題集リスト -->
                        {{-- @include('_parts.question_group_card_list') --}}

                        <!-- ページネーション -->
                        {{-- <div class="mb-5 d-flex justify-content-center">
                            {{ $keep_question_groups->links('vendor.pagination.bootstrap-4') }}
                        </div>
                        --}}
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


                            <!-- ページネーション -->
                            <div class="my-5 d-flex justify-content-center">
                                {{ $keep_question_groups->links('vendor.pagination.bootstrap-4') }}
                            </div>

                        </div>


                    @else

                        <div class="h2 text-secondary text-center py-5">
                            いいねした問題集はありません。
                        </div>

                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection


