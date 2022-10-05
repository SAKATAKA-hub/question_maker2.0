@extends('layouts.base')


<!----- title ----->
@section('title')
    @if ( empty($question) )
    問題の新規登録
    @else
    問題の編集
    @endif
@endsection


<!----- breadcrumb ----->
@section('breadcrumb')
{{-- <li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成問題集リスト
</a></li> --}}
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成した問題集
</a></li>
<li class="breadcrumb-item"><a href="{{ route('make_question_group.select_edit', $question_group ) }}" class="text-success">
    {{'『'.$question_group->title.'』の編集'}}
</a></li>

<li class="breadcrumb-item" aria-current="page">
    @if ( empty($question) )
    問題の新規登録
    @else
    問題の編集
    @endif
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
<!-- フォームのページ離脱防止アラート -->
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200 pt-5">
        @if ( empty($question) ){{-- 新規作成 --}}
        <form action="{{ route('make_question.store', $question_group ) }}"
        method="POST" enctype="multipart/form-data" onsubmit="stopOnbeforeunload()">
            @csrf

        @else{{-- 更新 --}}
        <form action="{{ route('make_question.update', $question ) }}"
        method="POST" enctype="multipart/form-data" onsubmit="stopOnbeforeunload()">
            @csrf
            @method('PATCH')

        @endif


            @if ( $question_group->questions->count() == 0 )
                <!-- 最初の問題作成時の表示 -->
                <div class="card  shadow border-success border-2 mb-5">
                    <div class="card-header bg-success text-white d-md-flex">
                        <h5 class="mb-0 card-title">『問題』を登録しよう！</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-secondary">
                            『ひとつの答えを選ぶ』、『複数の答えを選ぶ』、『テキストで答えを入力する』の三種類から解答方法を選択して、問題をつくろう。
                        </p>
                    </div>
                </div>
            @endif


            <div class="card mb-5 card-body border-0 shadow">
                <!-- 出題順 -->
                <div class="form-group mb-4 card card-body border-info">
                    <label for="order_input" class="form-check-label fs-5 mb-2 fw-bold"
                    >出題の順番</label>
                    <select name="order" class="form-select" id="order_input">
                        @php
                            $count = $question_group->questions->count(); //更新前の問題数
                            $count = empty($question) ?/*新規作成*/ $count +1 :/*更新*/ $count;
                        @endphp
                        @for ($i = 1; $i <= $count; $i++)

                            @if ( empty($question) ){{-- 新規作成 --}}
                                <option value="{{ $i }}"
                                @if ($i == $count) selected @endif
                                >{{ $i }}問目</option>

                            @else{{-- 更新 --}}
                                <option value="{{ $i }}"
                                @if ( $i == $question->order ) selected @endif
                                >{{ $i }}問目</option>
                            @endif

                        @endfor
                    </select>
                </div>


                <!-- 問題文 -->
                <div class="form-group mb-4 card card-body border-info">
                    <label for="text" >
                        <span class="form-check-label fs-5 mb-2 fw-bold">問題文</span>
                        <span class="badge bg-danger" style="transform:translateY(-3px);">必須</span>
                    </label>

                    <textarea name="text" class="form-control" id="text" rows="3" placeholder="問題文を入力してください。"
                    required>@if( isset($question) ) {{$question->text_text}} @endif</textarea>
                </div>



                <!-- 正解と解答方法 -->
                @php
                    $answer_type_num = isset($question) ? $question->answer_type : 1 ;
                    $question_id = isset($question) ? $question->id : null ;
                @endphp
                <div class="form-group mb-4 card card-body border-info">
                    <select-answer-component
                        answer_type_num="{{ $answer_type_num }}"
                        question_id="{{ $question_id }}"
                        token="{{ csrf_token() }}"
                        api_route="{{ route('make_question.question_options_api') }}"
                    ></select-answer-component>
                </div>


                <!-- 問題画像 -->
                <div class="form-group mb-4 card card-body border-info">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >問題画像</label>

                    @php $img_path = isset($question) ? $question->image_puth : 'site/image/no_image.png' ; @endphp
                    <read-image-file-component img_path="{{asset('storage/'.$img_path)}}" alt="問題画像"></read-image-file-component>
                    <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>

                </div>


                <!-- 解説 -->
                <div class="form-group mb-4 card card-body border-success bg-light-success">

                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >解説</label>

                    <p class="callout callout-success">
                        問題集の受検後の成績発表時に、『解説』を表示させることができます。
                    </p>

                    @php $img_path = isset($question) ? $question->commentary_image_puth : 'site/image/no_image2.png' ; @endphp
                    <commentary-input-component
                    img_path="{{asset('storage/'.$img_path)}}"
                    text="{{ isset($question) ? $question->commentary_storage_text : ''}}"
                    ></commentary-input-component>

                </div>



                <!-- 送信ボタン -->
                <div class="mt-5 mb-5">
                    <div class="d-grid gap-2 col-md-4 mx-auto">
                        <button class="btn btn-info btn-lg rounded-pill" type="submit">
                            @if ( empty($question) )
                            問題の新規登録
                            @else
                            問題の更新
                            @endif
                        </button>
                    </div>
                </div>

            </div>
        </form>




    </div>
</section>
@endsection
