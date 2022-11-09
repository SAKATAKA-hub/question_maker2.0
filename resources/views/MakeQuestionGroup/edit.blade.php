@extends('layouts.base')


<!----- title ----->
@section('title')
    @if ( empty($question_group) )
    問題集の新規作成
    @else
    基本情報の編集
    @endif
@endsection


<!----- breadcrumb ----->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
        マイページ
    </a></li>
    <li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
        作成した問題集
    </a></li>
    @if ( empty($question_group) )
        <li class="breadcrumb-item" aria-current="page">
            問題集の新規作成
        </li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('make_question_group.select_edit', $question_group ) }}" class="text-success">
            {{'『'.$question_group->title.'』詳細情報'}}
        </a></li>
        <li class="breadcrumb-item" aria-current="page">
            基本情報の編集
        </li>
    @endif
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
<script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
@endsection


<!----- contents ----->
@section('contents')
<section class="bg-light">
    <div class="container-1200 pt-5">

        @php
            $noimage_path = 'site/image/no_image.png';
            $img_path = isset($question_group) ? $question_group->image_puth : $noimage_path ;
            // $H =  isset($question_group) ? substr( $question_group->time_limit,0,2 ) : '';
            // $m =  isset($question_group) ? substr( $question_group->time_limit,3,2 ) : '';
            // $s =  isset($question_group) ? substr( $question_group->time_limit,6,2 ) : '';
        @endphp

        @if ( empty($question_group) )
            <!-- 新規作成 -->
            <make-question-group-form-component
            form_style="store"
            token="{{ csrf_token() }}"
            url_action="{{ route('make_question_group.store' ) }}"
            url_back="{{route('make_question_group.list')}}"

            img_path="{{asset('storage/'.$img_path)}}"
            noimg_path="{{asset('storage/'.$noimage_path)}}"
            ></make-question-group-form-component>


        @else
            <!-- 更新 -->
            <make-question-group-form-component
            form_style="update"
            token="{{ csrf_token() }}"
            url_action="{{ route('make_question_group.update', $question_group ) }}"
            url_back="{{ route('make_question_group.select_edit', $question_group ) }}"

            input_title="{{$question_group->title}}"
            input_resume="{{$question_group->resume_text}}"
            input_tags="{{$question_group->tags}}"
            img_path="{{asset('storage/'.$img_path)}}"
            noimg_path="{{asset('storage/'.$noimage_path)}}"
            input_time_h="{{substr( $question_group->time_limit,0,2 )}}"
            input_time_m="{{substr( $question_group->time_limit,3,2 )}}"
            input_time_s="{{substr( $question_group->time_limit,6,2 )}}"
            ></make-question-group-form-component>


        @endif


    </div>
</section>
@endsection
