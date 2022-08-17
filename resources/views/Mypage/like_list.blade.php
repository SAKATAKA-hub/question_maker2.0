@extends('layouts.base')


<!----- title ----->
@section('title', 'いいね一覧' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ 'いいね一覧' }}
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
        <div class="container-1200 my-5">
            <div class="row">
                <!-- サイドコンテンツ -->
                <div class="d-none d-md-block" style="width:300px;">

                    @include('Mypage.side.creater_user_info')

                </div>
                <!-- 中央コンテンツ -->
                <div class="col">
                    hoge
                </div>
            </div>



        </div>
    </section>
@endsection


