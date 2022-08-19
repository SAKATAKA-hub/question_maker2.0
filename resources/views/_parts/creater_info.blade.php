<div class="">
    <!-- ユーザーネーム -->
    <div class="d-flex align-items-center ps-2">
        <div class="user-image border border-1 ratio ratio-1x1 mb-1" style="
        background:url({{ asset('storage/'.$creater_user->image_puth) }});
        background-repeat  : no-repeat;
        background-size    : cover;
        background-position: center center;
        width:20%; border-radius:50%;
        "></div>
        <div class="text-center ms-3">
            <h5>{{$creater_user->name}}</h5>
        </div>
    </div>


    <!-- 三点セット -->
    <div class="row mb-1">
        <div class="col p-0 text-center">
            <a href="{{route('creater.questin_group_list',$creater_user->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-card-checklist"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">公開問題</p>
                <h5 class="text-info mb-0">10000</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="{{route('creater.follower_list',$creater_user->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-people-fill"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロワー</p>
                <h5 class="text-info mb-0">10000</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="{{route('creater.follow_creater_list',$creater_user->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-person-heart"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロー中</p>
                <h5 class="text-info mb-0">10000</h5>
            </a>
        </div>
    </div>

    <!-- フォローボタン -->
    <div class="mb-3">
        <button class="btn btn-success btn-sm">フォローする</button>
    </div>

    <!-- 自己紹介 -->
    <div class="card border-1 card-body mb-3">
        <p class="text-secondary" style="font-size:.6rem">自己紹介</p>
        <p>
            hogehogehogehoge <br>
            hogehogehogehoge <br>
            hogehogehogehoge <br>

        </p>
    </div>

    <!-- メニューリスト -->
    <div class="card">
        @include('_parts.user_menu')
    </div>

</div>
