@extends('layouts.base')


<!----- title ----->
@section('title','問題集カードテスト')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"> 問題集カードテスト</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
@endsection


<!----- style ----->
@section('style')
<style>
    /*問題集カード マウスオーバー*/
    .question_group_card:hover{
        box-shadow: none !important;
    }
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section class="">
    <div class="container-1200 my-5">

        @php
            $user_id = 1;
            $question_groups = \App\Models\QuestionGroup::orderBy('published_at','desc')
            ->where('published_at', '<>', null) //非公開は除く
            ->paginate(10);
        @endphp

        @include('_parts.question_group_card_list')


    </div>
</section>
@endsection
