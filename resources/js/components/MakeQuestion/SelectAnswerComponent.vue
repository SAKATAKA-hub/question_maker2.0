<template>
<div>
    <div class="mb-4">
        <label>
            <span class="form-check-label fs-5 mb-2 fw-bold">正解と解答方法</span>
            <span class="badge bg-danger" style="transform:translateY(-3px);">1つ以上必須</span>
        </label>
        <div class="ms-3 d-flex gap-3 mb-3">


            <div class="form-check">
                <input name="answer_type" value="1" type="radio" class="form-check-input"
                id="answerType1" v-model="answer_type">
                <label class="form-check-label fw-bold" for="answerType1">ひとつの答えを選ぶ</label>
            </div>
            <div class="form-check">
                <input name="answer_type" value="2" type="radio" class="form-check-input"
                id="answerType2" v-model="answer_type">
                <label class="form-check-label fw-bold" for="answerType2">複数の答えを選ぶ</label>
            </div>
            <div class="form-check">
                <input name="answer_type" value="0" type="radio" class="form-check-input"
                id="answerType0" v-model="answer_type">
                <label class="form-check-label fw-bold" for="answerType0">テキストで答えを入力する</label>
            </div>


        </div>
        <div class="ms-3 mb-3">


            <div v-if="answer_type == 0">


                <!-- 最初のinput(key==0)は正解 -->
                <input name="answer_booleans[]" type="hidden" value="0">

                テキストで答えを入力する （50文字以内）
                <div class="input-group mb-2">

                    <!--[ 正解ボタン ]-->
                    <div class="input-group-text overflow-hidden p-0">
                        <input type="checkbox" class="btn-check" name="answer_booleans[]" id="answer_booleans0" autocomplete="off"
                        disabled  value="0" checked
                        >
                        <label class="btn btn-outline-info border-0" for="answer_booleans0" style="border-radius:0;">
                            <span>正　解</span>
                        </label>
                    </div>


                    <!--[ option_id ]-->
                    <input name="option_ids[]" type="hidden" :value="options[0].id">


                    <!--[ 選択肢テキストの入力 ]-->
                    <input type="text" name="answer_texts[]" class="form-control" maxlength="50"
                    v-model="options[0].answer_text" required>


                </div>


            </div>
            <div v-if="answer_type == 1">


                <!-- 最初のinput(key==0)は正解 -->
                <input name="answer_booleans[]" type="hidden" value="0">

                ひとつの答えを選ぶ （50文字以内）
                <div class="input-group mb-2" v-for="(option, key) in options" :key="key">

                    <!--[ 正解ボタン ]-->
                    <div class="input-group-text overflow-hidden p-0">
                        <input type="checkbox" class="btn-check" name="answer_booleans[]" :id="'answer_booleans'+key" autocomplete="off"
                        disabled  :value="key" :checked="option.only"
                        >
                        <label class="btn btn-outline-info border-0" :for="'answer_booleans'+key" style="border-radius:0;">
                            <span v-if="option.only">正　解</span>
                            <span v-else            >不正解</span>
                        </label>
                    </div>


                    <!--[ option_id ]-->
                    <input name="option_ids[]" type="hidden" :value="option.id">


                    <!--[ 選択肢テキストの入力 ]-->
                    <input type="text" name="answer_texts[]" class="form-control" maxlength="50"
                    v-model="option.answer_text" :required="option.only">


                    <!--[ 削除ボタン ]-->
                    <div class="input-group-text" v-if="key != 0">
                        <a href="" class="disabled text-danger" style="text-decoration:none;"
                        @click.prevent="deleteInput(key)"
                        >削除</a>
                    </div>
                </div>
                <button type="button" class="btn btn-light border" @click="addInput">選択肢の追加</button>


            </div>
            <div v-if="answer_type == 2">


                <!-- 最初のinput(key==0)は正解 -->
                <input name="answer_booleans[]" type="hidden" value="0">


                複数の答えを選ぶ （50文字以内）
                <div class="input-group mb-2" v-for="(option, key) in options" :key="key">
                    <!--[ 正解ボタン ]-->
                    <div class="input-group-text  overflow-hidden  p-0">

                        <input type="checkbox" class="btn-check" name="answer_booleans[]" :id="'answer_booleans'+key" autocomplete="off"
                        :disabled="option.only"  :value="key" v-model="answer_booleans"
                        >
                        <label class="btn btn-outline-info border-0" :for="'answer_booleans'+key" style="border-radius:0;"
                            @click="changeButtonText(key)">
                            {{ option.button_text }}
                        </label>

                    </div>

                    <!-- [ option_id ] -->
                    <input name="option_ids[]" type="hidden" :value="option.id">


                    <!--[ 選択肢テキストの入力 ]-->
                    <input type="text" name="answer_texts[]" class="form-control" maxlength="50"
                    v-model="option.answer_text" :required="option.only">


                    <!--[ 削除ボタン ]-->
                    <div class="input-group-text" v-if="key != 0">
                        <a href="" class="disabled text-danger" style="text-decoration:none;"
                        @click.prevent="deleteInput(key)"
                        >削除</a>
                    </div>
                </div>
                <button type="button" class="btn btn-light border" @click="addInput">選択肢の追加</button>


            </div>


        </div>
    </div>


</div>
</template>

<script>
    export default {
        data : function() {
            return{

                /*
                |  解答方法(anser_type) ------
                |  0: テキストで答えを入力する
                |  1: ひとつの答えを選ぶ
                |  2: 複数の答えを選ぶ
                |  ---------------------------
                */
                answer_type: 0,

                /* 回答選択肢 */
                options: [
                    { answer_text: '', only: true , button_text: '正　解', option_id: null},
                    // { answer_text: '', only: false, button_text: '不正解', id: null},
                    // { answer_text: '', only: false, button_text: '不正解', id: null},
                    // { answer_text: '', only: false, button_text: '不正解', id: null},
                ],

                /* 正解ID */
                answer_booleans: [0,],

            }
        },
        props: {

            answer_type_num: { type: String, default: '0',},
            question_id:     { type: String, default: '', },
            token:           { type: String, default: '', },
            api_route:       { type: String, default: '', },

        },
        mounted() {

            // propsのデータを利用(解答方法)
            this.answer_type = this.answer_type_num;


            // 編集の時、問題の選択肢データを取得
            if( this.question_id ){

                // [ 非同期通信 ]
                fetch(this.api_route, {

                    method: 'POST',
                    body: new URLSearchParams({
                        _token: this.token,
                        question_id: this.question_id,
                    }),

                })
                .then(response => {
                    if(!response.ok){ alert('データ受信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {
                    /* 回答選択肢データのコピー */
                    this.options = json.options;

                    /* 正解IDデータのコピー */
                    this.answer_booleans = json.answer_booleans;

                })


            }else{

                this.options = [
                    { answer_text: '', only: true , button_text: '正　解', option_id: null},
                    { answer_text: '', only: false, button_text: '不正解', option_id: null},
                    { answer_text: '', only: false, button_text: '不正解', option_id: null},
                    { answer_text: '', only: false, button_text: '不正解', option_id: null},
                ];
            }


        },
        methods:{

            //選択肢の追加
            addInput: function(){

                this.options.push( { answer_boolean: false, answer_text: '', only: false, button_text: '不正解'} );

            },

            //ボタンテキストの変更
            changeButtonText: function(key){
                const button_text = this.options[key].button_text;
                if( button_text == '不正解' ){
                    this.options[key].button_text    = '正　解';
                    // this.options[key].answer_boolean = true;
                }else{
                    this.options[key].button_text    = '不正解';
                    // this.options[key].answer_boolean = false;
                }
            },

            //削除ボタン
            deleteInput: function(key){

                //optionsの削除処理
                this.options.splice(key,1);

                //answer_booleansの削除処理
                const array = [];
                for (let index = 0; index < this.answer_booleans.length; index++) {
                    const value = this.answer_booleans[ index ];
                    if( value < key )
                    {
                        array.push( value );
                    }
                    else if( value > key )
                    {
                        array.push( value -1 );
                    }
                }
                this.answer_booleans = array;
            }
        }
    }
</script>
