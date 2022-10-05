@extends('layouts.base')


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


<!----- contents ----->
@section('contents')
    <section>
        <div class="container-1200 my-5">
            <div class="row">

                <!-- サイドコンテンツ[pc] -->
                <div class="d-none d-lg-block" style="width:300px;">
                    @include('_parts.user_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="col">


                    <div class="">

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
                            <div class="card card-body border-0 shadow-sm mb-3">
                                <div class="row align-items-center">
                                    <!-- サムネイル -->
                                    <div class="col-auto  d-none d-sm-block">
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
                                        @php $param = [ 'answer_group'=>$answer_group, 'key'=>Auth::user()->key ]; @endphp
                                        <a href="{{route('results.detail', $param )}}"
                                        class="fs-3 text-success" style="text-decoration:none;">
                                            {{ $question_group->title }}
                                        </a>
                                    </div>
                                    <!-- 成績 -->
                                    <div class="col-auto d-none d-sm-block text-secondary">
                                        <div class="d-flex justify-content-between align-items-end">
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
                        @empty
                            <div class="h2 text-secondary text-center py-5">
                                受検した問題集はありません。
                            </div>
                        @endforelse


                        <!-- ページネーション -->
                        <div class="mx-5 d-flex justify-content-center">
                            {{ $answer_groups->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection


