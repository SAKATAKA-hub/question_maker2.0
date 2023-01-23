@extends('layouts.base')


<!----- title ----->
@section('title','規約違反報告一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item" aria-current="page">
    規約違反報告一覧
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


        {{-- <contact-list-component
        route_list="{{      route('contact.list.api')}}"
        route_responsed="{{ route('contact.responsed.api')}}"
        rote_destoroy="{{   route('contact.destory.api')}}"
        api_key="{{config('app.api_key')}}"
        ></contact-list-component> --}}

        <violation-report-list-component
        route_list="{{      route('violation_report.list.api')      }}"
        route_responsed="{{ route('violation_report.responsed.api') }}"
        rote_destoroy="{{   route('violation_report.destory.api')   }}"
        api_key="{{config('app.api_key')}}"
        ></violation-report-list-component>

    </div>
</section>

@endsection
