@extends('layouts.base')


<!----- title ----->
@section('title','アンケート新規作成')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.survey.form_list')}}" class="text-success">
    アンケート一覧
</a></li>
<li class="breadcrumb-item" aria-current="page">
    アンケート新規作成
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

        <form action="{{route('admin.survey.store')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">アンケート新規作成</button>
        </form>


    </div>
</section>

@endsection
