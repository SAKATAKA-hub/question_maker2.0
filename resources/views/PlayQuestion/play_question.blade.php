<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>{{$question_group->title}}</title>

    <meta  name="description" content="{{$question_group->title}}">
    <meta property="og:title" content="{{$question_group->title}}" />
    <meta property="og:description" content="{{$question_group->resume_text}}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content=" {{url()->current()}}" />
    <meta property="og:image" content="{{ asset('storage/'.$question_group->image_puth) }}" />
    <meta property="og:site_name" content="もんだいDIY" />
    <meta property="og:locale" content="ja_JP"  />


    <!-- 基本CSS -->
    @include('_parts.meta_css')
    <meta name="csrf_token"                  content="{{ csrf_token() }}">
    <meta name="question_group_id"           content="{{ $question_group->id }}">
    <meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
    <meta name="route_scoring"           content="{{ route('scoring') }}">
    <style>
        .card{
            text-decoration:none;
        }
    </style>


</head>
<body class="bg-white">
    <div id="app">


        <header>
            @include('_parts.header')
        </header>
        <main >

            <!-- 背景 -->
            <div class="position-fixed top-0 start-0 h-100 w-100"
            style="
            background: no-repeat center center / cover;
            background-image: url({{ asset('storage/site/image/top.png') }});
            opacity: .3; z-index:-1;
            "></div>

            <!-- contents -->
            <section class="">
                {{-- <div class="container-900 py-2 mt-md-5 bg-light border-start border-5 border-success"> --}}
                <div class="container-900">
                    <div class="p-2 px-3 border-start border-5 border-success"
                    style="background:rgb(20, 207, 160, .1); border-radius:0 1.6rem 1.6rem 0;">

                    <h2 class="mb-0 fs-6 d-md-none">{{$question_group->title}}</h2>
                    <h2 class="mb-0 d-none d-md-block">{{$question_group->title}}</h2>

                    </div>
                </div>
            </section>
            <section>
                <div class="container-900 my-md-">


                    <play-question-component></play-question-component>

                </div>
            </section>


            <!-- フェードインアラート -->
            @include('_parts.alert')


        </main>
        <footer>
            @include('_parts.footer')
        </footer>


    </div><!--end id:app-->

    <!-- フォームのページ離脱防止アラート -->
    <script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
    <!-- bootstrap JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>


