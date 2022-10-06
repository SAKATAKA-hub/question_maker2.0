@extends('layouts.base')


<!----- title ----->
@section('title','サービステスト')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"> サービステスト</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
@endsection


<!----- style ----->
@section('style')
<style>
/*タブメニュー*/
@media screen and (max-width: 576px) {
    .tab-menu{ font-size:11px; }
}
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200 my-5">

        @php
            $user_id =  Auth::check() ? Auth::user()->id : '' ;
            $user_id =  1;




            $question_group_id =1;

            $keep_question_group =
            \App\Models\KeepQuestionGroup
            ::where('user_id',$user_id)
            ->where('question_group_id',$question_group_id)->first();


            $keep_creator_user =
            \App\Models\KeepCreatorUser
            ::where('user_id',$user_id)
            ->where('creater_user_id',1)->first();

        @endphp


        <!-- Please Login Modal -->
        <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
        ></please-login-modal-component>


        <div class="card card-body mb-3">

            <h5>問題集のお気に入り登録</h5>

            <!-- お気に入りボタン -->
            <div class="d-flex align-items-center">
                <keep-question-group-component user_id="{{$user_id}}" question_group_id="{{$question_group_id}}"
                keep="{{ $keep_question_group ? $keep_question_group->keep : '' }}"
                route="{{route('keep_question_group.api')}}"></keep-question-group-component>

                <span class="ms-3">←ログイン済みイイネボタン</span>
            </div>

            <!-- お気に入りボタン ログアウト中 -->
            <div class="d-flex align-items-center">
                <keep-question-group-component user_id="" question_group_id="{{$question_group_id}}" keep=""
                route="{{route('keep_question_group.api')}}"></keep-question-group-component>

                <span class="ms-3">←ログインしていない時のイイネボタン</span>
            </div>


        </div>
        <div class="card card-body">

            <h5>クリエーターユーザーのキープ[フォロー]</h5>

            <!-- フォローボタン -->
            <div class="d-flex align-items-center">
                <keep-creator-user-component user_id="{{$user_id}}" creater_user_id="1"
                keep="{{ $keep_creator_user ? $keep_creator_user->keep : '' }}"
                route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>

                <span class="ms-3">←ログイン済みフォローボタン</span>
            </div>


            <!-- フォローボタン ログアウト中 -->
            <div class="d-flex align-items-center">
                <keep-creator-user-component user_id="" creater_user_id="1" keep=""
                route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>

                <span class="ms-3">←ログインしていない時のフォローボタン</span>
            </div>


        </div>
        <div class="my-3">


            <h5>問題集へのコメント</h5>
            <url-copy-component copy_url="{{ route('home') }}"></url-copy-component>

            <!-- コメントリストコンポーネントコンポーネント -->
            <comment-component
            route_comment_api="{{        route('comment.api')}}"
            route_comment_destory_api="{{route('comment.destroy.api')}}"
            user_id="{{$user_id}}" question_group_id="{{$question_group_id}}"
            ></comment-component>

            <div class="card card-body mt-3">
                <form action="{{route('comment.api')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="1">
                    <input type="hidden" name="question_group_id" value="1">

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

            </div>


        </div>
        <div class="card card-body">


            <h5>規約違反の報告</h5>

            <violation-report-component user_id="{{$user_id}}" question_group_id="{{$question_group_id}}"
            route="{{route('violation_report.post.api')}}"></violation-report-component>


            <violation-report-component user_id="" question_group_id="{{$question_group_id}}"
            route="{{route('violation_report.post.api')}}"></violation-report-component>



            <form action="{{route('violation_report.post.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="0">
                <input type="hidden" name="question_group_id" value="1">

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



        </div>
        <div class="my-3">

            報告リストコンポーネント
            {{-- <violation-report-list-component
            route_list="{{     route('violation_report.list.api')}}"
            route_responsed="{{route('violation_report.responsed.api')}}"
            rote_destoroy="{{  route('violation_report.destory.api')}}"
            app_key="{{env('APP_KEY')}}"
            ></violation-report-list-component> --}}

            route_list: {{     route('violation_report.list.api')}} <br>
            route_responsed: {{route('violation_report.responsed.api')}} <br>
            rote_destoroy: {{  route('violation_report.destory.api')}}

        </div>


        <div class="card card-body">
            <h5>お問い合わせ[投稿]</h5>
            <form action="{{route('contact.post.api')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="0">
                <input type="hidden" name="question_group_id" value="1">

                <!-- 氏名 -->
                <div class="mb-3">
                    <label for="contact_name" class="form-label">
                        氏名<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="text" name="name" class="form-control" id="contact_name"
                    placeholder="山田　太郎" maxlength="50" required>
                </div>
                <!-- メールアドレス -->
                <div class="mb-3">
                    <label for="contact_email" class="form-label">
                        メールアドレス<small class="text-danger ms-3">※必須</small>
                    </label>
                    <input type="email" name="email" class="form-control" id="contact_email"
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
        </div>
        {{-- <div class="my-3">

            <contact-form-component></contact-form-componentt>


        </div> --}}
        <div class="my-3">


            お問い合わせコンポーネント
            <contact-list-component
            route_list="{{     route('contact.list.api')}}"
            route_responsed="{{route('contact.responsed.api')}}"
            rote_destoroy="{{  route('contact.destory.api')}}"
            app_key="{{env('APP_KEY')}}"
            ></contact-list-component>

            route_list: {{     route('contact.list.api')}} <br>
            route_responsed: {{route('contact.responsed.api')}} <br>
            rote_destoroy: {{  route('contact.destory.api')}}

        </div>


        <!-- タブメニュー -->
        <div class="my-5">
            @php $tab_menu='tab01'; @endphp
            <ul class="nav nav-tabs nav-fill" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if( $tab_menu === 'tab01' ) active @endif"
                    id="tab-tab01-tab" data-bs-target="#tab-tab01"
                    aria-controls="tab-tab01" aria-selected="{{ $tab_menu === 'tab01' ? 'true' : 'false' }}"
                    type="button" role="tab" data-bs-toggle="pill"
                    >
                        <span class="tab-menu">基本情報</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if( $tab_menu === 'tab02' ) active @endif"
                    id="tab-tab02-tab" data-bs-target="#tab-tab02"
                    aria-controls="tab-tab02" aria-selected="{{ $tab_menu === 'tab02' ? 'true' : 'false' }}"
                    type="button" role="tab" data-bs-toggle="pill"
                    >
                        <span class="tab-menu">出題問題</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if( $tab_menu === 'tab03' ) active @endif"
                    id="tab-tab03-tab" data-bs-target="#tab-tab03"
                    aria-controls="tab-tab03" aria-selected="{{ $tab_menu === 'tab03' ? 'true' : 'false' }}"
                    type="button" role="tab" data-bs-toggle="pill"
                    >
                        <span class="tab-menu">公開設定</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if( $tab_menu === 'tab04' ) active @endif"
                    id="tab-tab04-tab" data-bs-target="#tab-tab04"
                    aria-controls="tab-tab04" aria-selected="{{ $tab_menu === 'tab04' ? 'true' : 'false' }}"
                    type="button" role="tab" data-bs-toggle="pill"
                    >
                        <span class="tab-menu">コメント</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade @if( $tab_menu === 'tab01' ) show active @endif" role="tabpane0l"
                id="tab-tab01" aria-labelledby="tab-tab01-tab">

                    tab01


                </div>
                <div class="tab-pane fade @if( $tab_menu === 'tab02' ) show active @endif" role="tabpane02"
                id="tab-tab02" aria-labelledby="tab-tab02-tab">

                    tab02
                </div>
                <div class="tab-pane fade @if( $tab_menu === 'tab03' ) show active @endif" role="tabpane03"
                id="tab-tab03" aria-labelledby="tab-tab03-tab">

                    tab03
                </div>
                <div class="tab-pane fade @if( $tab_menu === 'tab04' ) show active @endif" role="tabpane04"
                id="tab-tab04" aria-labelledby="tab-info04-tab">

                    tab04
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
