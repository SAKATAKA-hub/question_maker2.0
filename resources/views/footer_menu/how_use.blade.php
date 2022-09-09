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
    main{ background-color: #F8F9FA !important; }
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200">

        hoge

    </div>
</section>

@endsection
