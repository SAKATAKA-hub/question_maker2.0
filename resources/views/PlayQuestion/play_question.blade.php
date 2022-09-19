<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>{{$question_group->title}}</title>


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
    <header>
        @include('_parts.header')
    </header>
    <main>

        <!-- contents -->
        <div id="app">
            <section class="bg-light-success">
                <div class="container-1200">

                    <h2 class="p-3">{{$question_group->title}}</h2>

                </div>
            </section>
            <section>
                <div class="container-600 my-5">


                    <play-question-component></play-question-component>

                </div>
            </section>
        </div>


        <!-- フェードインアラート -->
        @include('_parts.alert')


    </main>
    <footer>
        @include('_parts.footer')
    </footer>


    <!-- フォームのページ離脱防止アラート -->
    <script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
    <!-- bootstrap JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>


