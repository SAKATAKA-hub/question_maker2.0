<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')


    <title>@yield('title')</title>

    <!-- 基本CSS -->
    @include('_parts.meta_css')
    @yield('style')

    <style> main{ min-height: 0; } </style>

    <!-- Google tag (gtag.js) -->
    @include('_parts.google_tag')

</head>
<body class="bg-white">
    <header class="">
        <h1 class="container-900"><a href="{{ route('home')}}" class="navbar-brand fs-2 fw-bold text-success">
            {{-- {{ env('APP_NAME') }} --}}
            <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="サイトロゴ" style="width:3rem;">
        </a></h1>
    </header>
    <main class="container-900">




        @yield('contents')


    </main>
    <footer class="container-600">
        <p class="m-0">&copy; TOSUMA Co.,Ltd.</p>
    </footer>


    <!-- bootstrap JavaScript -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @include('_parts.appjs')
    @yield('script')

</body>
</html>
