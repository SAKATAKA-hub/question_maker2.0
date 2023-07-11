<template>
    <div class="">
        <form :action="api_route" v-if="test" method="POST">
            <input v-for="( value, name) in  {  _token: token, question_id: question_id, }" :key="name"
            type="hidden" :name="name" :value="value">
            <button class="btn btn-danger">テスト</button>
        </form>



        <label>
            <span class="form-check-label fs-5 mb-2 fw-bold">正解と解答方法</span>
            <span class="badge bg-danger" style="transform:translateY(-3px);">1つ以上必須</span>
        </label>
        <div class="ms-3 d-flex flex-column flex-md-row gap-3 my-3">


            <label class="card p-2"  for="answerType1">
                <div class="form-check w-100">
                    <input name="answer_type" value="1" type="radio" class="form-check-input"
                    id="answerType1" v-model="answer_type">
                    <label class="form-check-label fw-bold" for="answerType1">ひとつの答えを選ぶ</label>
                </div>
            </label>

            <label class="card p-2"  for="answerType2">
                <div class="form-check">
                    <input name="answer_type" value="2" type="radio" class="form-check-input"
                    id="answerType2" v-model="answer_type">
                    <label class="form-check-label fw-bold" for="answerType2">複数の答えを選ぶ</label>
                </div>
            </label>
            <label class="card p-2"  for="answerType0">
                <div class="form-check">
                    <input name="answer_type" value="0" type="radio" class="form-check-input"
                    id="answerType0" v-model="answer_type">
                    <label class="form-check-label fw-bold" for="answerType0">テキストで答えを入力する</label>
                </div>
            </label>


        </div>
        <div class="ms-3 mb-3">


            <div v-if="answer_type == 0">


                <!-- 最初のinput(key==0)は正解 -->
                <input name="answer_booleans[]" type="hidden" value="0">

                テキストで答えを入力する （140文字以内）
                <div class="input-group mb-2">

                    <!--[ 正解ボタン ]-->
                    <div class="input-group-text overflow-hidden p-0">
                        <input type="checkbox" class="btn-check" name="answer_booleans[]" id="answer_booleans0" autocomplete="off"
                        disabled  value="0" checked
                        >
                        <label class="btn action-btn btn-outline-info border-0" for="answer_booleans0" style="border-radius:0;">
                            <span>正　解</span>
                        </label>
                    </div>


                    <!--[ option_id ]-->
                    <input name="option_ids[]" type="hidden" :value="options[0].id">


                    <!--[ 選択肢テキストの入力 ]-->
                    <!-- <input type="text" name="answer_texts[]" class="form-control" maxlength="140"
                    v-model="answer_text" required> -->
                    <encodedーinputtext-component
                    id="text" name="answer_texts[]" style_class="form-control" maxlength="140"
                    :default_body="answer_text" required="1"
                    ></encodedーinputtext-component>

                </div>


            </div>
            <div v-if="answer_type == 1">


                ひとつの答えを選ぶ （140文字以内）
                <div class="input-group mb-2" v-for="(option, key) in options" :key="key">

                    <!--[ 正解ボタン ]-->
                    <div class="input-group-text overflow-hidden p-0">
                        <input type="radio" class="btn-check" name="answer_booleans[]" :id="'answer_booleans'+key" autocomplete="off"
                        :value="key" v-model="answer_radio"
                        >

                        <label class="btn action-btn btn-outline-info border-0" :for="'answer_booleans'+key" style="border-radius:0;"
                            @click="changeRadioButton( answer_radio, key )"
                        >
                            <!-- <span v-if="option.only">正　解</span> -->
                            <span v-if="answer_radio==key">正　解</span>
                            <span v-else            >不正解</span>
                        </label>
                    </div>


                    <!--[ option_id ]-->
                    <input name="option_ids[]" type="hidden" :value="option.id">


                    <!--[ 選択肢テキストの入力 ]-->
                    <encodedーinputtext-component
                    id="text" name="answer_texts[]" style_class="form-control" maxlength="140"
                    :default_body="option.answer_text" :required="option.only?1:0"
                    @send-input="getInputText(key,$event)"
                    ></encodedーinputtext-component>


                    <!--[ 削除ボタン ]-->
                    <div class="input-group-text">
                        <a href="" class="btn p-0 text-danger" style="text-decoration:none;"
                        :class="{'disabled': answer_radio == key}"
                        @click.prevent="deleteInput(key)"
                        >削除</a>
                    </div>

                </div>
                <button type="button" class="btn btn-light border" @click="addInput">+ 選択肢の追加</button>


            </div>
            <div v-if="answer_type == 2">


                <!-- inputがdisableのとき -->
                <div  v-if="answer_booleans.length<2">
                    <input name="answer_booleans[]" type="hidden" :value="answer_booleans[0]">
                </div>


                複数の答えを選ぶ （140文字以内）
                <div class="input-group mb-2" v-for="(option, key) in options" :key="key">
                    <!--[ 正解ボタン ]-->
                    <div class="input-group-text  overflow-hidden  p-0">

                        <input type="checkbox" class="btn-check" name="answer_booleans[]" :id="'answer_booleans'+key" autocomplete="off"
                        :disabled="(answer_booleans.length<2) && answer_booleans.includes(key)"
                        @change="refreshRadiioChack(), refreshInputText()"
                        :value="key" v-model="answer_booleans"
                        >

                        <label class="btn action-btn btn-outline-info border-0" :for="'answer_booleans'+key" style="border-radius:0;"
                            @click="changeButtonText(key)">
                            {{ option.button_text }}
                        </label>

                    </div>

                    <!-- [ option_id ] -->
                    <input name="option_ids[]" type="hidden" :value="option.id">


                    <!--[ 選択肢テキストの入力 ]-->
                    <encodedーinputtext-component
                    id="text" name="answer_texts[]" style_class="form-control" maxlength="140"
                    :default_body="option.answer_text" :required="option.only?1:0"
                    @send-input="getInputText(key,$event)"
                    ></encodedーinputtext-component>


                    <!--[ 削除ボタン ]-->
                    <div class="input-group-text">
                        <a href="" class="btn p-0 text-danger" style="text-decoration:none;"
                        :class="{'disabled': (answer_booleans.length<2) && answer_booleans.includes(key)}"
                        @click.prevent="deleteInput(key)"
                        >削除</a>
                    </div>

                </div>
                <button type="button" class="btn btn-light border" @click="addInput">+ 選択肢の追加</button>


            </div>


        </div>
    </div>
</template>

<script>
    export default {
        data : function() {
            return{

                test: false,
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

                /*各 正解ID */
                answer_text: '',
                answer_radio: 0,
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

                    // ラジオボタンの更新
                    this.refreshRadiioChack();

                    // テキスト入力の値を更新
                    if(this.answer_type==0){
                        this.refreshInputText();
                    }

                })


            }else{

                this.answer_radio = 0;

                this.options = [
                    { answer_text: '', only: true , button_text: '正　解', option_id: null},
                    { answer_text: '', only: false, button_text: '不正解', option_id: null},
                    { answer_text: '', only: false, button_text: '不正解', option_id: null},
                    { answer_text: '', only: false, button_text: '不正解', option_id: null},
                ];
            }


        },
        methods:{

            /* 選択肢の追加 */
            addInput: function(){

                this.options.push( { answer_boolean: false, answer_text: '', only: false, button_text: '不正解'} );
                // console.log( this.options );

            },

            /* 削除ボタン */
            deleteInput: function(key){

                //削除
                const options_array = [];
                for (let index = 0; index < this.options.length; index++) {
                    if(index==key){ continue; }
                    options_array.push( this.options[ index ] );
                }
                this.options = options_array;
                // console.log(this.options);


                //answer_booleansの修正処理
                if(this.answer_radio > key){ this.answer_radio -= 1; }

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

            },

            /* ボタンテキストの変更 */
            changeButtonText: function(key){
                const button_text = this.options[key].button_text;
                if( button_text == '不正解' ){
                    this.options[key].button_text    = '正　解';
                    // this.options[key].answer_boolean = true;
                }else{
                    this.options[key].button_text    = '不正解';
                    // this.options[key].answer_boolean = false;
                }

                // // ラジオボタンの更新
                // this.refreshRadiioChack();

            },


            /* ラジオボタンの変更 */
            changeRadioButton: function( old_key, key ){

                // 前の正解を、不正解に変更
                this.changeButtonText( old_key );
                this.answer_booleans = this.answer_booleans.filter( val => { return val!=old_key } );


                // 選択したラジオボタンが、チェックボックスでは選択されていないとき => 正解の追加
                let cheack = this.answer_booleans.filter( val => { return val==key } );
                // console.log( cheack.length );
                if( cheack.length==0 ){
                    this.changeButtonText( key );
                    this.answer_booleans.push( key );
                }

            },



            /* ラジオボタンの値を更新（チェックボックスの変更時等） */
            refreshRadiioChack: function(){
                // チェックオックスの並び替え
                this.answer_booleans.sort((a,b) => (a < b ? -1 : 1));
                // チェックボックスの最初の正解
                this.answer_radio = this.answer_booleans[0];
            },

            /* テキスト入力の値を更新 */
            refreshInputText: function(){
                let key = this.answer_radio;
                this.answer_text = this.options[key].answer_text;
            },

            /* 子コンポーネント(encoded-inputtext-component)から値の受け取り */
            getInputText: function( key, input ){
                // console.log( input );
                // console.log( key );


                this.options[key].answer_text = input;
                // console.log( this.options[key].answer_text );

            },
        }
    }
</script>
<style>
    .action-btn:hover{
        background: #fff;
        color: #28abbd;
    }
</style>
