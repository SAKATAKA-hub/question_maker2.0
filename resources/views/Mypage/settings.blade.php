@extends('layouts.base')


<!----- title ----->
@section('title', 'プロフィール・設定変更' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ 'プロフィール/・設定変更' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
/* アコーディオン */
.accordion-button:focus {
    box-shadow: none;
}
.accordion-button:not(.collapsed) {
    color: #6C757D;
    background-color:rgba(92, 240, 203, 0.5);;
}
</style>
@endsection


<!----- script ----->
@section('script')
<!-- フォームのページ離脱防止アラート -->
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')
    <section class="">
        <div class="container-1200 my-5">
            <div class="d-md-flex">

                <!-- サイドコンテンツ[pc] -->
                <div class="d-none d-md-block  pe-3" style="width:300px;">
                    @include('_parts.user_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="flex-fill">


                    <div class="m-auto" style="max-width:600px;">

                        <!-- [ プロフィールの変更 ] -->
                        <div class="mb-3">

                            <div class="accordion" id="profile01Acco">
                                <div class="accordion-item border">
                                    <h2 class="accordion-header" id="profile01AccoHeadingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile01AccoOne" aria-expanded="false" aria-controls="profile01AccoOne">
                                            <div class="mb-0">プロフィールの変更</div>
                                        </button>
                                    </h2>
                                    <div id="profile01AccoOne" class="accordion-collapse collapse" aria-labelledby="profile01AccoHeadingOne" data-bs-parent="#profile01Acco">
                                        <div class="accordion-body  bg-white">

                                            <form action="{{route('update_user_profile')}}" method="POST"
                                            enctype="multipart/form-data" onsubmit="stopOnbeforeunload()"
                                            >
                                                @csrf

                                                <!-- 氏名 -->
                                                <div class="mb-4">
                                                    <label for="profile_name" class="form-label">
                                                        氏名<small class="text-danger ms-3">※必須</small>
                                                    </label>
                                                    <input type="text" name="name" class="form-control" id="profile_name"
                                                    value="{{Auth::user()->name}}"
                                                    placeholder="山田　太郎" maxlength="50" required>
                                                </div>


                                                <!-- 問題画像 -->
                                                <div class="mb-4">
                                                    <label class="form-label">問題画像</label>
                                                    <div class="" style="max-width:200px">
                                                        <read-image-file-component img_path="{{asset('storage/'.Auth::user()->image_puth)}}"
                                                        noimg_path="{{asset('storage/'.'site/image/user_no_image.png')}}" alt="ユーザー画像"/>
                                                    </div>
                                                    <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
                                                </div>

                                                <!-- 自己紹介 -->
                                                <div class="mb-4">
                                                    <label for="profile_profile" class="form-label">
                                                        自己紹介
                                                    </label>
                                                    <textarea class="form-control" name="profile" id="profile_profile" rows="6"
                                                    placeholder="自己紹介の文章を入力しましょう！">{{Auth::user()->profile_text}}</textarea>
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success btn-sm">更新</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- [ アカウント情報の変更 ] -->
                        <div class="mb-3">

                            <div class="accordion" id="profile02Acco">
                                <div class="accordion-item border">
                                    <h2 class="accordion-header" id="profile02AccoHeadingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile02AccoOne" aria-expanded="false" aria-controls="profile02AccoOne">
                                            <div class="mb-0">アカウント情報の変更</div>
                                        </button>
                                    </h2>
                                    <div id="profile02AccoOne" class="accordion-collapse collapse" aria-labelledby="profile02AccoHeadingOne" data-bs-parent="#profile02Acco">
                                        <div class="accordion-body  bg-white">

                                            <form action="{{route('update_user_email')}}" method="POST"
                                            class="mb-3" onsubmit="stopOnbeforeunload()">
                                                @csrf
                                                <label for="inputEmail1" class="form-label">
                                                    メールアドレスの変更<small class="text-danger ms-3">※必須</small>
                                                </label>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="email" name="email" class="form-control" id="inputEmail1" value="{{Auth::user()->email}}" required>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit" class="btn btn-success btn-sm">更新</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="">
                                                <a href="{{route('user_auth.reset_pass_form')}}" class="text-success">パスワードの変更はこちら</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- [ メール受信設定 ] -->
                        <div class="mb-3">
                            <form action="{{route('email_setting')}}" method="POST" onsubmit="stopOnbeforeunload()">
                                @csrf
                                <input type="hidden" name="mail_setting_id" value="{{Auth::user()->mail_setting['id']}}">

                                <div class="accordion" id="profile03Acco">
                                    <div class="accordion-item border">
                                        <h2 class="accordion-header" id="profile03AccoHeadingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile03AccoOne" aria-expanded="false" aria-controls="profile03AccoOne">
                                                <div class="mb-0">メール受信設定</div>
                                            </button>
                                        </h2>
                                        <div id="profile03AccoOne" class="accordion-collapse collapse" aria-labelledby="profile03AccoHeadingOne" data-bs-parent="#profile03Acco">
                                            <div class="accordion-body  bg-white p-0">

                                                <ul class="list-group  border-0">
                                                    <li class="list-group-item border-0">
                                                        <div class="row align-items-center">
                                                            <div class="col">「いいね」されたとき</div>
                                                            <div class="col-auto">
                                                                <!--チェックボタン-->
                                                                <div class="form-check form-switch fs-5">
                                                                    <input class="form-check-input" type="checkbox" name="keep_question_group"
                                                                    {{ Auth::user()->mail_setting['keep_question_group'] ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="row align-items-center">
                                                            <div class="col">「フォロー」されたとき</div>
                                                            <div class="col-auto">
                                                                <!--チェックボタン-->
                                                                <div class="form-check form-switch fs-5">
                                                                    <input class="form-check-input" type="checkbox" name="keep_creator_user"
                                                                    {{ Auth::user()->mail_setting['keep_creator_user'] ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="row align-items-center">
                                                            <div class="col">「コメント」されたとき</div>
                                                            <div class="col-auto">
                                                                <!--チェックボタン-->
                                                                <div class="form-check form-switch fs-5">
                                                                    <input class="form-check-input" type="checkbox" name="comment"
                                                                    {{ Auth::user()->mail_setting['comment'] ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                ダイレクトメールの受取り<br>
                                                                <small>※重要事項以外のお知らせメール</small>
                                                            </div>
                                                            <div class="col-auto">
                                                                <!--チェックボタン-->
                                                                <div class="form-check form-switch fs-5">
                                                                    <input class="form-check-input" type="checkbox" name="infomation"
                                                                    {{ Auth::user()->mail_setting['infomation'] ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <!------>
                                                            </div>
                                                            <div class="col-auto">
                                                                <!--送信ボタン-->
                                                                <button type="submit" class="btn btn-success btn-sm">更新</button>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- [ 退会の手続き ] -->
                        <div class="mb-3">

                            <div class="accordion" id="profile04Acco">
                                <div class="accordion-item border">
                                    <h2 class="accordion-header" id="profile04AccoHeadingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile04AccoOne" aria-expanded="false" aria-controls="profile04AccoOne">
                                            <div class="mb-0">退会の手続き</div>
                                        </button>
                                    </h2>
                                    <div id="profile04AccoOne" class="accordion-collapse collapse" aria-labelledby="profile04AccoHeadingOne" data-bs-parent="#profile04Acco">
                                        <div class="accordion-body  bg-white">

                                            <div class="card card-body border-danger">
                                                一度退会すると、あなたのアカウントに関する情報がすべて失われ、元に戻すことができません。
                                                <ul class="my-3">
                                                    <li>
                                                        これまで作成した全ての問題集が削除され、他のユーザからも利用できなくなります。
                                                    </li>
                                                    <li>
                                                        これまで受検した問題集の成績結果がすべて失われます。
                                                    </li>
                                                </ul>
                                                <h5 class="text-danger">本当に退会しますか？</h5>

                                                <a href="{{route('withdrawal_form')}}" class="btn btn-outline-danger btn-sm"
                                                onclick="stopOnbeforeunload()"
                                                >退会</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection


