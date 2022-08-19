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
                        <div class="mb-5">


                            <h5>プロフィールの変更</h5>
                            <div class="card card-body  border-2">
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
                                        <div class="" style="width:200px">
                                            <read-image-file-component img_path="{{asset('storage/'.Auth::user()->image_puth)}}" alt="問題画像"/>
                                        </div>
                                        <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
                                    </div>

                                    <!-- 自己紹介 -->
                                    <div class="mb-4">
                                        <label for="profile_profile" class="form-label">
                                            自己紹介
                                        </label>
                                        <textarea class="form-control" name="profile" id="profile_profile" rows="6"
                                        placeholder="自己紹介の文章を入力しましょう！">{{Auth::user()->profile}}</textarea>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success btn-sm">更新</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                        <div class="mb-5">


                            <h5>アカウント情報の変更</h5>
                            <div class="card card-body  border-2">
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
                                            <button type="submit" class="btn btn-success btn-sm">変更</button>

                                        </div>
                                    </div>
                                </form>
                                <div class="">
                                    <a href="{{route('user_auth.reset_pass_form')}}" class="text-success">パスワードの変更はこちら</a>
                                </div>
                            </div>


                        </div>
                        <div class="mb-5">


                            <h5>退会の手続き</h5>
                            <div class="card card-body  border-2">
                                <p>
                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUserDestory" aria-expanded="false" aria-controls="collapseUserDestory">
                                      退会
                                    </button>
                                </p>
                                <div class="collapse" id="collapseUserDestory">
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
    </section>
@endsection


