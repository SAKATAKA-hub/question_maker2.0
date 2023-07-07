@extends('layouts.base')


<!----- title ----->
@section('title','管理者画面')

<!----- breadcrumb ----->
@section('breadcrumb')
{{-- <li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li> --}}
<li class="breadcrumb-item" aria-current="page">
    管理者画面
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
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-600 my-5">

        <div class="list-group">
            <a href="{{(route('admin.user_list'))}}" class="list-group-item list-group-item-action"
            > > 登録ユーザー一覧</a>
            <a href="{{(route('admin.info_mail.form'))}}" class="list-group-item list-group-item-action"
            > > お知らせメール手動送信</a>
            <a href="{{route('admin.survey')}}" class="list-group-item list-group-item-action"
            > > アンケートフォーム一覧</a>
            <a href="{{(route('admin.contact'))}}" class="list-group-item list-group-item-action"
            > > お問い合わせ一覧</a>
            <a href="{{(route('admin.violation_report'))}}" class="list-group-item list-group-item-action"
            > > 規約違反報告一覧</a>

        </div>

    </div>
</section>

@endsection
