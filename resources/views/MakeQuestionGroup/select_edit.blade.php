@extends('layouts.base_02col')


<!----- title ----->
@section('title','『'.$question_group->title.'』詳細情報')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item"><a href="{{route('make_question_group.list')}}" class="text-success">
    作成した問題集
</a></li>
<li class="breadcrumb-item" aria-current="page">
   {{'『'.$question_group->title.'』詳細情報'}}
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
@endsection


<!----- style ----->
@section('style')
<style>
/*タブメニュー*/
@media screen and (max-width: 576px) {
    .tab-menu{ font-size:11px; }
    #question-group-tabmenu .active{
        font-weight: bold;
    }
    #question-group-tabmenu{
        width: 100%;
        overflow: auto;
    }
    #question-group-tabmenu > ul{
        /* width:540px; */
        width:360px;
    }
}

.nav-pills .nav-link.active {
    background-color: #14CFA0 !important ;
}

</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <section>

        {{-- <!-- タイトル -->
        <div class="border-bottom border-2 border-success">
            <!-- 更新日 -->
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
            <div class="text-success fw-bold" style="font-size:.6rem">問題集のタイトル：</div>
            <h3 class="w-100 text-break">{{ $question_group->title }}</h3>

        </div> --}}


        <!-- tabmenu -->
        <div class="mb-3 mt-">

            <!-- tabmenu button -->
            {{-- <div id="question-group-tabmenu" style="font-size:11px;">
                <ul class="nav nav-pills flex-row gap-1" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill border border-success
                        @if( $tab_menu === 'tab01' )  active @endif"
                        id="tab-tab01-tab" data-bs-target="#tab-tab01"
                        aria-controls="tab-tab01" aria-selected="{{ $tab_menu === 'tab01' ? 'true' : 'false' }}"
                        type="button" role="tab" data-bs-toggle="pill"
                        >
                            <span class="tab-menu">基本情報</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill border border-success
                        @if( $tab_menu === 'tab02' )  active @endif"
                        id="tab-tab02-tab" data-bs-target="#tab-tab02"
                        aria-controls="tab-tab02" aria-selected="{{ $tab_menu === 'tab02' ? 'true' : 'false' }}"
                        type="button" role="tab" data-bs-toggle="pill"
                        >
                            <span class="tab-menu">出題問題</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill border border-success
                        @if( $tab_menu === 'tab03' )  active @endif"
                        id="tab-tab03-tab" data-bs-target="#tab-tab03"
                        aria-controls="tab-tab03" aria-selected="{{ $tab_menu === 'tab03' ? 'true' : 'false' }}"
                        type="button" role="tab" data-bs-toggle="pill"
                        >
                            <span class="tab-menu">公開設定</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill border border-success
                        @if( $tab_menu === 'tab04' )  active @endif"
                        id="tab-tab04-tab" data-bs-target="#tab-tab04"
                        aria-controls="tab-tab04" aria-selected="{{ $tab_menu === 'tab04' ? 'true' : 'false' }}"
                        type="button" role="tab" data-bs-toggle="pill"
                        >
                            <span class="tab-menu">コメント</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill border border-success
                        @if( $tab_menu === 'tab05' )  active @endif"
                        id="tab-tab05-tab" data-bs-target="#tab-tab05"
                        aria-controls="tab-tab05" aria-selected="{{ $tab_menu === 'tab05' ? 'true' : 'false' }}"
                        type="button" role="tab" data-bs-toggle="pill"
                        >
                            <span class="tab-menu">受検者一覧</span>
                        </button>
                    </li>

                </ul>
            </div> --}}
            <div id="question-group-tabmenu" style="font-size:11px;">
                <ul class="nav nav-pills flex-row gap-1" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('make_question_group.select_edit', ['question_group'=>$question_group->id,'tab_menu'=>'tab01',] ) }}"
                        class="nav-link rounded-pill border border-success py-1 px-2 px-md-4
                        @if( $tab_menu === 'tab01' )  active @endif"
                        >
                            <span class="tab-menu">基本情報</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('make_question_group.select_edit', ['question_group'=>$question_group->id,'tab_menu'=>'tab02',] ) }}"
                        class="nav-link rounded-pill border border-success py-1 px-2 px-md-4
                        @if( $tab_menu === 'tab02' )  active @endif"
                        >
                            <span class="tab-menu">出題問題</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('make_question_group.select_edit', ['question_group'=>$question_group->id,'tab_menu'=>'tab03',] ) }}"
                        class="nav-link rounded-pill border border-success py-1 px-2 px-md-4
                        @if( $tab_menu === 'tab03' )  active @endif"
                        >
                            <span class="tab-menu">公開設定</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('make_question_group.select_edit', ['question_group'=>$question_group->id,'tab_menu'=>'tab04',] ) }}"
                        class="nav-link rounded-pill border border-success py-1 px-2 px-md-4
                        @if( $tab_menu === 'tab04' )  active @endif"
                        >
                            <span class="tab-menu">コメント</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('make_question_group.select_edit', ['question_group'=>$question_group->id,'tab_menu'=>'tab05',] ) }}"
                        class="nav-link rounded-pill border border-success py-1 px-2 px-md-4
                        @if( $tab_menu === 'tab05' )  active @endif"
                        >
                            <span class="tab-menu">受検者一覧</span>
                        </a>
                    </li>

                </ul>
            </div>

            <!-- tabmenu contents -->
            <div class="tab-content" id="pills-tabContent" style="border-top-color: transparent;">
                <!-- tab01 -->
                <div class="tab-pane fade
                @if( $tab_menu === 'tab01' ) show active @endif
                " role="tabpane0l"
                id="tab-tab01" aria-labelledby="tab-tab01-tab">


                    <div class="mt-3">

                        <!-- タイトル -->
                        <div class="border-bottom border-2 border-success">
                            <!-- 更新日 -->
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
                                {{-- <span>更新日{{ \Carbon\Carbon::parse($question_group->updated_at)->format('Y-m-d') }}</span> --}}
                            </div>

                            <!-- タイトル -->
                            <div class="text-success fw-bold" style="font-size:.6rem">問題集のタイトル：</div>
                            <h3 class="w-100 text-break">{{ $question_group->title }}</h3>

                        </div>


                        <!-- 公開日等 -->
                        <div class="my-3 cardd py-">
                            @if ($question_group->published_at)
                                <div class="d-flex">
                                    <div class="col-auto ps-">公開</div>
                                    <div class="col ps-3">{{
                                    $question_group->published_at ?
                                    \Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H時i分') :
                                    '非公開'}}</div>
                                </div>
                            @endif
                            <div class="d-flex">
                                <div class="col-auto ps-">作成</div>
                                <div class="col ps-3">
                                    {{\Carbon\Carbon::parse($question_group->created_at)->format('Y年m月d日 H時i分')}}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto ps-">更新</div>
                                <div class="col ps-3">
                                    {{\Carbon\Carbon::parse($question_group->updated_at)->format('Y年m月d日 H時i分')}}
                                </div>
                            </div>
                        </div>


                        <!-- [ シェアボタン ] -->
                        <div class="cardd card-bodyy my-3">
                            @include('_parts.share_group')

                            <div class="d-flex align-items-top mt-2" style="font-size:11px;">
                                <span class="me-1">
                                    <i class="bi bi-exclamation-circle"></i>
                                </span>
                                公開設定が『非公開』のときでも、受検用URLを教えた友達だけに自分の問題集にチャレンジしてもらうことができます。
                            </div>
                        </div>


                        <!-- その他情報 -->
                        <div class="">
                            <div class="card overflow-hidden">
                                <div class="">
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
                        </div>


                        <!-- 入力情報 -->
                        <div class="mb-5">
                            <div class="row">
                                <!-- サムネ画像 -->
                                <div class="col-md-4 order-md-2">
                                    <div class="my-3">
                                        <span class="text-success fw-bold">サムネ画像</span>
                                        <div class="w-100  mb-3">
                                            <div class="ratio ratio-16x9 border" style="
                                                background: no-repeat center center / cover;
                                                background-image:url({{asset('storage/'.$question_group->image_puth)}});
                                                border-radius: .5rem;
                                            "></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <!-- 問題集のタイトル -->
                                    <div class="my-3">
                                        <label for="title_input" class="form-check-label text-success fw-bold">問題集のタイトル</label>
                                        <input type="text" name="title" class="form-control bg-white" disabled
                                        value="{{$question_group->title}}">
                                    </div>

                                    <!-- 制限時間 -->
                                    <div class="form-group mb-3">
                                        <label for="title_input" class="form-check-label text-success fw-bold">制限時間</label>

                                        <input type="text" class="form-control bg-white" disabled
                                        value="{{ $question_group->time_limit_text }}">
                                    </div>

                                    <!-- タグ -->
                                    <div class="form-group mb-3">
                                        <label for="title_input" class="form-check-label text-success fw-bold">タグ</label>

                                        <input type="text" class="form-control bg-white" disabled
                                        value="{{ $question_group->tags }}">
                                    </div>

                                    <!-- 説明文 -->
                                    <div class="form-group mb-3">
                                        <label for="title_input" class="form-check-label text-success fw-bold">説明文</label>

                                        <div class="card overflow-auto" style="max-height:50vh; border-color:#e9ecef;">
                                            <div class="card-body">
                                                <replace-text-component text="{{ $question_group->resume_text }}"></replace-text-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <a href="{{route('make_question_group.edit',$question_group)}}" class="btn btn-success rounded-pill"
                            >基本情報の編集</a>
                        </div>


                        <hr>


                        <!-- [ シェアボタン ] -->
                        <div class="d-grid gap-2 col-md-6 mx-auto mt-5">

                            <div class="mb-1 text-center">この問題に挑戦しますか？</div>


                            <div class="row g-0">
                                <div class="col">
                                    @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                                    <a href="{{ route('play_question', $param ) }}" class="btn rounded-pill btn-outline-success w-100"
                                    >挑戦する！</a>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- tab02 -->
                <div class="tab-pane fade p-0
                @if( $tab_menu === 'tab02' ) show active @endif
                " role="tabpane02"
                id="tab-tab02" aria-labelledby="tab-tab02-tab">


                    <div class="pt-3">


                        @forelse ($question_group->questions as $key => $question)
                            <div class="mb-3 border-bottom">
                                <div class="card-body px-0">
                                    <h2 class="text-secondary fw-bold">
                                        問題 {{sprintf('%02d', $question->order )}}
                                    </h2>



                                    @include('MakeQuestionGroup.component.question_discription')


                                    <div class="my-3">
                                        <a href="{{route('make_question.edit',$question)}}"    class="btn btn-info rounded-pill" style="text-decoration:none;"
                                        >編集</a>
                                        <a href="{{route('make_question.copy',$question)}}" class="btn btn-warning  rounded-pill" style="text-decoration:none;"
                                        >コピー</a>
                                        <a href="#" class="btn btn-outline-danger  rounded-pill" style="text-decoration:none;"
                                        data-bs-toggle="modal" data-bs-target="#deleteQuestionModal{{$key}}"
                                        >削除</a>
                                    </div>
                                </div>
                            </div>

                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteQuestionModal{{$key}}" tabindex="-1" aria-labelledby="deleteQuestionModal{{$key}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        {{-- <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="deleteQuestionModal{{$key}}Label">問題の削除</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div> --}}
                                        <div class="modal-body fw-bold text-center">

                                            <strong>問題 {{sprintf('%02d', $question->order )}}</strong>を削除します。<br>
                                            <strong>本当に、削除してもよろしいですか？</strong><br>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="col">
                                                <button type="button" style="text-decoration:none;"
                                                class="btn btn-light border fw-bold w-100" data-bs-dismiss="modal"
                                                >閉じる</button>
                                            </div>

                                            <form action="{{route('make_question.destroy',$question)}}" method="post" class="col">
                                                @csrf
                                                @method('delete')

                                                <disabled-button
                                                style_class="btn btn-danger fw-bold w-100"
                                                btn_text="削除する"></disabled-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="text-secondary text-center">問題はまだ作成されていません</h3>
                        @endforelse


                    </div>



                </div>
                <!-- tab03 -->
                <div class="tab-pane fade
                @if( $tab_menu === 'tab03' ) show active @endif
                " role="tabpane03"
                id="tab-tab03" aria-labelledby="tab-tab03-tab">


                    <form action="{{route('make_question_group.update_published', $question_group)}}" method="POST" class="mt-3">
                        @csrf
                        @method('PATCH')
                        <label for="publishedType1" class="card card-body mb-3">
                            <div class="form-check w-100">
                                <input name="is_public" value="1" type="radio" id="publishedType1" class="form-check-input"
                                {{ $question_group->published_at ? 'checked' : ''}}
                                {{ $question_group->questions->count() < 1 ? 'disabled' : ''}}
                                >
                                <h5 class="mb-0">公開</h5>
                            </div>
                            <p>
                                『いいね』で評価をもらったり、『コメント』機能で感想をもらったり、全国のユーザーに問題を解いてもらおう！<br>
                                <small>※問題が1問以上登録されていない場合、自動的に非公開となります。</small>
                            </p>
                        </label>
                        <label for="publishedType3" class="card card-body mb-3">
                            <div class="form-check w-100">
                                <input name="is_public" value="0" type="radio" id="publishedType3" class="form-check-input"
                                {{ !$question_group->published_at ? 'checked' : ''}}
                                >
                                <h5>非公開</h5>
                            </div>
                            <p>
                                問題集の一覧や検索では表示されないよ！<br>
                                作成中の問題を一時保存したり、個人的に問題を解いて楽しもう！<br>
                                公開設定が『非公開』のときでも、受検用URLを教えた友達だけに自分の問題集にチャレンジしてもらうことができるよ！
                            </p>
                        </label>

                        <div class="my-3">
                            <button class="btn btn-primary rounded-pill" type="submit"
                            >公開設定の更新</button>
                        </div>
                    </form>


                </div>
                <!-- tab04 -->
                <div class="tab-pane fade
                @if( $tab_menu === 'tab04' ) show active @endif
                " role="tabpane04"
                id="tab-tab04" aria-labelledby="tab-info04-tab">


                    <!-- コメントリストコンポーネント -->
                    <div class="mt-3">
                        @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp
                        <comment-component
                        route_comment_api="{{        route('comment.api')}}"
                        route_comment_destory_api="{{route('comment.destroy.api')}}"
                        user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                        ></comment-component>
                    </div>


                </div>
                <!-- tab05 -->
                <div class="tab-pane fade
                @if( $tab_menu === 'tab05' ) show active @endif
                " role="tabpane05"
                id="tab-tab05" aria-labelledby="tab-info05-tab">


                    <div class="list-group mt-3">
                        @forelse ($question_group->answer_groups as $key => $answer_group)
                            @php $param = [ 'answer_group'=>$answer_group, 'key'=>$answer_group->user->key ]; @endphp
                            <a href="{{route('results.detail', $param )}}" class="list-group-item list-group-item-action text-decoration-none text-secondary" >
                                <div class="row">
                                    <!--[フォロワー画像]-->
                                    <div class="col">
                                        <div class="pb-1">
                                            受験日{{ \Carbon\Carbon::parse($answer_group->created_at)->format('Y-m-d') }}
                                        </div>
                                        <div class="d-flex gap-3">
                                            <div class="col-auto">
                                                <div class="user-image border border-1 ratio ratio-1x1 mb-1" style="
                                                background:url({{ asset('storage/'.$answer_group->user->image_puth) }});
                                                background-repeat  : no-repeat;
                                                background-size    : cover;
                                                background-position: center center;
                                                width:2rem; border-radius:50%;
                                                "></div>
                                            </div>


                                            <div class="col">
                                                <div class="d-flex align-items-center h-100">
                                                    <!--[フォロワー名前]-->
                                                    <h5 class="mb-0">
                                                        {{-- @php $param = [ 'answer_group'=>$answer_group, 'key'=>$answer_group->user->key ]; @endphp
                                                        <a href="{{route('results.detail', $param )}}" class="text-decoration-none text-success"> --}}
                                                            {{$answer_group->user->name}}
                                                        {{-- </a> --}}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 成績 -->
                                    <div class="col-auto d-none d-sm-block text-secondary">
                                        <div class="d-flex justify-content-between align-items-end">
                                                <span class="">正解率</span>
                                                <span class="">
                                                    <strong class="fs-3">{{$answer_group->score}}</strong>％
                                                </span>
                                        </div>
                                        <div class="">
                                            解答時間 {{$answer_group->elapsed_time}}
                                        </div>
                                    </div>

                                </div>
                            </a>

                        @empty
                            <div class="list-group-item  border-0">
                                <div class="h5 text-secondary text-center py-5">
                                    ここに受検したユーザーが表示されます。
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-5 mb-5">
            <div class="d-grid gap-2 col-md-6 mx-auto">

                <!-- 問題集一覧へ戻る -->
                <a href="{{ route('make_question_group.list') }}"
                class="btn btn-light border rounded-pill w-100">一覧に戻る</a>

            </div>
        </div>

    </section>


    <!-- 問題追加ボタン -->
    <a id="addQuestion" href="{{route('make_question.create',$question_group)}}" class="d-block text-decoration-none">
        <div class="icon text-white bg-info shadow">
            <i class="bi bi-plus"></i>
        </div>
        <div class="text-secondary text-center w-100">問題の追加</div>
    </a>

@endsection
