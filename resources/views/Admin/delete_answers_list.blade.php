@extends('layouts.base')


<!----- title ----->
@section('title','お問い合わせ一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item" aria-current="page">
    削除リスト
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

        <form action="{{route('admin.delete_answers_list.destory')}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="hidden" name="question_group_id" value="{{$question_group->id}}">

            @foreach ($answer_groups as $answer_group)
                <div class="card d-flex">
                    <div class="">
                        <input class="form-check-input" type="checkbox" name="answer_group_ids[]" value="{{$answer_group->id}}" checked>
                        {{$answer_group->id}}
                    </div>
                    <div class="">{{$answer_group->question_group->title}}</div>
                    <div class="">{{$answer_group->user->name}}</div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-danger">削除</button>
        </form>


    </div>
</section>

@endsection
