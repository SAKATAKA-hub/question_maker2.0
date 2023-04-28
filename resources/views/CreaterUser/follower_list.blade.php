@extends('layouts.base_02col_createruser')


<!----- title ----->
@php $creater_user_name = mb_strlen($creater_user->name ) > 8 ? mb_substr($creater_user->name,0,8).'...' : $creater_user->name; @endphp
@section('title', $creater_user_name.'さん　フォロワー' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('creater',$creater_user->id)}}" class="text-success">
    {{$creater_user_name.'さん'}}
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ 'フォロワー' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
<meta name="csrf_token" content="{{ csrf_token() }}">
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <!--
     // Please Login Modal //
     利用：フォローボタン・いいねボタン・通報ボタン・コメントコンポーネント
    -->
    <please-login-modal-component login_form_route="{{ route('user_auth.login_form') }}"
    ></please-login-modal-component>
    @php $user_id = Auth::check() ? Auth::user()->id : '' ; @endphp


    <section>
        <ul class="list-group">
            @forelse ($creater_user->follower_users as $follower_user)

                <li class="list-group-item" >
                    <div class="row">
                        <!--[フォロワー画像]-->
                        <div class="col-auto">
                            <div class="user-image border border-1 ratio ratio-1x1 mb-1" style="
                            background:url({{ asset('storage/'.$follower_user->image_puth) }});
                            background-repeat  : no-repeat;
                            background-size    : cover;
                            background-position: center center;
                            width:2rem; border-radius:50%;
                            "></div>
                        </div>


                        <div class="col">
                            <div class="d-flex align-items-center h-100">
                                <!--[フォロワー名前]-->
                                <h5 class="mb-0 fs-6">
                                    <a href="{{route('creater',$follower_user->id)}}" class="text-decoration-none text-success">
                                        {{$follower_user->name}}
                                    </a>
                                </h5>
                            </div>
                        </div>

                        <!--[フォローボタン]-->
                        <div class="col-auto">
                            <div class="d-flex align-items-center h-100">

                                <!--[フォローボタン]-->
                                <keep-creator-user-component
                                user_id="{{$user_id}}" creater_user_id="{{$follower_user->id}}"
                                keep="{{\App\Models\KeepCreatorUser::isKeep($user_id, $follower_user->id)}}"
                                route="{{route('keep_creator_user.api')}}"></keep-creator-user-component>


                                <div class="d-none d-lg-flex">

                                    <!--[公開問題集数]-->
                                    <div class="d-flex align-items-center ms-3">
                                        <h3 class="mb-0 me-2"><i class="bi bi-card-checklist"></i></h3>
                                        <h5 class="text-info mb-0">{{ $follower_user->public_question_groups->count() }}</h5>
                                    </div>

                                    <!--[フォロアー数]-->
                                    <div class="d-flex align-items-center ms-3">
                                        <h3 class="mb-0 me-2"><i class="bi bi-people-fill"></i></h3>
                                        <h5 class="text-info mb-0">{{ count( $follower_user->follower_users ) }}</h5>
                                    </div>

                                    <!--[フォロー数]-->
                                    <div class="d-flex align-items-center ms-3">
                                        <h3 class="mb-0 me-2"><i class="bi bi-person-heart"></i></h3>
                                        <h5 class="text-info mb-0">{{ count( $follower_user->follow_creators ) }}</h5>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </li>

            @empty
                <li class="list-group-item  border-0">
                    <h2 class="text-secondary text-center py-5">
                        ここにフォロワーが表示されます。
                    </h2>
                </li>
            @endforelse


        </ul>
    </section>
@endsection



