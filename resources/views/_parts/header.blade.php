<nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">
    <div class="container-fluid">

        <h1 class="m-0 d-flex align-items-center">
            <!--PC-->
            <a class="navbar-brand d-none d-md-block  anm_top_s01"
            href="{{ route('home')}} ">
                <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="もんだいDIY - mondai DIY - オリジナル問題集が自由に作れる！無料の問題作成ツール"  style="height:3rem;">
            </a>
            <!--movile-->
            <a class="navbar-brand d-md-none  anm_top_s01" href="{{ route('home')}} ">
                <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="もんだいDIY - mondai DIY - オリジナル問題集が自由に作れる！無料の問題作成ツール"  style="height:2rem;">
            </a>
        </h1>



        <ul class="navbar-nav ms-auto p-0 gap-2 my-2">

            <li class="nav-item anm_top_s01">
                <a class="btn border fw-bold" style="font-size:.6rem; border-radius: 1.1rem; padding:.5rem 11px;"
                data-bs-toggle="offcanvas" data-bs-target="#seachOffcanvas" aria-controls="seachOffcanvas"
                >
                    <i class="bi bi-search"></i>
                    <span class="ms-2 d-none d-md-inline">問題集検索</span>
                </a>
            </li>


            @if ( Auth::check() )
                <!-- PC -->
                <li class="nav-item dropdown d-none d-md-block">
                        <a class="nav-link p-0  d-inline-block" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">

                            <div class="d-flex align-items-center h-100">
                                <div class="user-image border ratio ratio-1x1 d-inline-block" style="
                                background:url({{ asset('storage/'. Auth::user()->image_puth ) }}) no-repeat center center /cover;
                                width:2rem; border-radius:50%;
                                "></div>

                                @php $user_name = mb_strlen(Auth::user()->name ) > 14 ? mb_substr(Auth::user()->name,0,14).'...' : Auth::user()->name; @endphp
                                <span class="ms-1">{{ $user_name.' さん' }}</span>
                            </div>

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:280px; left:auto; right:0;">
                            @include('_parts.user_menu')
                        </div>
                    {{-- </div> --}}

                </li>
                <!-- mobile -->
                <li class="d-md-none">
                    <a class=""
                    data-bs-toggle="offcanvas" href="#offcanvasHeaderUserMenu" role="button" aria-controls="offcanvasHeaderUserMenu"
                    >
                        <!--[user image]-->
                        <div class="user-image border ratio ratio-1x1 d-inline-block" style="
                        background:url({{ asset('storage/'. Auth::user()->image_puth ) }}) no-repeat center center /cover;
                        width:2.2rem; border-radius:50%;
                        "></div>


                    </a>
                </li>
            @else
                <li class="nav-item"><a class="btn btn-warning" style="font-size:.6rem; " href="{{ route('user_auth.login_method_choosing') }}"
                >会員登録</a></li>
                <li class="nav-item"><a class="btn btn-success" style="font-size:.6rem; text-decoration:none;" href="{{ route('user_auth.login_form') }}"
                >ログイン</a></li>
            @endif
        </ul>
    </div>
</nav>


<!-- 検索ボックス　offcanpas -->
<div class="offcanvas offcanvas-top" tabindex="-1" style="height: 12rem;"
id="seachOffcanvas" aria-labelledby="seachOffcanvasLabel">
    <form action="{{ route('questions_search_list') }}">


        <div class="offcanvas-body">
            <!--title-->
            <div class="mx-auto mb-3  position-relative" style="max-width:1200px;">
                <h5 class="offcanvas-title">問題集検索</h5>
                <div class="p-3 position-absolute top-0 end-0">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
            <!--body-->
            <div class="mx-auto mb-3" style="max-width:1200px;">

                <!-- 順序入れ替え -->
                @php  $order = isset($order) ? $order : 'published_at,desc'; @endphp
                <div class="col-6 col-md-3 mb-2">
                    <select class="form-select border" name="order" style="font-size:11px;"
                    id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option value="published_at,desc" {{$order=='published_at,desc' ? 'selected' : ''}}
                        >新着順</option>
                        <option value="published_at,asc"  {{$order=='published_at,asc'  ? 'selected' : ''}}
                        >古い順</option>
                        <option value="accessed_count,desc" {{$order=='accessed_count,desc' ? 'selected' : ''}}
                        >受検者数多い順</option>
                        <option value="accessed_count,asc"  {{$order=='accessed_count,asc' ? 'selected' : ''}}
                        >受検者数少ない順</option>
                        <option value="average_score,asc" {{$order=='average_score,asc' ? 'selected' : ''}}
                        >難しい</option>
                        <option value="average_score,desc"  {{$order=='average_score,desc' ? 'selected' : ''}}
                        >やさしい</option>
                    </select>
                </div>

                <!-- 検索フォーム -->
                <div class="col-md-12">
                    <div  class="input-group overflow-hidden border" style="border-radius:1.6rem;">
                        <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
                        value="{{ isset($keywords) ? $keywords.' ' : '' }}" placeholder="キーワード" aria-label="SeachKeywords" aria-describedby="basic-addon1">
                        <span class="py-0 input-group-text bg-success border-0" id="basic-addon1">
                            <button type="submit" class="btn btn-sm text-white fs-5"><i class="bi bi-search"></i></button>
                        </span>
                    </div>
                </div>

            </div>
        </div>

    </form>
</div>


@if ( Auth::check() )
<!-- mobileユーザーメニュー offcanvas -->
<div class="offcanvas offcanvas-end" style="max-width: 90vw;"
tabindex="-1" id="offcanvasHeaderUserMenu" aria-labelledby="offcanvasHeaderUserMenuLabel">

    <div class="offcanvas-header align-items-center">
        <h5 class="mb-0 text-success"><i class="bi bi-person-fill"></i>マイメニュー</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <!-- user_menu -->
        @include('_parts.user_info')

        <!-- マイページメニューリスト -->
        <div class="card border-1 ">
            @include('_parts.user_menu')
        </div>


    </div>
</div>
@endif


<!-- Bottom menu(mobile) -->
<ul class="nav justify-content-between  d-md-none text-center text-white w-100 position-fixed bottom-0"
style="z-index:10; background-color:rgb(20 207 160 / 90%);">
    <li class="nav-item" style="flex:1;">
        <a class="text-decoration-none text-white " aria-current="page" href="{{ route('home')}}">
            <div class="fs-2"><i class="bi bi-house-door-fill"></i></div>
            <div class="text-" style="font-size:10px;">Home</div>
        </a>
    </li>
    <li class="nav-item" style="flex:1;">
        <a class="text-decoration-none text-white " aria-current="page"
        data-bs-toggle="offcanvas" data-bs-target="#seachOffcanvas" aria-controls="seachOffcanvas"
        href="#">
            <div class="fs-2"><i class="bi bi-search"></i></div>
            <div class="text-" style="font-size:10px;">検　索</div>
        </a>
    </li>
    <li class="nav-item" style="flex:1;">
        <a class="text-decoration-none text-white " aria-current="page" href="{{route('footer_menu.news')}}">
            <div class="fs-2"><i class="bi bi-bell"></i></div>
            <div class="text-" style="font-size:10px;">お知らせ</div>
        </a>
    </li>
    @if ( Auth::check() )
    <li class="nav-item" style="flex:1;">
        <a class="text-decoration-none text-white " aria-current="page"
        data-bs-toggle="offcanvas" href="#offcanvasHeaderUserMenu" role="button" aria-controls="offcanvasHeaderUserMenu"
        >
            <div class="fs-2"><i class="bi bi-person-fill"></i></div>
            <div class="text-" style="font-size:10px;">マイメニュー</div>
        </a>
    </li>
    @else
    <li class="nav-item" style="flex:1;">
        <a class="text-decoration-none text-white " aria-current="page" href="{{ route('user_auth.login_form')}}">
            <div class="fs-2"><i class="bi bi-box-arrow-in-right"></i></div>
            <div class="text-" style="font-size:10px;">ログイン</div>
        </a>
    </li>
    @endif
</ul>
