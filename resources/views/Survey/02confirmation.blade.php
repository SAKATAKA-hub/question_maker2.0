@extends('layouts.simple_base')


<!----- title ----->
@section('title','アンケートフォーム 確認')


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<!-- form progressbar  -->
<link href="{{ asset('css/progressbar.css') }}" rel="stylesheet">
@endsection


<!----- script ----->
@section('script')
<!-- 二重投稿の防止  -->
<script src="{{ asset('js/stopDoubleSubmit.js') }}" defer></script>
@endsection




<!----- contents ----->
@section('contents')
<div class="container-900 mb-5">


    <h3 class="m-3 fw-bold text-center">{{ $survey_group->title }}</h3>


    <!-- ステップバー -->
    <div class="progressbar mb-5">
        <div class="item active">STEP.1<br>入力</div>
        <div class="item active">STEP.2<br>確認</div>
        <div class="item">STEP.3<br>完了</div>
    </div>

    <!-- ご入力内容 -->
    <div class="card w-100 mb-5 overflow-auto" style="max-height:50vh; ">
        <h5 class="card-title p-3 border-bottom bg-light">ご入力内容の確認をお願いします。</h5>


        <div class="card-body">



            {{-- @foreach ($questions as $q_index => $question) --}}
            @foreach ($survey_group->survey_questions as $q_index => $question)
            <div class="mb-3">
                <p class="m-0"><strong> {{ $q_index +1 .'. '.$question->text }}：</strong></p>


                <!-- 入力内容 -->
                @switch($question->survey_input_type->input_text)
                    @case('テキスト')
                        {{-- 改行の反映 --}}
                        <p class="m-0 ms-3">
                            {!! nl2br( e( $question->input ? $question->input : '※未入力' ) ) !!}
                        </p>
                        @break
                    <!-- // -->
                    @case('チェック')
                        {{-- 改行の反映 --}}
                        <p class="m-0 ms-3">
                            {!! nl2br( e( $question->input ? $question->input : '※未入力' ) ) !!}
                        </p>
                        @break
                    <!-- // -->

                    @default
                    <p class="m-0 ms-3">{{ $question->input ? $question->input : '※未入力' }}</p>
                    <!-- // -->
                @endswitch


            </div>
            @endforeach

        </div>
    </div>

    <!-- 送信ボタン -->
    <div class="row form_group mb-5" style="max-width:500px; margin:0 auto;">
        <div class="col-sm-6 p-3">
            <form action="{{ route('survey.completion', $survey_group ) }}" method="POST">
            <fieldset >
                @csrf

                @foreach ( $survey_group->survey_questions as $question)
                <input type="hidden" name="{{ $question->id }}" value="{{ $question->input }}">
                @endforeach


                <button class="btn btn-success btn-lg fs-5 w-100" type="submit"
                onclick="stopDoubleSubmit()"
                >確定</button>

            </fieldset>
            </form>
        </div>
        <div class="col-sm-6 p-3">
            <!-- <a href="input.php" class="btn btn btn-outline-secondary btn-lg fs-5 w-100">戻る</a> -->
            <button class="btn btn-outline-secondary btn-lg fs-5 w-100" type="button"
            onClick="history.back(); return false;"
            >戻る</button>
        </div>
    </div>


</div>
@endsection
