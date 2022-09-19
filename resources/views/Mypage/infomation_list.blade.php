@extends('layouts.base')


<!----- title ----->
@section('title', '通知一覧' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-success">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '通知一覧' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    <section>
        <div class="container-1200 my-5">
            <div class="d-md-flex">

                <!-- サイドコンテンツ[pc] -->
                <div class="d-none d-md-block  pe-3" style="width:300px;">
                    @include('_parts.user_info')
                </div>


                <!-- 中央コンテンツ -->
                <div class="flex-fill">

                    @if( false )

                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <!--[フォロワー画像]-->
                                <div class="col-auto">
                                    <div class="user-image border border-1 ratio ratio-1x1 mb-1" style="
                                        background:url({{ asset('storage/'.$creater_user->image_puth) }});
                                        background-repeat  : no-repeat;
                                        background-size    : cover;
                                        background-position: center center;
                                        width:50px; border-radius:50%;
                                    "></div>
                                </div>

                                <!--[フォロワー名前]-->
                                <div class="col">
                                    <div class="d-flex align-items-center h-100">
                                        <h5 class="mb-0">{{Auth::user()->name}}</h5>
                                    </div>
                                </div>

                                <!--[フォローボタン]-->
                                <div class="col-auto">
                                    <div class="d-flex align-items-center h-100">
                                        <button class="btn btn-outline-success btn-sm">フォロー中</button>
                                    </div>
                                </div>
                            </li>
                        </ul>


                    @else

                        <div class="h2 text-secondary text-center py-5">
                            ここに通知連絡が表示されます。
                        </div>

                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection



