@extends('layouts.base')


<!----- title ----->
@section('title','問題集の編集')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成問題集リスト
</a></li>
<li class="breadcrumb-item" aria-current="page">
   問題集の編集
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200">




        <div class="callout callout-success mb-5">
            <h5>問題集に載せる問題を作成しましょう！</h5>
            <p>
                <strong>問題の追加</strong>から、問題を沢山追加しましょう。<br>
                <strong>公開設定の変更</strong>は、<strong>基本情報の編集</strong>から変更できます。
            </p>
        </div>


    </div>
</section>
<section>
    <div class="container-1200">



        <h3>基本情報</h3>
        <div class="card mb-5">
            <div class="card-body">
                <h3 class="border-bottom border-4 pb-2 mb-3">
                    <!-- 公開設定 -->
                    @if ( $question_group->published_at )
                    <span class="badge badge-info"  style="border-radius:.8rem; transform: translateY(-0.1rem);"
                    >公開中</span>
                    @else
                    <span class="badge badge-secondary" style="border-radius:.8rem; transform: translateY(-0.1rem);"
                    >非公開</span>
                    @endif

                    {{$question_group->title}}
                </h3>
                <div class="row">
                    <div class="col-md-4 order-md-2  mb-3">
                        <div class="card overflow-hidden w-100 h-100">
                            {{-- <img src="{{asset('storage/'.$question_group->image_puth)}}" alt="サムネ画像"> --}}
                            <div class="card-image" style="
                                background:url({{asset('storage/'.$question_group->image_puth)}});
                                background-repeat  : no-repeat;
                                background-size    : cover;
                                background-position: center center;
                                width: 100%; min-height: 16rem;
                            "></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <!-- 日付 -->
                            公開日：{{ $question_group->published_at ?
                            \Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H:i') :
                             '非公開' }}　<br>
                            作成日：{{ \Carbon\Carbon::parse( $question_group->created_at )->format('Y年m月d日 H:i') }}<br>
                            更新日：{{ \Carbon\Carbon::parse( $question_group->max_updated_at )->format('Y年m月d日 H:i') }}

                            <!-- タグ -->
                            @if ($question_group->tags)
                            <div class="d-flex gap-1">
                                @foreach ( explode('　',$question_group->tags) as $tag )
                                <div class="border" style="padding:0 .5rem; font-size:.8rem;">{{ $tag }}</div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="mb-3 ">
                            説明文
                            <div class="card-body border-top border-bottom border-2" style="min-height:8rem;">
                                {!! nl2br( e( $question_group->resume ) )  !!}
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="mb-3">
                    <a href="{{route('make_question_group.edit',$question_group)}}" class="btn btn-warning rounded-pill"
                    >基本情報の編集</a>
                </div>
            </div>
        </div>




    </div>
</section>
<section class="bg-light py-5">
    <div class="container-1200">



        <h3>問題</h3>
        @foreach ($question_group->questions as $key => $question)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="text-secondary fw-bold">
                    問題 {{sprintf('%02d', $question->order )}}
                    {{-- id:{{sprintf('%02d', $question->id )}} --}}
                </h2>

                <div class="row">
                    <!-- 問題画像 -->
                    @if ($question->image)
                    <div class="col-md-4 order-md-2">
                        <div class="card overflow-hidden w-100 mb-3">
                            <img src="{{asset('storage/'.$question->image_puth)}}" alt="サムネ画像">
                        </div>
                    </div>
                    @endif

                    <div class="col-md-8">
                        <!-- 問題文 -->
                        <div class="mt-3 mb-3">
                            {!! nl2br( e( $question->text ) )  !!} <br>
                        </div>

                        <!-- 正解 -->
                        <div class="mb-3">
                            <div class="mb-2" style="font-size:.6rem">
                                解答方法：
                                {{ $question->answer_type == 0 ? '文章で答えを入力する' :
                                (  $question->answer_type == 1 ? 'ひとつの答えを選ぶ' : '複数の答えを選ぶ'  ) }}
                            </div>
                            @foreach ($question->question_options as $option)
                                <div class="row mb-2">
                                    @if ($option->answer_boolean)
                                        <div class="col-auto">
                                            <span class="fw-bold text-success">正　解</span>
                                        </div>
                                        <div class="col card border-success"> {{ $option->answer_text }}</div>
                                    @else
                                        <div class="col-auto">
                                            <span class="fw-bold">不正解</span>
                                        </div>
                                        <div class="col card bg-light">{{ $option->answer_text }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <a href="{{route('make_question.edit',$question)}}"    class="btn btn-warning rounded-pill" style="text-decoration:none;"
                    >編集</a>
                    <a href="#" class="btn btn-danger  rounded-pill" style="text-decoration:none;"
                    data-bs-toggle="modal" data-bs-target="#deleteQuestionModal{{$key}}"
                    >削除</a>
                </div>
            </div>
        </div>

        <!-- delete Modal -->
        <div class="modal fade" id="deleteQuestionModal{{$key}}" tabindex="-1" aria-labelledby="deleteQuestionModal{{$key}}Label" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteQuestionModal{{$key}}Label">問題の削除</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    問題 {{sprintf('%02d', $question->order )}}を削除します。<br>よろしいですか？
                </div>
                <div class="modal-footer">
                    <button type="button" style="text-decoration:none;" class="btn btn-link text-secondary fw-bold" data-bs-dismiss="modal"
                    >閉じる</button>

                    <form action="{{route('make_question.destroy',$question)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" style="text-decoration:none;" class="btn btn-link text-danger fw-bold"
                        >削除</button>
                    </form>
                </div>
            </div>
            </div>
        </div>

        @endforeach


    </div>

    <!-- 問題追加ボタン -->
    <div  id="addQuestion" class="text-end">
        <a href="{{route('make_question.create', $question_group )}}"
        class="btn btn-info btn-lg rounded-pill shadow m-3 me-md-5 ">+ 問題の追加</a>
    </div>
</section>
@endsection
