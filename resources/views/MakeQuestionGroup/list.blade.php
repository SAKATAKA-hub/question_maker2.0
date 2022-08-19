@extends('layouts.base')


<!----- title ----->
@section('title', '作成問題集リスト' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '作成問題集リスト' }}
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


                    <section class="">

                        <ul class="list-group list-group-flush">
                            @forelse ($question_groups as $key => $question_group)
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


                                        <div>
                                            <!-- 公開設定 -->
                                            @if ( $question_group->published_at )
                                            <span class="badge badge-info"  style="border-radius:.8rem; transform: translateY(-0.1rem);"
                                            >公開中</span>
                                            @else
                                            <span class="badge badge-secondary" style="border-radius:.8rem; transform: translateY(-0.1rem);"
                                            >非公開</span>
                                            @endif

                                            <!-- 作成日 -->
                                            <span>作成日{{ \Carbon\Carbon::parse($question_group->created_at)->format('Y-m-d') }}</span>
                                        </div>

                                        <!-- タイトル -->
                                        <a href=""
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight{{ $key }}" aria-controls="offcanvasRight{{ $key }}"
                                        class="fs-3" style="text-decoration:none;">{{ $question_group->title }}</a>


                                    </div>
                                    <!-- メニューボタン -->
                                    <div class="col-auto">
                                        <button class="btn btn-link text-secondary" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight{{ $key }}" aria-controls="offcanvasRight{{ $key }}"
                                        ><i class="bi bi-three-dots-vertical"></i></button>


                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight{{ $key }}" aria-labelledby="offcanvasRight{{ $key }}Label">
                                            <div class="offcanvas-header text-end">
                                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body p-0">
                                                <div class="">
                                                    <!-- サムネ画像 -->
                                                    <div class="card-image" style="
                                                        background:url({{ asset('storage/'.$question_group->image_puth) }});
                                                        background-repeat  : no-repeat;
                                                        background-size    : cover;
                                                        background-position: center center;
                                                        height: 12rem;
                                                    "></div>
                                                    <div class="card-body">
                                                        <h5 class="comment-author">{{ $question_group->title }}</h5>
                                                        @if ($question_group->published_at)
                                                        <div class="">
                                                            公開日時：{{\Carbon\Carbon::parse($question_group->published_at)->format('Y年m月d日 H時i分')}}
                                                        </div>
                                                        @else
                                                        <div class="">公開日時：未公開</div>
                                                        @endif
                                                        <div class="">
                                                            作成日時：{{\Carbon\Carbon::parse($question_group->created_at)->format('Y年m月d日 H時i分')}}
                                                        </div>
                                                        <div class="">
                                                            更新日時：{{\Carbon\Carbon::parse($question_group->updated_at)->format('Y年m月d日 H時i分')}}
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="">
                                                            問題数　：{{$question_group->question_count}}問
                                                        </div>
                                                        <div class="">
                                                            制限時間：{{$question_group->time_limit_text}}
                                                        </div>
                                                        <div class="">
                                                            平均点　：99.9点
                                                        </div>
                                                        <div class="">
                                                            挑戦者数：100人
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        {{$question_group->resume}}
                                                    </div>
                                                </div>
                                                <div class="list-group">
                                                    {{-- <a class="list-group-item list-group-item-action text-secondary"
                                                    href=""
                                                    >問題集情報の編集</a>
                                                    <a class="list-group-item list-group-item-action text-secondary"
                                                    href=""
                                                    >問題集情報の編集</a>
                                                    <a class="list-group-item list-group-item-action text-secondary"
                                                    href=""
                                                    >プレイ</a>
                                                    <a class="list-group-item list-group-item-action text-secondary"
                                                    href="#"
                                                    data-bs-toggle="modal" data-bs-target="#deleteQuestionGroupModal{{$key}}"
                                                    >削除</a> --}}

                                                    <a href="{{ route('make_question_group.edit', $question_group->id ) }}"
                                                    class="list-group-item list-group-item-action">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0">
                                                                <i class="bi bi-journals"></i>
                                                                <span class="ms-3">問題集の基本情報編集</span>
                                                            </p>
                                                            <i class="bi bi-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('make_question_group.select_edit', $question_group->id ) }}"
                                                    class="list-group-item list-group-item-action">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0">
                                                                <i class="bi bi-file-earmark"></i>
                                                                <span class="ms-3">問題の追加・編集</span>
                                                            </p>
                                                            <i class="bi bi-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('play_question', $question_group->id ) }}"
                                                    class="list-group-item list-group-item-action">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0">
                                                                <i class="bi bi-pencil"></i>
                                                                <span class="ms-3">受検する</span>
                                                            </p>
                                                            <i class="bi bi-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#deleteQuestionGroupModal{{$key}}"
                                                    class="list-group-item list-group-item-action">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0">
                                                                <i class="bi bi-trash"></i>
                                                                <span class="ms-3">削除する</span>
                                                            </p>
                                                            <i class="bi bi-chevron-right"></i>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <!-- delete Modal -->
                                <div class="modal fade" id="deleteQuestionGroupModal{{$key}}" tabindex="-1" aria-labelledby="deleteQuestionGroupModal{{$key}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="deleteQuestionGroupModal{{$key}}Label">問題集の削除</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            "{{ $question_group->title }}"を削除します。<br>よろしいですか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" style="text-decoration:none;" class="btn btn-link text-secondary fw-bold" data-bs-dismiss="modal"
                                            >閉じる</button>

                                            <form action="{{route('make_question_group.destroy',$question_group)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="text-decoration:none;" class="btn btn-link text-danger fw-bold"
                                                >削除</button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </li>
                            @empty
                            <li class="list-group-item">
                                <div class="h2 text-secondary text-center">
                                    問題集を作成しましょう！
                                </div>
                            </li>
                            @endforelse
                        </ul>


                        <!-- 問題追加ボタン -->
                        <div  id="addQuestion" class="text-end">
                            <a href="{{route('make_question_group.create')}}"
                            class="btn btn-success btn-lg rounded-pill shadow m-3 me-md-5 ">+ 問題集の新規作成</a>
                        </div>
                    </section>


                </div>
            </div>
        </div>
    </section>
@endsection


