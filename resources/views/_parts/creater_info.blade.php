<div class="">
    <!-- ユーザーネーム -->
    <div class="d-flex align-items-center ps-2">
        <div class="user-image border border-1 ratio ratio-1x1 mb-1" style="
        background:url({{ asset('storage/'.$creater_user->image_puth) }});
        background-repeat  : no-repeat;
        background-size    : cover;
        background-position: center center;
        width:50px; border-radius:50%;
        "></div>
        <div class="ms-3">
            <p class="text-secondary mb-0" style="font-size:.6rem">クリエイター</p>
            <h5>{{$creater_user->name}}</h5>
        </div>
    </div>


    <!-- 三点セット -->
    <div class="row mb-1">
        <div class="col p-0 text-center">
            <a href="{{route('creater',$creater_user->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-card-checklist"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">公開問題集</p>
                <h5 class="text-info mb-0">{{ $creater_user->public_question_groups->count() }}</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="{{route('creater.follower_list',$creater_user->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-people-fill"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロワー</p>
                <h5 class="text-info mb-0">{{ count( $creater_user->follower_users ) }}</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="{{route('creater.follow_creater_list',$creater_user->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-person-heart"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロー中</p>
                <h5 class="text-info mb-0">{{ count( $creater_user->follow_creators ) }}</h5>
            </a>
        </div>
    </div>

    <!-- フォローボタン -->

    <div class="mb-3">
        @if  (Auth::check() )
            <keep-creator-user-component
            user_id="{{Auth::user()->id}}" creater_user_id="{{$creater_user->id}}"
            keep="{{ \App\Models\KeepCreatorUser::where('user_id',Auth::user()->id)->where('creater_user_id',$creater_user->id)->first()->keep }}"
            route="{{route('keep_creator_user.api')}}"/>
        @endif
    </div>

    <!-- 自己紹介 -->
    <div class="card border-1 card-body mb-3">
        <p class="text-secondary" style="font-size:.6rem">自己紹介</p>
        <p>
            {!! nl2br( e($creater_user->profile) ) !!}
        </p>
    </div>

    <!-- メニューリスト -->
    {{-- <div class="card">
        @include('_parts.user_menu')
    </div> --}}

</div>
