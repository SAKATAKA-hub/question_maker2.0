<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 error</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            min-height: 100vh;
            /* background: pink; */
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="text-center">
        <h3>403 Access Not Granted</h3>

        <div class="w-100 my-5">
            <img class="d-block mx-auto" style="max-width:200px;" src="https://tosuma.ltd/storage/site/image/error.jpg" alt="キャラクター画像">
        </div>
        <h5>指定されたページへのアクセスは<br>禁止されています。</h5>
        <div>入力したURLをもう一度ご確認ください。</div>

        <div class="mt-3">
            <a href="#" onClick="history.back(); return false;">>戻る</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
