@extends('layouts.simple_base')


<!----- title ----->
@section('title','アンケートフォーム 入力')


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
    <!-- form progressbar  -->
    <link href="{{ asset('css/progressbar.css') }}" rel="stylesheet">

    <style>
        .form-check-input:checked {
            background-color: #14CFA0;
            border-color: #14CFA0;
        }
        .form-control:focus, .form-control.focus, .custom-select:focus, .custom-select.focus {
            border-color: #14CFA0;
        }
    </style>
@endsection


<!----- script ----->
@section('script')

@endsection




<!----- contents ----->
@section('contents')
<div class="container-900 mb-5">


    <h3 class="m-3 fw-bold text-center">{{ $survey_group->title }}</h3>


    <!-- ステップバー -->
    <div class="progressbar mb-5">
        <div class="item active">STEP.1<br>入力</div>
        <div class="item">STEP.2<br>確認</div>
        <div class="item">STEP.3<br>完了</div>
    </div>


    <!-- メッセージ -->
    <div class="alert alert-warning text-dark mb-5" role="alert">
        <p class="text-center">
            <strong>アンケートのご協力、ありがとうございます。</strong>
        </p>
        <p>
            このアンケートは、頂いた情報をもとにお客様のご状況やご要望を把握し、お客様にとってよいご縁へとお繋ぎできるよう活用させていただきます。
        </p>
        <p>
            お手数をおかけいたしますが、 是非最後までご入力いただきますよう、ご協力よろしくお願い致します。
        </p>
    </div>


    <!-- アンケートの入力 -->
    <form action="{{route('survey.confirmation', $survey_group )}}" method="POST">
        @csrf

        <!-- アンケート項目 -->
        @foreach ($survey_group->survey_questions as $q_index => $question)


            @switch($question->survey_input_type->input_text)
                @case('文字列')
                    <div class="form_group mb-5">


                        <label class="form-label fw-bold fs-5 mb-3" for="{{ 'input'.$q_index }}">
                            {{ $q_index +1 .'. '.$question->text }}
                            @if ($question->required) <span class="badge bg-danger">必須</span> @endif
                        </label>


                        <input class="form-control" type="text" name="{{ 'question'.$question->id }}" id="{{ 'input'.$q_index }}"
                        @if ($question->placeholder) placeholder="{{ $question->placeholder }}" @endif
                        @if ($question->required) required @endif
                        >


                    </div>
                    @break
                <!-- // ------------------------------------>
                @case('ラジオ')
                    <div class="form_group mb-5">


                        <label class="form-label fw-bold fs-5 mb-3">
                            {{ $q_index +1 .'. '.$question->text }}
                            @if ($question->required) <span class="badge bg-danger">必須</span> @endif
                        </label>


                        <!-- 選択肢 -->
                        <div class="ms-3 me-3">
                            @foreach ($question->items as $i_index => $item)
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="{{ 'question'.$question->id }}"
                                 value="{{ $item->value }}" id="{{ 'input'.$q_index.'radio'. $i_index }}"
                                 @if ($question->required) required @endif
                                >
                                <label class="form-check-label" for="{{ 'input'.$q_index.'radio'. $i_index }}">
                                    {{ $item->value }}
                                </label>
                            </div>
                            @endforeach
                        </div>


                    </div>
                    @break
                <!-- // ------------------------------------>
                @case('チェック')
                    <div class="form_group mb-5">


                        <label class="form-label fw-bold fs-5 mb-3">
                            {{ $q_index +1 .'. '.$question->text }}
                            @if ($question->required) <span class="badge bg-danger">必須</span> @endif
                        </label>

                        <!-- 選択肢 -->
                        <div class="ms-3 me-3">
                            @foreach ($question->items as $i_index => $item)
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="{{ 'question'.$question->id.'[]' }}"
                                 value="{{ $item->value }}" id="{{ 'input'.$q_index.'checkbox'. $i_index }}"
                                 @if ($question->required) required @endif
                                >
                                <label class="form-check-label" for="{{ 'input'.$q_index.'checkbox'. $i_index }}">
                                    {{ $item->value }}
                                </label>
                            </div>
                            @endforeach
                        </div>


                    </div>
                    @break
                <!-- // ------------------------------------>
                @case('セレクト')
                    <div class="form_group mb-5">


                        <label class="form-label fw-bold fs-5 mb-3" for="{{ 'input'.$q_index }}">
                            {{ $q_index +1 .'. '.$question->text }}
                            @if ($question->required) <span class="badge bg-danger">必須</span> @endif
                        </label>


                        <select class="form-select" aria-label="Default select example" id="{{ 'input'.$q_index }}"
                         name="{{ 'question'.$question->id }}"
                         @if ($question->required) required @endif
                        >
                            <option value="">選択してください</option>

                            @foreach ($question->items as $i_index => $item)
                            <option value="{{ $item->value }}">{{ $item->value }}</option>
                            @endforeach
                        </select>


                    </div>
                    @break
                <!-- // ------------------------------------>
                @case('テキスト')
                    <div class="form_group mb-5">
                        <label class="form-label fw-bold fs-5 mb-3" for="{{ 'input'.$q_index }}">
                            {{ $q_index +1 .'. '.$question->text }}
                            @if ($question->required) <span class="badge bg-danger">必須</span> @endif
                        </label>

                        <textarea class="form-control" id="{{ 'input'.$q_index }}"
                        name="{{ 'question'.$question->id }}"
                        style=" @if ($question->input_text) height:15rem; @else height:5rem; @endif "
                        @if ($question->placeholder) placeholder="{{ $question->placeholder }}" @endif
                        @if ($question->required) required @endif
                        >{{ $question->input_text }}</textarea>
                    </div>
                    @break
                <!-- // ------------------------------------>
                @default

            @endswitch
            <!-- end アンケート項目 -->


        @endforeach
        <!-- end アンケート項目 -->


        <!-- 確認ボタン -->
        <div class="form_group mb-5 p-5" style="max-width:500px; margin:0 auto;">
            <button class="btn btn-success btn-lg fs-5 w-100" type="submit">入力内容の確認</button>
        </div>
    </form>


</div>
@endsection
