@extends('layouts.base')


<!----- title ----->
@section('title','プライバシーポリシー個人情報利用方針')

<!----- breadcrumb ----->
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page">
    {{ 'プライバシーポリシー個人情報利用方針' }}
</li>
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
<link href="{{ asset('css/privacy_policy.css') }}" rel="stylesheet">
<style>
    main{ background: rgba(92, 240, 203, 0.5);}
</style>
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
<section>
    <div class="container-1200 bg-white">
        <div class="pb-5">

            <!-- [ 見出し ] -->
            <div class="mb-3">
                {{env('COMPANY_NAME')}}（以下「当社」）は、当社が運営するサービス（以下「当社サービス」といいます）をユーザーにご利用いただくにあたり、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識と取組みを徹底させることにより、個人情報の保護・管理を推進いたします。
            </div>


            <!-- [ 本文 ] -->
            <div>
                <div class="mb-3">
                    <h5>１．個人情報の管理</h5>
                    当社は、お客さまの個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、セキュリティシステムの維持・管理体制の整備・社員教育の徹底等の必要な措置を講じるとともに、万一の問題発生時には速やかな是正措置を実施いたします。当社が講じている安全管理措置は、『５．個人情報の安全対策』をご確認下さい。
                </div>

                <div class="mb-3">
                    <h5>２．個人情報の取得方法</h5>
                    当社は、個人情報の取得にあたっては、適法かつ公正な手段によって行い、不正な方法によって取得はいたしません。 <br>
                    個人情報の取得方法は、WEBサイトの画面にて取得いたします。なお、当社へのお客様の個人情報の提供は任意といたします。但し、ご提供いただけない場合には、適切なサービスが提供できないことがございますので、予めご了承ください。                </div>

                <div class="mb-3">
                    <h5>３．個人情報の利用目的</h5>
                    お客さまからお預かりした個人情報は、以下の利用目的に基づいて利用いたします。以下に定めのない目的で個人情報を利用する場合は、あらかじめご本人に確認をとった上で行います。
                    <ol class="original_ol">
                        <li>
                            当サービスのシステムの会員情報の認証、管理、事務連絡および各種システム機能を提供するため                        </li>
                        <li>
                            当サービスに関するメールマガジン等の情報を配信するため                        </li>
                        <li>
                            当社のサービス・商品・人材募集等のご案内のため
                        </li>
                        <li>
                            当社サービスに関するアンケートの依頼のため
                        </li>
                        <li>
                            受託業務に伴い業務委託遂行のため
                        </li>
                        <li>
                            各種お問い合わせへの対応のため
                        </li>
                        <li>
                            当社のサービス向上を目的として、お客様からの問い合わせへの対応履歴を保管するため
                        </li>
                        <li>
                            その他上記に関連・付随する業務
                        </li>
                    </ol>
                </div>


                <div class="mb-3">
                    <h5>４．個人情報の第三者への開示・提供の禁止 </h5>
                    当社は、お客さまよりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。
                    <ol class="original_ol">
                        <li>
                            お客さまの同意がある場合
                        </li>
                        <li>
                            お客さまが希望されるサービスを行なうために当社が業務を委託する業者に対して開示する場合
                        </li>
                        <li>
                            人の生命・身体・財産の保護に必要な場合
                        </li>
                        <li>
                            公衆衛生・児童の健全育成に必要な場合
                        </li>
                        <li>
                            国の機関等の法令の定める事務への協力の場合（税務調査、統計調査等）
                        </li>
                        <li>
                            法令に基づき開示することが必要である場合
                        </li>            </ol>
                </div>

                <div class="mb-3">
                    <h5>５．個人情報の安全対策 </h5>
                    <ol class="original_ol">
                        <li>
                            当社は、個人情報の紛失、破壊、改ざんおよび漏えい等のリスクに対して、個人情報の安全管理が図られるよう、以下のような措置を実施いたします。
                            <ul style="list-style-type: disc;">
                                <li>
                                    個人情報の取扱いに関する規程を制定する
                                </li>
                                <li>
                                    個人情報の取扱いに関する責任者を設置するとともに、個人情報保護法または社内規程に違反している事実または兆候を把握した場合における報告連絡体制を整備する
                                </li>
                                <li>
                                    従業者に対し、個人情報の取扱いに関する留意事項について定期的な教育を実施する
                                </li>
                                <li>
                                    機器等の盗難または紛失等を防止するために適切な措置を講じるとともに、個人情報の削除を適切な方法で行う
                                </li>
                                <li>
                                    アクセス制御を実施し、従業者が取り扱う個人情報の範囲を限定する
                                </li>
                            </ul>
                        </li>

                        <li>
                            当社は、個人情報の取扱いの全部または一部を委託する場合は、委託先において個人情報 の安全管理が図られるよう、必要かつ適切な監督を行います。
                        </li>
                        <li>
                            当社は、個人情報の漏えい等の事故が発生した場合、個人情報保護法および関連するガイ ドラインに則り、監督官庁への報告を行い、監督官庁の指示に従うとともに、再発防止等のために必要な対応を行います。
                        </li>

                    </ol>
                </div>





                <div class="mb-3">
                    <h5>６．ご本人の照会 </h5>
                    お客さまがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。
                </div>





                <div class="mb-3">
                    <h5>７．法令、規範の遵守と見直し</h5>
                    当社は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、本ポリシーの内容を適宜見直し、その改善に努めます。
                </div>





                <div class="mb-3">
                    <h5>８．免責事項</h5>
                    当社サイトにおける各コンテンツは、作成時において充分に注意し、確認した上で掲載しておりますが、その正確性、相当性、完全性などに対して当社及びコンテンツ提供者は責任を負いません。 当該情報に起因するいかなる損害についても当社及びコンテンツ提供者は責任を負いません。 本サイトより得られるいかなる情報も利用者ご自身の判断と責任において利用していただきます。 また、当社サイトからリンクされているサイトの情報についての責任、あるいはその内容から発生するあらゆる問題についての責任は、全てリンク先の管理者が負うものであり、当社ならびに当社サイトへのコンテンツ提供者が責任を負うものではありません。
                </div>





                <div class="mb-3">
                    <h5>９．プライバシーポリシーの改訂について </h5>
                    <ol class="original_ol">
                        <li>当社は、本プライバシーポリシーの内容を適宜見直し、その改善に努めます。 </li>
                        <li>本プライバシーポリシーは、事前の予告なく変更することがあります。 </li>
                        <li>本プライバシーポリシーは、当社が必要と認めた場合に内容を変更することができるものとします。 </li>
                        <li>本プライバシーポリシーの変更は、当サイトに掲載された時点で有効になるものとします。 </li>
                        <li>法令上お客さまの同意が必要となる変更を行う場合は、当社が適当と判断した方法により同意を得るものとします。  </li>
                    </ol>
                </div>

                <div class="mb-3">
                    <h5>１０．個人情報取り扱いに関する連絡先</h5>
                    〒105-0003 東京都港区西新橋1-6-12 アイオス虎ノ門803<br>
                    当社の個人情報の取り扱いに関するご質問やご不明点、苦情、その他のお問い合わせは
                    <a href="javascript:void(0)" onclick="window.open('{{route('footer_menu.contact')}}')">
                        お問い合わせフォーム<i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                    よりご連絡ください。
                </div>

                <div class="mb-3">
                    <h5> １１．SSL（Secure Socket Layer）について</h5>
                    当社のWebサイトはSSLに対応しており、WebブラウザとWebサーバーとの通信を暗号化しています。ユーザーが入力する氏名や住所、電話番号などの個人情報は自動的に暗号化されます。
                </div>

                <div class="mb-3">
                    <h5>１２．cookieについて </h5>
                    cookieとは、WebサーバーからWebブラウザに送信されるデータのことです。Webサーバーがcookieを参照することでユーザーのパソコンを識別でき、効率的に当社Webサイトを利用することができます。当社Webサイトがcookieとして送るファイルは、個人を特定するような情報は含んでおりません。お使いのWebブラウザの設定により、cookieを無効にすることも可能です。当社のWEBサイトには、「クッキー（Cookie）」を利用したページがあります。クッキーとは、WEBサイトにアクセスした際にお客様のコンピューターやスマートデバイスなどのインターネット接続可能な機器上に保存されるファイルや情報のことをいいます。当社が利用しているクッキーの具体例は以下のとおりです。
                </div>


                <div class="mb-3">
                    ■ファーストパーティー・アナリティクスクッキー <br>
                    　これらのクッキーにより、Googleアナリティクスの機能が有効となります。当社のWEBサイトでは、Googleによるアクセス解析ツール「Googleアナリティクス」を使用しています。このGoogleアナリティクスはデータの収集のためにクッキーを使用しています。このデータは匿名で収集されており、個人を特定するものではありません。 <br>
                    解析した結果は、当社のWEBサイトの改善・サービス向上を目的として利用します。 <br>
                    アクセス情報の収集方法及び利用方法については、Googleアナリティクス利用規約、Googleプライバシーポリシーによって定められています。 <br>
                    詳細は、下記をご参照ください。 <br>
                    <ul style="list-style-type: disc;">
                        <li>
                            <a href="javascript:void(0)" onclick="window.open('https://marketingplatform.google.com/about/analytics/terms/jp/', '_blank')">
                                Googleアナリティクス利用規約（Terms of Service | Google Analytics - Google）<i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="window.open('https://policies.google.com/privacy', '_blank')">
                                Googleプライバシーポリシー<i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="mb-3">
                <div class="float-end text-end">
                    <p>制定日2022年12月12日</p>

                    <div class="d-flex flex-column">
                        <span>旧プライバシーポリシー</span>
                        <a href="{{route('footer_menu.privacy_policy','20221010')}}"
                        >2022年10月10日<i class="bi bi-box-arrow-up-right ms-1"></i></a>
                    </div>


                </div>
            </div>


        </div>
    </div>
</section>

@endsection
