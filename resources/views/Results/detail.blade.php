@extends('layouts.base')


<!----- title ----->
@section('title', '「'.$question_group->title.'」の受験結果' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    「{{ $question_group->title }}」の受験結果
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token"                  content="{{ csrf_token() }}">
<meta name="company_key" content="{{ env('COMPANY_KEY') }}">
<meta name="question_group_id"           content="{{ $question_group->id }}">
<meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
<meta name="route_scoring"           content="{{ route('scoring') }}">
@endsection


<!----- style ----->
@section('style')
<style>
    .card{
        text-decoration:none;
    }
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')

    <!-- 受検結果 -->
    <section class="bg-light">
        <div class="container-1200 py-3">

            <div class="card card-body  mb-3">

                <div class="text-center my-5">
                    <div class="fs-5">
                        {{\Carbon\Carbon::parse($answer_group->created_at)->format('Y年m月d日')}}
                    </div>
                    <h5>
                        <a href="{{route('creater',$answer_group->user->id)}}" class="text-success fw-bold fs-3 text-decoration-none">
                            {{$answer_group->user->name}}
                        </a>さんの受検結果
                    </h5>
                </div>


                <!-- 成績円グラフ -->
                <div class="d-flex justify-content-center">
                    <pie-chart-component percent_value="{{$answer_group->score}}"></pie-chart-component>
                </div>


                <div class="text-center my-5">
                    解答時間 {{$answer_group->elapsed_time}}
                </div>


            </div>
            <div class="card">
                <ul class="list-group list-group-flush">
                    @foreach ($answers as $num => $answer)
                        <li class="list-group-item p-0 overflow-hidden">
                            <!-- 00問目 問題文 -->
                            <div class="px-3 py-2 bg-light">
                                <div class="row align-items-start ">
                                    <div class="col-auto">
                                        <h5 class="mb-0 text-success">{{ sprintf('%02d',$answer->question->order) }}問目</h5>
                                    </div>
                                    <div class="col text-truncateee">
                                        {{ $answer->question->text_text }}
                                    </div>
                                </div>
                            </div>

                            <!-- 解答と結果 -->
                            <div class="px-3 py-2">
                                <div class="row mt-3">
                                    <div class="col text-truncateee ">
                                        <div class="text-secondary" style="font-size:11px;">あなたの解答</div>
                                        {{ $answer->text ? $answer->text : '---' }}
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-secondary" style="font-size:11px;">添削結果</div>
                                        @if ( $answer->is_correct )
                                            <div class="fs-3 text-info">
                                                <i class="bi bi-record"></i><span>正　解</span>
                                            </div>
                                        @else
                                            <div class="fs-3 text-danger">
                                                <i class="bi bi-x-lg"></i><span>不正解</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- 詳細と解説 -->
                            <div class="px-3 py-2">
                                <div  class="collapse card card-body bg-light-success border-0 mb-3
                                {{ $answer->is_correct==0 ? 'show' : ''}} " id="collapse{{$num}}">

                                    <!-- 詳細 -->
                                    <div class="row">
                                        <!-- 問題画像 -->
                                        @if ( $answer->question->image)
                                        <div class="col-md-4 order-md-2">
                                            <div class="my-3">
                                                <span class="text-success fw-bold">問題画像</span>
                                                <div class="w-100 mb-3">
                                                    <div class="ratio ratio-16x9 border border-light" style="
                                                        background: no-repeat center center / cover;
                                                        background-image:url({{asset('storage/'. $answer->question->image_puth)}});
                                                        border-radius: .5rem;
                                                    "></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-md-8">
                                            <!-- 問題文 -->
                                            <div class="my-3">
                                                <span class="text-success fw-bold">問題文</span>
                                                <div class="p-2 bg-light">
                                                    {!! nl2br( e(  $answer->question->text_text ) )  !!}
                                                </div>
                                            </div>

                                            <!-- 正解 -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="text-success fw-bold me-5">正解</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="mb-2 text-secondary">
                                                            解答方法：
                                                            {{  $answer->question->answer_type == 0 ? '文章で答えを入力する' :
                                                            (   $answer->question->answer_type == 1 ? 'ひとつの答えを選ぶ' : '複数の答えを選ぶ'  ) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ( $answer->question->question_options as $option)
                                                    <div class="row mb-2 pe-3">
                                                        @if ($option->answer_boolean)
                                                            <div class="col-auto">
                                                                <span class="fw-bold text-info">正　解</span>
                                                            </div>
                                                            <div class="col card border-info"> {{ $option->answer_text }}</div>
                                                        @else
                                                            <div class="col-auto">
                                                                <span class="fw-bold text-secondary">不正解</span>
                                                            </div>
                                                            <div class="col card bg-light">{{ $option->answer_text }}</div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 解説 -->
                                    @if($answer->question->commentary_text )

                                        <div class="divider divider-dashed my-3"></div>
                                        <div class="row">

                                            <!-- 解説画像 -->
                                            @if ($answer->question->commentary_image)
                                            <div class="col-md-4 order-md-2">
                                                <div class="my-3">
                                                    <span class="text-warning fw-bold">解説画像</span>
                                                    <div class="w-100  mb-3">
                                                        <div class="ratio ratio-16x9 border border-light" style="
                                                            background: no-repeat center center / cover;
                                                            background-image:url({{asset('storage/'.$answer->question->commentary_image_puth)}});
                                                            border-radius: .5rem;
                                                        "></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-md-8">
                                                <!-- 解説文 -->
                                                <div class="my-3">
                                                    <span class="text-warning fw-bold">解説文</span>
                                                    <div class="p-2 bg-light">
                                                        <replace-text-component text="{{ $answer->question->commentary_storage_text }}"></replace-text-component>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                </div>

                                <!--詳しく見るボタン-->
                                <div class="text-center">
                                    <a class="text-decoration-none"
                                    data-bs-toggle="collapse" href="#collapse{{$num}}" role="button" aria-expanded="false" aria-controls="collapse{{$num}}"
                                    >
                                        <see-more-btn-component open="{{$answer->is_correct}}"></see-more-btn-component>

                                    </a>
                                </div>

                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>



    <section class="bg-light">
        <div class="container-1200 py-3">

            <!--
            // Please Login Modal //
            利用：フォローボタン・いいねボタン・通報ボタン・コメントコンポーネント
            -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


            <!-- [ 作成者情報 ] -->
            <div class="">
                <div class="d-flex justify-content-between w-100">
                    <div class="col-auto">
                        <a href="{{route('creater',$question_group->user->id)}}" class="btn ps-0">
                            <div class="d-flex align-items-center">
                                <div class="user-image border ratio ratio-1x1 me-2" style="
                                background: no-repeat center center / cover;
                                background-image:url({{ asset('storage/'.$question_group->user->image_puth) }});
                                width:1.8rem; border-radius:50%;
                                "></div>
                                <span class="text-truncate m-0">
                                    {{$question_group->user->name}}
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto h-100">
                        <div class="py-2">

                            <!-- フォローボタン -->
                            <keep-creator-user-component user_id="{{$user_id}}" creater_user_id="{{$question_group->user->id}}"
                            keep="{{\App\Models\KeepCreatorUser::isKeep($user_id, $question_group->user->id)}}"
                            route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>

                        </div>
                    </div>
                </div>
            </div>


            <!-- [ 問題集の情報 ] -->
            <div class="card card-body mb-3">


                <!-- タイトル -->
                <h5 class="">{{ $question_group->title }}</h5>

                <!-- タグ -->
                <div class="mb-3">
                    @if ($question_group->tags)
                    <div class="d-flex gap-1 align-items-center">
                        @foreach ( explode('　',$question_group->tags) as $tag )
                        <form action="{{ route('questions_search_list') }}">
                            <input type="hidden" name="seach_keywords" value="{{$tag}}">

                            <button type="submit" class="btn p-0 px-1 border text-muted" style="font-size:.8rem;">{{ $tag }}</button>
                        </form>
                        @endforeach
                    </div>
                    @endif
                </div>


                <!-- 3ボタン -->
                <div class="d-flex align-items-center gap-3">
                    <!-- お気に入りボタン -->
                    <div>
                        <keep-question-group-component
                        user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                        keep="{{\App\Models\KeepQuestionGroup::isKeep($user_id, $question_group->id)}}"
                        route="{{route('keep_question_group.api')}}"
                        ></keep-question-group-component>
                    </div>

                    <!-- コメントボタン -->
                    @if( $user_id )
                        <div>
                            <button class="btn btn-sm"
                            data-bs-toggle="offcanvas" data-bs-target="#commentOffcanvas" aria-controls="commentOffcanvas"
                            >
                                <div class="fs-5">
                                    <i class="bi bi-chat-square-text"></i>
                                </div>
                                <div style="font-size:.6rem;">コメント</div>
                            </button>
                        </div>
                    @else
                        <div>
                            <button class="btn btn-sm"
                            data-bs-toggle="modal" data-bs-target="#PleaseLoginModal"                        >
                                <div class="fs-5">
                                    <i class="bi bi-chat-square-text"></i>
                                </div>
                                <div style="font-size:.6rem;">コメント</div>
                            </button>
                        </div>
                    @endif




                    <!-- 通報ボタン -->
                    <div>
                        <violation-report-component
                        user_id="{{$user_id}}"
                        question_group_id="{{$question_group->id}}"
                        route="{{route('violation_report.post.api')}}"
                        route_admin_send_email="{{ env('COMPANY_ROUTE_VIOLATION_REPORT_SEND_EMAIL') }}"
                        ></violation-report-component>
                    </div>
                </div>


                <!-- [ シェアボタン ] -->
                <div class="py-2">
                    @include('_parts.share_group')
                </div>


                <div id="collapseQGInfo" class="collapse mt-3">
                    <div class="row g-3">
                        <div class="col-md-6">


                            <!-- サムネ画像 -->
                            <div class="ratio ratio-16x9 mb-3" style="
                                background: no-repeat center center / cover;
                                background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                                border-radius: .5rem;
                            "></div>


                            <!-- [ 基本情報 ] -->
                            <div class="card">
                                <div class="d-flex">
                                    <div class="col-4 ps-3 bg-light">公開日</div>
                                    <div class="col-8 ps-3">{{\Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H:i')}}</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-4 ps-3 bg-light">問題数</div>
                                    <div class="col-8 ps-3">全{{$question_group->question_count}}問</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-4 ps-3 bg-light">制限時間</div>
                                    <div class="col-8 ps-3">{{$question_group->time_limit_text}}</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-4 ps-3 bg-light">受験回数</div>
                                    <div class="col-8 ps-3">{{$question_group->accessed_count}}回</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-4 ps-3 bg-light">平均点</div>
                                    <div class="col-8 ps-3">{{sprintf('%.1f',$question_group->average_score)}}点</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-4 ps-3 bg-light">いいね数</div>
                                    <div class="col-8 ps-3">{{$question_group->keep_question_groups->count()}}</div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">


                            <!-- [ 問題集の説明 ] -->
                            @if ( $question_group->resume_text )
                                <div class="card card-body border-0 bg-light-success">
                                    <replace-text-component text="{{ $question_group->resume_text }}"></replace-text-component>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>


                <!--詳しく見るボタン-->
                <div class="py-2 text-end">
                    <a href="" class="text-decoration-none"
                    data-bs-toggle="collapse" data-bs-target="#collapseQGInfo" aria-expanded="false" aria-controls="collapseQGInfo"
                    >
                        <see-more-btn-component></see-more-btn-component>

                    </a>
                </div>


            </div>


        </div>
    </section>


    <section class="bg-light">
        <div class="container-1200 py-3">

            <!-- コメントリストコンポーネント -->
            <div>
                @php
                    $user_id = Auth::check() ? Auth::user()->id : '' ;
                @endphp
                <comment-component
                route_comment_api="{{        route('comment.api')}}"
                route_comment_destory_api="{{route('comment.destroy.api')}}"
                user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                ></comment-component>
            </div>



        </div>
    </section>


    <!-- 三連メニュー -->
    <section class="bg-light">
        <div class="container-1200 py-3 pb-5">
            <div class="row gap-3 px-3">
                <div class="col-md h-100 card">
                    <div class="card-body text-center">
                        <h6 class="mb-3">同じ問題に挑戦する</h6>
                        @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                        <a href="{{ route('play_question', $param ) }}" class="btn rounded-pill btn-outline-success mx-auto"
                        >GO!</a>
                    </div>
                </div>
                <div class="col-md h-100 card">
                    <div class="card-body text-center">
                        <h6 class="mb-3">別の問題に挑戦する</h6>
                        <a href="{{ route('questions_search_list') }}" class="btn rounded-pill btn-outline-success mx-auto"
                        >GO!</a>
                    </div>
                </div>
                @if (Auth::check())
                    <div class="col-md h-100 card">
                        <div class="card-body text-center">
                            <h6 class="mb-3">これまでの成績を見る</h6>
                            <a href="{{route('results.list')}}" class="btn rounded-pill btn-outline-success mx-auto"
                            >GO!</a>
                        </div>
                    </div>
                @else
                    <div class="col-md h-100 card">
                        <div class="card-body text-center">
                            <h6 class="mb-3">新しい問題を作る</h6>
                            <a href="{{ route('make_question_group.list') }}" class="btn rounded-pill btn-outline-success mx-auto"
                            >GO!</a>
                        </div>
                    </div>

                @endif

            </div>

        </div>
    </section>
@endsection


