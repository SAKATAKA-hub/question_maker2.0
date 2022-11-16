<template>
    <div>
        <!-- 「登録しよう！」 -->
        <div class="mb-5" v-if="form_style == 'store'">
            <div class="card-header bg-success text-white d-md-flex">
                <h5 class="mb-0 card-title">『基本情報』を登録しよう！</h5>
            </div>
            <div class="card-body">
                <p class="card-text text-secondary">
                    問題一覧に表示される『基本情報』を登録しましよう！<br>
                </p>
            </div>
        </div>



        <form :action="url_action" method="POST"   @submit="submit"
        enctype="multipart/form-data" onsubmit="stopOnbeforeunload()"
        >
            <!--token-->
            <input type="hidden" name="_token" :value="token">
            <!--method patch-->
            <input v-if="form_style == 'update'" type="hidden" name="_method" value="patch">


            <!-- タイトル -->
            <div class="form-group mb-4 card card-body border-success">
                <div class="d-flex align-items-center">
                    <label for="title_input" class="form-check-label fs-5 mb-2 fw-bold"
                    >問題集のタイトル</label>
                    <span class="badge bg-danger ms-2 mb-2">必須</span>
                </div>

                <input type="text" name="title" class="form-control" id="title_input" placeholder="問題集のタイトル"
                v-model="inputs.title" required
                maxlength="150">
            </div>


            <!-- 説明文 -->
            <div class="form-group mb-4 card card-body border-success">
                <div class="d-flex align-items-center">
                    <label for="resume_input1" class="form-check-label fs-5 mb-2 fw-bold"
                    >説明文</label>
                    <span class="badge bg-danger ms-2 mb-2">必須</span>
                </div>

                <textarea name="resume" class="form-control" id="resume_input1" rows="10"
                placeholder="問題集の簡単な説明を書きましょう！" required
                v-model="inputs.resume"
                ></textarea>
            </div>


            <!-- サムネ画像 -->
            <div class="form-group mb-4 card card-body border-success">
                <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                >サムネ画像</label>

                <read-image-file-component :img_path="img_path" :noimg_path="noimg_path"></read-image-file-component>

                <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
            </div>


            <!-- 制限時間 -->
            <div class="form-group mb-4 card card-body border-success">
                <label for="time_limit_h_input" class="form-check-label fs-5 mb-2 fw-bold"
                >制限時間</label>
                <p class="callout callout-success">
                    制限時間を設定したくないときは、『00時間00分00秒』に時間を合せてください。
                </p>
                <div class="row align-items-center">
                    <!--時間-->
                    <div class="col-auto">
                        <select v-model="inputs.time_h"
                        name="time_limit[]" class="form-select " aria-label="Default select example" id="time_limit_h_input">

                            <option v-for="num_h in 24" :key="num_h"
                            :value=" 10 > num_h-1  ? '0'+(num_h-1) : num_h-1"
                            >{{ 10 > num_h-1 ? '0'+(num_h-1) : num_h-1}}</option>

                        </select>
                    </div>
                    <div class="col-auto">時間</div>
                    <!--分-->
                    <div class="col-auto">
                        <select v-model="inputs.time_m"
                        name="time_limit[]" class="form-select" aria-label="Default select example">

                            <option v-for="num_m in 60" :key="num_m"
                            :value=" 10 > num_m-1  ? '0'+(num_m-1) : num_m-1"
                            >{{ 10 > num_m-1 ? '0'+(num_m-1) : num_m-1}}</option>

                        </select>
                    </div>
                    <div class="col-auto">分</div>
                    <!--秒-->
                    <div class="col-auto">
                        <select v-model="inputs.time_s"
                        name="time_limit[]" class="form-select" aria-label="Default select example">

                            <option v-for="num_s in 60" :key="num_s"
                            :value=" 10 > num_s-1  ? '0'+(num_s-1) : num_s-1"
                            :selected="( 10 > num_s-1  ? '0'+(num_s-1) : num_s-1 ) == inputs.time_s"
                            >{{ 10 > num_s-1 ? '0'+(num_s-1) : num_s-1}}</option>

                        </select>
                    </div>
                    <div class="col-auto">秒</div>
                </div>
            </div>


            <!-- タグ -->
            <div class="form-group mb-4 card card-body border-success">
                <label for="tags_input" class="form-check-label fs-5 mb-2 fw-bold"
                >タグ</label>
                <p class="callout callout-success">
                    タグが複数あるときは、全角または半角スペースで区切ってください。
                </p>


                <input type="text" name="tags" class="form-control" id="tags_input" placeholder="タグ"
                v-model="inputs.tags" maxlength="150">
            </div>

            <div class="my-5">
                <div class="d-grid gap-2 col-md-4 mx-auto">

                    <!-- 詳細一覧へ戻る -->
                    <button v-if="!submit_disabled"
                    class="btn btn-success btn-lg rounded-pill fs-5 w-100" type="submit">登録・更新</button>

                    <button v-else
                    class="btn btn-success btn-lg rounded-pill fs-5 w-100" type="submit" disabled>送信中・・・</button>

                    <!-- 詳細一覧へ戻る -->
                    <a :href="url_back"
                    class="btn btn-secondary btn-lg rounded-pill fs-5 w-100">戻る</a>

                </div>
            </div>

        </form>

    </div>
</template>

<script>
    export default {
        data : function() {
            return{
                // 送信の制御
                submit_disabled: false,

                inputs:{
                    title: '',
                    resume: '',
                    tags: '',
                    time_h: '00',time_m: '00',time_s: '00',
                },
            }
        },
        props: {

            // 送信形式：　新規作成(stoer),更新(update)
            form_style: { type: String, default: 'store', },

            token:       { type: String, default: '', },
            url_action:  { type: String, default: '', }, //表示画像のパス
            url_back:    { type: String, default: '', }, //表示画像のパス

            input_title:  { type: String, default: '', }, //問題集のタイトル
            input_resume: { type: String, default: '', }, //説明文
            input_tags:   { type: String, default: '', }, //タグ
            img_path:     { type: String, default: '', }, //画像パス
            noimg_path:   { type: String, default: '', }, //画像なし画像パス

            input_time_h:       { type: String, default: '00', }, //制限時間[時]
            input_time_m:       { type: String, default: '00', }, //制限時間[分}
            input_time_s:       { type: String, default: '00', }, //制限時間[秒]

        },
        mounted() {
            this.inputs.title = this.input_title;
            this.inputs.resume = this.input_resume;
            this.inputs.time_h = this.input_time_h;
            this.inputs.time_m = this.input_time_m;
            this.inputs.time_s = this.input_time_s;
            this.inputs.tags = this.input_tags;
        },
        methods:{
            /* 送信ボタンを押したとき */
            submit: function(){
                this.submit_disabled = true;
                console.log('submit');
            },
        }
    }
</script>
