@extends('layouts.base')


<!----- title ----->
@section('title', 'いいねした問題集' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ 'いいねした問題集' }}
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
                    hoge
                </div>
            </div>
        </div>
    </section>
@endsection


