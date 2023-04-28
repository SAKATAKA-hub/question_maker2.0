@extends('layouts.base_02col')


<!----- title ----->
@section('title', '受検成績' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '受検成績' }}
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


<!----- side_contents ----->
@section('side_contents')

    @include('_parts.user_info')

@endsection


<!----- contents ----->
@section('contents')
    <section class="">

        <div class="card card-body border-success text-secondary mb-5">
            <span class="text-success">{{Auth::user()->name}}さんの受検成績</span>
            <div class="d-lg-flex gap-3">
                <div class="col-auto">
                    <span class="fs-5 fw-bold">受検回数</span>
                    <span class="fs-5 ms-1">{{ count( Auth::user()->answer_groups ) }}</span>
                    <span>件</span>
                </div>

                <div class="">
                    <span class="fs-5 fw-bold">合計受検時間</span>
                    <span class="fs-5 ms-1">{{Auth::user()->answer_groups_total_time}}</span>
                </div>
            </div>

        </div>

        @forelse ( $answer_groups as $key => $answer_group)
            @php $question_group = $answer_group->question_group; @endphp
            @php $param = [ 'answer_group'=>$answer_group, 'key'=>$answer_group->user->key ]; @endphp
            <a href="{{route('results.detail', $param )}}"
            class="card card-body border-0 shadow-sm mb-3 text-dark text-decoration-none list-group-item-action">

                <div class="row align-items-center">
                    <!-- サムネイルmobile -->
                    <div class="col-auto  d-md-none">
                        <div class="card-image border border-light" style="
                            background:url({{ asset('storage/'.$question_group->image_puth) }});
                            background-repeat  : no-repeat;
                            background-size    : cover;
                            background-position: center center;
                            width: 3rem; height: 3rem; border-radius: .5rem;
                        "></div>
                    </div>
                    <!-- サムネイルpc -->
                    <div class="col-auto  d-none d-md-block">
                        <div class="card-image border border-light" style="
                            background:url({{ asset('storage/'.$question_group->image_puth) }});
                            background-repeat  : no-repeat;
                            background-size    : cover;
                            background-position: center center;
                            width: 4rem; height: 4rem; border-radius: .5rem;
                        "></div>
                    </div>


                    <!-- タイトルリンク -->
                    <div class="col text-truncate">
                        <div>
                            受験日{{ \Carbon\Carbon::parse($answer_group->created_at)->format('Y-m-d') }}
                        </div>
                        {{-- <span class="fs-3">{{ $question_group->title }}</span> --}}
                        @php $title = mb_strlen($question_group->title ) > 16 ? mb_substr($question_group->title,0,16).'...' : $question_group->title; @endphp
                        <span class="d-md-none fs-6">{{ $title }}</span>
                        @php $title = mb_strlen($question_group->title ) > 24 ? mb_substr($question_group->title,0,24).'...' : $question_group->title; @endphp
                        <span class="d-none d-md-inline fs-3">{{ $title }}</span>
                    </div>
                    <!-- 成績 -->
                    <div class="col-auto d-none d-sm-block">
                        <div class="d-flex justify-content-between align-items-end">
                                <span class="">正解率</span>
                                <span class="">
                                    <strong class="fs-3 text-success">{{ $answer_group->score.'％'}}</strong>
                                </span>
                        </div>
                        <div class="">
                            解答時間 {{$answer_group->elapsed_time}}
                        </div>
                    </div>

                </div>

            </a>
        @empty
            <div class="h2 text-secondary text-center py-5">
                受検した問題集はありません。
            </div>
        @endforelse


        <!-- ページネーション -->
        <div class="mx-5 d-flex justify-content-center">
            {{ $answer_groups->links('vendor.pagination.bootstrap-4') }}
        </div>

    </section>
@endsection


