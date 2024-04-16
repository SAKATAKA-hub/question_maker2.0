<div class="row">
    <!-- 問題画像 -->
    @if ($question->image)
    <div class="col-md-4 order-md-2">
        <div class="my-3">
            <span class="text-success fw-bold">問題画像</span>
            <div class="w-100  mb-3">
                <div class="ratio ratio-16x9 border" style="
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
                <replace-text-component
                text="{{ $question->text_text }}" replace_url="0"
                ></replace-text-component>

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
                        <div class="col card border-info">
                            <replace-text-component
                            text="{{ $option->answer_text }}" replace_url="0"
                            ></replace-text-component>
                        </div>
                    @else
                        <div class="col-auto">
                            <span class="fw-bold text-secondary">不正解</span>
                        </div>
                        <div class="col card bg-light">
                            <replace-text-component
                            text="{{ $option->answer_text }}" replace_url="0"
                            ></replace-text-component>
                        </div>
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
                <div class="w-100  mb-3">
                    <div class="ratio ratio-16x9 border" style="
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
                    <replace-text-component
                    text="{{ $question->commentary_storage_text }}"
                    ></replace-text-component>
                </div>
            </div>
        </div>
    </div>
@endif
