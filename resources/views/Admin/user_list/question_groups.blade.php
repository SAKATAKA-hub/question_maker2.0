@extends('layouts.base_02col_createruser')


<!----- title ----->
@section('title', $user->name.'さんの問題集一覧')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.top')}}" class="text-success">
    管理者画面
</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.user_list')}}" class="text-success">
    登録ユーザー一覧
</a></li>

<li class="breadcrumb-item" aria-current="page">
    {{  $user->name.'さんの問題集一覧' }}
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

    <section class="">

        @forelse ($question_groups as $i => $question_group)
        <a href=""
        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight{{ $i }}" aria-controls="offcanvasRight{{ $i }}"
        class="card card-body border-0 shadow-sm mb-3 text-dark text-decoration-none list-group-item-action">


            <div class="row">
                <!-- サムネイルmobile -->
                <div class="col-auto  d-md-none">
                    <div class="card-image border border-light" style="
                        background:url({{ asset('storage/'.$question_group->image_puth) }});
                        background-repeat  : no-repeat;
                        background-size    : cover;
                        background-position: center center;
                        width: 3rem; height: 3rem; border-radius: .5rem;
                    "></div>
                </div>
                <!-- サムネイルpc -->
                <div class="col-auto  d-none d-md-block">
                    <div class="card-image border border-light" style="
                        background:url({{ asset('storage/'.$question_group->image_puth) }});
                        background-repeat  : no-repeat;
                        background-size    : cover;
                        background-position: center center;
                        width: 4rem; height: 4rem; border-radius: .5rem;
                    "></div>
                </div>
                <!-- タイトルリンク -->
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

                    @php $title = mb_strlen($question_group->title ) > 16 ? mb_substr($question_group->title,0,16).'...' : $question_group->title; @endphp
                    <span class="d-md-none fs-6">{{ $title }}</span>
                    @php $title = mb_strlen($question_group->title ) > 24 ? mb_substr($question_group->title,0,24).'...' : $question_group->title; @endphp
                    <span class="d-none d-md-inline fs-3">{{ $title }}</span>



                </div>
            </div>



        </a>

        <!--// offcanvas //-->
        <div class="offcanvas offcanvas-end"  style="max-width: 90vw;"
        tabindex="-1" id="offcanvasRight{{ $i }}" aria-labelledby="offcanvasRight{{ $i }}Label"
        style="width:600px;">
            <!-- offcanvas-header -->
            <div class="offcanvas-header align-items-center">
                <h5 class="mb-0 text-success"><i class="bi bi-journals"></i>作成した問題集　詳細情報</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- offcanvas-body -->
            <div class="offcanvas-body p-0">

                <div class="p-3">
                    <div class="">
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
                        <div class="d-flex gap-1 flex-wrap align-items-center">
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

                <!-- サムネ画像 -->
                <div class="mx-auto" style="width:300px;">
                    <div class="ratio ratio-16x9 h-100" style="
                        background: no-repeat center center / cover;
                        background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                        border-radius: .5rem;
                    "></div>
                </div>

                <!-- [ シェアボタン ] -->
                <div class="m-3">
                    @include('_parts.share_group')
                </div>

                <!-- 公開日等 -->
                <div class="m-3 card py-2">
                    @if ($question_group->published_at)
                        <div class="d-flex">
                            <div class="col-auto ps-3">公開</div>
                            <div class="col ps-3">{{
                            $question_group->published_at ?
                            \Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H時i分') :
                            '非公開'}}</div>
                        </div>
                    @endif
                    <div class="d-flex">
                        <div class="col-auto ps-3">作成</div>
                        <div class="col ps-3">
                            {{\Carbon\Carbon::parse($question_group->created_at)->format('Y年m月d日 H時i分')}}
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-auto ps-3">更新</div>
                        <div class="col ps-3">
                            {{\Carbon\Carbon::parse($question_group->updated_at)->format('Y年m月d日 H時i分')}}
                        </div>
                    </div>
                </div>

                <!-- 基本情報 -->
                <div class="m-3">
                    <div class="card">
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
                        <div class="col-8 ps-3">{{$question_group->accessed_count}}回</div>
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
                </div>

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
                    <a href="{{ route('admin.user_list.question_group_ditail', compact('user','question_group') ) }}"
                    class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0">
                                <i class="bi bi-card-heading"></i>
                                <span class="ms-3">詳細情報</span>
                            </p>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>

                </div>
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




    </section>


    {{-- <!-- 問題追加ボタン -->
    <a id="addQuestion" href="{{route('make_question_group.create')}}" class="d-block text-decoration-none">
        <div class="icon text-white bg-success shadow">
            <i class="bi bi-plus"></i>
        </div>
        <div class="text-secondary text-center w-100">新規作成</div>
    </a> --}}
@endsection
