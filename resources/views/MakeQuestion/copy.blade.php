@extends('layouts.base')


<!----- title ----->
@section('title','コピー')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成した問題集
</a></li>
<li class="breadcrumb-item"><a href="{{ route('make_question_group.select_edit', $question_group ) }}" class="text-success">
    {{'『'.$question_group->title.'』詳細情報'}}
</a></li>

<li class="breadcrumb-item" aria-current="page">問題のコピー</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection



<!----- contents ----->
@section('contents')
<section class="bg-light" style="min-height:80vh;">
    <div class="container-1200 pt-5">


        <form action="{{route('make_question.copy_post', $question)}}" method="POST">
            @csrf

            <div class="card card-body mb-3">
                <label class="form-check-label fs-5 mb-2 fw-bold"
                >コピーする問題</label>

                @include('MakeQuestionGroup.component.question_discription')
            </div>


            <!-- 問題集選択 -->
            <div class="form-group mb-4 card card-body border-info">
                <label for="order_input" class="form-check-label fs-5 mb-2 fw-bold"
                >コピー先の問題集を指定</label>
                <select name="question_group_id" class="form-select" id="order_input">

                    @foreach ($question_groups as $item)
                        <option value="{{$item->id}}"
                        @if($item->id == $question->id) selected @endif
                        >{{$item->title}}</option>
                    @endforeach

                </select>
            </div>


            <!-- ボタングループ -->
            <div class="my-5">
                <div class="d-grid gap-2 col-md-4 mx-auto">

                    <!-- 登録・更新 -->
                    <button class="btn btn-warning btn-lg rounded-pill fs-5 w-100" type="submit">コピー</button>

                    <!-- 詳細一覧へ戻る -->
                    <a href="{{ route('make_question_group.select_edit', $question_group ) }}"
                    class="btn btn-secondary btn-lg rounded-pill fs-5 w-100">戻る</a>

                </div>
            </div>

        </form>


    </div>
</section>
@endsection
