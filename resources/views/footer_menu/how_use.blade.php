@extends('layouts.base')


<!----- title ----->
@section('title','このサイトの使い方')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ 'このサイトの使い方' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
    /* main{ background-color: #F8F9FA !important; } */
    /* main{ background-color:  rgb(20, 207, 160,.1); } */
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')

<!--// セクション１ //-->
<section class="bg-white py-5">
    <div class="container-1200">

        <div class="text-center">
            <h3 class="fs-1 text-success mb-3">
                オリジナル問題集のつくり方
            </h3>
            <p>
                ※問題集を作るには、アカウント登録が必要です。
            </p>
        </div>


        <div class="row mx-3 mb-5">
            <div class="col-lg-6 order-lg-2" >
                <img src="{{ asset('storage/site/image/make_flow01.png') }}" class="d-block w-100" alt="人気の問題集">
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="py-3">
                    <p class="d-inline px-3 fw-bold bg-success text-light">
                        Step 1
                    </p>
                    <h3 class="mt-3">『基本情報』を登録しよう！</h3>
                    <p class="my-3 text-secondary">
                        まずは、問題一覧に表示される『基本情報』を登録しよう！<br>
                        『問題集のタイトル』、『説明文』、『サムネイル画像』、『タグ』、『制限時間』を設定することができるよ。
                    </p>
                </div>
            </div>
        </div>
        <div class="row mx-3 mb-5">
            <div class="col-lg-6" >
                <img src="{{ asset('storage/site/image/make_flow02.png') }}" class="d-block w-100" alt="人気の問題集">
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="py-3">
                    <p class="d-inline px-3 fw-bold bg-success text-light">
                        Step 2
                    </p>
                    <h3 class="mt-3">『問題』を登録しよう！</h3>
                    <p class="my-3 text-secondary">
                        ひとつの答えを選ぶ』、『複数の答えを選ぶ』、『テキストで答えを入力する』の三種類から解答方法を選択して、問題をつくろう。
                    </p>
                </div>
            </div>
        </div>
        <div class="row mx-3 mb-5">
            <div class="col-lg-6 order-lg-2" >
                <img src="{{ asset('storage/site/image/make_flow03.png') }}" class="d-block w-100" alt="人気の問題集">
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="py-3">
                    <p class="d-inline px-3 fw-bold bg-success text-light">
                        Step 3
                    </p>
                    <h3 class="mt-3">『公開設定』を登録しよう！</h3>
                    <p class="my-3 text-secondary">
                        <strong class="text-success">\ 公開 /</strong><br>
                        『いいね』で評価をもらったり、『コメント』機能で感想をもらったり、全国のユーザーに問題を解いてもらおう！
                    </p>
                    <p class="my-3 text-secondary">
                        <strong class="text-success">\ 非公開 /</strong><br>
                        問題集の一覧や検索では表示されないよ！<br>
                        作成中の問題を一時保存したり、個人的に問題を解いて楽しもう！<br>
                        公開URLを使えば、URLを教えた友達だけに自分の問題にチャレンジしてもらうこともできるよ！
                    </p>

                </div>
            </div>
        </div>

    </div>
</section>

<!--// セクション２ //-->
<section class="bg-light-success py-5">
    <div class="container-1200">

        <div class="text-center mb-3">
            <h3 class="fs-1 text-success">
                問題集作成時の注意
            </h3>
        </div>

        <div class="py-3">
            <p class="d-inline fw-bold text-success px-3 bg-white">Note 1</p>
            <h3 class="my-3">
                問題集作成をプライベートで楽しむときは、公開設定を「非公開」にしましょう！
            </h3>
            <div class="card card-body border-0">
                <p>
                    このサイトで作成した問題集は、公開設定を「公開」にすることで、多くの利用者の方から閲覧できる状態になり、評価やコメントをもらう事ができます。
                    <br>
                    ただし、下に記した注意点から外れた制作物を公開した場合、トラブルの原因になる恐れがあるため注意が必要です。
                </p>
                <p>
                    公開設定を「非公開」の状態にすることで、他の利用者から閲覧することはできなくなります。
                </p>
                <p>
                    <strong class="text-success">公開設定を「非公開」にするとき</strong><br>
                    ・問題集を作りかけで保存しておきたいとき<br>
                    ・作った問題集をプライベートで利用したいとき
                </p>
            </div>
        </div>


        <div class="py-3">
            <p class="d-inline fw-bold text-success px-3 bg-white">Note 2</p>
            <h3 class="my-3">
                公開するときは気をつけよう！！
            </h3>
            <div class="card card-body border-0">
                <p>
                    以下の内容に抵触すること判断した場合は警告・問題集の非公開処置、または悪質と判断した場合は問題集またはアカウントをを削除させていただく場合があります。
                </p>
                <p>
                    <strong class="text-success">1. 他者の権利を害する行為は避けましょう</strong><br>
                    ・基本的人権を害するような行為は避けましょう。<br>
                    ・著作権・肖像権などあらゆる権利を侵害する行為は避けましょう。<br>
                </p>
                <p>
                    <strong class="text-success">2. 他者を傷つけるような表現は避けましょう</strong><br>
                    ・特定の誰かを中傷、または名誉を毀損するための文章や画像が含まれるもの<br>
                    ・過度に性的な表現、または画像などを含むもの（R12以上相当を対象とします）<br>
                    ・過度に暴力的な表現、または画像などを含むもの（R12以上相当を対象とします）<br>
                </p>
                <p>
                    <strong class="text-success">3. 解答に誤りが無いか確認しましょう</strong><br>
                    ・意図的に誤った解答を設定することは避けましょう。<br>
                    ・解答に誤りがあると気づいた際は、速やかに修正を行いましょう。<br>
                    ・解答に様々な考え方がある場合は、問題集の説明文や問題文に以下のような『補足文』を明示するようにしてください。<br>
                    <span class="ms-3">例）「文献により異なります。」「諸説あります。」</span>

                </p>
            </div>
        </div>

    </div>
</section>


@endsection
