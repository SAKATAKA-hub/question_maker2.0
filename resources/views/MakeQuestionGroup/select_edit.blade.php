@extends('layouts.base')


<!----- title ----->
@section('title','問題集の修正')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成した問題集
</a></li>
<li class="breadcrumb-item" aria-current="page">
   問題集の修正
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<style>
/* アコーディオン */
.accordion-button:focus {
    box-shadow: none;
}
.accordion-button:not(.collapsed) {
    color: #6C757D;
    background-color:rgba(92, 240, 203, 0.5);
    /* border-color: #14CFA0 !important; */
}
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
{{-- <section>
    <div class="container-1200-my-5">




        <div class="callout callout-success mb-5">
            <h5>問題集に載せる問題を作成しましょう！</h5>
            <p>
                <strong>問題の追加</strong>から、問題を沢山追加しましょう。<br>
                <strong>公開設定の変更</strong>は、<strong>基本情報の修正</strong>から変更できます。
            </p>
        </div>

        修正
    </div>
</section> --}}
<section>
    <div class="container-1200 my-5">
        <div class="d-md-flex">

            <!-- サイドコンテンツ[pc] -->
            <div class="d-none d-md-block  pe-3" style="width:300px;">
                @include('_parts.user_info')
            </div>


            <!-- 中央コンテンツ -->
            <div class="flex-fill">


                <div class="mb-5 border-bottom border-2 border-success">
                    <!-- 更新日 -->
                    <div class="mb-2">更新日{{ \Carbon\Carbon::parse($question_group->updated_at)->format('Y-m-d') }}</div>

                    <!-- タイトル -->
                    <div class="text-success fw-bold" style="font-size:.6rem">問題集のタイトル：</div>
                    <h3>
                        {{-- <small class="text-success">問題集のタイトル：</small> --}}
                        {{ $question_group->title }}
                    </h3>

                </div>
                <!-- [ 公開設定 ] -->
                <div class="mb-3">

                    <div class="accordion" id="publicSettingAcco">
                        <div class="accordion-item border border-success">
                            <h2 class="accordion-header" id="publicSettingAccoHeadingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#publicSettingAccoOne" aria-expanded="false" aria-controls="publicSettingAccoOne">
                                    <div class="d-flex">

                                        <h5 class="mb-0">公開設定</h5>

                                        <div class="ms-3">
                                            <!-- 公開設定 -->
                                            @if ( $question_group->published_at )
                                            <span class="badge badge-primary"  style="border-radius:.8rem;"
                                            >公開中</span>
                                            @else
                                            <span class="badge badge-secondary" style="border-radius:.8rem;"
                                            >非公開</span>
                                            @endif
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="publicSettingAccoOne" class="accordion-collapse collapse" aria-labelledby="publicSettingAccoHeadingOne" data-bs-parent="#publicSettingAcco">
                                <div class="accordion-body  bg-white">


                                    <form action="{{route('make_question_group.update_published', $question_group)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <label for="publishedType1" class="card card-body mb-3">
                                            <div class="form-check w-100">
                                                <input name="is_public" value="1" type="radio" id="publishedType1" class="form-check-input"
                                                {{ $question_group->published_at ? 'checked' : ''}}
                                                >
                                                <h5 class="mb-0">公開</h5>
                                            </div>
                                            <p class="ms-4">
                                                『いいね』で評価をもらったり、『コメント』機能で感想をもらったり、全国のユーザーに問題を解いてもらおう！
                                            </p>
                                        </label>
                                        {{-- <label for="publishedType2" class="card card-body mb-3">
                                            <div class="form-check w-100">
                                                <input name="is_public" value="2" type="radio" id="publishedType2" class="form-check-input"
                                                {{ !$question_group->published_at && $question_group->limited_published ? 'checked' : ''}}
                                                >
                                                <h5>限定公開</h5>
                                            </div>
                                            <p class="ms-4">
                                                問題集の一覧や検索では表示されないよ！<br>
                                                公開用URLを発行し、URLを教えた友達だけに自分の問題にチャレンジしてもらうことができるよ！
                                            </p>

                                        </label> --}}
                                        <label for="publishedType3" class="card card-body mb-3">
                                            <div class="form-check w-100">
                                                <input name="is_public" value="0" type="radio" id="publishedType3" class="form-check-input"
                                                {{ !$question_group->published_at ? 'checked' : ''}}
                                                >
                                                <h5>非公開</h5>
                                            </div>
                                            <p class="ms-4">
                                                問題集の一覧や検索では表示されないよ！<br>
                                                作成中の問題を一時保存したり、個人的に問題を解いて楽しもう！<br>
                                                公開URLを使えば、URLを教えた友達だけに自分の問題にチャレンジしてもらうこともできるよ！
                                            </p>

                                        </label>
                                        <div class="mb-3">
                                            <button class="btn btn-primary rounded-pill" type="submit"
                                            >公開設定の更新</button>
                                        </div>
                                    </form>


                                    {{-- <div class="form-group mb-4 card card-body border-success">
                                        <label class="form-check-label fs-5 mb-2 fw-bold">公開設定</label>
                                        <div class="ms-3 d-flex gap-3">

                                            <div class="form-check">
                                                <input name="is_public" value="true" type="radio" class="form-check-input" id="exampleCheck1"
                                                {{ isset($question_group) && !$question_group->published_at ? '' : 'checked'}}
                                                >
                                                <label class="form-check-label fw-bold" for="exampleCheck1">公開</label>
                                            </div>
                                            <div class="form-check">
                                                <input name="is_public" value="" type="radio" class="form-check-input" id="exampleCheck2"
                                                {{ isset($question_group) && !$question_group->published_at ? 'checked' : ''}}
                                                >
                                                <label class="form-check-label fw-bold" for="exampleCheck2">非公開</label>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- [ 基本情報 ] -->
                <div class="mb-3">

                    <div class="accordion" id="questionGroupAcco">
                        <div class="accordion-item border border-success">
                            <h2 class="accordion-header" id="questionGroupAccoHeadingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questionGroupAccoOne" aria-expanded="false" aria-controls="questionGroupAccoOne">
                                    <h5 class="mb-0">基本情報</h5>
                                </button>
                            </h2>
                            <div id="questionGroupAccoOne" class="accordion-collapse collapse" aria-labelledby="questionGroupAccoHeadingOne" data-bs-parent="#questionGroupAcco">
                                <div class="accordion-body  bg-white">


                                    <!-- タイトル -->
                                    <div class="form-group mb-3">
                                        <label for="title_input" class="form-check-label fw-bold">問題集のタイトル</label>

                                        <input type="text" name="title" class="form-control bg-white" disabled
                                        value="{{ $question_group->title }}">
                                    </div>

                                    <div class="d-md-flex">
                                        <div class="col-md-4 pe-md-3">

                                            <label for="title_input" class="form-check-label fw-bold">サムネ画像</label>

                                            <!-- サムネ画像 -->
                                            <div class="ratio ratio-16x9 border border-light" style="
                                                background: no-repeat center center / cover;
                                                background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                                                border-radius: .5rem;
                                            "></div>


                                        </div>
                                        <div class="col-md-8">


                                            <!-- 制限時間 -->
                                            <div class="form-group mb-3">
                                                <label for="title_input" class="form-check-label fw-bold">制限時間</label>

                                                <input type="text" class="form-control bg-white" disabled
                                                value="{{ $question_group->time_limit_text }}">
                                            </div>

                                            <!-- タグ -->
                                            <div class="form-group mb-3">
                                                <label for="title_input" class="form-check-label fw-bold">タグ</label>

                                                <input type="text" class="form-control bg-white" disabled
                                                value="{{ $question_group->tags }}">
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 説明文 -->
                                    <div class="form-group mb-3">
                                        <label for="title_input" class="form-check-label fw-bold">説明文</label>

                                        <textarea class="form-control bg-white" rows="6" disabled>{{ $question_group->resume_text }}</textarea>
                                    </div>



                                    <div class="mb-3">
                                        <a href="{{route('make_question_group.edit',$question_group)}}" class="btn btn-success rounded-pill"
                                        >修正</a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- [ 問題 ] -->
                <div class="mb-3">

                    <div class="accordion" id="questionsAcco">
                        <div class="accordion-item border border-success">
                            <h2 class="accordion-header" id="questionsAccoHeadingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#questionsAccoOne" aria-expanded="true" aria-controls="questionsAccoOne">
                                    <h5 class="mb-0">問題</h5>
                                </button>
                            </h2>
                            <div id="questionsAccoOne" class="accordion-collapse collapse show" aria-labelledby="questionsAccoHeadingOne" data-bs-parent="#questionsAcco">
                                <div class="accordion-body  bg-white">


                                    @foreach ($question_group->questions as $key => $question)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h2 class="text-secondary fw-bold">
                                                問題 {{sprintf('%02d', $question->order )}}
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
                                                    <div class="my-3 p-2 bg-light">
                                                        {!! nl2br( e( $question->text_text ) )  !!}
                                                    </div>

                                                    <!-- 正解 -->
                                                    <div class="mb-3">
                                                        <div class="mb-2" style="font-size:.6rem">
                                                            解答方法：
                                                            {{ $question->answer_type == 0 ? '文章で答えを入力する' :
                                                            (  $question->answer_type == 1 ? 'ひとつの答えを選ぶ' : '複数の答えを選ぶ'  ) }}
                                                        </div>
                                                        @foreach ($question->question_options as $option)
                                                            <div class="row mb-2 pe-3">
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
                                            <div class="my-3">
                                                <a href="{{route('make_question.edit',$question)}}"    class="btn btn-info rounded-pill" style="text-decoration:none;"
                                                >修正</a>
                                                <a href="#" class="btn btn-outline-danger  rounded-pill" style="text-decoration:none;"
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
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>


    </div>


    <!-- 問題追加ボタン -->
    <div  id="addQuestion">
        <div class="container-1200">

            <a href="{{route('make_question.create',$question_group)}}" class="d-block text-decoration-none  mx-3 float-end">

                <div class="bg-info d-flex flex-column justify-content-center align-items-center shadow-lg position-relative"
                style="width:90px; height:90px; border-radius:50%;">

                    <div class="text-white pb-4" style="font-size:4rem;">
                        <i class="bi bi-plus"></i>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x
                    text-white text-center w-100" style="bottom: 1rem;">問題の追加</div>

                </div>
            </a>

        </div>
    </div>


</section>
@endsection
