@extends('layouts.base')


<!----- title ----->
@section('title', $question_group->title )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ $question_group->title }}
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token"                  content="{{ csrf_token() }}">
<meta name="question_group_id"           content="{{ $question_group->id }}">
<meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
<meta name="route_scoring"           content="{{ route('scoring') }}">

@endsection


<!----- style ----->
@section('style')
<style>
    .card{
        text-decoration:none;
    }
</style>
@endsection


<!----- script ----->
@section('script')
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')
    <section>
        <div class="container-1200 my-5">

            <play-question-component></play-question-component>

        </div>
    </section>
@endsection


