<template>
    <div class="w-100 mx-auto">

        <!-- フォームテスト -->
        <div v-if="test.form">
            <form :action="route.get_questions_api" method="POST">
                <input type="hidden" name="_token" :value="token">
                <input type="hidden" name="question_group_id" :value="question_group_id">
                <button type="submit">問題集の受け取り</button>
            </form>

        </div>


        <!-- 読読み込み中 -->
        <div v-if="questions.length == 0">
            <div class="card card-body py-5">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <h2 class="text-center">読み込み中</h2>
            </div>
        </div>
        <!-- 読読み込み後 -->
        <div v-else>


            <div class="mb-2">
                <div class="d-flex justify-content-between align-items-end">
                    <h5>
                        <!-- 残り時間 -->
                        <div v-if="time_limit">
                            残り時間
                            <count-down-timer-component :time_limit="time_limit" @time_up="timeUP"></count-down-timer-component>
                        </div>
                        <!-- 経過時間 -->
                        <div v-show="!time_limit">
                            経過時間
                            <count-up-timer-component   :time_limit="time_limit" @getElapsedTime="getElapsedTime"></count-up-timer-component>
                        </div>
                    </h5>
                    <h3>
                        <!-- 現在の問題番号 -->
                        <span class="text-success fs-1">{{ question_num+1 > questions.length ? questions.length : question_num+1 }}</span>
                        <span class="mx-1">/</span>
                        <span>{{questions.length}}</span>
                    </h3>
                </div>
            </div>


            <form :action="route.scoring" method="post" @submit="submit" onsubmit="stopOnbeforeunload()">
                <input type="hidden" name="_token" :value="token"/>
                <input type="hidden" name="question_group_id" :value="question_group_id"/>
                <input type="hidden" name="elapsed_time" :value="elapsed_time">

                <ul class="ps-0" style="list-style:none;">

                    <li v-for="( question, q_num ) in questions" :key="q_num">
                        <div v-show="question_num == q_num" class="card">

                            <!-- 問題文 -->
                            <div class="card-body">

                                <h5 class="fw-bold">問題{{q_num+1}}</h5>
                                <p class="bg-light p-3">{{ question.text }}</p>

                                <!-- 問題画像 -->
                                <div v-if="question.image"
                                class="overflow-hidden w-100 mb-3" style="border-radius:.5rem;">
                                    <img :src="question.image" class="w-100" alt="問題画像"/>
                                </div>

                            </div>

                            <!-- 解答選択・入力 -->
                            <div class="card-body">

                                <div class="form-text">
                                    <div class="" v-if="question.answer_type == 0">解答をテキストで入力してください。</div>
                                    <div class="" v-if="question.answer_type == 1">解答を1つ選択してください。</div>
                                    <div class="" v-if="question.answer_type == 2">解答を全て選択してください。</div>
                                </div>

                                <div>
                                    <!-- 解答をテキストで入力 -->
                                    <ul v-if="question.answer_type == 0"
                                    class="ps-0 mb-3" style=" list-style:none;">
                                        <li>
                                            <input type="text" class="form-control" :name="'answer_'+q_num"
                                                placeholder="入力してください"/>
                                        </li>
                                    </ul>


                                    <!-- 解答を1つ選択 -->
                                    <ul v-if="question.answer_type == 1"
                                    class="ps-0 mb-3" style=" list-style:none;">
                                        <li v-for="(option_answer_text, o_num) in question.option_answer_texts" :key="o_num"
                                        class="w-100"
                                        >
                                            <div class="input-group mb-2">
                                                <input type="radio" class="btn-check"
                                                :name="'answer_'+q_num" :id="'answer_'+q_num +o_num" :value="option_answer_text"
                                                >
                                                <label class="btn btn-outline-success text-start w-100" :for="'answer_'+q_num +o_num"
                                                >{{option_answer_text}}</label>
                                            </div>

                                        </li>
                                    </ul>


                                    <!-- 解答を複数選択 -->
                                    <ul v-if="question.answer_type == 2"
                                    class="ps-0 mb-3" style=" list-style:none;">
                                        <li v-for="(option_answer_text, o_num) in question.option_answer_texts" :key="o_num"
                                        class="w-100"
                                        >
                                            <div class="input-group mb-2">
                                                <input type="checkbox" class="btn-check"
                                                :name="'answer_'+q_num+'[]'" :id="'answer_'+q_num +o_num" :value="option_answer_text"
                                                >
                                                <label class="btn btn-outline-success text-start w-100" :for="'answer_'+q_num +o_num"
                                                >{{option_answer_text}}</label>
                                            </div>

                                        </li>
                                    </ul>

                                </div>

                            </div><!-- end body -->

                        </div><!-- end card -->
                    </li>
                    <li v-if="questions.length == 0">
                        <div class="card card-body py-5">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <h2 class="text-center">読み込み中</h2>
                        </div>
                    </li>
                    <li v-else-if="question_num == questions.length">
                        <div class="card card-body text-center py-5">


                            <i class="bi bi-hourglass-split mb-3" style="font-size:3rem;"></i>

                            <h5>おつかれさまです</h5>
                            <p class="mb-5">
                                「採点する」を押すと、採点結果を確認できます。
                            </p>

                            <h5>入力内容に間違いはありませんか？</h5>
                            <p class="mb-5">
                                時間に余裕があれば、解答内容を見直しましょう！
                            </p>

                            <!-- 採点ボタン -->
                            <button type="submit" class="btn btn-success rounded-pill btn-lg px-3"
                            :disabled="submit_button.disabled">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="spinner-border me-3" role="status" v-show="submit_button.disabled">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    {{ submit_button.text }}
                                </div>
                            </button>

                        </div>
                    </li>
                    <li v-else-if="question_num > questions.length">
                        <div class="card card-body text-center py-5">
                            <i class="bi bi-hourglass-bottom mb-3" style="font-size:3rem;"></i>
                            <h5>タイムオーバー！</h5>
                            <p class="mb-5">
                                「採点する」を押して、採点結果を確認しましょう。
                            </p>

                            <!-- 採点ボタン -->
                            <button type="submit" class="btn btn-success rounded-pill btn-lg px-3"
                            :disabled="submit_button.disabled">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="spinner-border me-3" role="status" v-show="submit_button.disabled">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    {{ submit_button.text }}
                                </div>
                            </button>


                        </div>
                    </li>

                </ul>
            </form>


            <!-- 操作ボタン -->
            <div class="d-flex justify-content-between mt-3">
                <!-- 戻るボタン -->
                <button class="btn btn-light border rounded-pill" style="height:3rem;"
                @click="numSub" :disabled="(question_num <= 0)||(question_num > questions.length)"
                ><i class="bi bi-arrow-left  fw-bold"></i></button>


                <!-- 問題番号ボタン -->
                <div>
                    <div class="d-flex flex-wrap justify-content-center">
                        <div v-for="btn_num in questions.length" :key="btn_num">
                            <div v-if="true">

                                <button class="btn rounded-pill"
                                :class="{'btn-light border':(question_num != btn_num-1), 'btn-success':(question_num == btn_num-1)}"
                                @click="numChange(btn_num)" :disabled="(question_num == btn_num-1)||(question_num > questions.length)"
                                >{{btn_num}}</button>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- 進むボタン -->
                <button class="btn btn-light border rounded-pill" style="height:3rem;"
                @click="numAdd" :disabled="question_num >= questions.length"
                ><i class="bi bi-arrow-right fw-bold"></i></button>
            </div>

            <div class="mt-5 text-center">
                <button class="btn btn-light btn-sm border rounded-pill"
                onClick="history.back(); return false;">中断する</button>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        data : function() {
            return{



                /* test用フォーム・データの利用 */
                test: { form : false, data : false, },

                /* token ( ログイン処理のページ遷移時に利用 )*/
                token: document.querySelector('[name="csrf_token"]').content,

                /* 問題集ID*/
                question_group_id: document.querySelector('[name="question_group_id"]').content,
                /* ルート */
                route : {
                    get_questions_api: document.querySelector('[name="route_get_questions_api"]').content, //登録済メールアドレスか確認するAPI
                    scoring:           document.querySelector('[name="route_scoring"]').content, //採点
                },


                /* 表示中の問題番号 */
                question_num: 0,

                /* 問題データ */
                questions: [],

                /* 制限時間 */
                time_limit: null,

                /* 経過時間 */
                elapsed_time: '',

                /* 送信の有無 */
                submit_button: {
                    text: '採点する',
                    disabled: false,
                },
            }
        },
        mounted() {


            // 問題データの取得 [ 非同期通信 ]
            fetch(this.route.get_questions_api, {

                method: 'POST',
                body: new URLSearchParams({
                    _token : this.token, //token
                    question_group_id : this.question_group_id,
                }),

            })
            .then(response => {
                if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                return response.json();
            })
            // [ 非同期通信・成功処理 ]
            .then(json => {

                this.questions = json.questions;
                this.time_limit = json.time_limit!='00:00:00' ? json.time_limit : null ;
                // console.log( json );
            })


        },
        methods:{

            /* タイムアップ */
            timeUP: function(){
                this.question_num = this.questions.length +1;
            },

            getElapsedTime: function(elapsed_time){
                this.elapsed_time = elapsed_time;
                // console.log( this.elapsed_time );
            },

            submit: function(){
                this.submit_button.disabled = true;
                this.submit_button.text = '送信中・・・';
            },

            numSub: function(){
                this.question_num --;
                window.scroll({top: 0, behavior: 'smooth'});
            },
            numAdd: function(){
                this.question_num ++;
                window.scroll({top: 0, behavior: 'smooth'});
            },
            numChange: function(btn_num){
                this.question_num = btn_num -1;
                window.scroll({top: 0, behavior: 'smooth'});
            },


        }
    }
</script>
