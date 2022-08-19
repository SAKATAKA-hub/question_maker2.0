@extends('layouts.base')


<!----- title ----->
@section('title', '未読コメント' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '未読コメント' }}
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
            <div class="d-md-flex">

                <!-- サイドコンテンツ[pc] -->
                <div class="d-none d-md-block  pe-3" style="width:300px;">
                    @include('_parts.user_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="flex-fill">

                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>
                    <div class="card card-body">
                        hoge
                    </div>








                </div>
            </div>
        </div>
    </section>
@endsection



