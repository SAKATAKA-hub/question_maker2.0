<template>
    <div>

        <form :action="route_list" v-if="test" method="POST">
            <input v-for="(input, key) in inputs" :key="key"
            type="hidden" :name="key" :value="input"
            >
            <button type="submit" class="btn btn-primary btn-sm">テスト</button>
        </form>


        <!-- 通報リスト -->
        <div>
            <div v-if="loading" class="card card-body py-5">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <h2 class="text-center">読み込み中</h2>
            </div>

            <div v-else-if="!data_list.length" class="card card-body py-5">
                <h5 class="text-center">お問い合わせ情報はありません</h5>
            </div>

            <div v-else class="list-group">

                <h5 v-if="!data_list.length" class="my-5 text-center">
                    お問い合わせ情報はありません。
                </h5>


                <div v-for=" (data, dKey) in data_list " :key="dKey"
                class="list-group-item list-group-item-action p-0 d-flex"
                >

                    <a href="#"
                    class="d-block p-3 py-2 col text-dark text-decoration-none"
                    data-bs-toggle="offcanvas" :data-bs-target="'#contactListOffcanvas'+dKey " :aria-controls="'contactListOffcanvas'+dKey "
                    >

                        <div class="row">
                            <div class="col-auto">
                                <span v-if="data.contact.responsed" class="badge text-secondary">対応済</span>

                                <span v-else class="badge bg-danger">未対応</span>
                            </div>
                            <!-- 日付 -->
                            <div class="col-auto">{{data.date}}</div>
                            <!-- 名前 -->
                            <div class="col d-none d-md-block overflow-hidden">
                                <span class="d-inline-block text-truncate" style="width: 200px;">
                                    {{data.contact.name}}様
                                </span>
                            </div>
                        </div>

                    </a>


                    <!-- dropdown menu -->
                    <div class="col-auto">
                        <div class="dropdown">
                            <button class="btn" type="button"
                            :id="'contactDropdownMenuButton'+dKey" data-bs-toggle="dropdown" aria-expanded="false"
                            >
                                <span class="fs-5">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </span>
                            </button>

                            <ul class="dropdown-menu" :aria-labelledby="'contactDropdownMenuButton'+dKey">
                                <li>
                                    <a @click="destory(data.contact.id)"
                                    data-bs-toggle="modal" :data-bs-target="'#deleteModal'+dKey"
                                    class="dropdown-item" href="#">削除</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- offcanvas -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" style="width:600px;"
                    :id="'contactListOffcanvas'+dKey " :aria-labelledby="'contactListOffcanvasLabel'+dKey "
                    >
                        <div class="offcanvas-header">
                            <h5 :id="'contactListOffcanvasLabel'+dKey ">お問い合わせ内容</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">

                            <div class="card card-body mb-3">
                                <strong>お問い合わせ者情報</strong>
                                <div class="row py-2 border-top">
                                    <div class="col-4">対応状況</div>
                                    <div class="col-8">
                                        <div class="row align-items-center">
                                            <!--text-->
                                            <div class="col">
                                                <span v-if="data.contact.responsed"
                                                class="text-success">対応済</span>
                                                <span v-else
                                                class="text-danger">未対応</span>
                                            </div>
                                            <!--button-->
                                            <div class="col-auto">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" @change="changeResponsed(dKey)"
                                                    :id="'flexSwitchResponsed'+dKey" v-model="data.contact.responsed">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-2 border-top">
                                    <div class="col-4">日時</div>
                                    <div class="col-8">{{data.date}}</div>
                                </div>
                                <div class="row py-2 border-top">
                                    <div class="col-4">氏名</div>
                                    <div class="col-8">{{data.contact.name}}</div>
                                </div>
                                <div class="row py-2 border-top">
                                    <div class="col-12 col-md-4">お問い合わせ内容</div>
                                    <div class="col-12 col-md-8">
                                        <div v-html="data.contact.body_text.replace(/\r?\n/g, '<br>')"></div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div><!-- end for -->


            </div><!-- end list-group -->

        </div>



    </div>
</template>
<script>
    export default {
        data : function() {
            return{

                test: true,

                loading: true,


                // データリスト
                data_list: [
                    /*
                        // 日時
                        'date': '',

                        // お問い合わせ情報
                        'contact':         [],

                    */
                ] ,


                inputs:{ app_key: '', },


            }
        },
        props: {

            route_list:      { type: String, default: '', }, //一覧表示
            route_responsed: { type: String, default: '', }, //対応済変更
            rote_destoroy:   { type: String, default: '', }, //削除

            app_key: { type: String, default: '', },

        },
        mounted() {

            this.inputs.app_key = this.app_key;


            // [ 非同期通信 ]
            fetch( this.route_list, {
                method: 'POST',
                body: new URLSearchParams( this.inputs ),
            })
            .then(response => {
                if(!response.ok){ throw new Error('送信エラー'); }
                return response.json();
            })
            .then(json => {

                // データの保存
                this.data_list = json.data_list;


                // ローディング表示->非表示
                this.loading = false;
                console.log( json );
            })
            .catch(err=>{
                alert('通信エラーが発生しました。再読みを行います。');
                location.reload();
            })


        },
        methods:{

            /* 対応状況の変更 */
            changeResponsed: function(dKey){

                // params
                const inputs = {
                    _method: 'patch',
                    app_key: this.app_key,
                    id:        this.data_list[dKey].contact.id,
                    responsed: this.data_list[dKey].contact.responsed,
                };
                // [ 非同期通信 ]
                fetch( this.route_responsed, {
                    method: 'POST',
                    body: new URLSearchParams( inputs ),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // 保存状態の変更
                    console.log( json );

                })
                .catch(err=>{
                    alert('通信エラーが発生しました。');
                    this.data_list[dKey].report.responsed = (inputs.responsed +1) %2 ;
                })


            },


            /* お問い合わせの削除 */
            destory: function(id){

                // params
                const inputs = {
                    _method: 'delete',
                    app_key: this.app_key,
                    id: id,
                };

                // [ 非同期通信 ]
                fetch( this.rote_destoroy, {
                    method: 'POST',
                    body: new URLSearchParams( inputs ),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // データの保存
                    this.data_list = json.data_list;
                    // console.log( json );
                })
                .catch(err=>{
                    alert('通信エラーが発生しました。');
                })

            },

        }
    }
</script>
