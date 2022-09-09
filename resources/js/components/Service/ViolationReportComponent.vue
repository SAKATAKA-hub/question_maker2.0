<template>
    <div>

        <!-- <form :action="route" v-show="test" method="POST">
            <input v-for="(input, key) in inputs" :key="key"
            type="text" :name="key" :value="input"
            >
            <button type="submit" class="btn btn-primary btn-sm">お気に入り</button>
        </form> -->


        <!-- 報告済み -->
        <button v-if="reported" class="btn btn-sm"  disabled>
            <div class="fs-5">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div style="font-size:.6rem;">報告済み</div>
        </button>


        <!-- ログインしているとき => 報告ボタン -->
        <button v-else-if="user_id"
        data-bs-toggle="offcanvas" data-bs-target="#violationReportOffcanvas" aria-controls="violationReportOffcanvas"
        class="btn btn-sm">
            <div class="fs-5">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div style="font-size:.6rem;">報　告</div>
        </button>

        <!-- ログインしていないとき => ログインモーダルボタン -->
        <button v-else
        data-bs-toggle="modal" data-bs-target="#PleaseLoginModal"
        class="btn btn-sm">
            <div class="fs-5">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div style="font-size:.6rem;">報　告</div>
        </button>



        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="violationReportOffcanvas" aria-labelledby="violationReportOffcanvasLabel">
            <div class="offcanvas-body small  position-relative">

                <!--close btn-->
                <div class="p-3 position-absolute top-0 end-0">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!--title-->
                <div class="mx-auto mb-3" style="max-width:1200px;">
                    <h5 class="offcanvas-title" id="violationReportOffcanvasLabel">
                        <span class="text-warning me-2">
                            <i class="bi bi-exclamation-triangle"></i>
                        </span>
                        規約違反の報告
                    </h5>
                </div>

                <!--body-->
                <div class="mx-auto" style="max-width:1200px;">

                    <div class="callout callout-warning mb-3">
                        利用規約に反する内容があった場合、内容をご報告ください。
                    </div>

                    <!--[コメント入力テキストエリア]-->
                    <div class="row">
                        <div class="col pb-0">
                            <textarea class="form-control bg-white h-100" placeholder="規約違反内容を入力"
                            v-model="inputs.body" name="body" :maxlength="body_maxlength"></textarea>
                        </div>
                        <div class="col-auto">
                            <div class="text-center">
                                <!--[入力中文字数の表示]-->
                                <label class="form-label">{{ inputs.body.length +'/'+ body_maxlength }}</label>
                            </div>

                            <button class="btn btn-warning" type="button"
                            data-bs-dismiss="offcanvas" aria-label="Close"
                            @click="click"
                            >送信</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>
<script>
    export default {
        data : function() {
            return{

                test: false,

                // 報告済みかどうか
                reported: false,

                // 入力できる最大文字数
                body_maxlength: 140,


                inputs:{
                    _token: document.querySelector('[name="csrf_token"]').content,
                    user_id: '',
                    question_group_id: '',
                    body:'',
                },


            }
        },
        props: {
            route:           { type: String, default: '', },
            user_id:           { type: String, default: '', },
            question_group_id: { type: String, default: '', },
            is_reported:       { type: String, default: '', },

        },
        mounted() {

            this.inputs.user_id = this.user_id;
            this.inputs.question_group_id = this.question_group_id;

        },
        methods:{

            click: function(){



                // [ 非同期通信 ]
                fetch( this.route, {
                    method: 'POST',
                    body: new URLSearchParams( this.inputs ),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {
                    // 表示の切り替え
                    this.reported = true;
                    // console.log( json );
                })
                .catch(err=>{
                    alert('データ送信エラーが発生しました。');
                })



            },
        }
    }
</script>
