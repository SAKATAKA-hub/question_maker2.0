<div class="">

    <div class="question_group_card card p-1 overflow-hidden list-group-item-action border-0 shadow mb-3 " style="cursor:pointer;"
    data-bs-toggle="modal" data-bs-target="#questionModal{{ $question_group->id +1 }}"
    >
        <div class="d-flex gap-3">
            <div class="col-3">
                <div class="d-flex  align-items-center h-100">

                    <!-- サムネ画像 -->
                    <div class="ratio d-none d-md-block" style="
                        height:150px;
                        background: no-repeat center center / cover;
                        background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                        border-radius:.25rem;
                    "></div>
                    <div class="ratio h-100 d-md-none" style="
                        background: no-repeat center center / cover;
                        background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                        border-radius:.25rem;
                    "></div>

                </div>
            </div>
            <div class="col-9 py-2 pe-5 question-card-text">

                <!-- タイトル -->
                <h5 class="d-none d-md-block text-truncate fw-bold">{{ $question_group->title }}</h5>
                <div class="d-md-none text-truncate fw-bold">{{ $question_group->title }}</div>

                <!-- 作成者情報 -->
                <div class="">
                    <div class="d-flex align-items-center">
                        <div class="user-image border ratio ratio-1x1 me-2" style="
                            background: no-repeat center center / cover;
                            background-image:url({{ asset('storage/'.$question_group->user->image_puth) }});
                            width:1.2rem; border-radius:50%;
                        "></div>

                        @php $user_name = mb_strlen($question_group->user->name ) > 14 ? mb_substr($question_group->user->name,0,14).'...' : $question_group->user->name; @endphp
                        <span class="">{{ $user_name }}</span>
                    </div>
                </div>

                <div class="">
                    <!-- 公開日(0日前) -->
                    <span class="text-muted">{{$question_group->befor_datetime_text}}</span>
                    <!-- 受験回数 -->
                    <span class="text-muted">-回数{{$question_group->accessed_count}}</span>

                    <!-- 問題数 -->
                    <span class="text-muted">-全{{$question_group->question_count}}問</span>
                    <!-- 制限時間 -->
                    <span class="text-muted d-none d-md-inline">-<i class="bi bi-stopwatch"></i>{{$question_group->time_limit_text}}</span>
                    <!-- 平均点 -->
                    <span class="text-muted">-平均{{$question_group->average_score}}点</span>
                </div>

                <!-- 説明文 -->
                <div class="d-none d-md-block w-100">
                    <div class="col-12 w-100">
                        {{ $question_group->resume_text_truncate }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



    <!-- Modal -->
    <div class="modal fade" id="questionModal{{ $question_group->id +1 }}" tabindex="-1" aria-labelledby="questionModal{{ $question_group->id +1 }}Label" aria-hidden="true">
        <div class="modal-dialog px-3">
            <div class="modal-content">
                <!-- [ Modal-Header ] -->
                <div class="modal-header">
                    <div class="w-100">

                        <!-- サムネ画像 -->
                        <div class="ratio ratio-16x9" style="
                            background: no-repeat center center / cover;
                            background-image:url({{ asset('storage/'.$question_group->image_puth) }});
                            border-radius: .5rem;
                        "></div>


                        <div class="d-flex">
                            <div class="col">
                                <!-- タイトル -->
                                <h4 class="modal-title mb-0" id="questionModal{{ $question_group->id +1 }}Label">
                                    {{ $question_group->title }}
                                </h4>
                                <!-- タグ -->
                                <div class="">
                                    @if ($question_group->tags)
                                    <div class="d-flex gap-1 align-items-center flex-wrap">
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
                            <div class="col-auto">
                                <!-- いいねボタン -->
                                <keep-question-group-component
                                user_id="{{$user_id}}" question_group_id="{{$question_group->id}}"
                                keep="{{\App\Models\KeepQuestionGroup::isKeep($user_id, $question_group->id)}}"
                                route="{{route('keep_question_group.api')}}"
                                ></keep-question-group-component>
                            </div>
                        </div>


                    </div><!--end w-100 -->
                </div><!--end modal-header-->


                <!-- [ 作成者情報 ] -->
                <div class=" border-bottom">
                    <div class="d-flex px-3">
                        <div class="col text-truncate">
                            <a href="{{route('creater',$question_group->user->id)}}" class="btn ps-0 w-100 list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="user-image border ratio ratio-1x1 me-2" style="
                                    background: no-repeat center center / cover;
                                    background-image:url({{ asset('storage/'.$question_group->user->image_puth) }});
                                    width:1.8rem; border-radius:50%;
                                    "></div>
                                    <span class="text-truncate m-0">
                                        {{$question_group->user->name}}
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto h-100">
                            <div class="py-2">

                                <!-- フォローボタン -->
                                <keep-creator-user-component user_id="{{$user_id}}" creater_user_id="{{$question_group->user->id}}"
                                keep="{{\App\Models\KeepCreatorUser::isKeep($user_id, $question_group->user->id)}}"
                                route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- [ シェアボタン ] -->
                <div class="modal-body">
                    @include('_parts.share_group')
                </div>


                <!-- [ 基本情報 ] -->
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="col-4 ps-3 bg-light">公開日</div>
                        <div class="col-8 ps-3">{{\Carbon\Carbon::parse( $question_group->published_at )->format('Y年m月d日 H:i')}}</div>
                    </div>
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



                <!-- [ 問題集の説明 ] -->
                @if ( $question_group->resume_text )
                    <div class="modal-body">
                        <div class="card card-body">
                            <short-text-component  text="{{ $question_group->resume_text }}"></short-text-component>
                        </div>
                    </div>
                @endif


                <div class="modal-body fw-bold">

                    <div class="mb-3">この問題に挑戦しますか？</div>


                    <div class="row g-3">
                        <div class="col-12">
                            @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
                            <a href="{{ route('play_question', $param ) }}" class="btn btn-lg rounded-pill fs-5 btn-success w-100"
                            >挑戦する！</a>
                        </div>
                        <div class="col">
                            <button type="button" class="btn text-secondary w-100" data-bs-dismiss="modal"
                            ><i class="bi bi-x"></i>閉じる</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                </div>
            </div>
        </div>
    </div>



