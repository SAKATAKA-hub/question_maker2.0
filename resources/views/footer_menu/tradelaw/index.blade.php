@extends('layouts.base')


<!----- title ----->
@section('title','特定商取引法に基づく表記')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ '特定商取引法に基づく表記' }}
</li>
@endsection





@section('contents')

<section>
    <div class="container-900 bg-white">
        <div class="pb-5">

            <!-- [ 本文 ] -->
            @include('footer_menu.tradelaw.'.$revision_date)

            {{-- <div class="mt-5">
                <a href="{{route('tradelaw','2023-12-01')}}"
                >2023年12月1日制定</a><br>
                <a href="{{route('tradelaw','2024-02-14')}}"
                >2024年02月14日改訂</a><br>
            </div> --}}



        </div>
    </div>
</section>

@endsection

