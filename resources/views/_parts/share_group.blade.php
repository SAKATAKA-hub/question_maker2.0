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
        class="btn btn-sm" style="color:#3578E5; border-color:#3578E5;"
        >Facebook</a>

        <a href="http://twitter.com/share?text={{ $question_group->title.'/'.$question_group->resume_text }}&url={{ route('play_question', $param ) }}" rel="nofollow"
        class="btn btn-sm" style="color:#1DA1F2; border-color:#1DA1F2;"  target="_blank"
        >Twitter</a>

        {{-- <a href="http://b.hatena.ne.jp/add?mode=confirm&url={{ route('play_question', $param ) }}" rel="nofollow" target="_blank"
        class="btn btn-sm" style="color:#009fd7; border-color:#009fd7;"
        >はてブ</a> --}}

        {{-- <a href="http://getpocket.com/edit?url={{ route('play_question', $param ) }}" rel="nofollow" target="_blank"
        class="btn btn-sm" style="color:#ed374d; border-color:#ed374d;"
        >Pocket</a> --}}

        <a href="https://social-plugins.line.me/lineit/share?url={{ route('play_question', $param ) }}" target="_blank"
        class="btn btn-sm" style="color:#01ba01; border-color:#01ba01;"
        >LINE</a>

        <div class="">
            <url-copy-component copy_url="{{ route('play_question', $param ) }}"></url-copy-component>
        </div>
    </div>
</div>
