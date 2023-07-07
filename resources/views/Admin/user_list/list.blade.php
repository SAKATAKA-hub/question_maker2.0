@extends('layouts.base')


<!----- title ----->
@section('title','登録ユーザー一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item" aria-current="page">
    登録ユーザー一覧
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


        <div class="card mb-3" style="max-height: 50vh; overflow:auto;">
            <table class="table bg-white mb-0" style="min-width:600px;">
                <tbody>
                    <!-- header -->
                    <tr class="bg-light">
                        <th scope="col"></th>
                        <th scope="col">名前</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">入会日</th>
                        <th scope="col">問題作成数</th>
                    </tr>
                    <!-- body -->
                    @foreach ($users as $key => $user)
                        <tr>

                            <!--チェックボックス-->
                            <th scope="row" class="text-warning text-center ">
                                <input value="{{$user->id}}" name="user_ids[]" class="form-check-input m-0" type="checkbox" >
                            </th>
                            <th scope="row">
                                <a href="{{ route('admin.user_list.question_groups', $user) }}">{{$user->name}}</a>
                            </th>
                            <td class="text-start">
                                {{$user->email}}
                            </td>
                            <td class="text-start">
                                {{$user->created_at->format('Y-m-d')}}
                            </td>
                            <td class="text-center">
                                {{ $user->question_groups_count }}
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div><!-- end table card -->




    </div>
</section>

@endsection
