@extends('layouts.base')


<!----- title ----->
@section('title','FAQ - よくある質問')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ 'FAQ - よくある質問' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
    /* main{ background-color:  rgb(20, 207, 160,.1); } */
    main{ background: rgba(92, 240, 203, 0.5);}
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200 py-4">


        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>
                    『問題集』と『問題』は何が違うのですか？　『受検』とは何のことですか？
                </strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                このサイトでは、ユーザーが作成した『問題』の集まりを『問題集』、問題にチャレンジすることを『受検』と表記しています。
            </li>
        </ul>

        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>料金はかかりますか？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                今のところ全ての機能が無料でご利用いただけます。
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>会員登録は必要ですか？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                会員登録をしなくても、問題を解いて遊ぶことができます。<br>
                会員登録して頂くと、問題集を作成すろことができたり、受験結果の再確認、フォロー機能、いいね機能、コメント機能がご利用いただけます。
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>問題の解答形式を複数選択にしたいのですが、解答形式を変更することはできますか？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                解答が複数ある問題の出題にも対応しています。<br>
                現在解答形式は、「ひとつの答えを選ぶ」、「複数の答えを選ぶ」、「テキストで答えを入力する」からお選びいただけます。
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>問題の出題に画像を載せることはできますか？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                可能です。<br>
                一問につき一つまで画像を添付することができます。<br>
                画像ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式でお願いします。
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>問題の答えが違っているみたいなんですが・・・？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                コメント機能を利用して、出題者様に問題内容の確認を行うことができます。<br>
                表記の誤りや内容についての疑問点がありましたら、コメント機能を利用してご確認ください。<br>
                明らかに問題ないように不備があるものについては、問題解答後に表示される「報告」ボタンよりお知らせください。内容を確認の上、対応致します。
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>利用規約に違反した問題が掲載されています！</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                利用規約をご確認頂き、内容に反する問題を発見された場合は、お手数ですがご報告をお願いします。<br>
                問題解答後に表示される「報告」ボタンよりお知らせください。内容を確認の上、対応致します。また、<a href="{{route('footer_menu.contact')}}">お問い合わせ</a>よりご連絡いただく事も可能です。
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>退会はどのようにすればいいですか？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                ログイン後、<a href="{{route('settings')}}">こちら</a>より退会の手続きを行う事ができます。<br>
                一度退会すると、これまで作成した全ての問題集が削除され、他のユーザからも利用できなくなります。また、これまで受検した問題集の成績結果もすべて失われます。<br>

                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>掲載されている問題集の種類が少なくないですか？</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                まだサービスを開始したばかりで、ご迷惑をおかけします。<br>
                是非皆さんに問題を投稿して頂き、サービスを盛り上げたいと思っています。<br>
                応援よろしくお願いします！<br>
                <br>
            </li>
        </ul>
        <ul class="list-group mb-3">
            <li class="list-group-item border-0 shadow-sm bg-light">
                <strong class="text-success">Q.</strong>
                <strong>もっとこうしたら、いいサービスになると思うよ！</strong>
                <br>
            </li>
            <li class="list-group-item border-0 shadow-sm">
                <strong class="text-danger">A.</strong>
                システムに対してのご要望や、不具合報告、その他もっとこうしたら良くなるというご意見を、 常に募集しております。<br>
                ご要望、アイデア、そのほかご提案がありましたら、
                <a href="{{route('footer_menu.contact')}}">お問い合わせ</a>よりご連絡ください。
                <br>
            </li>
        </ul>




    </div>
</section>

@endsection
