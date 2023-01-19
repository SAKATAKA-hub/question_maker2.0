@extends('layouts.base')


<!----- title ----->
@section('title','お知らせメール送信フォーム')

<!----- breadcrumb ----->
@section('breadcrumb')
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

        <form action="{{route('admin.info_mail.send')}}" method="POST">
            @csrf

            <div class="card card-body mb-3">
                <div class="row mb-3">
                    <div class="col-auto" style="width:10rem;">お知らせメール番号</div>
                    <div class="col-auto">
                        <input type="text" class="form-controll"
                        name="mail_num" value="20230123">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-auto" style="width:10rem;">件名</div>
                    <div class="col-auto">
                        <input type="text" class="form-controll"
                        name="subject" value="サービス向上アンケートのお願い">
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <p class="fw-bold mb-1">
                    メールを送信するユーザーを選択
                </p>
                <user-list-component
                api_key="{{config('app.api_key')}}"
                route_user_list="{{route('user.list.api')}}"
                ></user-list-component>
            </div>


            <div class="card card-body">
                <div class="">
                    <button type="submit" class="btn btn-secondary">メール送信</button>
                </div>
            </div>


        </form>


    </div>
</section>

@endsection
