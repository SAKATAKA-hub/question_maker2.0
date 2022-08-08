<nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home')}} ">
            <strong class="text-success"> {{ env('APP_NAME') }}</strong>
        </a>

        <ul class="navbar-nav ms-auto p-0 gap-2 my-2">
            @if ( Auth::check() )
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name.' さん' }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                    </ul>
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
