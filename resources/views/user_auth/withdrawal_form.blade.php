@extends('layouts.user_auth_base')


<!----- title ----->
@section('title','退会アンケート')


<!----- meta ----->
@section('meta')
@endsection



<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
<!-- フォームのページ離脱防止アラート -->
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')

<form action="{{route('user_auth.destroy')}}" method="POST" onsubmit="stopOnbeforeunload()">
    @csrf
    @method('DELETE')

    <div class="card card-body border-success mb-5">
        <h5 class="mb-4">
            これまで”<strong class="text-success">{{env('APP_NAME')}}</strong>”のサービスをご利用<br class="d-sm-none">
            いただき、<br class="d-none d-sm-inline">ありがとうございました。
        </h5>
        <p>
            ご利用者様へのサービス向上を目的にアンケートの記入のお願いをしています。<br>
            下の入力フォームより、私たちが提供するサービス”<strong class="text-success">{{env('APP_NAME')}}</strong>”
            をご利用した際のご意見・ご感想などありましたら、お送りください。
        </p>
    </div>
    <!-- 本文 -->
    <div class="mb-3">
        <label for="body" class="form-label">ご意見・ご感想</label>
        <textarea class="form-control" name="body" id="body" rows="6"
        placeholder="サービス向上のため、ご意見・ご感想をお聞かせください。"></textarea>
    </div>

    <button type="submit" class="btn btn-outline-success">退会の確定</button>
</form>


@endsection
