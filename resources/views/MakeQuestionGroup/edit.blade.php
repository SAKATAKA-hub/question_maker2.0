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
<section>
    <div class="container-1200 pt-5">


        @if ( empty($question_group) ){{-- 新規作成 --}}
        <form action="{{ route('make_question_group.store' ) }}"
        method="POST" enctype="multipart/form-data" onsubmit="stopOnbeforeunload()">
            @csrf
            <div class="card  shadow border-success border-2 mb-5">
                <div class="card-header bg-success text-white d-md-flex">
                    <h5 class="mb-0 card-title">『基本情報』を登録しよう！</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-secondary">
                        問題一覧に表示される『基本情報』を登録しましよう！<br>
                    </p>
                </div>
            </div>


        @else{{-- 更新 --}}
        <form action="{{ route('make_question_group.update', $question_group ) }}"
        method="POST" enctype="multipart/form-data" onsubmit="stopOnbeforeunload()">
            @csrf
            @method('PATCH')

        @endif

            <div class="card mb-5 card-body border-0 shadow">

                <!-- タイトル -->
                <div class="form-group mb-4 card card-body border-success">
                    <div class="d-flex align-items-center">
                        <label for="title_input" class="form-check-label fs-5 mb-2 fw-bold"
                        >問題集のタイトル</label>
                        <span class="badge bg-danger ms-2 mb-2">必須</span>
                    </div>

                    <input type="text" name="title" class="form-control" id="title_input" placeholder="問題集のタイトル"
                    value="{{ isset($question_group) ? $question_group->title : '' }}" required
                    maxlength="150">
                </div>


                <!-- 説明文 -->
                <div class="form-group mb-4 card card-body border-success">
                    <div class="d-flex align-items-center">
                        <label for="resume_input1" class="form-check-label fs-5 mb-2 fw-bold"
                        >説明文</label>
                        <span class="badge bg-danger ms-2 mb-2">必須</span>
                    </div>

                    <textarea name="resume" class="form-control" id="resume_input1" rows="10"
                    placeholder="問題集の簡単な説明を書きましょう！" required
                    >{{ isset($question_group) ? $question_group->resume_text : '' }}</textarea>
                    {{-- <div class="form-text">※150文字以内</div> --}}
                </div>



                <!-- サムネ画像 -->
                <div class="form-group mb-4 card card-body border-success">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >サムネ画像</label>

                    @php $img_path = isset($question_group) ? $question_group->image_puth : 'site/image/no_image.png' ; @endphp
                    <read-image-file-component img_path="{{asset('storage/'.$img_path)}}"></read-image-file-component>

                    <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
                </div>


                <!-- 制限時間 -->
                <div class="form-group mb-4 card card-body border-success">
                    <label for="title_input" class="form-check-label fs-5 mb-2 fw-bold"
                    >制限時間</label>
                    <p class="callout callout-success">
                        制限時間を設定したくないときは、『00時間00分00秒』に時間を合せてください。
                    </p>
                    <div class="row align-items-center">
                        <!--時間-->
                        @php $H =  isset($question_group) ? substr( $question_group->time_limit,0,2 ) : '';  @endphp
                        <div class="col-auto">
                            <select name="time_limit[]" class="form-select " aria-label="Default select example">
                                @for ($i = 0; $i < 24; $i++)
                                <option value="{{ sprintf('%02d',$i) }}"
                                {{ sprintf('%02d',$i)== $H ? 'selected' : ''}}
                                >{{ sprintf('%02d',$i) }}</option>
                                @endfor
                            </select>
                            </select>
                        </div>
                        <div class="col-auto">時間</div>
                        <!--分-->
                        @php $m =  isset($question_group) ? substr( $question_group->time_limit,3,2 ) : '';  @endphp
                        <div class="col-auto">
                            <select name="time_limit[]" class="form-select" aria-label="Default select example">
                                @for ($i = 0; $i < 60; $i++)
                                <option value="{{ sprintf('%02d',$i) }}"
                                {{ sprintf('%02d',$i)== $m ? 'selected' : ''}}
                                >{{ sprintf('%02d',$i) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">分</div>
                        <!--秒-->
                        @php $s =  isset($question_group) ? substr( $question_group->time_limit,6,2 ) : '';  @endphp
                        <div class="col-auto">
                            <select name="time_limit[]" class="form-select" aria-label="Default select example">
                                @for ($i = 0; $i < 60; $i++)
                                <option value="{{ sprintf('%02d',$i) }}"
                                {{ sprintf('%02d',$i)== $s ? 'selected' : ''}}
                                >{{ sprintf('%02d',$i) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">秒</div>
                    </div>
                </div>


                <!-- タグ -->
                <div class="form-group mb-4 card card-body border-success">
                    <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                    >タグ</label>
                    <p class="callout callout-success">
                        タグが複数あるときは、全角または半角スペースで区切ってください。
                    </p>


                    <input type="text" name="tags" class="form-control" id="exampleFormControlInput1" placeholder="タグ"
                    value="{{ isset($question_group) ? $question_group->tags : '' }}"
                    maxlength="150">
                </div>



                <!-- 送信ボタン -->
                <div class="mt-5 mb-5">
                    {{-- <div class="d-grid gap-2 col-md-4 mx-auto"> --}}
                        <button class="btn btn-success btn-lg rounded-pill fs-5 w-100" type="submit">
                            @if ( empty($question_group) )
                            基本情報の登録
                            @else
                            基本情報の更新
                            @endif
                        </button>
                    {{-- </div> --}}
                </div>

            </div>

        </form>

    </div>
</section>
@endsection
