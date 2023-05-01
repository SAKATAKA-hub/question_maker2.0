@extends('layouts.base')


<!----- title ----->
@section('title','お知らせ')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ 'お知らせ' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<link href="{{ asset('css/privacy_policy.css') }}" rel="stylesheet">
<style>
    main{ background: rgba(92, 240, 203, 0.5);}
</style>
@endsection


<!----- script ----->
@section('script')
<script>
    // reloadメソッドによりページをリロード
    // function doReload() { window.location.reload(true); }
</script>
@endsection


<!----- contents ----->
@section('contents')
@php $news_list = config('news.list'); @endphp
<section>
    <div class="container-600 py-5">

        <div class="list-group list-group-flush">


            @foreach ($news_list as $news)
                <a href="" class="list-group-item bg-transparent border-0"
                data-bs-toggle="modal" data-bs-target="#modal{{$news['blade']}}"
                >
                    <div class="card card-body py-1 border-0">
                        <div class="text-secondary">{{$news['date']}}</div>
                        <span class="text-decoration-none text-dark fw-bold">{{$news['title']}}</span>
                    </div>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="modal{{$news['blade']}}" tabindex="-1" aria-labelledby="modal{{$news['blade']}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-success">
                                <div class="">
                                    <!--[date]-->
                                    <div class="text-success">{{$news['date']}}</div>
                                    <!--[title]-->
                                    <h5 class="modal-title" id="modal{{$news['blade']}}Label">{{$news['title']}}</h5>
                                </div>

                            </div>
                            <div class="modal-body">
                                @include('news.'.$news['blade'])
                            </div>
                            <div class="modal-footer border-0">
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                <button type="button" class="btn btn-sm fw-bold text-secondary" data-bs-dismiss="modal">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
</section>

@endsection
