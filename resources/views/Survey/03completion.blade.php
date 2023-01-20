@extends('layouts.simple_base')


<!----- title ----->
@section('title','アンケートフォーム 完了')


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
    <!-- form progressbar  -->
    <link href="{{ asset('css/progressbar.css') }}" rel="stylesheet">
@endsection


<!----- script ----->
@section('script')

@endsection




<!----- contents ----->
@section('contents')
<div class="container-900 mb-5">


    <h3 class="m-3 fw-hold text-center">アンケートフォーム　完了</h3>


        <!-- ステップバー -->
        <div class="progressbar mb-5">
            <div class="item active">STEP.1<br>入力</div>
            <div class="item active">STEP.2<br>確認</div>
            <div class="item active">STEP.3<br>完了</div>
        </div>


        <!-- ご入力完了 -->
        <div class="card w-100 mb-5">
            <h5 class="card-title p-3 border-bottom bg-light">ご入力内容を送信いたしました。</h5>
            <div class="card-body pb-5">ご協力いただき、ありがとうございました。</div>
        </div>


</div>
@endsection
