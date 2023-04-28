<div class="">

    @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


    <!-- ユーザーネーム -->
    <div class="d-flex align-items-center ps-2">
        <div class="">
            <div class="user-image border border-1 ratio ratio-1x1 mb-1" style="
            background:url({{ asset('storage/'. Auth::user()->image_puth) }});
            background-repeat  : no-repeat;
            background-size    : cover;
            background-position: center center;
            width:4rem; border-radius:50%;
            "></div>
        </div>

        <h6 class="m-0 ms-3">{{ Auth::user()->name}}</h6>
    </div>


    <!-- 三点セット -->
    <div class="row mb-1">
        <div class="col p-0 text-center">
            <a href="{{route('creater', Auth::user()->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-card-checklist"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">公開中</p>
                <h5 class="text-info mb-0">{{  Auth::user()->public_question_groups->count() }}</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="{{route('creater.follower_list', Auth::user()->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-people-fill"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロワー</p>
                <h5 class="text-info mb-0">{{ count(  Auth::user()->follower_users ) }}</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="{{route('creater.follow_creater_list', Auth::user()->id)}}"
            class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-person-heart"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロー中</p>
                <h5 class="text-info mb-0">{{ count(  Auth::user()->follow_creators ) }}</h5>
            </a>
        </div>
    </div>



    <!-- シェアボタン -->
    <div class="mb-3">
        @php $route = route('creater', Auth::user()->id ); @endphp

        <div class="d-flex align-items-center">
            <span class="badge rounded-pill bg-success me-1">
                <i class="bi bi-share"></i>
            </span>
            <span>{{'公開中ページをシェアしよう！'}}</span>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-2">

            <a href="http://www.facebook.com/share.php?u={{ $route }}" target="_blank"
            class="btn btn-sm py-0 text-white" style="background-color:#3578E5; border-color:#3578E5;"
            >
                <div class="d-flex align-items-center h-100">
                    <span class="">facebook</span>
                </div>
            </a>

            <a href="http://twitter.com/share?text={{  Auth::user()->profile_text }}&url={{ $route }}" rel="nofollow"
            class="btn btn-sm py-0 text-white" style="background-color:#1DA1F2; border-color:#1DA1F2;"  target="_blank"
            >
                <div class="d-flex align-items-center h-100">
                    <span class="">twitter</span>
                </div>
            </a>

            <a href="https://social-plugins.line.me/lineit/share?url={{ $route }}" target="_blank"
            class="btn btn-sm py-0 text-white" style="background-color:#01ba01; border-color:#01ba01;"
            >
                <div class="d-flex align-items-center h-100">
                    <span class="">LINE</span>
                </div>
            </a>


            <url-copy-component copy_url="{{ $route }}"></url-copy-component>
        </div>
    </div>


    <!-- フォローボタン -->
    @if ( $user_id!= Auth::user()->id)
        <div class="mb-3">
            <keep-creator-user-component
            user_id="{{$user_id}}" creater_user_id="{{ Auth::user()->id}}"
            keep="{{\App\Models\KeepCreatorUser::isKeep($user_id,  Auth::user()->id)}}"
            route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>
        </div>
    @endif


    <!-- 自己紹介 -->
    <div class="card border-1 card-body py-2 mb-3">
        <p class="text-secondary mb-0" style="font-size:.6rem">自己紹介</p>

        <!--mobile text-->
        <div class="d-md-none">
            <short-text-component  text="{{  Auth::user()->profile_text }}"></short-text-component>
        </div>
        <!--pc text-->
        <div class="d-none d-md-block">
            <replace-text-component text="{{  Auth::user()->profile_text }}"></replace-text-component>
        </div>
    </div>


    @if ( $user_id ==  Auth::user()->id)
        <!-- メニューリスト -->
        <div class="card d-none d-md-block">
            @include('_parts.user_menu')
        </div>

    @endif
</div>
