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

    <meta name="csrf_token" content="{{ csrf_token() }}">


</head>
<body class="bg-white ">
    <header>
        @include('_parts.header')
    </header>
    <main id="app" class="">


        <section>
            <div class="container-1200">


                <!-- 検索結果 -->
                <div class="my-5">

                    <div class="mb-5">
                        @if ( $question_groups->count() )
                        <h5 class="text-secondary">”{{$keywords?$keywords:'すべて'}}”の条件で一致する検索結果</h5>
                        @else
                        <h5 class="text-secondary">”{{$keywords}}”の条件に一致する結果がみつかりません。</h5>
                        @endif
                    </div>


                    <div class="">

                        <!-- Please Login Modal -->
                        <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
                        ></please-login-modal-component>
                        @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


                        <!-- 問題集リスト -->
                        @foreach ($question_groups as $question_group)

                            @include('_parts.question_group_card_list')

                        @endforeach


                        <!-- ページネーション -->
                        <div class="my-5 d-flex justify-content-center">
                            {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>


                </div>


                <!-- タグ一覧 -->
                {{-- <div class="row my-5">
                    <h5 class="text-secondary">＃タグから検索する</h5>
                    <div class="bg-light">
                        <div class="card-body">hoge</div>
                    </div>
                </div> --}}

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
