@extends('layouts.base')


<!----- title ----->
@section('title','ユーザーさんの問題集リスト')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    ユーザーさんの問題集リスト
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
<section class="bg-white py-5">

    <div class="container-1200">
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
                        <a href="" class="fs-3" style="text-decoration:none;">{{ $question_group->title }}</a>


                    </div>
                    <!-- 操作ボタン -->
                    <div class="col-auto">
                        <div class="dropdown">
                            <button class="btn btn-link text-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href=""
                                >詳細情報</a></li>
                                <li><a class="dropdown-item" href=""
                                >利用者成績一覧</a></li>
                                <li><a class="dropdown-item" href="{{route('make_question_group.select_edit',$question_group)}}"
                                >編集</a></li>
                                <li><a class="dropdown-item" href="#"
                                data-bs-toggle="modal" data-bs-target="#deleteQuestionGroupModal{{$key}}"
                                >削除</a></li>
                            </ul>
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
    </div>


    <!-- 問題追加ボタン -->
    <div  id="addQuestion" class="text-end">
        <a href="{{route('make_question_group.create')}}"
        class="btn btn-success btn-lg rounded-pill shadow m-3 me-md-5 ">+ 問題集の新規作成</a>
    </div>
</section>
@endsection
