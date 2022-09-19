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

    <style>
        main{
            min-height: 0;
        }
    </style>
</head>
<body class="bg-white">
    <header class="container-600">
        <h1 class="m-0"><a href="{{ route('home')}}" class="navbar-brand fs-2 fw-bold text-success">
            {{ env('APP_NAME') }}
        </a></h1>
    </header>
    <main class="container-600">




        @yield('contents')


    </main>
    <footer class="container-600">
        <p class="m-0 ">&copy; Next Arrow Inc. All Rights Reserved.</p>
    </footer>

    <!-- bootstrap JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('script')

</body>
</html>
