@extends('layouts.base')


<!----- title ----->
@section('title','test ユーザー一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
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
    <div class="container-1200">

        <user-list-component
        api_key="{{config('app.api_key')}}"
        route_user_list="{{route('user.list.api')}}"
        ></user-list-component>

        route_user_list="{{route('user.list.api')}}"

    </div>
</section>

@endsection
