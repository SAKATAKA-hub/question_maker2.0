<template>
    <div>
        <form :action="url_action" method="POST"   @submit="submit"
        enctype="multipart/form-data" onsubmit="stopOnbeforeunload()"
        >
            <!--token-->
            <input type="hidden" name="_token" :value="token">
            <!--method patch-->
            <input v-if="form_style == 'update'" type="hidden" name="_method" value="patch">




            <!-- 出題順 -->
            <div class="form-group mb-4 card card-body border-info">
                <label for="order_input" class="form-check-label fs-5 mb-2 fw-bold"
                >出題の順番</label>
                <select name="order" class="form-select" id="order_input">

                    <option v-for="index in Number(question.count)" :key="index " :value="index "
                    :selected="question.num == index">{{index +'問目'}}</option>{}

                </select>
            </div>



            <!-- 問題文 -->
            <div class="form-group mb-4 card card-body border-info">
                <label for="text" >
                    <span class="form-check-label fs-5 mb-2 fw-bold">問題文</span>
                    <span class="badge bg-danger" style="transform:translateY(-3px);">必須</span>
                </label>

                <textarea name="text" class="form-control" id="text" rows="8" placeholder="問題文を入力してください。"
                v-model="inputs.text" required></textarea>
            </div>


            <!-- 正解と解答方法 -->
            <div class="form-group mb-4 card card-body border-info">
                <select-answer-component
                    :answer_type_num="select_answer_type_num"
                    :question_id="select_answer_question_id"
                    :token="token"
                    :api_route="select_answer_api_route"
                ></select-answer-component>
            </div>


            <!-- 問題画像 -->
            <div class="form-group mb-4 card card-body border-info">
                <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                >問題画像</label>

                <read-image-file-component :img_path="img_path" :noimg_path="noimg_path"
                alt="問題画像"></read-image-file-component>

                <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>
            </div>


            <!-- 解説 -->
            <div class="form-group mb-4 card card-body border-info bg-light-success">
                <label for="exampleFormControlInput1" class="form-check-label fs-5 mb-2 fw-bold"
                >解説</label>

                <p class="callout callout-info">
                    問題集の受検後の成績発表時に、『解説』を表示させることができます。
                </p>

                <!-- 解説コンポーネント -->
                <commentary-input-component :img_path="commentary_img_path" :noimg_path="noimg_path"
                :text="commentary_text"></commentary-input-component>
            </div>


            <!-- ボタングループ -->
            <div class="my-5">
                <div class="d-grid gap-2 col-md-4 mx-auto">

                    <!-- 登録・更新 -->
                    <button v-if="!submit_disabled"
                    class="btn btn-info btn-lg rounded-pill fs-5 w-100" type="submit">登録・更新</button>

                    <button v-else
                    class="btn btn-info btn-lg rounded-pill fs-5 w-100" type="submit" disabled>送信中・・・</button>

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

                question: {count:0 , num:0,},
                inputs:{
                    text: '',
                },
            }
        },
        props: {

            // 送信形式：　新規作成(stoer),更新(update)
            form_style: { type: String, default: 'store', },

            token:       { type: String, default: '', },
            url_action:  { type: String, default: '', }, //表示画像のパス
            url_back:    { type: String, default: '', }, //表示画像のパス

            questions_count:    { type: String, default: '', }, //問題数
            question_num:       { type: String, default: '', }, //問題番号
            input_text:         { type: String, default: '', }, //問題文
            img_path:           { type: String, default: '', }, //画像パス
            noimg_path:         { type: String, default: '', }, //画像なし画像パス
            commentary_img_path:{ type: String, default: '', }, //解説画像
            commentary_text:    { type: String, default: '', }, //解説文

            // 解答選択肢
            select_answer_type_num:   { type: String, default: '1', },
            select_answer_question_id:{ type: String, default: '', },
            select_answer_api_route:  { type: String, default: '', },
        },
        mounted() {
            this.question.count = this.questions_count;
            this.question.num   = this.question_num
            this.inputs.text    = this.input_text;

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
