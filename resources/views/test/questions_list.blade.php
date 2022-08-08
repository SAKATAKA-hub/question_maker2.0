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

    <style>

        main{
            margin-top: 0;
            min-height: 100vh;
        }
        .card{
            text-decoration:none;
        }

    </style>

</head>
<body class="bg-white ">
    <header>
    </header>
    <main class="container">


        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">\ 手作り問題集 /</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">
                    このサイトは誰かが作った問題を解いたり、<br
                    >じぶんでオリジナルの問題を作ることができます。

                </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn rounded-pill btn-primary btn-lg px-4 me-sm-3">問題を解く</button>
                    <button type="button" class="btn rounded-pill btn-outline-secondary btn-lg px-4">問題を作る</button>
                </div>
            </div>
        </div>


        <div class="row my-5">

            @for ($i = 0; $i < 12; $i++)
                <div class="col-md-6 col-lg-4 p-1 pb-3">
                    <a href="" class="card card-body text-dark" class="text-decoration:none;"
                    data-bs-toggle="modal" data-bs-target="#questionModal{{ $i+1 }}"
                    >
                        <div class="media comment d-flex">
                            <img src="{{ asset('storage/app/image/sample3.jpeg') }}" class="img-avatar mr-3 mx-3" alt="author image">
                            <div class="media-body">
                                <div class="media-body-header">
                                    <h4 class="comment-author">{{ 'サンプル問題集'.$i+1 }}</h4>
                                    <span class="comment-date text-muted">7 日前</span>
                                    <span class="comment-reply">問題数：3問</span>
                                    <span class="comment-reply">制限時間：60分</span>
                                    <span class="comment-share">平均点：99.9点</span>
                           </div>
                               サンプルで作った問題です。
                            </div>
                        </div>
                    </a>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="questionModal{{ $i+1 }}" tabindex="-1" aria-labelledby="questionModal{{ $i+1 }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <div class="modal-title" id="questionModal{{ $i+1 }}Label">
                            問題を開始します。<br>
                            準備はよろしいですか？
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="media comment d-flex">
                                <img src="{{ asset('storage/app/image/sample1.jpeg') }}" class="img-avatar mr-3 mx-3" alt="author image">
                                <div class="media-body">
                                    <div class="media-body-header">
                                        <h4 class="comment-author">{{ 'サンプル問題集'.$i+1 }}</h4>
                                        <span class="comment-date text-muted">7 日前</span>
                                        <span class="comment-reply">問題数：3問</span>
                                        <span class="comment-reply">制限時間：60分</span>
                                        <span class="comment-share">平均点：99.9点</span>
                                    </div>
                                   サンプルで作った問題です。
                                   <div class="d-flex">
                                        <span></span>
                                   </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                            <a href="{{ route('question', ['id'=>$i+1, 'num'=>'1',] ) }}" class="btn btn-primary">開始</a>
                        </div>
                    </div>
                    </div>
                </div>
            @endfor
        </div>


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
