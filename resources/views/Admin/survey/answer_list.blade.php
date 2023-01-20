@extends('layouts.base')


<!----- title ----->
@section('title', $survey_question_group->title.'解答一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.survey.form_list')}}" class="text-success">
    アンケート一覧
</a></li>
<li class="breadcrumb-item" aria-current="page">
    解答一覧
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


        <div class="card w-100 border-bottom-0 overflow-auto">
            <table class="table table-striped mb-0" style="min-width: 900px">
                {{-- <thead>
                </thead> --}}
                <tbody>
                    <tr>
                        <th scope="col">
                            回答日
                            <!--昇順-->
                            @php $param = [ 'survey_question_group'=>$survey_question_group, 'column_name'=>"date", 'order'=>"desc" ] ; @endphp
                            <a href="{{ route('admin.survey.answer_list', $param ) }}"
                            ><i class="bi bi-caret-up-square-fill text-secondary"></i></a>
                            <!--降順-->
                            @php $param = [ 'survey_question_group'=>$survey_question_group, 'column_name'=>"date", 'order'=>"asc" ] ; @endphp
                            <a href="{{ route('admin.survey.answer_list', $param ) }}"
                            ><i class="bi bi-caret-down-square-fill text-secondary"></i></a>
                        </th>
                        <th scope="col"></th><!-- 詳細 --><!-- 削除 -->
                    </tr>

                    @foreach ($answers_groups as $answers_group)
                    <tr>
                        <td scope="row">{{ \Carbon\Carbon::parse( $answers_group->created_at)->format('Y年m月d日 H:i:s') }}</td>
                        {{-- <th scope="col">{{ $answers_group->title }}</th>
                        <td>{{ $answers_group->respondent }}</td>
                        <td>{{ $answers_group->company }}</td> --}}
                        <td>
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.survey.answer_ditail', $answers_group) }}"
                                class="btn btn-sm btn-outline-secondary"
                                >詳細</a>

                                <a href="#" class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $answers_group->id}}"
                                >削除</a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $answers_group->id}}" tabindex="-1" aria-labelledby="deleteModal{{ $answers_group->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ \Carbon\Carbon::parse( $answers_group->created_at)->format('Y年m月d日 H:i:s') }}のアンケートを削除します。<br>よろしいですか？
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            閉じる
                                        </button>

                                        <form action="{{ route('admin.survey.answer_destroy',$answers_group) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-white">削除</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- end Modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>

@endsection
