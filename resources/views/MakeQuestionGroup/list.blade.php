@extends('layouts.base')


<!----- title ----->
@section('title', '作成した問題集リスト' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '作成した問題集リスト' }}
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

                    <section class="">

                        @forelse ($question_groups as $i => $question_group)
                        <div class="card card-body border-0 shadow-sm mb-3">

                            <div class="row">
                                <div class="col-auto  d-none d-sm-block">
                                    <div class="card-image border border-light" style="
                                        background:url({{ asset('storage/'.$question_group->image_puth) }});
                                        background-repeat  : no-repeat;
                                        background-size    : cover;
                                        background-position: center center;
                                        width: 4rem; height: 4rem; border-radius: .5rem;
                                    "></div>
                                </div>
                                <div class="col">


                                    <div>
                                        <!-- 公開設定 -->
                                        @if ( $question_group->published_at )
                                        <span class="badge badge-primary"  style="border-radius:.8rem; transform: translateY(-0.1rem);"
                                        >公開中</span>
                                        @else
                                        <span class="badge badge-secondary" style="border-radius:.8rem; transform: translateY(-0.1rem);"
                                        >非公開</span>
                                        @endif

                                        <!-- 更新日 -->
                                        <span>更新日{{ \Carbon\Carbon::parse($question_group->updated_at)->format('Y-m-d') }}</span>
                                    </div>

                                    <!-- タイトル -->
                                    <a href=""
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight{{ $i }}" aria-controls="offcanvasRight{{ $i }}"
                                    class="fs-3 text-success" style="text-decoration:none;">{{ $question_group->title }}</a>


                                    <!--// offcanvas //-->
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight{{ $i }}" aria-labelledby="offcanvasRight{{ $i }}Label"
                                    style="width:600px;">
                                        <!-- offcanvas-header -->
                                        <div class="offcanvas-header text-end">


                                            <div class="col">
                                                <div class="text-start">
                                                    <!-- 公開設定 -->
                                                    @if ( $question_group->published_at )
                                                    <span class="badge badge-primary"  style="border-radius:.8rem; transform: translateY(-0.1rem);"
                                                    >公開中</span>
                                                    @else
                                                    <span class="badge badge-secondary" style="border-radius:.8rem; transform: translateY(-0.1rem);"
                                                    >非公開</span>
                                                    @endif
                                                </div>

                                                <!-- タイトル -->
                                                <h4 class="modal-title text-start mb-0" id="questionModal{{ $i+1 }}Label">
                                                    {{ $question_group->title }}
                                                </h4>
                                                <!-- タグ -->
                                                <div class="">
                                                    @if ($question_group->tags)
                                                    <div class="d-flex gap-1 align-items-center">
                                                        @foreach ( explode('　',$question_group->tags) as $tag )
                                                        <form action="{{ route('questions_search_list') }}">
                                                            <input type="hidden" name="seach_keywords" value="{{$tag}}">

                                                            <button type="submit" class="btn p-0 px-1 border text-muted" style="font-size:.8rem;">{{ $tag }}</button>
                                                        </form>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>


                                        </div>
                                        <!-- offcanvas-body -->
                                        <div class="offcanvas-body p-0">


                                            <!-- サムネ画像 -->
                                            <div class="ratio ratio-16x9" style="
                                                background: no-repeat center center / cover;
                                                background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                                                border-radius: .5rem;
                                            "></div>

                                            <!-- URLコピー -->
                                            <div class="modal-body">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge rounded-pill bg-success me-1">
                                                        <i class="bi bi-link-45deg"></i>
                                                    </span>
                                                    問題集のURLを友達に送ろう！
                                                </div>
                                                @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                                                <url-copy-component copy_url="{{ route('play_question', $param ) }}"></url-copy-component>

                                                <div class="text-secondary fst-italic">
                                                    <i class="bi bi-exclamation-circle me-1"></i>
                                                    公開設定が『非公開』のときでも、受検用URLを教えた友達だけに自分の問題集にチャレンジしてもらうことができるよ！                                                </div>
                                            </div>

                                            <!-- 公開日等 -->
                                            <div class="card-body">

                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">公開日</div>
                                                    <div class="col-8 ps-3">{{
                                                    $question_group->published_at ?
                                                    \Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H:i') :
                                                    '非公開'}}</div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">作成日時</div>
                                                    <div class="col-8 ps-3">
                                                        {{\Carbon\Carbon::parse($question_group->created_at)->format('Y年m月d日 H時i分')}}
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">更新日時</div>
                                                    <div class="col-8 ps-3">
                                                        {{\Carbon\Carbon::parse($question_group->updated_at)->format('Y年m月d日 H時i分')}}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 基本情報 -->
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">問題数</div>
                                                    <div class="col-8 ps-3">全{{$question_group->question_count}}問</div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">制限時間</div>
                                                    <div class="col-8 ps-3">{{$question_group->time_limit_text}}</div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">受験回数</div>
                                                    <div class="col-8 ps-3">{{$question_group->answer_groups->count()}}回</div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">平均点</div>
                                                    <div class="col-8 ps-3">{{sprintf('%.1f',$question_group->average_score)}}点</div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-4 ps-3 bg-light">いいね数</div>
                                                    <div class="col-8 ps-3">{{$question_group->keep_question_groups->count()}}</div>
                                                </div>
                                            </div>

                                            <!-- 問題集の説明 -->
                                            @if ( $question_group->resume_text )
                                                <div class="modal-body">
                                                    <div class="card card-body border-0 bg-light-success">
                                                        {!! nl2br( e( $question_group->resume_text ) ) !!}
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- menu -->
                                            <div class="list-group mx-3 mb-5">
                                                @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                                                <a href="{{ route('play_question', $param ) }}"
                                                class="list-group-item list-group-item-action">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0">
                                                            <i class="bi bi-play-circle-fill"></i>
                                                            <span class="ms-3">受検する</span>
                                                        </p>
                                                        <i class="bi bi-chevron-right"></i>
                                                    </div>
                                                </a>
                                                <a href="{{ route('make_question_group.select_edit', $question_group ) }}"
                                                class="list-group-item list-group-item-action">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0">
                                                            <i class="bi bi-pencil"></i>
                                                            <span class="ms-3">編集</span>
                                                        </p>
                                                        <i class="bi bi-chevron-right"></i>
                                                    </div>
                                                </a>
                                                <a href="#"
                                                data-bs-toggle="modal" data-bs-target="#deleteQuestionGroupModal{{$i}}"
                                                class="list-group-item list-group-item-action">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="ms-3">削除</span>
                                                        </p>
                                                        <i class="bi bi-chevron-right"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- メニューボタン -->
                                <div class="col-auto d-none d-sm-block">

                                    <div class="dropdown">
                                        <button class="btn btn-link text-secondary" type="button"
                                        id="dropdownMenu{{ $i }}" data-bs-toggle="dropdown" aria-expanded="false"
                                        ><i class="bi bi-three-dots-vertical"></i></button>

                                        <!--dropdownMenu-->
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu{{ $i }}" style="width:160px;">
                                            @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                                            <a href="{{ route('play_question', $param ) }}"
                                            class="list-group-item list-group-item-action border-0">
                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-0">
                                                        <i class="bi bi-play-circle-fill"></i>
                                                        <span class="ms-3">受検する</span>
                                                    </p>
                                                    {{-- <i class="bi bi-chevron-right"></i> --}}
                                                </div>
                                            </a>
                                            <a href="{{ route('make_question_group.select_edit', $question_group ) }}"
                                            class="list-group-item list-group-item-action border-0">
                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-0">
                                                        <i class="bi bi-pencil"></i>
                                                        <span class="ms-3">編集</span>
                                                    </p>
                                                </div>
                                            </a>
                                            <a href="#"
                                            data-bs-toggle="modal" data-bs-target="#deleteQuestionGroupModal{{$i}}"
                                            class="list-group-item list-group-item-action border-0">
                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-0">
                                                        <i class="bi bi-trash"></i>
                                                        <span class="ms-3">削除</span>
                                                    </p>
                                                    {{-- <i class="bi bi-chevron-right"></i> --}}
                                                </div>
                                            </a>
                                        </div>
                                    </div><!--end dropdown-->

                                </div>
                            </div>


                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteQuestionGroupModal{{$i}}" tabindex="-1" aria-labelledby="deleteQuestionGroupModal{{$i}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="deleteQuestionGroupModal{{$i}}Label">問題集の削除</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        "{{ $question_group->title }}"を削除します。<br>よろしいですか？
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" style="text-decoration:none;" class="btn btn-link text-secondary fw-bold" data-bs-dismiss="modal"
                                        >閉じる</button>


                                        <form action="{{route('make_question_group.destroy',$question_group)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="text-decoration:none;" class="btn btn-link text-danger fw-bold"
                                            >削除</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </div>
                        @empty
                        <!-- 問題の作成が無いとき -->
                        <div class="py-5">


                            <div class="mb-5">
                                <h2 class="text-secondary text-center">作成された問題はありません。</h2>
                            </div>

                            <div class="card card-body py-4">

                                <div class="mb-3">
                                    <h3 class="text-success text-center">\ オリジナル問題集 /<br>~ 作成の流れ ~</h3>
                                </div>

                                <div class="mb-3 row mx-auto" style="max-width:600px;">
                                    <div class="col-12 pb-3">
                                        <div class="card  shadow border-success border-2 mb-3">
                                            <div class="card-header bg-success text-white d-md-flex">
                                                <h6 class="mb-0 bg-white text-primary d-inline-block px-2 py-1 me-2">Step 1</h6>
                                                <h5 class="mb-0 card-title">『基本情報』を登録しよう！</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text text-secondary">
                                                    まずは、問題一覧に表示される『基本情報』を登録しよう！<br>
                                                    『問題集のタイトル』、『説明文』、『サムネイル画像』、『タグ』、『制限時間』を設定することができるよ。<br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pb-3">
                                        <div class="card  shadow border-success border-2 mb-3">
                                            <div class="card-header bg-success text-white d-md-flex">
                                                <h6 class="mb-0 bg-white text-primary d-inline-block px-2 py-1 me-2">Step 2</h6>
                                                <h5 class="mb-0 card-title">『問題』を登録しよう！</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text text-secondary">
                                                    『ひとつの答えを選ぶ』、『複数の答えを選ぶ』、『テキストで答えを入力する』の三種類から解答方法を選択して、問題をつくろう。
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pb-3">
                                        <div class="card  shadow border-success border-2 mb-3">
                                            <div class="card-header bg-success text-white d-md-flex">
                                                <h6 class="mb-0 bg-white text-primary d-inline-block px-2 py-1 me-2">Step 3</h6>
                                                <h5 class="mb-0 card-title">『『公開設定』を登録しよう！</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text text-secondary">
                                                    お好みで公開設定を選択しましょう！<br>
                                                </p>
                                                <p class="card-text text-secondary">
                                                    <strong class="text-success">\ 公開 /</strong><br>
                                                    『いいね』で評価をもらったり、『コメント』機能で感想をもらったり、全国のユーザーに問題を解いてもらおう！
                                                </p>
                                                <p class="card-text text-secondary">
                                                    <strong class="text-success">\ 非公開 /</strong><br>
                                                    問題集の一覧や検索では表示されないよ！<br>
                                                    作成中の問題を一時保存したり、個人的に問題を解いて楽しもう！<br>
                                                    公開URLを使えば、URLを教えた友達だけに自分の問題にチャレンジしてもらうこともできるよ！
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h3 class="text-success text-center">さあ、オリジナル問題集を<br class="d-block d-md-none"> 作成しょう！</h3>

                                    <div class="col-sm-8 offset-sm-2 mt-3">
                                        <a class="btn btn-lg bg-gradient-red-orange rounded-pill text-white shadow w-100 fs-5 fw-bold"
                                        href="{{route('make_question_group.create')}}">問題集の新規作成</a>
                                    </div>

                                </div>

                            </div>


                        </div>
                        @endforelse


                        <div class="my-3">
                            <!-- ページネーション -->
                            <div class="mb-5 d-flex justify-content-center">
                                {{ $question_groups->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>


                        <!-- 問題追加ボタン -->
                        <div  id="addQuestion">
                            <div class="container-1200">

                                <a href="{{route('make_question_group.create')}}" class="d-block text-decoration-none  mx-3 float-end">

                                    <div class="bg-success d-flex flex-column justify-content-center align-items-center shadow-lg position-relative"
                                    style="width:90px; height:90px; border-radius:50%;">

                                        <div class="text-white pb-4" style="font-size:4rem;">
                                            <i class="bi bi-plus"></i>
                                        </div>
                                        <div class="position-absolute start-50 translate-middle-x
                                        text-white text-center w-100" style="bottom: 1rem;">新規作成</div>

                                    </div>
                                </a>

                            </div>
                        </div>
                    </section>


                </div>
            </div>
        </div>
    </section>
@endsection


