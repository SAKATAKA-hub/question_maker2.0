@extends('layouts.base')


<!----- title ----->
@section('title','『'.$question_group->title.'』の編集')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成した問題集
</a></li>
<li class="breadcrumb-item" aria-current="page">
   {{'『'.$question_group->title.'』の編集'}}
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
<section>
    <div class="container-1200 my-5">
        <div class="row">

            <!-- サイドコンテンツ[pc] -->
            <div class="d-none d-lg-block" style="width:300px;">
                @include('_parts.user_info')
            </div>

            <!-- 中央コンテンツ -->
            <div class="col">


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
                                                {{ $question_group->questions->count() < 1 ? 'disabled' : ''}}
                                                >
                                                <h5 class="mb-0">公開</h5>
                                            </div>
                                            <p>
                                                『いいね』で評価をもらったり、『コメント』機能で感想をもらったり、全国のユーザーに問題を解いてもらおう！<br>
                                                <small>※問題が1問以上登録されていない場合、自動的に非公開となります。</small>
                                            </p>
                                        </label>
                                        <label for="publishedType3" class="card card-body mb-3">
                                            <div class="form-check w-100">
                                                <input name="is_public" value="0" type="radio" id="publishedType3" class="form-check-input"
                                                {{ !$question_group->published_at ? 'checked' : ''}}
                                                >
                                                <h5>非公開</h5>
                                            </div>
                                            <p>
                                                問題集の一覧や検索では表示されないよ！<br>
                                                作成中の問題を一時保存したり、個人的に問題を解いて楽しもう！<br>
                                                公開設定が『非公開』のときでも、受検用URLを教えた友達だけに自分の問題集にチャレンジしてもらうことができるよ！
                                            </p>
                                            <!-- URLコピー -->
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge rounded-pill bg-success me-1">
                                                        <i class="bi bi-link-45deg"></i>
                                                    </span>
                                                    問題集のURLを友達に送ろう！
                                                </div>
                                                @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                                                <url-copy-component copy_url="{{ route('play_question', $param ) }}"></url-copy-component>
                                            </div>
                                        </label>

                                        <div class="my-3">
                                            <button class="btn btn-primary rounded-pill" type="submit"
                                            >公開設定の更新</button>
                                        </div>
                                    </form>



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
                                        >編集</a>
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
                                    <div class="d-flex align-items-center">
                                        <h5 class="mb-0">問題</h5>
                                        <div>（全{{$question_group->question_count}}問）</div>
                                    </div>
                                </button>
                            </h2>
                            <div id="questionsAccoOne" class="accordion-collapse collapse show" aria-labelledby="questionsAccoHeadingOne" data-bs-parent="#questionsAcco">
                                <div class="accordion-body  bg-white">


                                    @forelse ($question_group->questions as $key => $question)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h2 class="text-secondary fw-bold">
                                                問題 {{sprintf('%02d', $question->order )}}
                                            </h2>

                                            <div class="row">
                                                <!-- 問題画像 -->
                                                @if ($question->image)
                                                <div class="col-md-4 order-md-2">
                                                    <div class="my-3">
                                                        <span class="text-success fw-bold">問題画像</span>
                                                        <div class="card w-100  mb-3">
                                                            <div class="ratio ratio-16x9 border border-light" style="
                                                                background: no-repeat center center / cover;
                                                                background-image:url({{asset('storage/'.$question->image_puth)}});
                                                                border-radius: .5rem;
                                                            "></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                <div class="col-md-8">
                                                    <!-- 問題文 -->
                                                    <div class="my-3">
                                                        <span class="text-success fw-bold">問題文</span>
                                                        <div class="p-2 bg-light">
                                                            {!! nl2br( e( $question->text_text ) )  !!}
                                                        </div>
                                                    </div>

                                                    <!-- 正解 -->
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <span class="text-success fw-bold me-5">正解</span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="mb-2 text-secondary">
                                                                    解答方法：
                                                                    {{ $question->answer_type == 0 ? '文章で答えを入力する' :
                                                                    (  $question->answer_type == 1 ? 'ひとつの答えを選ぶ' : '複数の答えを選ぶ'  ) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($question->question_options as $option)
                                                            <div class="row mb-2 pe-3">
                                                                @if ($option->answer_boolean)
                                                                    <div class="col-auto">
                                                                        <span class="fw-bold text-info">正　解</span>
                                                                    </div>
                                                                    <div class="col card border-info"> {{ $option->answer_text }}</div>
                                                                @else
                                                                    <div class="col-auto">
                                                                        <span class="fw-bold text-secondary">不正解</span>
                                                                    </div>
                                                                    <div class="col card bg-light">{{ $option->answer_text }}</div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>


                                            <!-- 解説 -->
                                            @if($question->commentary_text )

                                                <div class="divider divider-dashed my-3"></div>
                                                <div class="row">

                                                    <!-- 解説画像 -->
                                                    @if ($question->commentary_image)
                                                    <div class="col-md-4 order-md-2">
                                                        <div class="my-3">
                                                            <span class="text-warning fw-bold">解説画像</span>
                                                            <div class="card w-100  mb-3">
                                                                <div class="ratio ratio-16x9 border border-light" style="
                                                                    background: no-repeat center center / cover;
                                                                    background-image:url({{asset('storage/'.$question->commentary_image_puth)}});
                                                                    border-radius: .5rem;
                                                                "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="col-md-8">
                                                        <!-- 解説文 -->
                                                        <div class="my-3">
                                                            <span class="text-warning fw-bold">解説文</span>
                                                            <div class="p-2 bg-light">
                                                                {!! nl2br( e( $question->commentary_storage_text ) )  !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif

                                            <div class="my-3">
                                                <a href="{{route('make_question.edit',$question)}}"    class="btn btn-info rounded-pill" style="text-decoration:none;"
                                                >編集</a>
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
                                                <strong>問題 {{sprintf('%02d', $question->order )}}</strong>を削除します。<br>
                                                <strong>本当に、削除してもよろしいですか？</strong><br>
                                                ※公開中の問題集の問題数が<strong>"0問"</strong>になると、自動的に公開設定が<strong>”非公開”</strong>となります。<br>

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
                                    @empty
                                        <h3 class="text-secondary text-center">問題はまだ作成されていません</h3>
                                    @endforelse


                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>


    </div>
</section>


<!-- 問題追加ボタン -->
<a id="addQuestion" href="{{route('make_question.create',$question_group)}}" class="d-block text-decoration-none">
    <div class="icon text-white bg-info shadow">
        <i class="bi bi-plus"></i>
    </div>
    <div class="text-secondary text-center w-100">問題の追加</div>
</a>

@endsection
