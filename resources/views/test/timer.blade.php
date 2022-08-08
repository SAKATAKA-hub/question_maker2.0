<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カウントアップタイマー</title>

    <!-- bootstrap アイコン -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- avant-ui CSS -->
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

</head>
<body class="pt-3 container">


    <h2>カウントアップタイマー</h2>


    <div id="app">
        <count-up-timer-component></count-up-timer-component>
    </div>



    <form onsubmit="stopOnbeforeunload()">
        <div class="mb-3">
            <label for="inputText" class="form-label">テキスト入力</label>
            <input type="text" class="form-control" id="inputText">
        </div>
        <button type="submit" class="btn btn-primary">送信</button>
    </form>


    <script>
        /*
        | =========================================
        |   フォームのページ離脱防止アラート
        |    page_exit_prevention_alert
        |
        |   ※1.フォームにonsubmit="stopOnbeforeunload()"を指定する。
        |   ※2.scriptタグを読込む。
        |   src="{{asset('js/page_exit_prevention_alert.js')}}
        | =========================================
        */


        /* リロードアラート */
        window.onbeforeunload = function(e) {
            return 'hoge'; //なんでもよい。
        };

        /* フォーム送信時に、アラートの解除 */
        const stopOnbeforeunload = function(){
            console.log('stopOnbeforeunload');
            window.onbeforeunload = null;
        };

    </script>




    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
