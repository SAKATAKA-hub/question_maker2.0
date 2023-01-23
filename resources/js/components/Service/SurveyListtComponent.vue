<template>
    <div>
        <div class="d-flex gap-3 mb-3">
            <form :action="route_list" v-if="test" method="POST">
                <input v-for="(input, key) in { api_key: this.api_key, }" :key="key"
                type="hidden" :name="key" :value="input"
                >
                <button type="submit" class="btn btn-primary btn-sm">アンケート一覧</button>
            </form>
            <form :action="route_answer_list" v-if="test" method="POST">
                <input v-for="(input, key) in { api_key: this.api_key, survey_id: 1}" :key="key"
                type="hidden" :name="key" :value="input"
                >
                <button type="submit" class="btn btn-primary btn-sm">回答一覧</button>
            </form>
            <form :action="route_answer" v-if="test" method="POST">
                <input v-for="(input, key) in { api_key: this.api_key, answers_id: 1}" :key="key"
                type="hidden" :name="key" :value="input"
                >
                <button type="submit" class="btn btn-primary btn-sm">回答詳細</button>
            </form>
        </div>

        <div class="">
            <div v-if="loading" class="py-5">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <h2 class="text-center">読み込み中</h2>
            </div>
            <div v-else class="">

                <!-- アンケート回答情報の表示 -->
                <div v-if="survey_answers!==null">

                    <button @click="resetAnswer()"
                    class="btn btn-sm btn-outline-secondary mb-3">回答一覧</button>

                    <div class="card w-100 mb-5" style="overflow:hidden; font-size:1.2rem;">
                        <div class="card-body">


                            <div v-for="(answer, key) in survey_answers" :key="key"
                            class="mb-3">
                                <div class="fw-bold">{{ (key+1) +'. '+answer.question }}</div>
                                <div class="ms-3" v-html="answer.value_text.replace(/\r?\n/g, '<br>')"></div>
                            </div>


                        </div>
                    </div>



                </div>
                <!-- アンケート回答リストが無いとき -->
                <div v-else-if="survey_answers_group_list!==null && !survey_answers_group_list.length"
                class="py-5">

                    <button @click="resetAnswerList()"
                    class="btn btn-sm btn-outline-secondary mb-3">アンケート一覧</button>

                    <h5 class="text-center">アンケートの回答はありません</h5>


                </div>
                <!-- アンケート回答リストの表示 -->
                <div  v-else-if="survey_answers_group_list!==null">


                    <button @click="resetAnswerList()"
                    class="btn btn-sm btn-outline-secondary mb-3">アンケート一覧</button>

                    <div class="card w-100 border-bottom-0 overflow-auto">
                        <table class="table table-striped mb-0" style="min-width: 900px">
                            <tbody>
                                <tr>
                                    <th scope="col">回答日</th>
                                    <th scope="col"></th><!-- 詳細 --><!-- 削除 -->
                                </tr>

                                <tr v-for="(survey_answers_group, key) in survey_answers_group_list" :key="key">
                                    <td scope="row">{{ survey_answers_group.date }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-3">
                                            <a class="btn btn-sm btn-outline-secondary"
                                            @click.prevent="answerDitail(survey_answers_group.id)"
                                            >詳細</a>

                                            <a href="#" class="btn btn-sm btn-outline-secondary"
                                            data-bs-toggle="modal" :data-bs-target="'#deleteModal'+key"
                                            >削除</a>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" :id="'deleteModal'+key" tabindex="-1" :aria-labelledby="'deleteModal'.key+'Label'" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    {{ survey_answers_group.date }}のアンケートを削除します。<br>よろしいですか？
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                    >閉じる</button>

                                                    <button type="submit" class="btn btn-danger text-white" data-bs-dismiss="modal"
                                                    @click="answerDestory(survey_answers_group.id)"
                                                    >削除</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- end Modal -->

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- アンケートが無いとき -->
                <div v-else-if="!survey_list.length" class="py-5">


                    <h5 class="text-center">アンケートはありません</h5>


                </div>
                <!-- アンケートリストの表示 -->
                <ul v-else class="ps-0" style="list-style:none;">


                    <li v-for="(survey, key) in survey_list" :key="key"
                    class="card mb-3">
                        <div class="card-body">
                            <h5 class="mb-3">
                                <strong>{{ survey.title }}</strong>
                            </h5>
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col">
                                    <!-- コピーボタン -->
                                    <url-input-copy-component :copy_url="survey.url"
                                    ></url-input-copy-component>
                                </div>
                                <div class="col-auto">
                                    <a class="btn btn-sm btn-outline-secondary" @click.prevent="windowOpen(survey.url)"
                                    >開く</a>
                                </div>
                                <div class="col-auto">
                                    <a class="btn btn-sm btn-outline-secondary" @click.prevent="answerList(survey.id)"
                                    >回答一覧</a>
                                </div>

                            </div>
                        </div>
                    </li>


                </ul>



            </div>
        </div>



    </div>
</template>
<script>
    export default {
        props: {

            route_list:           { type: String, default: '', },
            route_answer_list:    { type: String, default: '', },
            route_answer:         { type: String, default: '', },
            route_answer_destory: { type: String, default: '', },
            api_key: { type: String, default: '', },

        },
        data : function() {
            return{

                test: false,

                loading: true,

                // アンケートリスト
                survey_list: [],

                // アンケート回答リスト
                survey_answers_group_list:null,

                // 回答詳細
                survey_answers_group:null,
                survey_answers:null,

                inputs:{

                },
            }
        },
        mounted() {

            /* 一覧の取得 */
            this.getList();

        },
        methods:{


            /* 一覧の取得 */
            getList: function(){

                // [ 非同期通信 ]
                fetch( this.route_list, {
                    method: 'POST',
                    body: new URLSearchParams({ api_key: this.api_key, }),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // データの保存 survey_groups
                    this.survey_list = json.survey_groups;

                    // ローディング表示->非表示
                    this.loading = false;
                    // console.log( json );
                })
                .catch(err=>{

                    this.getList();
                    // alert('通信エラーが発生しました。再読みを行います。');
                    // location.reload();
                })

            },


            /* 回答一覧の取得 */
            answerList(answers_id){

                // ローディング表示
                this.loading = true;

                // return console.log({ api_key: this.api_key, answers_id: answers_id});
                fetch( this.route_answer_list, {
                    method: 'POST',
                    body: new URLSearchParams({ api_key: this.api_key, answers_id: answers_id}),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // データの保存 answers_groups
                    this.survey_answers_group_list = json.answers_groups;

                    // ローディング表示->非表示
                    this.loading = false;
                    // console.log( json );
                })
                .catch(err=>{

                    this.getList();
                    // alert('通信エラーが発生しました。再読みを行います。');
                    // location.reload();
                })
            },


            /* 回答情報の取得 */
            answerDitail(answers_id){
                // this.survey_answers_group = [1];

                // return console.log(answers_id);

                // ローディング表示
                this.loading = true;

                fetch( this.route_answer, {
                    method: 'POST',
                    body: new URLSearchParams({ api_key: this.api_key, answers_id: answers_id}),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // データの保存 answers_groups
                    this.survey_answers_group = this.survey_answers_group_list[answers_id];
                    this.survey_answers       = json.answers;

                    // ローディング表示->非表示
                    this.loading = false;
                    console.log( json );
                })
                .catch(err=>{

                    this.getList();
                    // alert('通信エラーが発生しました。再読みを行います。');
                    // location.reload();
                })

            },


            /* 回答情報の削除 */
            answerDestory: function(answers_id){

                // params
                const inputs = {
                    _method: 'delete',
                    api_key: this.api_key,
                    answers_id: answers_id,
                };

                // [ 非同期通信 ]
                fetch( this.route_answer_destory, {
                    method: 'POST',
                    body: new URLSearchParams( inputs ),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // データの保存
                    this.survey_answers_group_list = json.answers_groups;
                    // console.log( json );
                })
                .catch(err=>{
                    alert('通信エラーが発生しました。');
                })

            },


            /* 回答一覧のリセット */
            resetAnswerList: function(){ this.survey_answers_group_list = null; },

            /* 回答詳細のリセット */
            resetAnswer: function(){
                this.survey_answers_group = null;
                this.survey_answers       = null;
            },

            /* 別タブでリンクを開く */
            windowOpen: function(url){ window.open(url,'_blank') },
        }
    }
</script>
