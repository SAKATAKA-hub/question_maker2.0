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
            <div class="d-md-flex">

                <!-- サイドコンテンツ[pc] -->
                <div class="d-none d-md-block  pe-3" style="width:300px;">
                    @include('_parts.user_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="flex-fill">


                    <div class="">

                        <div class="card card-body border-success text-secondary mb-5">
                            <span class="text-success">{{Auth::user()->name}}さんの受検成績</span>
                            <div class="d-lg-flex gap-3">
                                <div class="col-auto">
                                    <span class="fs-5 fw-bold">受検数</span>
                                    <span class="fs-3 ms-1">{{ count( Auth::user()->answer_groups ) }}</span>
                                    <span>件</span>
                                </div>

                                <div class="">
                                    <span class="fs-5 fw-bold">合計学習時間</span>
                                    <span class="fs-3 ms-1">640時間57分59秒(仮)</span>
                                </div>
                            </div>

                        </div>

                        <ul class="list-group ">
                            @forelse ( $answer_groups as $key => $answer_group)
                            @php $question_group = $answer_group->question_group; @endphp


                            <li class="list-group-item">
                                <div class="row">
                                    <!-- [ left ] -->
                                    <div class="col p-0">
                                        @php $param = [ 'answer_group'=>$answer_group, 'key'=>Auth::user()->key ]; @endphp
                                        <a href="{{route('results.detail', $param )}}"
                                        class="fs-3 btn w-100 d-flex align-items-center">

                                            <div class="card-image" style="
                                                background:url({{ asset('storage/'.$question_group->image_puth) }});
                                                background-repeat  : no-repeat;
                                                background-size    : cover;
                                                background-position: center center;
                                                width: 4rem; height: 4rem; border-radius: .5rem;
                                            "></div>

                                            <span class="ms-3">{{ $question_group->title }}</span>
                                        </a>
                                    </div>

                                    <!-- [ right ] -->
                                    <div class="col-auto text-secondary">
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

                            </li>
                            @empty
                            <li class="list-group-item">
                                <div class="h2 text-secondary text-center">
                                    挑戦した問題集はありません。
                                </div>
                            </li>
                            @endforelse
                        </ul>


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


