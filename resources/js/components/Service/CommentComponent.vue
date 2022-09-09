<template>
    <div>
        <form :action="route_comment_api" v-show="test" method="POST">
            <input v-for="(input, key) in inputs" :key="key"
            type="text" :name="key" :value="input"
            >
            <button type="submit" class="btn btn-primary btn-sm">{{'コメントリスト'}}</button>
        </form>



        <div class="card">
            <ul class="list-group list-group-flush">
                <!-- コメントHeader -->
                <li class="list-group-item bg-light">
                    <h5 class="mb-0 text-secondary">コメント</h5>
                </li>

                <!-- コメント内容 -->
                <li class="list-group-item overflow-auto" style="max-height: 400px;">

                    <!--[コメント読み込み前]-->
                    <div v-if="comments==null"
                    class="text-secondary text-center my-5">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <!--[コメント投稿なしの時]-->
                    <div v-else-if="!comments.length"
                    class="text-secondary text-center my-5"
                    >コメントはありません</div>

                    <!--[コメントの投稿があるとき]-->
                    <div v-else >
                        <div v-for="(comment,key) in comments" :key="key">


                            <!--{{コメントが削除(非表示)されている・投稿者が退会しているとき}}-->
                            <div v-if="!comment.user || comment.is_hidden">
                                <div class="text-secondary text-center my-5">
                                    <small>{{comment.posted_at}} -</small>このコメントは削除されました
                                </div>
                            </div>
                            <!--{{コメントが削除されていないとき}}-->
                            <div v-else>
                                <div class="row my-4">
                                    <div class="col-auto pe-0" style="width:3rem;">
                                        <!--//投稿者画像//-->
                                        <div class="comment-user-image border ratio ratio-1x1 w-100"
                                        :style="'background:url('+ comment.user.image_url +') white no-repeat center center /cover'"
                                        style="border-radius:50%;"></div>
                                    </div>
                                    <div class="col">
                                        <div class="text-secondary mb-2">
                                            <!--//投稿者名//-->
                                            <span>{{comment.user.name}}</span>
                                            <!--//投稿時間//-->
                                            <small>- {{comment.posted_at}}</small>
                                        </div>

                                        <!--//コメント本文(改行対応)//-->
                                        <div class="card card-body d-inline-block border-0 py-2 bg-comment"
                                        :class="{ 'bg-comment-sucess': comment.user.id == user_id }">
                                            <div v-html="comment.body.replace(/\r?\n/g, '<br>')"></div>
                                        </div>
                                    </div>


                                    <!--//メニューボタン( 投稿者のみ操作可能 )//-->
                                    <div v-if="comment.user.id == user_id" class="col-auto">

                                        <button class="btn" type="button"
                                        :id="'commentMenuDropdown'+key" data-bs-toggle="dropdown" aria-expanded="false"
                                        ><i class="bi bi-three-dots-vertical"></i></button>

                                        <ul class="dropdown-menu" :aria-labelledby="'commentMenuDropdown'+key">
                                            <li><a class="dropdown-item" href="#"
                                            data-bs-toggle="modal" :data-bs-target="'#comentDeleteModal'+key"
                                            >削除</a></li>
                                        </ul>


                                        <!-- Coment Delete Modal -->
                                        <div class="modal fade" :id="'comentDeleteModal'+key" tabindex="-1" aria-labelledby="'comentDeleteModal'+key+'Label'" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <p>
                                                            <strong>コメント</strong>を1件削除します。<br>よろしいですか？
                                                        </p>
                                                        <div class="row">
                                                            <div class="col">
                                                                <button type="button" class="btn w-100 btn-secondary"
                                                                data-bs-dismiss="modal">閉じる</button>
                                                            </div>
                                                            <div class="col">
                                                                <button type="button" class="btn w-100 btn-danger"
                                                                @click="comment_destory_api(comment.id)"
                                                                data-bs-dismiss="modal">削除</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div><!--end v-for comments-->
                    </div><!--end if [コメントの投稿があるとき]-->


                </li>


                <!-- コメント入力フォーム -->
                <li class="list-group-item list-group-item-action">

                    <!-- [ログインしているとき => 入力フォーム] -->
                    <a v-if="user_id" href="" class="text-decoration-none text-dark"
                    data-bs-toggle="offcanvas" data-bs-target="#commentOffcanvas" aria-controls="commentOffcanvas"
                    >
                        <div class="row text-success py-2">
                            <div class="col-auto" style="width:3rem;">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <div class="col">
                                コメントを書く
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- [ログインしていないとき => ログインモーダルボタン] -->
                    <a v-else href="" class="text-decoration-none text-dark"
                    data-bs-toggle="modal" data-bs-target="#PleaseLoginModal"
                    >
                        <div class="row py-2">
                            <div class="col-auto" style="width:3rem;">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <div class="col">
                                コメントを書く
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </a>


                    <!-- Comment Offcanvas -->
                    <div class="offcanvas offcanvas-bottom"  style="height:10rem;"
                    tabindex="-1" id="commentOffcanvas" aria-labelledby="commentOffcanvasLabel">

                        <div class="offcanvas-body small  position-relative">

                            <!-- close btn -->
                            <div class="p-3 position-absolute top-0 end-0">
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <!--title-->
                            <div class="mx-auto mb-3" style="max-width:1200px;">
                                <h5 class="offcanvas-title" id="commentOffcanvasLabel">
                                    <i class="bi bi-chat-square-text"></i>
                                    <span class="ms-2">コメントを書く</span>
                                </h5>
                            </div>

                            <!--body-->
                            <div class="mx-auto" style="max-width:1200px;">
                                <div class="row">
                                    <!--[コメント入力テキストエリア]-->
                                    <div class="col p-0">
                                        <textarea class="form-control bg-white border-0" placeholder="コメントを入力"
                                        v-model="inputs.body" name="body" :maxlength="body_maxlength"></textarea>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-center">
                                            <!--[入力中文字数の表示]-->
                                            <label class="form-label">{{ inputs.body.length +'/'+ body_maxlength }}</label>
                                        </div>

                                        <button class="btn btn-success" type="button"
                                        data-bs-dismiss="offcanvas" aria-label="Close"
                                        @click="comment_api()"
                                        >送信</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- <div class="offcanvas-body py-0">
                        </div> -->
                    </div>
                </li>

            </ul>

        </div>


    </div>
</template>
<script>
    export default {
        /*
            [ memo ]
            # コメント削除ボタンの表示 ---------------
                => 投稿者本人のみ

            # コメントの削除(非表示) -----------------
                => 投稿ユーザーが退会した時。
                => コメントの削除処理(comment.is_hidden==true)の処理がされたとき

            -----------------------------------------

        */
        data : function() {
            return{

                test: false,

                // 入力できる最大文字数
                body_maxlength: 140,

                // コメントデータリスト
                comments: null,

                inputs:{
                    _token: document.querySelector('[name="csrf_token"]').content,
                    user_id: '',
                    question_group_id: '',
                    body:'',
                },


            }
        },
        props: {
            route_comment_api:         { type: String, default: '', },
            route_comment_destory_api: { type: String, default: '', },
            user_id:                   { type: String, default: '', },
            question_group_id:         { type: String, default: '', },
        },
        mounted() {

            /* propsデータの保存 */
            this.inputs.user_id = this.user_id;
            this.inputs.question_group_id = this.question_group_id;

            /* コメントデータの取得[ 非同期通信 ] */
            this.comment_api();

        },
        methods:{

            /* コメントデータの取得 */
            comment_api: function(){

                // [ 非同期通信 ]
                fetch( this.route_comment_api, {
                    method: 'POST',
                    body: new URLSearchParams( this.inputs ),
                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                .then(json => {
                    // コメントデータの保存
                    this.comments = json.comments ;

                    // テキストエリアの入力をクリアする
                    this.inputs.body = '';

                    // console.log( json );
                })

            },




            /* コメントデータの削除 */
            comment_destory_api: function( comment_id ){

                // 送信パラメーター
                const inputs = {
                    _token:            this.inputs._token,
                    _method:           'PATCH',
                    comment_id:        comment_id,
                    question_group_id: this.inputs.question_group_id
                };

                // [ 非同期通信 ]
                fetch( this.route_comment_destory_api, {
                    method: 'POST',
                    body: new URLSearchParams( inputs ),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {
                    // コメントデータの保存
                    this.comments = json.comments ;

                    // テキストエリアの入力をクリアする
                    this.inputs.body = '';


                    console.log( json );
                })
                .catch(err=>{
                    alert('データ送信エラーが発生しました。');
                })
            },

        }
    }
</script>
<style>
    .bg-comment{
        background:#E9ECEF;
        color: #000;
    }
    .bg-comment-sucess{
        background: #5defca;
        background: #5cf0cb80;
    }
</style>
