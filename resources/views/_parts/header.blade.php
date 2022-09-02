<nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home')}} ">
            <strong class="text-success"> {{ env('APP_NAME') }}</strong>
        </a>

        <ul class="navbar-nav ms-auto p-0 gap-2 my-2">
            @if ( Auth::check() )

                <!-- PC -->
                <li class="nav-item dropdown d-none d-md-block">
                    <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="user-image border ratio ratio-1x1 d-inline-block" style="
                        background:url({{ asset('storage/'. Auth::user()->image_puth ) }}) no-repeat center center /cover;
                        width:1.2rem; border-radius:50%; transform: translateY(3px);
                        "></div>

                        {{ Auth::user()->name.' さん' }}
                    </a>
                    {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#"
                        >マイページ</a></li>
                        <li><a class="dropdown-item" href="{{route('results.list')}}"
                        >成績を見る</a></li>
                        <li><a class="dropdown-item" href="{{route('make_question_group.list')}}"
                        >問題を作る</a></li>
                        <li><a class="dropdown-item" href="#"
                        >プロフィール</a></li>
                        <li><a class="dropdown-item" href="#"
                        >設設定変更</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('user_auth.logout') }}"
                        >ログアウト</a></li>
                    </ul> --}}
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:280px; left:auto; right:0;">
                        @include('_parts.user_menu')
                    </div>
                </li>
                <!-- mobile -->
                <li class="d-md-none">
                    <a class=""
                    data-bs-toggle="offcanvas" href="#offcanvasHeaderUserMenu" role="button" aria-controls="offcanvasHeaderUserMenu"
                    >
                        <!--[user image]-->
                        <div class="user-image border ratio ratio-1x1 d-inline-block" style="
                        background:url({{ asset('storage/'. Auth::user()->image_puth ) }}) no-repeat center center /cover;
                        width:1.8rem; border-radius:50%; transform: translateY(3px);
                        "></div>


                    </a>
                </li>
            @else
                <li class="nav-item"><a class="btn btn-warning" style="font-size:.6rem; " href="{{ route('user_auth.register_form') }}"
                >会員登録</a></li>
                <li class="nav-item"><a class="btn btn-success" style="font-size:.6rem; text-decoration:none;" href="{{ route('user_auth.login_form') }}"
                >ログイン</a></li>
            @endif
        </ul>
    </div>
</nav>



@if ( Auth::check() )
<!-- mobileユーザーメニュー offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasHeaderUserMenu" aria-labelledby="offcanvasHeaderUserMenuLabel">
    <div class="offcanvas-header bg-light">

        <button type="button" class="btn btn-sm px-1 py-0" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-arrow-left fs-5"></i>
        </button>

    </div>
    <div class="offcanvas-body">
        <!-- user_menu -->
        @include('_parts.user_info')
    </div>
</div>
@endif
