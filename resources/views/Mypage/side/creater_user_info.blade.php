<div class="">
    <!-- ユーザーネーム -->
    <div class="d-flex align-items-center ps-2">
        <div class="user-image border ratio ratio-1x1 mb-1" style="
        background:url({{ asset('storage/'.$creater_user->image_puth) }});
        background-repeat  : no-repeat;
        background-size    : cover;
        background-position: center center;
        width:20%; border-radius:50%;
        "></div>
        <div class="text-center ms-3">
            <h5>{{$creater_user->name}}</h5>
        </div>
    </div>

    <!-- 三点セット -->
    <div class="row mb-1">
        <div class="col p-0 text-center">
            <a href="" class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-card-checklist"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">公開問題</p>
                <h5 class="mb-0">10000</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="" class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-people-fill"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロワー</p>
                <h5 class="mb-0">10000</h5>
            </a>
        </div>
        <div class="col p-0 text-center">
            <a href="" class="btn list-group-item-action">
                <h3 class="mb-0"><i class="bi bi-person-heart"></i></h3>
                <p class="text-secondary mb-0" style="font-size:.6rem;">フォロー中</p>
                <h5 class="mb-0">10000</h5>
            </a>
        </div>
    </div>

    <!-- フォローボタン -->
    <div class="mb-3">
        <button class="btn btn-success btn-sm">フォローする</button>
    </div>

    <!-- 自己紹介 -->
    <div class="card card-body mb-3">
        <p class="text-secondary" style="font-size:.6rem">自己紹介</p>
        <p>
            hogehogehogehoge <br>
            hogehogehogehoge <br>
            hogehogehogehoge <br>

        </p>
    </div>

    <!-- メニューリスト -->
    <div class="card">
        <div class="list-group list-group-flush">
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-person-fill"></i>
                        <span class="ms-3">マイページ</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-pencil-square"></i>
                        <span class="ms-3">問題を作る</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-heart"></i>
                        <span class="ms-3">いいね</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-graph-up"></i>
                        <span class="ms-3">成績</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-chat-left-dots"></i>
                        <span class="ms-3">未読コメント</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-gear"></i>
                        <span class="ms-3">設定変更</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
            <a href="" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="ms-3">ログアウト</span>
                    </p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>

        </div>
    </div>

</div>
