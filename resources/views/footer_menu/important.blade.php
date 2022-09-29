@extends('layouts.base')


<!----- title ----->
@section('title','問題集公開時の注意点')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ '問題集公開時の注意点' }}
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

<!--// セクション１ //-->
<section class="top">
    <!-- 背景 -->
    <div class="top_bg_container">
        <div class="top_bg" style="
            background:url({{ asset('storage/site/image/22636100.jpg') }});
            background-repeat  : repeat;
        "></div>
    </div>


    <div class="container-1200">
        <div class="px-4 py-5 my-5 text-center">
            {{-- <h2 class="display-1 h-1 text-success fw-bold mb-4">{{ env('APP_NAME') }}</h2> --}}
            <div class="col-12 col-md-6 mx-auto  position-relative">
                <h5 class="fw-bold  position-absolute top-0 start-50 translate-middle-x w-100"
                >\オリジナル問題集を自由に作る！/</h5>

                <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="サイトロゴ" class="d-block w-100">
            </div>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">
                    このサイトはオリジナルの<br class="d-md-none">
                    問題集を作って楽しみ、<br>
                    作った問題を公開したり、<br class="d-md-none">
                    誰かが作った問題に挑戦、<br>
                    することができます。

                </small>
                <div class="my-5">
                    <!-- 検索フォーム -->
                    <form action="{{ route('questions_search_list') }}">
                        <div  class="input-group overflow-hidden shadow" style="border-radius:2rem;">
                            <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
                            value="@if ( isset($keywords) ){{  $keywords.' '  }}@endif" placeholder="キーワード" aria-label="SeachKeywords" aria-describedby="basic-addon1">

                            <span class="input-group-text bg-white border-0" id="basic-addon1">
                                <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="mt-5">
                    <a href="{{ route('make_question_group.list') }}" class="btn rounded-pill btn-outline-success btn-lg px-4"
                    >問題を作る</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light-success py-4">
    <div class="container-1200">

        <h3>セクション１</h3>

        <p>
            テキストテキストテキスト
        </p>
        <p>
            テキストテキストテキスト
        </p>
        <p>
            テキストテキストテキスト
        </p>


        <div class="card mb-5">
            <div class="card-body">
                <h5>カードタイトル</h5>
                <p>
                    カードボディー
                </p>
            </div>
        </div>

        {{-- <div class="row mx-3">
            <div class="col-md-6 order-md-2" >
                <img src="{{ asset('storage/site/image/22901978.jpg') }}" class="d-block w-100" alt="人気の問題集">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <p class="fw-bold text-success">
                        Most popular handmade questions
                    </p>
                    <h3>もっとも人気な問題集をピックアップ！</h3>
                    <p class="my-4 text-secondary">
                        もっとも利用されている問題集をピックアップしました。<br>
                        問題を解いて、お気に入りの問題集をフォローしましょう！！
                    </p>
                </div>
            </div>
        </div> --}}

    </div>
</section>

<!--// セクション２ //-->
<section class="bg-white py-4">
    <div class="container-1200">

        <h3>セクション２</h3>

        <p>
            テキストテキストテキスト
        </p>
        <p>
            テキストテキストテキスト
        </p>
        <p>
            テキストテキストテキスト
        </p>


        <div class="card mb-5">
            <div class="card-body">
                <h5>カードタイトル</h5>
                <p>
                    カードボディー
                </p>
            </div>
        </div>

        <div class="row mx-3">
            <div class="col-md-6 order-md-2" >
                <img src="{{ asset('storage/site/image/22901978.jpg') }}" class="d-block w-100" alt="人気の問題集">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <p class="fw-bold text-success">
                        Most popular handmade questions
                    </p>
                    <h3>もっとも人気な問題集をピックアップ！</h3>
                    <p class="my-4 text-secondary">
                        もっとも利用されている問題集をピックアップしました。<br>
                        問題を解いて、お気に入りの問題集をフォローしましょう！！
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection
