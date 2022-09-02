@extends('layouts.base')


<!----- title ----->
@section('title', '「'.$question_group->title.'」の受験結果' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    「{{ $question_group->title }}」の受験結果
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token"                  content="{{ csrf_token() }}">
<meta name="question_group_id"           content="{{ $question_group->id }}">
<meta name="route_get_questions_api" content="{{ route('get_questions_api') }}">
<meta name="route_scoring"           content="{{ route('scoring') }}">
@endsection


<!----- style ----->
@section('style')
<style>
    .card{
        text-decoration:none;
    }
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <!-- 受検結果 -->
    <section>
        <div class="container-1200 my-3">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <h5 class="fs-5 mb-0">あなたの受検結果</h5>
                        <div class="col">

                        </div>
                        <div class="col-auto">
                            <div class="d-flex justify-content-between align-items-end"  style="width:10rem;">
                                    <span class="">正解率</span>
                                    <span class="">
                                        <strong class="fs-3">{{$answer_group->score}}</strong>％
                                    </span>
                            </div>
                            <div class="">
                                解答時間 {{$answer_group->elapsed_time}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-bottom-0 overflow-hidden">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-light">#</th>
                            <th scope="col" class="bg-light">問題文</th>
                            <th scope="col">あなたの解答</th>
                            <th scope="col" class="d-none d-md-block"
                            style="min-width:5rem;">添削結果</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $num => $answer)
                        <tr>
                            <th scope="row" class="bg-light">{{ $num + 1 }}</th>

                            <td class="bg-light">
                                <span class="d-inline-block text-truncate d-md-none"
                                style="max-width: 100px;">{{ $questions[$num]->text }}</span>
                                <span class="d-none d-md-inline">{{ $questions[$num]->text }}</span>
                            </td>

                            <td class="" >
                                {{ $answer->text }}

                                <div class="d-md-none">
                                    @if ( $answer->is_correct )
                                        <div class="text-info">
                                            <i class="bi bi-record fs-5"></i><span>正　解</span>
                                        </div>
                                    @else
                                        <div class="text-danger">
                                            <i class="bi bi-x-lg fs-5"></i><span>不正解</span>
                                        </div>
                                    @endif
                                </div>
                            </td>


                            @if ( $answer->is_correct )
                                <th class="d-none d-md-block text-info">
                                    <i class="bi bi-record fs-5"></i><span>正　解</span>
                                </th>
                            @else
                                <th class="d-none d-md-block text-danger">
                                    <i class="bi bi-x-lg fs-5"></i><span>不正解</span>
                                </th>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>



    <section>
        <div class="container-1200 my-3">

            <div class="card card-body mb-3">
                <h5>問題集の作成者情報(仮)</h5>
            </div>

            <div class="card card-body mb-3">
                <h5>問題集の情報(仮)</h5>
                <p>
                    texttexttext
                </p>

                <div class="d-flex align-items-center gap-3">
                    <div>
                        <!-- お気に入りボタン -->
                        @php
                            $user_id = Auth::check() ? Auth::user()->id : '' ;
                        @endphp
                        <keep-question-group-component
                        user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                        keep="{{\App\Models\KeepQuestionGroup::isKeep($user_id, $question_group->id)}}"
                        route="{{route('keep_question_group.api')}}"
                        ></keep-question-group-component>
                    </div>
                    <div>
                        <button class="btn border text-secondary">通 報</button>
                    </div>
                </div>
            </div>

            <!-- コメントリストコンポーネントコンポーネント -->
            <div>
                @php
                    $user_id = Auth::check() ? Auth::user()->id : '' ;
                @endphp
                <comment-component
                route_comment_api="{{        route('comment.api')}}"
                route_comment_destory_api="{{route('comment.destroy.api')}}"
                user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                ></comment-component>
            </div>



        </div>
    </section>


    <!-- 三連メニュー -->
    <section class="mb-5">
        <div class="container-1200 my-3">
            <div class="row gap-3 px-3">
                <div class="col-md h-100 card">
                    <div class="card-body text-center">
                        <h6 class="mb-3">同じ問題に挑戦する</h6>
                        <a href="{{ route('play_question',$question_group) }}" class="btn rounded-pill btn-outline-success mx-auto"
                        >GO!</a>
                    </div>
                </div>
                <div class="col-md h-100 card">
                    <div class="card-body text-center">
                        <h6 class="mb-3">別の問題に挑戦する</h6>
                        <a href="{{ route('questions_search_list') }}" class="btn rounded-pill btn-outline-success mx-auto"
                        >GO!</a>
                    </div>
                </div>
                @if (Auth::check())
                    <div class="col-md h-100 card">
                        <div class="card-body text-center">
                            <h6 class="mb-3">これまでの成績を見る</h6>
                            <a href="{{route('results.list')}}" class="btn rounded-pill btn-outline-success mx-auto"
                            >GO!</a>
                        </div>
                    </div>
                @else
                    <div class="col-md h-100 card">
                        <div class="card-body text-center">
                            <h6 class="mb-3">新しい問題を作る</h6>
                            <a href="{{ route('make_question_group.list') }}" class="btn rounded-pill btn-outline-success mx-auto"
                            >GO!</a>
                        </div>
                    </div>

                @endif

            </div>

        </div>
    </section>
@endsection


