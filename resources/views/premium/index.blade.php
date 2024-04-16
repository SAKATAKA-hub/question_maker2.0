@extends('layouts.base')


<!----- title ----->
@section('title','プレミアムサービス')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ 'プレミアムサービス' }}
</li>
@endsection


<!----- meta ----->
@section('meta') @endsection


<!----- style ----->
@section('style') @endsection


<!----- script ----->
@section('script') @endsection


<!----- contents ----->
@section('contents')
<section class="bg-gradient-blue-green">
    <div class="container-1200 py-3">


        <div class="row mx-">
            <div class="col-md-6 d-flex align-items-center">
                <div class="bg- rounded-3 py-5 p-md-5 text-white w-100 text-center text-md-start">
                    <p class="fw-bold text-warning mb-2 fs-5">
                        Mondai DIY premium service!
                    </p>
                    <h3 class="mb-2 fs-1">プレミアムサービス</h3>
                    <p class="text-light">
                        月額プラン加入で、便利な機能が追加されます。<br>
                        これまで以上に「もんだい」を共有しよう！
                    </p>
                    <h5 class="fs- ">月額500円（税込）</h5>

                    <button class="btn btn-lg rounded-pill btn-warning fw-bold w-100 my-3
                    border-white border-5
                    ">プレミアムサービスを登録する</button>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center" >
                <img src="{{ asset('storage/site/image/sub01.png') }}" class="d-block w-100  anm_scale_01" alt="人気の問題集">
            </div>
        </div>


    </div>
</section>
<section class="bg- py-5">
    <div class="container-1200 py-5 text-center">


        {{-- <h3>利用可能な機能</h3> --}}

    </div>
</section>
@endsection
