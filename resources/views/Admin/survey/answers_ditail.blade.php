@extends('layouts.base')


<!----- title ----->
@section('title', $answer_group->title.'解答詳細')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.survey.form_list')}}" class="text-success">
    アンケート一覧
</a></li>
<li class="breadcrumb-item"><a
href="{{route('admin.survey.answer_list',$answer_group->survey_questions_group_id)}}"
class="text-success">
    解答一覧
</a></li>
<li class="breadcrumb-item" aria-current="page">
    詳細
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



    </div>
</section>

@endsection
