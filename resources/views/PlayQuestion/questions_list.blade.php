<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>もんだいDIYパーク - mondai DIY park - オリジナル問題集が自由に作れる！無料の問題作成ツール</title>


    {{-- <meta  name="description" content="誰でも簡単な操作で、自分の好きな問題集を作れる！作成した問題集のURLをコピーして友達に送れば、簡単に出題できる！『もんだいDIYパーク』は、もんだいを「作る」「答える」「出題する」ツールを揃えた、もんだいのDIY広場です。">
    <meta property="og:title" content="もんだいDIYパーク - mondai DIY park - オリジナル問題集が自由に作れる！無料の問題作成ツール" />
    <meta property="og:description" content="誰でも簡単な操作で、自分の好きな問題集を作れる！作成した問題集のURLをコピーして友達に送れば、簡単に出題できる！『もんだいDIYパーク』は、もんだいを「作る」「答える」「出題する」ツールを揃えた、もんだいのDIY広場です。" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{route('home')}}" />
    <meta property="og:image" content="{{asset('storage/site/image/logo_lg.png')}}" />
    <meta property="og:site_name" content="もんだいDIYパーク" />
    <meta property="og:locale" content="ja_JP"  /> --}}


    <!-- ファビコン -->
    <link rel="icon" href="{{asset('storage/site/image/fabicon.png')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <style> .snss>a:hover{opacity: .8;} </style>

    <!-- Google tag (gtag.js) -->
    @include('_parts.google_tag')


</head>
<body class="bg-white ">
    <header>
        @include('_parts.header')
    </header>
    <main id="app" class="">


        <!-- [ ページトップ ] -->
        <section class="top">
            <!-- 背景 -->
            <div class="top_bg_container">
                <div class="top_bg" style="
                    background:url({{ asset('storage/site/image/22636100.jpg') }});
                    background-repeat  : repeat;
                "></div>
            </div>


            <div class="container-1200">
                <div class="px-4 py-3 py-md-5 text-center">
                    <div class="col-12 col-md-6 mx-auto  position-relative">
                        <h5 class="fw-bold  position-absolute top-0 start-50 translate-middle-x w-100"
                        >\オリジナル問題集をDIYできる！/</h5>

                        <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="サイトロゴ" class="d-block w-100">
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="mt-3">
                            <!-- 検索フォーム -->
                            <form action="{{ route('questions_search_list') }}">
                                <div  class="input-group overflow-hidden shadow" style="border-radius:2rem;">
                                    {{-- <span class="input-group-text bg-white border-0 ms-3 text-secondary" id="basic-addon1">
                                        問題集の検索：
                                    </span> --}}

                                    <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
                                    value="@if ( isset($keywords) ){{  $keywords.' '  }}@endif" placeholder="問題集の検索" aria-label="SeachKeywords" aria-describedby="basic-addon1">

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

                </div>
            </div>
        </section>
        <section class="bg-secondary text-white">
            <div class="container-1200">
                <p class="lead text-center mb-0" style="font-size:12px;">
                    このサイトではオリジナルの『問題集』を <strong class="fw-bold">DIYして（作って）</strong>公開したり、誰かが作った『問題集』に挑戦することができます。
                </p>
            </div>
        </section>
        <!-- [ news ] -->
        <section class="" style="background: rgba(92, 240, 203, 0.5);">
            <div class="container-600">
                <h5 class="text-dark text-center">\ お知らせ /</h5>
                @php
                    $news_list = [
                        [ 'date'=>'2022.10.10', 'title'=>'サイトをOPENしました！', 'blade'=>'20221010', ],
                    ];
                @endphp
                <div class="list-group list-group-flush">
                    @foreach ($news_list as $news)
                        <a href="" class="list-group-item bg-transparent border-0"
                        data-bs-toggle="modal" data-bs-target="#modal{{$news['blade']}}"
                        >
                            <div class="card card-body py-1 border-0">
                                <div class="text-secondary">{{$news['date']}}</div>
                                <span class="text-decoration-none text-dark fw-bold">{{$news['title']}}</span>
                            </div>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="modal{{$news['blade']}}" tabindex="-1" aria-labelledby="modal{{$news['blade']}}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-success">
                                        <div class="">
                                            <!--[date]-->
                                            <div class="text-success">{{$news['date']}}</div>
                                            <!--[title]-->
                                            <h5 class="modal-title" id="modal{{$news['blade']}}Label">{{$news['title']}}</h5>
                                        </div>

                                    </div>
                                    <div class="modal-body">
                                        @include('news.'.$news['blade'])
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm fw-bold text-secondary" data-bs-dismiss="modal">閉じる</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>                {{-- </div> --}}
                <div class="text-end py-3">
                    <a href="{{route('footer_menu.news')}}" class="text-decoration-none text-secondary">一覧を見る</a>
                </div>

            </div>
        </section>
        <!-- Please Login Modal -->
        <section>


            <!-- Please Login Modal -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


        </section>
        <!-- [ 人気な問題集トップ５！ ] -->
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
                    @foreach ($popular_question_groups as $question_group)

                        @include('_parts.question_group_card_list')

                    @endforeach


                    <div class="mt-5 text-center">
                        <a href="{{ route('questions_search_list',['order'=>'accessed_count,desc']) }}" class="btn rounded-pill btn-outline-success"
                        >もっと表示する</a>
                    </div>

                </div>


            </div>
        </section>
        <div class="container-1200 divider divider-dashed my-5"></div><!---- Divider ---->
        <!-- [ 新着問題集トップ１０！ ] -->
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
                    @foreach ($new_question_groups as $question_group)

                        @include('_parts.question_group_card_list')

                    @endforeach

                    <div class="mt-5 text-center">
                        <a href="{{ route('questions_search_list') }}" class="btn rounded-pill btn-outline-success"
                        >もっと表示する</a>
                    </div>

                </div>

            </div>
        </section>
        <!-- [ SNS ] -->
        <section>
            <div class="container-1200 my-5 text-center">
                <h5 class="">\ 公式アカウント /</h5>
                <p class="text-secondary">
                    サイトの更新情報やお知らせを配信中！
                </p>
                <div class="d-flex justify-content-center gap-3 snss">

                    <a href="{{env('LINE_URL')}}" class="badge rounded-pill fs-3 text-white p-3" style="background-color:#07b53b;">
                        <!--LINE-->
                        <i class="bi bi-line"></i>
                    </a>
                    <a href="{{env('TWIITER_URL')}}" class="badge rounded-pill fs-3 text-white p-3" style="background-color:#1DA1F2;">
                        <!--twitter-->
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="{{env('INSTAGRAM_URL')}}" class="badge rounded-pill fs-3 text-white p-3" style="background-color:#CF2E92;">
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
