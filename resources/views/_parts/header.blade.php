<nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home')}} ">
            <strong class="text-success"> {{ env('APP_NAME') }}</strong>
        </a>


        <ul class="navbar-nav ms-auto p-0 gap-2 my-2">

            <li class="nav-item me-3">
                <a class="btn border fw-bold" style="font-size:.6rem; border-radius: 1rem;"
                data-bs-toggle="offcanvas" data-bs-target="#seachOffcanvas" aria-controls="seachOffcanvas"
                href="{{ route('user_auth.register_form') }}">
                    <i class="bi bi-search"></i>
                    <span class="ms-2">問題集を検索</span>
                </a>
            </li>


            @if ( Auth::check() )
                <!-- PC -->
                <li class="nav-item dropdown d-none d-md-block">
                    <div class="d-flex align-items-center h-100">
                        <a class="nav-link dropdown-toggle p-0  d-inline-block" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-image border ratio ratio-1x1 d-inline-block" style="
                            background:url({{ asset('storage/'. Auth::user()->image_puth ) }}) no-repeat center center /cover;
                            width:1.2rem; border-radius:50%; transform: translateY(3px);
                            "></div>

                            {{ Auth::user()->name.' さん' }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:280px; left:auto; right:0;">
                            @include('_parts.user_menu')
                        </div>
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


<!-- 検索ボックス　offcanpas -->
<div class="offcanvas offcanvas-top" tabindex="-1" style="height: 6rem;"
id="seachOffcanvas" aria-labelledby="seachOffcanvasLabel">
    <div class="offcanvas-header">
      {{-- <h5 id="seachOffcanvasLabel">Offcanvas top</h5> --}}

        <div class="col me-3">
            <!-- 検索フォーム -->
            <form action="{{ route('questions_search_list') }}">
                <div  class="input-group overflow-hidden border" style="border-radius:2rem;">

                    @php  $order = isset($order) ? $order : 'published_at,desc'; @endphp
                    <span class="input-group-text">
                        <select class="form-select border-0" name="order" id="inputGroupSelect04" aria-label="Example select with button addon">
                            <option value="published_at,desc" {{$order=='published_at,desc' ? 'selected' : ''}}
                            >新着順</option>
                            <option value="published_at,asc"  {{$order=='published_at,asc'  ? 'selected' : ''}}
                            >古い順</option>
                            <option value="evaluation_points,desc" {{$order=='evaluation_points,desc' ? 'selected' : ''}}
                            >高評価</option>
                            <option value="accessed_count,desc" {{$order=='accessed_count,desc' ? 'selected' : ''}}
                            >受検者多</option>
                            <option value="accessed_count,asc"  {{$order=='accessed_count,asc' ? 'selected' : ''}}
                            >受検者少</option>
                            <option value="average_score,asc" {{$order=='average_score,asc' ? 'selected' : ''}}
                            >難しい</option>
                            <option value="average_score,desc"  {{$order=='average_score,desc' ? 'selected' : ''}}
                            >かんたん</option>
                        </select>
                    </span>

                    <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
                    value="@if ( isset($keywords) && $keywords==' '  ){{  $keywords.' '  }}@endif" placeholder="キーワード" aria-label="SeachKeywords" aria-describedby="basic-addon1">

                    <span class="input-group-text bg-white border-0" id="basic-addon1">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </span>
                </div>
            </form>
        </div>


      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
</div>



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
