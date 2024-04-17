<div class="list-group list-group-flush">
    <a href="{{route( 'make_question_group.create' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 d-flex align-items-center">
                {{-- <i class="bi bi-pencil-square fs-3 text-success"></i> --}}
                <i class="bi bi-plus fs-3 text-success"></i>
                <span class="ms-3">問題集を作る</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'mypage' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 d-flex align-items-center text">
                {{-- <i class="bi bi-journals fs-3 text-warning"></i> --}}
                <i class="bi bi-person-fill fs-3 text-warning"></i>

                <span class="ms-3">マイページ</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'like_list' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 d-flex align-items-center">
                <i class="bi bi-heart fs-3 text-danger"></i>
                <span class="ms-3">いいねした問題集</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'results.list' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 d-flex align-items-center">
                <i class="bi bi-graph-up fs-3 text-primary"></i>
                <span class="ms-3">受検成績</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'settings' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 d-flex align-items-center">
                <i class="bi bi-gear fs-3 text-info"></i>
                <span class="ms-3">プロフィール・設定変更</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
    <a href="{{route( 'user_auth.logout' )}}"
    class="list-group-item list-group-item-action">
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 d-flex align-items-center">
                <i class="bi bi-box-arrow-right fs-3"></i>
                <span class="ms-3">ログアウト</span>
            </p>
            <i class="bi bi-chevron-right"></i>
        </div>
    </a>
</div>
