@extends('layouts.base')


<!----- title ----->
@section('title')
    @if ( empty($question) )
    問題の新規登録
    @else
    問題の修正
    @endif
@endsection


<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成問題集リスト
</a></li>
<li class="breadcrumb-item" aria-current="page">
    @if ( empty($question) )
    問題の新規登録
    @else
    問題の修正
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


            <div class="card mb-5 card-body shadow">

                <!-- 出題順 -->
                <div class="form-group mb-4">
                    <label for="order_input" class="form-check-label fs-5 mb-2 fw-bold"
                    >出題順</label>
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
                <div class="form-group mb-4">
                    <label for="text" >
                        <span class="form-check-label fs-5 mb-2 fw-bold">問題文</span>
                        <span class="badge bg-danger" style="transform:translateY(-3px);">必須</span>
                    </label>
                    <textarea name="text" class="form-control" id="text" rows="3"
                    maxlength="150" required>@if( isset($question) ) {{$question->text}} @endif</textarea>
                    <div class="form-text">※150文字以内</div>
                </div>



                <!-- 正解と解答方法 -->
                @php
                    $answer_type_num = isset($question) ? $question->answer_type : 1 ;
                    $question_id = isset($question) ? $question->id : null ;
                @endphp
                <select-answer-component
                    answer_type_num="{{ $answer_type_num }}"
                    question_id="{{ $question_id }}"
                    token="{{ csrf_token() }}"
                    api_route="{{ route('make_question.question_options_api') }}"
                ></select-answer-component>



                <!-- 問題画像 -->
                <div class="form-group mb-4">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >問題画像</label>

                    @php $img_path = isset($question) ? $question->image_puth : 'site/image/no_image.png' ; @endphp
                    <read-image-file-component img_path="{{asset('storage/'.$img_path)}}" alt="問題画像"></read-image-file-component>

                    <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
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


        <!-- [ 問題を登録する ] -->
{{--
        <h3 class="text-secondary fw-bold mb-3">
            問題を登録する
        </h3>
        <ul class="p-0">
            <!-- ひとつの答えを選ぶ -->
            <li class="card mb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between  mb-3">
                        <h3 class="text-secondary fw-bold mb-0">01問目</h3>
                        <a href="" class="btn btn-danger btn-sm">削除</a>
                    </div>

                    <!-- 問題文 -->
                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題文</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="form-text">※150文字以内</div>
                    </div>


                    <!-- 回答の種類 -->
                    <div class="mb-3">
                        <label class="form-check-label fs-5 mb-2 fw-bold">回答方法</label>
                        <div class="ms-3 d-flex gap-3">

                            <div class="form-check">
                                <input name="answer_type" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label fw-bold" for="exampleCheck1">ひとつの答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label fw-bold" for="exampleCheck2">複数の答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label fw-bold" for="exampleCheck2">文章で答えを入力する</label>
                            </div>

                        </div>
                    </div>


                    <!-- 回答選択肢 -->
                    <div class="form-group mb-3">
                        <label for="" class="form-check-label fs-5 mb-2 fw-bold"
                        >回答選択肢</label>
                        <div class="row gap-1 ps-4 mb-2">
                            <div class="col-auto form-check mt-2">
                                <input name="ans" value="" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label" for="exampleCheck1">正解</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;" required>
                            </div>
                            <div class="col-auto">
                                <a href="" class="text-danger" style="text-decoration:none;">削除</a>
                            </div>
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                        <div class="row gap-1 ps-4 mb-2">
                            <div class="col-auto form-check mt-2">
                                <input name="ans" value="" type="radio" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">正解</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;" required>
                            </div>
                            <div class="col-auto">
                                <a href="" class="text-danger" style="text-decoration:none;">削除</a>
                            </div>
                        </div>
                        @endfor
                        <div class="ms-2 mt-3">
                            <button type="button" class="btn btn-light border">+ 選択肢の追加</button>
                        </div>

                    </div>

                </div>
            </li>

            <!-- 複数の答えを選ぶ -->
            <li class="card mb-3">
                <div class="card-body">
                    <h3 class="text-secondary fw-bold mb-3"
                    >01問目</h3>

                    <!-- 問題文 -->
                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題文</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="form-text">※150文字以内</div>
                    </div>


                    <!-- 回答の種類 -->
                    <div class="mb-3">
                        <label class="form-check-label fs-5 mb-2 fw-bold">回答方法</label>
                        <div class="ms-3 d-flex gap-3">

                            <div class="form-check">
                                <input name="answer_type" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label fw-bold" for="exampleCheck1">ひとつの答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label fw-bold" for="exampleCheck2">複数の答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label fw-bold" for="exampleCheck2">文章で答えを入力する</label>
                            </div>

                        </div>
                    </div>


                    <!-- 回答選択肢 -->
                    <div class="form-group mb-3">
                        <label for="" class="form-check-label fs-5 mb-2 fw-bold"
                        >回答選択肢</label>
                        @for ($i = 0; $i < 4; $i++)
                        <div class="row gap-3 ps-4 mb-2">
                            <div class="col-auto form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">正解</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;">
                            </div>
                        </div>
                        @endfor
                        <div class="ms-2 mt-3">
                            <button type="button" class="btn btn-light border">+ 選択肢の追加</button>
                        </div>

                    </div>

                </div>
            </li>

            <!-- 複数の答えを選ぶ -->
            <li class="card mb-3">
                <div class="card-body">
                    <h3 class="text-secondary fw-bold mb-3"
                    >01問目</h3>

                    <!-- 問題文 -->
                    <div class="form-group mb-3">
                        <label for="exampleFormControlTextarea1" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題文</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="form-text">※150文字以内</div>
                    </div>


                    <!-- 回答の種類 -->
                    <div class="mb-3">
                        <label class="form-check-label fs-5 mb-2 fw-bold">回答方法</label>
                        <div class="ms-3 d-flex gap-3">

                            <div class="form-check">
                                <input name="answer_type" value="true" type="radio" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label fw-bold" for="exampleCheck1">ひとつの答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label fw-bold" for="exampleCheck2">複数の答えを選ぶ</label>
                            </div>
                            <div class="form-check">
                                <input name="answer_type" value="" type="radio" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label fw-bold" for="exampleCheck2">文章で答えを入力する</label>
                            </div>

                        </div>
                    </div>


                    <!-- 回答選択肢 -->
                    <div class="form-group mb-3">
                        <label for="" class="form-check-label fs-5 mb-2 fw-bold"
                        >正解</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" style="height:2rem;">
                    </div>

                </div>
            </li>

        </ul>

        <div class="mt-3">
            <button type="button" class="btn btn-secondary border">+ 問題の新規登録</button>
        </div>
 --}}


    </div>
</section>
@endsection
