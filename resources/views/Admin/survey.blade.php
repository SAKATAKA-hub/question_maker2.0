@extends('layouts.base')


<!----- title ----->
@section('title','アンケート一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item" aria-current="page">
    アンケート一覧
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

        {{-- <ul class="ps-0" style="list-style:none;">
            @foreach ($survey_groups as $survey_group)
            <li class="card mb-3">
                <div class="card-body">
                    <h5 class="mb-3">
                        <strong>{{ $survey_group->title }}</strong>
                    </h5>
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col">
                            <!-- コピーボタン -->
                            @php $params = ['survey_group'=>$survey_group->id,'access_key'=>$survey_group->access_key]; @endphp
                            <url-input-copy-component copy_url="{{ route('survey.input', $params ) }}"></url-input-copy-component>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-outline-secondary"
                            href="javascript:void(0)" onclick="window.open('{{ route('survey.input', $params ) }}','_blank')"
                            >開く</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.survey.answer_list', $survey_group ) }}"
                            >解答一覧</a>
                        </div>

                    </div>
                </div>
            </li>
            @endforeach
        </ul> --}}


        <survey-list-component
        route_list="{{           route('survey.list.api')      }}"
        route_answer_list="{{    route('survey.answer_list.api')      }}"
        route_answer="{{         route('survey.answer.api')      }}"
        route_answer_destory="{{ route('survey.answer.destory.api')      }}"
        api_key="{{config('app.api_key')}}"
        ></survey-list-component>

    </div>
</section>

@endsection
