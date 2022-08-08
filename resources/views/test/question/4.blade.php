<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>問題</title>

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


        <section class="mt-3 mb-5"  style="max-width:600px; margin:0 auto;">


            <h5 class="card-title mb-3">
                \ 成績発表 /
            </h5>

            <div class="card shadow">

                <div class="card-body">
                    <h3 class="mb-3">
                        {{ 'サンプル問題集'.$id }}
                    </h3>

                    <div class="card-text border-bottom">
                        <span class="me-3">
                            所要時間45分/60分
                        </span>
                        <span class="me-3">
                            {{'3'}}問/3問正解
                        </span>
                        <span class="card-text fs-1 text-center fw-bold text-danger">
                            100
                        </span>
                        <span class="card-text fs-5 text-center fw-bold text-danger">
                            点
                        </span>
                    </div>

                    {{-- <img src="{{ asset('storage/app/image/conf.jpg') }}" class="rounded d-block w-75 mt-3" style="margin:0 auto;" alt="question image"> --}}
                </div>

                <div class="card-body p-5">
                    <ul class="list-group">
                        <li class="list-group-item">
                            問1　〇正解
                        </li>
                        <li class="list-group-item">
                            問1　〇正解
                        </li>
                        <li class="list-group-item">
                            問1　〇正解
                        </li>
                        <li class="list-group-item">
                            問1　〇正解
                        </li>
                        {{-- <li class="list-group-item">
                            <span class="me-3">
                                3問中、{{'3'}}問正解
                            </span>
                            <span class="card-text fs-1 text-center fw-bold text-danger">
                                100
                            </span>
                            <span class="card-text fs-5 text-center fw-bold text-danger">
                                点
                            </span>
                        </li> --}}
                    </ul>
                </div>

            </div>
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary"
            data-bs-toggle="modal" data-bs-target="#goodAnswerModal"
            >
                Launch demo modal
            </button> --}}

            <!-- Modal[ 正解 ] -->
            <div class="modal fade" id="goodAnswerModal" tabindex="-1" aria-labelledby="goodAnswerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/app/image/good.jpg') }}" class="rounded w-100 mt-3" alt="正解">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('question', ['id'=>$id, 'num'=>$num+1,] ) }}" class="btn btn-primary">成績を見る</a>
                          </div>
                    </div>
                </div>
            </div>
            <!-- Modal[ 不正解 ] -->
            <div class="modal fade" id="badAnswerModal" tabindex="-1" aria-labelledby="badAnswerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="{{ asset('storage/app/image/bad.jpg') }}" class="rounded w-100 mt-3" alt="不正解">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('question', ['id'=>$id, 'num'=>$num+1,] ) }}" class="btn btn-primary">成績を見る</a>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <div class="text-center mb-5">
            <a href="{{route('questions_list')}}" class="btn btn-link" style="text-decoration:none;">問題選択に戻る</a>
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
    <script>


        // ブラウザバック時の対応
        window.addEventListener('popstate', (e) => {
            alert('入力内容が保存されない可能性があります。ページを離れますか？');
            history.go(1);
        });


        // リロード・タブが閉じられる時の対応
        window.addEventListener('beforeunload', (e: BeforeUnloadEvent) => {

            alert('入力内容が保存されない可能性があります。ページを離れますか？');

            const message = '入力内容が保存されない可能性があります。ページを離れますか？';
            e.preventDefault();
            e.returnValue = message;
            return message;
        })


    </script>


</body>
</html>
