<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問題詳細</title>

    <!-- bootstrap アイコン -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- avant-ui CSS -->
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

</head>
<body class="pt-3 container">


    <h2>問題詳細</h2>

    <form action="{{route('play_question')}}" method="POST">
        @csrf
        <input type="hidden" name="question_group_id" value="{{ '1' }}">
        <button type="submit" class="btn btn-primary">
            スタート<i class="bi bi-play-circle-fill ms-2"></i>
        </button>
    </form>


    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
