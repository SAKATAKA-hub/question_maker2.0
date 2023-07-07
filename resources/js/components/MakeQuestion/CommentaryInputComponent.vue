<template>
    <div>
        <!-- 登録スイッチ -->
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="commentary_switch"
            v-model="inputs.display_switch" @change="change">
            <label class="form-check-label text-primary" for="commentary_switch" style="cursor:pointer;">解説を登録する</label>
        </div>


        <div class="row mb-3" v-if="inputs.display_switch">
            <div class="col-md-6 pb-3">


                <label for="commentary_image" class="form-check-label mb-2 fw-bold">解説画像</label>
                <read-image-file-component :img_path="img_path" :noimg_path="noimg_path" alt="解説画像" name="commentary_image"></read-image-file-component>
                <div class="form-text">※ファイルは10Mバイト以内で、jpeg・jpg・pngのいずれかの形式を選択してください。</div>

            </div>
            <div class="col-md-6 pb-3">

                <label for="commentary_text" class="form-check-label mb-2 fw-bold">
                    解説文 <span class="badge bg-danger" style="transform:translateY(-3px);">必須</span>
                </label>
                <!-- <textarea name="commentary_text" class="form-control h-100" id="commentary_text"
                placeholder="問題の解説文を入力してください。" required v-model="inputs.text"></textarea> -->
                <encodedーtextarea-component
                id="commentary_text" name="commentary_text" style_class="form-control" rows="10"
                placeholder="問題の解説文を入力してください。"
                :default_body="inputs.text" :required="1"
                ></encodedーtextarea-component>


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function() {
            return{

                inputs: {
                    display_switch: false,
                    text:'',
                },
            }
        },
        props: {

            display_switch: { type: String, default: '', },
            img_path:       { type: String, default: '', }, //表示画像のパス
            noimg_path:       { type: String, default: '', }, //表示画像のパス
            text:           { type: String, default: '', },

        },
        mounted() {

            this.inputs.display_switch = this.text == '' ? false : true;
            this.inputs.text = this.text;


        },
        methods:{
            change: function(){
                console.log( this.inputs.display_switch );
            }
        }
    }
</script>
