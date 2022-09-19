<div class="list-group list-group-flush">
    <a href="{{route( 'make_question_group.create' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-pencil-square"></i>
                <span class="ms-3">問題集を作る</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'mypage' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-journals"></i>
                <span class="ms-3">作成した問題集</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'like_list' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-heart"></i>
                <span class="ms-3">いいねした問題集</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'results.list' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-graph-up"></i>
                <span class="ms-3">受検成績</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    {{-- <a href="{{route( 'infomation_list' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-bell"></i>
                <span class="ms-3">おしらせ</span>
                <span class="badge  badge-pill badge-danger">100</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a> --}}
    <a href="{{route( 'settings' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-gear"></i>
                <span class="ms-3">プロフィール・設定変更</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'user_auth.logout' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between">
            <p class="mb-0">
                <i class="bi bi-box-arrow-right"></i>
                <span class="ms-3">ログアウト</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
</div>
