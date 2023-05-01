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
        @media screen and (min-width: 768px) {
            #center-contents{
                overflow: hidden;
                padding: 1rem;
            }
        }
    </style>

    <!-- Google tag (gtag.js) -->
    @include('_parts.google_tag')

</head>
<body class="bg-white">
    <div id="app">

        <header>
            @include('_parts.header')

            <!-- 見出しタイトル -->
            <section class="border-bottom border-1 bg-white">
                <div class="container-1200 pb-0">

                    <h2 class="text-secondary fw-bold fs-5">@yield('title')</h2>

                    <!-- breadcrumb -->
                    <nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 bg-white">
                            <li class="breadcrumb-item"><a href="{{route('questions_list')}}" class="text-success">
                                <i class="bi bi-house-door-fill"></i> Home
                            </a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </section>

        </header>
        <main>


            <!-- contents -->
            <div class="container-1200">
                <div class="d-md-flex gap-0">

                    <!-- サイドコンテンツ[pc] -->
                    <!--PC-->
                    <div class="d-none d-md-block pe-3" style="min-width:300px; width:300px;">
                        @include('_parts.creater_info')
                    </div>
                    <!--movile-->
                    <div class="d-md-none mb-5 w-100">
                        @include('_parts.creater_info')
                    </div>

                    <!-- 中央コンテンツ -->
                    <section id="center-contents" class="flex-fill">


                        @yield('contents')


                    </section>
                </div>
            </div>


            <!-- フェードインアラート -->
            @include('_parts.alert')


        </main>
        <footer>
            @include('_parts.footer')
        </footer>

    </div><!--end id:app-->

    <!-- bootstrap JavaScript -->
    @yield('script')
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
