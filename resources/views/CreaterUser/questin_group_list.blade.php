@extends('layouts.base')


<!----- title ----->
@section('title', '公開中の問題集' )

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('creater',$creater_user->id)}}" class="text-success">
    クリエイターページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ '公開中の問題集' }}
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


                <!-- サイドコンテンツ -->
                <div class="  pe-3" style="min-width:300px;">
                    @include('_parts.creater_info')
                </div>




                <!-- 中央コンテンツ -->
                <div class="flex-fill">


                    @if ( $question_groups->count() )

                        <!-- 問題集リスト・ページネーション use_param[$question_groups] -->
                        @php $list_sm = true; @endphp
                        @include('_parts.question_groups_icon_list')

                    @else

                        <div class="h2 text-secondary text-center py-5">
                            現在、公開中の問題はありません。
                        </div>

                    @endif



                </div>
            </div>
        </div>
    </section>
@endsection



