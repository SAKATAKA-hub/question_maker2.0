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
    <section>
        <div class="container-1200 my-3">
            <div class="card shadow mb-3">

                <div class="card-body">
                    <div class="row">
                        <h5 class="fs-5 mb-0">
                            <strong class="text-success">{{$answer_group->user->name}}</strong>さんの受検結果
                        </h5>
                        <div class="col">

                        </div>
                        <div class="col-auto">
                            <div class="d-flex justify-content-between align-items-end"  style="width:10rem;">
                                    <span class="">正解率</span>
                                    <span class="">
                                        <strong class="fs-3">{{$answer_group->score}}</strong>％
                                    </span>
                            </div>
                            <div class="">
                                解答時間 {{$answer_group->elapsed_time}}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="d-flex fw-bold border-top border-bottom">
                        <div class="col-6 p-2 bg-light">
                            <span class="me-2">#</span>
                            <span class="me-2">問題文</span>
                        </div>
                        <div class="col p-2">
                            あなたの解答
                        </div>
                        <div class="d-none d-md-block col-2 p-2">
                            添削結果
                        </div>
                    </div>
                    @foreach ($answers as $num => $answer)
                    <div class="d-flex">
                        <!-- 問題文 -->
                        <div class="col-6 p-2 bg-light">
                            <span class="me-2 ">{{ $num + 1 }}</span>

                            <span class="d-inline-block text-truncate d-md-none"
                            style="max-width: 100px;">{{ $questions[$num]->text_text }}</span>
                            <span class="d-none d-md-inline">{{ $questions[$num]->text_text }}</span>
                        </div>
                        <!-- あなたの解答 -->
                        <div class="col p-2">
                            {{ $answer->text }}

                            <div class="d-md-none">
                                @if ( $answer->is_correct )
                                    <div class="text-info">
                                        <i class="bi bi-record fs-5"></i><span>正　解</span>
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-x-lg fs-5"></i><span>不正解</span>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <!-- 添削結果 -->
                        <div class="d-none d-md-block col-2 p-2">
                            @if ( $answer->is_correct )
                                <div class="d-none d-md-block text-info">
                                    <i class="bi bi-record fs-5"></i><span>正　解</span>
                                </div>
                            @else
                                <div class="d-none d-md-block text-danger">
                                    <i class="bi bi-x-lg fs-5"></i><span>不正解</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>



    <section>
        <div class="container-1200 my-3">

            <!--
                // Please Login Modal //
                利用：フォローボタン・いいねボタン・通報ボタン・コメントコンポーネント
            -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


            <!-- [ 作成者情報 ] -->
            <div class="card border-0">
                <div class="d-flex">
                    <div class="col">
                        <a href="{{route('creater',$question_group->user->id)}}" class="btn ps-0 w-100 list-group-item-action">
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
                        <violation-report-component user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                        route="{{route('violation_report.post.api')}}"></violation-report-component>
                    </div>
                </div>


                <!-- URLコピー -->
                <div class="py-2">
                    <div class="d-flex align-items-center">
                        <span class="badge rounded-pill bg-success me-1">
                            <i class="bi bi-link-45deg"></i>
                        </span>
                        問題集のURLを友達に送ろう！
                    </div>
                    @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                    <url-copy-component copy_url="{{ route('play_question', $param ) }}"></url-copy-component>
                </div>


                <div id="collapseQGInfo" class="collapse mt-3">
                    <div class="d-md-flex">
                        <div class="col-md-6 order-2 p-3">


                            <!-- サムネ画像 -->
                            <div class="ratio ratio-16x9" style="
                                background: no-repeat center center / cover;
                                background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                                border-radius: .5rem;
                            "></div>


                        </div>
                        <div class="col-md-6 order-1">

                            <!-- [ 基本情報 ] -->
                            <div class="mb-3">
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
                                    <div class="col-8 ps-3">{{$question_group->answer_groups->count()}}回</div>
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

                            <!-- [ 問題集の説明 ] -->
                            @if ( $question_group->resume_text )
                                <div class="modal-body">
                                    <div class="card card-body border-0 bg-light-success">
                                        {!! nl2br( e( $question_group->resume_text ) ) !!}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>


                <div class="py-2 text-end">
                    <a href="" class="text-decoration-none text-success"
                    data-bs-toggle="collapse" data-bs-target="#collapseQGInfo" aria-expanded="false" aria-controls="collapseQGInfo"
                    >詳しく見る</a>
                </div>

            </div>

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
    <section class="mb-5">
        <div class="container-1200 my-3">
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


