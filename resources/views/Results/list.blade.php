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

                        <div class="card mb-5">
                            <div class="card-body">
                                解答した問題数　平均正解率
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            @forelse ( $answer_groups as $key => $answer_group)
                            @php $question_group = $answer_group->question_group @endphp


                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="card-image" style="
                                            background:url({{ asset('storage/'.$question_group->image_puth) }});
                                            background-repeat  : no-repeat;
                                            background-size    : cover;
                                            background-position: center center;
                                            width: 4rem; height: 4rem; border-radius: .5rem;
                                        "></div>
                                    </div>
                                    <div class="col">
                                        <!-- タイトル -->
                                        <a href="{{route('results.detail', $answer_group )}}" class="fs-3" style="text-decoration:none;"
                                        >{{ $question_group->title }}</a>

                                    </div>
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
                                    挑戦した問題はありません。
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


