@extends('layouts.base')


<!----- title ----->
@section('title')
CSVファイルから問題集を作成
@endsection


<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成した問題集
</a></li>
<li class="breadcrumb-item" aria-current="page">
    CSVファイルから問題集を作成
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
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-600 pt-5">
        <form action="{{route('make_question_group.read_csv_post')}}"
        method="POST" enctype="multipart/form-data" onsubmit="stopOnbeforeunload()">
            @csrf

            <h3>CSVファイルから問題集を作成</h3>
            <div class="card mb-5 card-body shadow">
                <div class="mb-3">
                    <label for="formFile" class="form-label">問題を登録したCSVファイルを読込んでください。</label>
                    <input class="form-control" name="csv" type="file" id="formFile">
                    <div class="form-text">
                        <a href="{{route('make_question_group.download_csv_file')}}" onclick="stopOnbeforeunload()">問題登録用CSVファイルのダウンロード</a>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-success" type="submit" style="padding:.4rem 1rem">CSV読み込み</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
