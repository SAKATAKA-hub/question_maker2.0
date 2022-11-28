{{-- advertisement.blade --}}
@php
$advertisements = [
    [
        'title'=>'パスワード自動生成ツール -Password Maker-', 'img'=>asset('storage/site/image/tools/password_maker.png'), 'url'=>'https://tosuma-tools.net/password_maker',
        'body'=>'自動的にランダムなパスワードを、お好みで複数個生成します。-WEBから無料で使える、便利なお役立ちツール-',
    ],
    [
        'title'=>'文字数自動カウントツール -Moji Counter-', 'img'=>asset('storage/site/image/tools/string_counter.png'), 'url'=>'https://tosuma-tools.net/string_counter',
        'body'=>'自動的に入力文字数を計測します。-WEBから無料で使える、便利なお役立ちツール-',
    ],
    [
        'title'=>'IPアドレス確認チェックツール -IP Address Checker-', 'img'=>asset('storage/site/image/tools/ipaddress_checker.png'), 'url'=>'https://tosuma-tools.net/ipaddress_checker',
        'body'=>'お使いのディバイスのIPアドレスなどの情報を表示します。-WEBから無料で使える、便利なお役立ちツール-',
    ],

];
@endphp
@foreach ($advertisements as $advertisement)
<a  href="javascript:void(0)" onclick="window.open( '{{$advertisement['url']}}' )" class="d-block text-decoration-none text-dark mb-3">
    <div class="question_group_card card p-1 overflow-hidden list-group-item-action border-0 shadow">
        <div class="d-flex gap-3">


            <div class="col-3">
                <div class="d-flex  align-items-center h-100">

                    <!-- サムネ画像 -->
                    <div class="ratio d-none d-sm-block" style="
                        height:150px;
                        background: no-repeat center center / cover;
                        background-image:url({{ $advertisement['img'] }});
                        border-radius:.25rem;
                    "></div>
                    <div class="ratio h-100 d-sm-none" style="
                        background: no-repeat center center / cover;
                        background-image:url({{ $advertisement['img'] }});
                        border-radius:.25rem;
                    "></div>
                </div>
            </div>
            <div class="col-9 py-2 pe-5 question-card-text">

                <!-- タイトル -->
                <h5 class="d-none d-md-block text-truncate fw-bold">{{ $advertisement['title'] }}</h5>
                <div class="d-md-none text-truncate fw-bold">{{ $advertisement['title'] }}</div>

                <!-- 説明文 -->
                <div class="w-100 mt-3">
                    <div class="col-12 text-truncate w-100">
                        {{ $advertisement['body'] }}
                    </div>
                </div>

            </div>


        </div>
    </div>
</a>
@endforeach
