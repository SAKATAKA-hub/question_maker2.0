@extends('layouts.base')


<!----- title ----->
@section('title','タイトル')

<!----- breadcrumb ----->
@section('breadcrumb')
<nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#">
            <i class="bi bi-house-door-fill"></i> Home
        </a></li>
        <li class="breadcrumb-item" aria-current="page">
            タイトル
        </li>
    </ol>
</nav>
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
<div class="container-1200">
    <h2 class="text-secondary fw-bold mb-3">
        タイトル
    </h2>
</div>

@endsection
