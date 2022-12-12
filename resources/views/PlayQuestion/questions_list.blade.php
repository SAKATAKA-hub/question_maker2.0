<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>もんだいDIY - mondai DIY - オリジナル問題集が自由に作れる！無料の問題作成ツール</title>


    <meta  name="description" content="誰でも簡単な操作で、自分の好きな問題集を作れる！作成した問題集のURLをコピーして友達に送れば、簡単に出題できる！『もんだいDIY』は、もんだいを「作る」「答える」「出題する」ツールを揃えた、もんだいのDIY広場です。">
    <meta property="og:title" content="もんだいDIY - mondai DIY - オリジナル問題集が自由に作れる！無料の問題作成ツール" />
    <meta property="og:description" content="誰でも簡単な操作で、自分の好きな問題集を作れる！作成した問題集のURLをコピーして友達に送れば、簡単に出題できる！『もんだいDIY』は、もんだいを「作る」「答える」「出題する」ツールを揃えた、もんだいのDIY広場です。" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{route('home')}}" />
    <meta property="og:image" content="{{asset('storage/site/image/logo_lg.png')}}" />
    <meta property="og:site_name" content="もんだいDIY" />
    <meta property="og:locale" content="ja_JP"  />


    <meta name="csrf_token" content="{{ csrf_token() }}">

    <!-- Google tag (gtag.js) -->
    @include('_parts.google_tag')

    @include('_parts.meta_css')
    <link href="{{asset('css/animation.css')}}"  rel="stylesheet" type="text/css" >
    <link href="{{asset('css/bootstrap_carousel.css')}}"  rel="stylesheet" type="text/css" >


    <!-- slider -->
    <style>
        .snss>a:hover{opacity: .8;}

        /*無料アイコン*/
        .free_icon{
            position: absolute;
            top: -50%; left: -68px;
            transform: translateY(-50%);
            z-index: 2;
            width:68px;
            rotate: -30deg;
        }
        @media screen and (max-width: 576px) {
            .free_icon{
                left: -48px;
                width:48px;
                top: -20%;
                transform: translateY(-20%);
            }
        }


    </style>


</head>
<body class="bg-white">
    <header class="">
        @include('_parts.header')
    </header>
    <main id="app" class="">

        <!-- [ ページローディング ] -->
        <div id="splash" class="fadeUOut bg-warning">
            <div id="splash_box">
                <img src="{{asset('storage/site/image/splash_icon.png')}}" alt="" class="anm_hammer">
                <p class="mt-2 text-dark">loading…</p>
            </div>
        </div>

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
                    <div class="col-12 col-md-6 mx-auto mb-5 text-center">


                        <h5 class="fw-bold d-inline-block position-relative  anm_top_01">
                            \オリジナル問題集をDIYできる！/
                            <img src="{{asset('storage/site/image/free.png')}}" alt="無料" class="free_icon anm_scale_01">
                        </h5>

                        <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="サイトロゴ" class="d-block w-100  anm_scale_01">

                        <h5 class="bg-success text-white  anm_bottom_01">もんだい DIY</h5>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="anm_bottom_02">
                            <div class="mt-3">
                                <!-- 検索フォーム -->
                                <form action="{{ route('questions_search_list') }}">
                                    <div  class="input-group overflow-hidden shadow" style="border-radius:2rem;">

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
            </div>
        </section>
        <section class="bg-secondary text-white">
            <div class="container-1200">
                <p class="lead text-center mb-0" style="font-size:12px;">
                    このサイトではオリジナルの『問題集』を <strong class="fw-bold">DIYして（作って）</strong>公開したり、誰かが作った『問題集』に挑戦することができます。
                </p>
            </div>
        </section>
        <!-- Please Login Modal -->
        <section>


            <!-- Please Login Modal -->
            <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
            ></please-login-modal-component>
            @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


        </section>





        <!-- [ 使い方スライダー ] -->
        {{-- @if( env('APP_DEBUG') ) --}}
        <section>
            <div class="container-1200 my-5">
                <div class="text-center mb-3  anm_bottom_01">
                    <p class="fw-bold text-success mb-2">
                        About this site
                    </p>
                    <h3>このサイトについて</h3>
                </div>
                @php
                    $slider_items = [
                        asset('storage/site/image/about01.png'),
                        asset('storage/site/image/about02.png'),
                        asset('storage/site/image/about03.png'),
                        asset('storage/site/image/about04.png'),
                    ];
                @endphp

                <div id="carouselIndicators" class="carousel slide w-100  anm_scale_02" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @php $num = 0; @endphp
                        <div class="carousel-item {{$num===0? 'active' : ''}}">
                            <img src="{{$slider_items[$num]}}" class="d-block w-100" alt="このサイトについて">
                        </div>
                        @php $num = 1; @endphp
                        <div class="carousel-item {{$num===0? 'active' : ''}}">
                            <img src="{{$slider_items[$num]}}" class="d-block w-100" alt="このサイトについて">
                        </div>
                        @php $num = 2; @endphp
                        <div class="carousel-item {{$num===0? 'active' : ''}}">
                            <img src="{{$slider_items[$num]}}" class="d-block w-100" alt="このサイトについて">
                        </div>
                        @php $num = 3; @endphp
                        <div class="carousel-item {{$num===0? 'active' : ''}}">
                            <img src="{{$slider_items[$num]}}" class="d-block w-100" alt="このサイトについて">
                        </div>

                    </div>
                    <!--画像ボタン-->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true"></button>
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        {{-- @endif --}}


        <!-- [ news ] -->
        <section class="bg-light">
            <div class="container-600 py-5">
                <h5 class="text-dark text-center  anm_bottom_01">\ お知らせ /</h5>

                @php $news_list = config('news.list'); @endphp
                <div class="list-group list-group-flush  anm_right_02">
                    @foreach ( $news_list as $news)
                        <a href="" class="list-group-item bg-transparent border-0"
                        data-bs-toggle="modal" data-bs-target="#modal{{$news['blade']}}"
                        >
                            <div class="card card-body py-1 border-0">
                                <div class="text-success">{{$news['date']}}</div>
                                <span class="text-decoration-none text-dark fw-bold">{{$news['title']}}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="text-end py-3 anm_scale_02">
                    <a href="{{route('footer_menu.news')}}" class="text-decoration-none text-secondary">一覧を見る</a>
                </div>

                <!-- Modal -->
                @foreach ($news_list as $news)
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


            </div>
        </section>

        <!-- [ 人気問題集トップ５！ ] -->
        <section>
            <div class="container-1200 my-5">


                <div class="row mx-3">
                    <div class="col-md-6 order-md-2" >
                        <img src="{{ asset('storage/site/image/22901978.jpg') }}" class="d-block w-100  anm_scale_01" alt="人気の問題集">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="  anm_left_01">
                            <p class="fw-bold text-success mb-2">
                                Most popular handmade questions
                            </p>
                            <h3 class="mb-2">人気問題集トップ５！</h3>
                            <p class="text-secondary">
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
                        <img src="{{ asset('storage/site/image/23020196.jpg') }}" class="d-block w-100 anm_scale_01" alt="人気の問題集">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="  anm_right_01">
                            <p class="fw-bold text-success mb-2">
                               New handmade questions!
                            </p>
                            <h3 class="mb-2">新着問題集</h3>
                            <p class="text-secondary">
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


        <!-- [ 広告リンク ] -->
        <section>
            <div class="container-1200 my-5">

                @include('_parts.advertisement')

            </div>
        </section>


    </main>
    <footer>
        @include('_parts.footer')
    </footer>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/animation.js') }}" defer></script>

</body>
</html>
