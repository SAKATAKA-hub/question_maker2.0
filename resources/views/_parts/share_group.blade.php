<div class="">
    <div class="d-flex align-items-center">
        <span class="badge rounded-pill bg-success me-1">
            <i class="bi bi-share"></i>
        </span>
        問題集をシェアしよう！
    </div>
    @php $param = ['question_group'=>$question_group->id,'key'=>$question_group->key,]; @endphp
    <div class="d-flex flex-wrap gap-2 mt-2">

        <a href="http://www.facebook.com/share.php?u={{ route('play_question', $param ) }}" target="_blank"
        class="btn btn-sm py-0 text-white" style="background-color:#3578E5; border-color:#3578E5;"
        >
            <div class="d-flex align-items-center h-100">
                <span class="fs-4 d-none d-sm-inline">
                    <i class="bi bi-facebook"></i>
                </span>
                <span class="d-none d-sm-inline ms-2">シェア</span>
                <span class="d-sm-none">facebook</span>
            </div>
        </a>

        <a href="http://twitter.com/share?text={{ $question_group->title.'/'.$question_group->resume_text }}&url={{ route('play_question', $param ) }}" rel="nofollow"
        class="btn btn-sm py-0 text-white" style="background-color:#1DA1F2; border-color:#1DA1F2;"  target="_blank"
        >
            <div class="d-flex align-items-center h-100">
                <span class="fs-4 d-none d-sm-inline">
                    <i class="bi bi-twitter"></i>
                </span>
                <span class="d-none d-sm-inline ms-2">ツイート</span>
                <span class="d-sm-none">twitter</span>
            </div>
        </a>

        {{-- <a href="http://b.hatena.ne.jp/add?mode=confirm&url={{ route('play_question', $param ) }}" rel="nofollow" target="_blank"
        class="btn btn-sm px-3 text-white" style="background-color:#009fd7; border-color:#009fd7;"
        >はてブ

        </a> --}}

        {{-- <a href="http://getpocket.com/edit?url={{ route('play_question', $param ) }}" rel="nofollow" target="_blank"
        class="btn btn-sm px-3 text-white" style="background-color:#ed374d; border-color:#ed374d;"
        >Pocket

        </a> --}}

        {{-- <a href="https://social-plugins.line.me/lineit/share?url={{ route('play_question', $param ) }}" target="_blank"
        class="btn btn-sm px-3 text-white" style="background-color:#01ba01; border-color:#01ba01;"
        >
            <i class="bi bi-line me-2"></i>
            <span class="d-none d-sm-inline">LINEで送る</span>
        </a> --}}
        <a href="https://social-plugins.line.me/lineit/share?url={{ route('play_question', $param ) }}" target="_blank"
        class="btn btn-sm py-0 text-white" style="background-color:#01ba01; border-color:#01ba01;"
        >
            <div class="d-flex align-items-center h-100">
                <span class="fs-4 d-none d-sm-inline">
                    <i class="bi bi-line"></i>
                </span>
                <span class="d-none d-sm-inline ms-2">LINEで送る</span>
                <span class="d-sm-none">LINE</span>
            </div>
        </a>


        <url-copy-component copy_url="{{ route('play_question', $param ) }}"></url-copy-component>
    </div>
</div>
