<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>{{ $keywords.'-検索結果' }}</title>

    <!-- ファビコン -->
    <link rel="icon" href="{{asset('storage/site/image/fabicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">


</head>
<body class="bg-white ">
    <header>
        @include('_parts.header')
    </header>
    <main class="">


        <section>
            <div class="container-1200">

                <!-- 検索フォーム -->
                <form action="{{ route('questions_search_list') }}">
                    <div  class="input-group overflow-hidden border shadow" style="border-radius:2rem;">

                        <span class="input-group-text">
                            <select class="form-select border-0" name="order" id="inputGroupSelect04" aria-label="Example select with button addon">
                                <option value="published_at,desc" {{$order=='published_at,desc' ? 'selected' : ''}}
                                >新着順</option>
                                <option value="published_at,asc"  {{$order=='published_at,asc'  ? 'selected' : ''}}
                                >古い順</option>
                                <option value="evaluation_points,desc" {{$order=='evaluation_points,desc' ? 'selected' : ''}}
                                >高評価</option>
                                <option value="accessed_count,desc" {{$order=='accessed_count,desc' ? 'selected' : ''}}
                                >受検者多</option>
                                <option value="accessed_count,asc"  {{$order=='accessed_count,asc' ? 'selected' : ''}}
                                >受検者少</option>
                                <option value="average_score,asc" {{$order=='average_score,asc' ? 'selected' : ''}}
                                >難しい</option>
                                <option value="average_score,desc"  {{$order=='average_score,desc' ? 'selected' : ''}}
                                >かんたん</option>
                            </select>
                        </span>

                        <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
                        value="@if ( isset($keywords) ){{  $keywords.' '  }}@endif" placeholder="キーワード" aria-label="SeachKeywords" aria-describedby="basic-addon1">

                        <span class="input-group-text bg-white border-0" id="basic-addon1">
                            <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                        </span>
                    </div>
                </form>


                <!-- 検索結果 -->
                <div class="row my-5">

                    @if ( $question_groups->count() )
                    <h5 class="text-secondary">”{{$keywords?$keywords:'すべて'}}”の条件で一致する検索結果</h5>
                    @else
                    <h5 class="text-secondary">”{{$keywords}}”の条件に一致する結果がみつかりません。</h5>
                    @endif


                    @foreach ($question_groups as $i => $question_group)

                        <div class="col-md-4 col-lg-3 p-3 pb-3">
                            <div href="#" class="card border-0 text-dark" style="cursor:pointer;"
                            data-bs-toggle="modal" data-bs-target="#questionModal{{ $i+1 }}"
                            >


                                <!-- サムネ画像 -->
                                <div class="card-image  ratio ratio-4x3" style="
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
                                        </div>
                                        <!-- n日前 -->
                                        <div class="col text-end">
                                            <span class="text-muted">{{$question_group->befor_datetime_text}}</span>
                                        </div>
                                    </div>


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

                            </div>
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



                    @endforeach

                    <!-- ページネーション -->
                    <div class="mb-5 d-flex justify-content-center">
                        {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>


                <!-- タグ一覧 -->
                <div class="row my-5">
                    <h5 class="text-secondary">＃タグから検索する</h5>
                    <div class="bg-light">
                        <div class="card-body">hoge</div>
                    </div>
                </div>

            </div>
        </section>


    </main>
    <footer>
        <section class="bg-dark">
            <div class="section_container text-white text-center" style="font-size:.8rem;">
                <p class="d-inline-block m-0">Copyright &copy; Next Arrow Inc.</p>
                <p class="d-inline-block m-0">All Rights Reserved.</p>
            </div>
        </section>
    </footer>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('avant-ui/js/avantui.js') }}" defer></script>


</body>
</html>
