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
    {{'『'.$question_group->title.'』詳細情報'}}
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
<section class="bg-light">
    <div class="container-1200 pt-5">

        @if ( $question_group->questions->count() == 0 )
            <!-- 最初の問題作成時の表示 -->
            <div class="mb-5">
                <div class="card-header bg-success text-white d-md-flex">
                    <h5 class="mb-0 card-title">『問題』を登録しよう！</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-secondary">
                        『ひとつの答えを選ぶ』、『複数の答えを選ぶ』、『テキストで答えを入力する』の三種類から解答方法を選択してください。
                    </p>
                </div>
            </div>
        @endif



        @php
            $param = ['question_group'=>$question_group, 'tab_menu'=>'tab02'];
            $noimage_path = 'site/image/no_image2.png';
            $img_path = isset($question) ? $question->image_puth : $noimage_path ;
            $commentary_img_path = isset($question) ? $question->commentary_image_puth : $noimage_path ;
        @endphp
        @if ( empty($question) )


            <!-- 新規作成 -->>
            <make-question-form-component
            form_style="store"
            token="{{ csrf_token() }}"
            url_action="{{  route('make_question.store', $question_group ) }}"
            url_back="{{   route('make_question_group.select_edit', $param ) }}"

            questions_count="{{$question_group->questions->count() + 1}}"
            question_num="{{$question_group->questions->count() + 1}}"

            select_answer_type_num="{{    isset($question) ? $question->answer_type : 1 }}"
            select_answer_question_id="{{ isset($question) ? $question->id : null }}"
            select_answer_api_route="{{ route('make_question.question_options_api') }}"

            img_path="{{asset('storage/'.$img_path)}}"
            noimg_path="{{asset('storage/'.$noimage_path)}}"
            commentary_img_path = "{{asset('storage/'.$commentary_img_path)}}"
            commentary_text="{{ isset($question) ? $question->commentary_storage_text : ''}}"
            ></make-question-form-component>


        @else


            <!-- 更新 -->
            <make-question-form-component
            form_style="update"
            token="{{ csrf_token() }}"
            url_action="{{ route('make_question.update', $question ) }}"
            url_back="{{   route('make_question_group.select_edit', $param ) }}"

            questions_count="{{$question_group->questions->count()}}"
            question_num="{{$question->order}}"

            select_answer_type_num="{{    isset($question) ? $question->answer_type : 1 }}"
            select_answer_question_id="{{ isset($question) ? $question->id : null }}"
            select_answer_api_route="{{ route('make_question.question_options_api') }}"

            input_text="{{$question->text_text}}"
            img_path="{{asset('storage/'.$img_path)}}"
            noimg_path="{{asset('storage/'.$noimage_path)}}"
            commentary_img_path = "{{asset('storage/'.$commentary_img_path)}}"
            commentary_text="{{ isset($question) ? $question->commentary_storage_text : ''}}"
            ></make-question-form-component>


        @endif


    </div>
</section>
@endsection
