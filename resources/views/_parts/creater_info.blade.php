<div class="">

    @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


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
    @if ( $user_id!=$creater_user->id)
        <div class="mb-3">
            <keep-creator-user-component
            user_id="{{$user_id}}" creater_user_id="{{$creater_user->id}}"
            keep="{{\App\Models\KeepCreatorUser::isKeep($user_id, $creater_user->id)}}"
            route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>
        </div>
    @endif


    <!-- 自己紹介 -->
    <div class="card border-1 card-body mb-3">
        <p class="text-secondary" style="font-size:.6rem">自己紹介</p>
        <p>
            {!! nl2br( e($creater_user->profile_text) ) !!}
        </p>
    </div>


    @if ( $user_id == $creater_user->id)
            <!-- メニューリスト -->
        <div class="card d-none d-md-block">
            @include('_parts.user_menu')
        </div>

    @endif


</div>
