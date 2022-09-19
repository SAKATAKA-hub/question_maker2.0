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

                        <div class="row">
                            @foreach ($keep_question_groups as $i => $keep_question_group)
                            @php $question_group = $keep_question_group->question_group @endphp


                                @if ( isset( $list_sm ) )<!-- カラムの幅[クリエーターページ]   -->
                                <div class="col-sm-12 col-md-6 col-lg-4 pb-3">
                                @else                       <!-- カラムの幅[問題一覧・検索ページ] -->
                                <div class="col-sm-6 col-md-4 col-lg-3 pb-3">
                                @endif
                                    <div href="#" class="card border-0 text-dark" style="cursor:pointer;"
                                    data-bs-toggle="modal" data-bs-target="#questionModal{{ $i+1 }}"
                                    >


                                        <!-- サムネ画像 -->
                                        <div class="card-image border ratio ratio-4x3" style="
                                            background:url({{ asset('storage/'.$question_group->image_puth) }});
                                            background-repeat  : no-repeat;
                                            background-size    : cover;
                                            background-position: center center;
                                            border-radius: .5rem;
                                        "></div>


                                        <div class="card-body">
                                            <h5 class="comment-author">{{ $question_group->title }}</h5>


                                            <div class="row">
                                                <!-- ユーザー情報 -->
                                                <div class="col-auto">
                                                    <div class="d-flex align-items-center">
                                                        <div class="user-image border ratio ratio-1x1 me-2" style="
                                                            background:url({{ asset('storage/'.$question_group->user->image_puth) }});
                                                            background-repeat  : no-repeat;
                                                            background-size    : cover;
                                                            background-position: center center;
                                                            width:1rem; border-radius:50%;
                                                        "></div>
                                                        <span class="text-muted text-truncate m-0">
                                                            {{$question_group->user->name}}
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- n日前 -->
                                                <div class="col text-end">
                                                    <span class="text-muted">{{$question_group->befor_datetime_text}}</span>
                                                </div>
                                            </div>


                                            <div class="text-muted">

                                                <div class="">
                                                    <!--問題数-->
                                                    <span class="me-2">
                                                        全{{$question_group->question_count}}問
                                                    </span>
                                                    <!--制限時間-->
                                                    <span class="me-2">
                                                        <i class="bi bi-stopwatch"></i>{{$question_group->time_limit_text}}
                                                    </span>
                                                    <!--平均点-->
                                                    <span class="me-2">
                                                        {{sprintf('平均%.1f点',$question_group->average_score)}}
                                                    </span>
                                                </div>

                                                <!--受検者数-->
                                                <div class="">
                                                    <span>
                                                        <i class="bi bi-pencil-fill"></i>
                                                        受検者{{$question_group->accessed_count}}人
                                                    </span>
                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                    <div class="">
                                        <!-- お気に入りボタン -->
                                        <keep-question-group-component
                                        user_id="{{Auth::user()->id}}" question_group_id="{{$question_group->id}}"
                                        keep="{{\App\Models\KeepQuestionGroup::isKeep(Auth::user()->id, $question_group->id)}}"
                                        route="{{route('keep_question_group.api')}}"
                                        />
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="questionModal{{ $i+1 }}" tabindex="-1" aria-labelledby="questionModal{{ $i+1 }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">


                                                    <div class="">
                                                        <h4 class="modal-title mb-0" id="questionModal{{ $i+1 }}Label">
                                                            {{ $question_group->title }}
                                                        </h4>

                                                        <!-- ユーザー情報 -->
                                                        <div class="col-auto">
                                                            <a href="{{route('creater',$question_group->user->id)}}" class="btn p-0">

                                                                <div class="d-flex align-items-center">
                                                                    <div class="user-image border me-2" style="
                                                                        background:url({{ asset('storage/'.$question_group->user->image_puth) }});
                                                                        background-repeat  : no-repeat;
                                                                        background-size    : cover;
                                                                        background-position: center center;
                                                                        width:1rem; height:1rem; border-radius:50%;
                                                                    "></div>
                                                                    <span class="text-muted text-truncate m-0">
                                                                        {{$question_group->user->name}}
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                                                </div>
                                                <div class="modal-body">

                                                    <!-- サムネ画像 -->
                                                    <div class="mb-3">
                                                        <div class="card-image" style="
                                                        background:url({{ asset('storage/'.$question_group->image_puth) }});
                                                        background-repeat  : no-repeat;
                                                        background-size    : cover;
                                                        background-position: center center;
                                                        height: 16rem; border-radius: .5rem;
                                                        "></div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <!-- 公開日 -->
                                                        <div class="">
                                                            公開日：{{\Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H:i')}}
                                                        </div>

                                                        <!-- タグ -->
                                                        @if ($question_group->tags)
                                                        <div class="d-flex gap-1 align-items-center">
                                                            @foreach ( explode('　',$question_group->tags) as $tag )
                                                            <div class="border p-1 " style="font-size:.8rem;">{{ $tag }}</div>
                                                            @endforeach
                                                        </div>
                                                        @endif


                                                        <div class="text-muted">
                                                            <!--評価点 (評価無し=>非表示)-->
                                                            <div class="">
                                                                @for ($si = 1; $si <= 5; $si++)
                                                                    {{ !$question_group->evaluation_points ? '' :
                                                                    ( $question_group->evaluation_points >= $si ? '★' : '☆' ) }}
                                                                @endfor
                                                            </div>
                                                            <!--受検者数-->
                                                            <div class="">
                                                                <span>
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                    受検者{{$question_group->accessed_count}}人
                                                                </span>
                                                            </div>
                                                            <div class="">
                                                                <!--問題数-->
                                                                <span class="me-2">
                                                                    全{{$question_group->question_count}}問
                                                                </span>
                                                                <!--制限時間-->
                                                                <span class="me-2">
                                                                    <i class="bi bi-stopwatch"></i>{{$question_group->time_limit_text}}
                                                                </span>
                                                                <!--平均点-->
                                                                <span class="me-2">
                                                                    {{sprintf('平均%.1f点',$question_group->average_score)}}
                                                                </span>

                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="mb-3 p-3 bg-light">
                                                        {{ $question_group->resume }}
                                                    </div>
                                                </div>
                                                <div class="modal-body text-center fw-bold">
                                                    この問題に挑戦しますか？
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                                                    <a href="{{ route('play_question', $question_group->id ) }}" class="btn btn-success">挑戦する</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            @endforeach
                        </div>

                        <!-- ページネーション -->
                        <div class="mb-5 d-flex justify-content-center">
                            {{ $keep_question_groups->links('vendor.pagination.bootstrap-4') }}
                        </div>


                    @else

                        <div class="h2 text-secondary text-center py-5">
                            現在、公開中の問題はありません。
                        </div>

                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection


