@extends('layouts.base')


<!----- title ----->
@section('title','お問い合わせ')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ 'お問い合わせ' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
<meta name="route_post_api"  content="{{route('contact.post.api')}}">
<meta name="route_privacy_policy"  content="{{ route('footer_menu.privacy_policy') }}">
<meta name="route_home"            content="{{ route('home') }}">
@endsection


<!----- style ----->
@section('style')
<style>
    main{ background-color: rgb(20, 207, 160,.1); }
</style>
@endsection


<!----- script ----->
@section('script')
<!-- フォームのページ離脱防止アラート -->
{{-- <script src="{{asset('js/page_exit_prevention_alert.js')}}"></script> --}}
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-600 py-5">

        <div class="callout callout-success mb-5">
            <h5 class="text-center">お問い合わせ</h5>
            <strong class="text-success">{{env('APP_NAME')}}</strong>のサービズについて、ご意見・ご感想・改善のご指摘など、お気づきの点がございましたら、下記フォームよりお気軽にお問い合わせください。
        </div>

        <contact-form-component></contact-form-componentt>

    </div>
</section>

@endsection
