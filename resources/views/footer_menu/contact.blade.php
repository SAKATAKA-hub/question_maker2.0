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
<meta name="company_key" content="{{ env('COMPANY_KEY') }}">
<meta name="route_post_api"  content="{{route('contact.post.api')}}">
<meta name="route_privacy_policy"  content="{{ route('footer_menu.privacy_policy') }}">
<meta name="route_home"            content="{{ route('home') }}">
<meta name="route_admin_send_email" content="{{ env('COMPANY_ROUTE_CONTACT_SEND_EMAIL') }}">

@endsection


<!----- style ----->
@section('style')
<style>
    /* main{ background-color: rgb(20, 207, 160,.1); } */
    main{ background: rgba(92, 240, 203, 0.5);}
</style>
@endsection


<!----- script ----->
@section('script')
<!-- フォームのページ離脱防止アラート -->
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-600 py-4">

        <div class="callout callout-success mb-4">
            <h5 class="text-center">お問い合わせ</h5>
            <strong class="text-success">{{env('APP_NAME')}}</strong>のサービズについて、ご意見・ご感想・改善のご指摘など、お気づきの点がございましたら、下記フォームよりお気軽にお問い合わせください。
        </div>

        <contact-form-component></contact-form-component>

    </div>
</section>

@endsection
