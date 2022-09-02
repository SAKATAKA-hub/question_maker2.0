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
                <div class="my-5">

                    @if ( $question_groups->count() )
                    <h5 class="text-secondary">”{{$keywords?$keywords:'すべて'}}”の条件で一致する検索結果</h5>
                    @else
                    <h5 class="text-secondary">”{{$keywords}}”の条件に一致する結果がみつかりません。</h5>
                    @endif


                    <!-- 問題集リスト・ページネーション use_param[$question_groups] -->
                    @include('_parts.question_groups_icon_list')



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
