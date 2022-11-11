<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SNS Login</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container">

        <div class="my-3">
            <h2>Googleログイン</h2>
            {{ route('user_auth.google.redirect')}} <br>
            <a href="{{route('user_auth.google.redirect')}}" class="btn btn-outline-secondary">google redirect</a>
            <br>
            {{ route('user_auth.google.callback') }} <br>
            <a href="{{route('user_auth.google.callback')}}" class="btn btn-outline-secondary">google callback</a>
        </div>


    </div>
</body>
</html>
