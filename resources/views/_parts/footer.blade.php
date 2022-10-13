<!-- [ SNS ] -->
<section>
    <div class="container-1200 my-5 text-center">
        <h5 class="">\ 公式アカウント /</h5>
        <p class="text-secondary">
            サイトの更新情報やお知らせを配信中！
        </p>
        <div class="d-flex justify-content-center gap-3 snss">

            <a href="{{env('LINE_URL')}}" class="badge bg-white rounded-pill fs-1 p-2" style="color:#07b53b;" target="_blank">
                <!--LINE-->
                <i class="bi bi-line"></i>
            </a>
            <a href="{{env('TWIITER_URL')}}" class="badge bg-white rounded-pill fs-1 p-2" style="color:#1DA1F2;" target="_blank">
                <!--twitter-->
                <i class="bi bi-twitter"></i>
            </a>
            <a href="{{env('INSTAGRAM_URL')}}" class="badge bg-white rounded-pill fs-1 p-2" style="color:#CF2E92;" target="_blank">
                <!--instagram-->
                <i class="bi bi-instagram"></i>
            </a>

        </div>
    </div>
</section>

<section class="bg-success px-3">
    <ul class="d-lg-flex justify-content-center mb-0 p-0">
        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.how_use')}}" class="text-white text-decoration-none">
            このサイトの使い方
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>

        {{-- <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.important')}}" class="text-white text-decoration-none">
            問題集公開時の注意点
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>
 --}}

        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.privacy_policy')}}" class="text-white text-decoration-none">
            プライバシーポリシー
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>


        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.trems')}}" class="text-white text-decoration-none">
            利用規約
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>


        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.news')}}" class="text-white text-decoration-none">
            お知らせ
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>


        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.contact')}}" class="text-white text-decoration-none">
            お問い合わせ
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>


        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="{{route('footer_menu.faq')}}" class="text-white text-decoration-none">
            FAQ
            </a>
        </li>
        <li class="d-none d-lg-block text-white ms-3 me-3 py-2">|</li>


        <li class="text-lg-center py-2" style="list-style:none;">
            <a href="javascript:void(0)" onclick="window.open('{{route('footer_menu.operating_companiy')}}')"
            class="text-white text-decoration-none">
                運営会社について
            </a>

        </li>
    </ul>
</section>

<section class="bg-dark">
    <div class="section_container text-white text-center py-2" style="font-size:.8rem;">
        <p class="d-inline-block m-0">Copyright &copy; Next Arrow Inc.</p>
        <p class="d-inline-block m-0">All Rights Reserved.</p>
    </div>
    <!-- bottom menu分の余白 -->
    <div class="d-sm-none" style="height:5rem;"></div>
</section>

