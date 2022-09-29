<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>手作り問題集</title>

    <!-- ファビコン -->
    <link rel="icon" href="{{asset('storage/site/image/fabicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <meta name="csrf_token" content="{{ csrf_token() }}">

</head>
<body class="bg-white ">
    <header>
        @include('_parts.header')
    </header>
    <main id="app" class="">
        <section class="top">
            <!-- 背景 -->
            <div class="top_bg_container">
                <div class="top_bg" style="
                    background:url({{ asset('storage/site/image/22636100.jpg') }});
                    background-repeat  : repeat;
                "></div>
            </div>


            <div class="container-1200">
                <div class="px-4 py-5 my-5 text-center">
                    {{-- <h2 class="display-1 h-1 text-success fw-bold mb-4">{{ env('APP_NAME') }}</h2> --}}
                    <div class="col-12 col-md-6 mx-auto  position-relative">
                        <h5 class="fw-bold  position-absolute top-0 start-50 translate-middle-x w-100"
                        >\ オリジナル問題集が自由に作れる！ /</h5>

                        <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="サイトロゴ" class="d-block w-100">
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="mt-3">
                            <!-- 検索フォーム -->
                            <form action="{{ route('questions_search_list') }}">
                                <div  class="input-group overflow-hidden shadow" style="border-radius:2rem;">
                                    <span class="input-group-text bg-white border-0 ms-3 text-secondary" id="basic-addon1">
                                        問題集の検索：
                                    </span>

                                    <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
                                    value="@if ( isset($keywords) ){{  $keywords.' '  }}@endif" placeholder="キーワード" aria-label="SeachKeywords" aria-describedby="basic-addon1">

                                    <span class="input-group-text bg-white border-0" id="basic-addon1">
                                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="mt-5">
                            <a href="{{ route('make_question_group.list') }}" class="btn rounded-pill btn-outline-success btn-lg fw-bold w-100"
                            >問題集を作る</a>
                        </div>
                    </div>

                    {{-- <div class="mt-5">
                        <p class="lead mb-4 bg-white">
                            このサイトではオリジナルの『問題集』を作って公開したり、誰かが作った『問題集』に挑戦することができます。
                        </p>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="bg-light-success">
            <div class="container-1200">
                <p class="lead text-center mb-0" style="font-size:12px;">
                    このサイトではオリジナルの『問題集』を <strong class="fw-bold">DIYして（作って）</strong>公開したり、誰かが作った『問題集』に挑戦することができます。
                </p>
            </div>
        </section>
        {{-- <div class="container-1200 divider divider-dashed"></div><!---- Divider ----> --}}
        <section>
            <div class="container-1200 my-5">


                <div class="row mx-3">
                    <div class="col-md-6 order-md-2" >
                        <img src="{{ asset('storage/site/image/22901978.jpg') }}" class="d-block w-100" alt="人気の問題集">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <p class="fw-bold text-success">
                                Most popular handmade questions
                            </p>
                            <h3>人気な問題集トップ５！</h3>
                            <p class="my-4 text-secondary">
                                もっとも受検されている問題集をピックアップしました。<br>
                                問題を解いて、お気に入りの問題集をフォローしましょう！！
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-5">

                    <!-- 問題集リスト -->
                    @php $question_groups = $popular_question_groups; @endphp
                    @include('_parts.question_group_card_list')

                    <div class="mt-5 text-center">
                        <a href="{{ route('questions_search_list',['order'=>'accessed_count,desc']) }}" class="btn rounded-pill btn-outline-success"
                        >もっと表示する</a>
                    </div>

                    <!-- ページネーション -->
                    {{-- <div class="my-5 d-flex justify-content-center">
                        {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
                    </div> --}}

                </div>


            </div>
        </section>
        <div class="container-1200 divider divider-dashed my-5"></div><!---- Divider ---->
        <section>
            <div class="container-1200 my-5">

                <div class="row mx-3">
                    <div class="col-md-6" >
                        <img src="{{ asset('storage/site/image/23020196.jpg') }}" class="d-block w-100" alt="人気の問題集">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <p class="fw-bold text-success">
                               New handmade questions!
                            </p>
                            <h3>新着問題集トップ１０！</h3>
                            <p class="my-4 text-secondary">
                                新着の問題集にチャレンジしよう！
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-5">

                    <!-- 問題集リスト -->
                    @php $question_groups = $new_question_groups; @endphp
                    @include('_parts.question_group_card_list')

                    <div class="mt-5 text-center">
                        <a href="{{ route('questions_search_list') }}" class="btn rounded-pill btn-outline-success"
                        >もっと表示する</a>
                    </div>

                    <!-- ページネーション -->
                    {{-- <div class="my-5 d-flex justify-content-center">
                        {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
                    </div> --}}

                </div>

                {{-- <div class="row my-5 mx-3">
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
                </div>
                <!-- ページネーション -->
                <div class="mb-5 d-flex justify-content-center">
                    {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
                </div> --}}
            </div>
        </section>
        <section>
            <div class="container-1200 my-5">
                <h5 class="text-center">\ 公式アカウント /</h5>
                <div class="d-flex justify-content-center gap-3">

                    <a href="#" class="d-block btn rounded-pill p-0 fs-1 text-white" style="width:4rem; height:4rem;line-height:3.8rem; background-color:#07b53b;">
                        <!--LINE-->
                        <i class="bi bi-line"></i>
                    </a>
                    <a href="#" class="d-block btn rounded-pill p-0 fs-1 text-white" style="width:4rem; height:4rem;line-height:3.8rem; background-color:#1DA1F2;">
                        <!--twitter-->
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="d-block btn rounded-pill p-0 fs-1 text-white" style="width:4rem; height:4rem;line-height:3.8rem; background-color:#CF2E92;">
                        <!--instagram-->
                        <i class="bi bi-instagram"></i>
                    </a>

                </div>
            </div>
        </section>

    </main>
    <footer>
        @include('_parts.footer')
    </footer>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>


</body>
</html>
