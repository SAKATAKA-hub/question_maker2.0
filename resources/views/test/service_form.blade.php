@extends('layouts.base')


<!----- title ----->
@section('title','サービステスト')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"> サービステスト</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200 my-5">

        <div class="card card-body">
            <h5>問題集のお気に入り登録</h5>
            <form action="{{route('keep_question_group.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="1">
                <input type="hidden" name="question_group_id" value="1">
                <input type="hidden" name="keep" value="0">

                <button type="submit" class="btn btn-primary">お気に入り</button>
            </form>
            {{-- <example-component/> --}}
            <keep-question-group-component></keep-question-group-component>



        </div>
        <div class="card card-body">
            <h5>クリエーターユーザーのキープ[フォロー]</h5>
            <form action="{{route('keep_creator_user.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="1">
                <input type="hidden" name="creater_user_id" value="2">
                <input type="hidden" name="keep" value="0">

                <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
            <keep-creator-user-component/>



        </div>
        <div class="card card-body">
            <h5>問題集へのコメント</h5>
            <form action="{{route('comment.post.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="0">
                <input type="hidden" name="question_group_id" value="1">

                <!-- ゲスト 氏名 -->
                <div class="mb-3">
                    <label for="comment_name" class="form-label">
                        氏名<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="text" name="gest_name" class="form-control" id="comment_name"
                    placeholder="山田　太郎" maxlength="50" required>
                </div>
                <!-- ゲスト メールアドレス -->
                <div class="mb-3">
                    <label for="comment_email" class="form-label">
                        メールアドレス<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="email" name="gest_email" class="form-control" id="comment_email"
                    placeholder="yamada@mail.co.jp" maxlength="50" required>
                </div>
                <!-- 本文 -->
                <div class="mb-3">
                    <label for="comment_body" class="form-label">
                        本文<small class="text-danger ms-3">※必須</small>
                    </label>
                    <textarea class="form-control" name="body" id="comment_body" rows="6"
                    placeholder="コメントを入力してください。"required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">投稿</button>
            </form>
            <comment-component/>



        </div>
        <div class="card card-body">
            <h5>規約違反問題集の通報</h5>
            <form action="{{route('violation_report.post.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="0">
                <input type="hidden" name="question_group_id" value="1">

                <!-- ゲスト 氏名 -->
                <div class="mb-3">
                    <label for="violation_report_name" class="form-label">
                        氏名<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="text" name="gest_name" class="form-control" id="violation_report_name"
                    placeholder="山田　太郎" maxlength="50" required>
                </div>
                <!-- ゲスト メールアドレス -->
                <div class="mb-3">
                    <label for="violation_report_email" class="form-label">
                        メールアドレス<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="email" name="gest_email" class="form-control" id="violation_report_email"
                    placeholder="yamada@mail.co.jp" maxlength="50" required>
                </div>
                <!-- 本文 -->
                <div class="mb-3">
                    <label for="violation_report_body" class="form-label">
                        本文<small class="text-danger ms-3">※必須</small>
                    </label>
                    <textarea class="form-control" name="body" id="violation_report_body" rows="6"
                    placeholder="利用規約に反する点を具体的にご入力ください。"required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">通報</button>
            </form>
            <violation-report-component/>



        </div>
        <div class="card card-body">
            <h5>お問い合わせ[投稿]</h5>
            <form action="{{route('contact.post.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="0">
                <input type="hidden" name="question_group_id" value="1">

                <!-- ゲスト 氏名 -->
                <div class="mb-3">
                    <label for="contact_name" class="form-label">
                        氏名<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="text" name="gest_name" class="form-control" id="contact_name"
                    placeholder="山田　太郎" maxlength="50" required>
                </div>
                <!-- ゲスト メールアドレス -->
                <div class="mb-3">
                    <label for="contact_email" class="form-label">
                        メールアドレス<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="email" name="gest_email" class="form-control" id="contact_email"
                    placeholder="yamada@mail.co.jp" maxlength="50" required>
                </div>
                <!-- 本文 -->
                <div class="mb-3">
                    <label for="contact_body" class="form-label">
                        本文<small class="text-danger ms-3">※必須</small>
                    </label>
                    <textarea class="form-control" name="body" id="contact_body" rows="6"
                    placeholder="お問い合わせ内容をご入力ください。"required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">送信</button>
            </form>
            <contact-component/>



        </div>

    </div>
</section>
@endsection
