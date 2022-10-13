<template>
<div>
    <div style="max-width: 400px;">

        <!-- 画像 -->
        <div class="card overflow-hidden mb-2">
            <img :src="src" :alt="alt">
        </div>
        <!--ファイル　インプット-->
        <div class="input-group mb-3">
            <input type="file" :name="name" class="form-control" :id="'file_input'+name"
            style="padding:.4rem;"
            @change="onChange"
            >
            <label class="input-group-text text-white" :class="{'bg-danger': delete_radio==null}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="画像の削除"
            :for="name+'_dalete'"><i class="bi bi-x-lg"></i></label>
        </div>

        <!-- delete(hidden) -->
        <div class="form-check d-none">
            <input class="form-check-input" type="radio" :name="name+'_dalete'" :id="name+'_dalete'"
            value="delete" v-model="delete_radio"  @change="delete_image">
        </div>

        <!-- message -->
        <div class="form-text text-danger">{{err_message}}</div>


    </div>
</div>
</template>

<script>
    export default {
        data : function() {
            return{
                /* 表示画像のソース */
                src: null,

                /* エラーメッセージ */
                err_message: '',

                /* 削除 */
                delete_radio: null,
            }
        },
        props: {

            img_path:   { type: String, default: '', }, //表示画像のパス
            noimg_path: { type: String, default: '', }, //画像無しのパス
            alt: { type: String, default: 'サムネ画像', },
            name:{ type: String, default: 'image', }, //インプット要素のname名

        },
        mounted() {
            //プロップの値をデータに保存 ※プロップの値は直接変更できないので、データに保存
            this.src = this.img_path;
            this.delete_radio = this.img_path == this.noimg_path ? 'delete' : null;

        },
        methods:{

            onChange(event) {

                const file = event.target.files[0];
                const input_file = document.getElementById('file_input'+ this.name);

                if(
                    //ファイル形式
                    ( file.type==='image/jpeg' || file.type==='image/png' ) &&
                    //ファイルサイズ
                    file.size < 10*1000*1000
                ){
                    this.src = URL.createObjectURL(file); //表示画像の変更
                    this.err_message = ''

                    // 削除チェックを外す
                    this.delete_radio = null;
                }else{
                    this.src = this.img_path;
                    this.err_message = '※エラー：ファイルサイズか形式が異なります。'
                    input_file.value = ''; //インプット要素内を空にする。
                }


            },

            delete_image: function(){

                this.src = this.noimg_path;

                const input_file = document.getElementById('file_input'+ this.name);
                input_file.value = ''; //インプット要素内を空にする。
            },

        }
    }
</script>
