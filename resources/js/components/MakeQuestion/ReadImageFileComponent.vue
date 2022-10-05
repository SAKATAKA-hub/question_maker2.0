<template>
<div>
    <div style="max-width: 400px;">
        <div class="card overflow-hidden mb-2">
            <img :src="src" :alt="alt">
        </div>
        <input type="file" :name="name" class="form-control" id="file_input"
        style="padding:.4rem;"
        @change="onChange"
        >
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

            }
        },
        props: {

            img_path: { type: String, default: '', }, //表示画像のパス
            alt: { type: String, default: 'サムネ画像', }, //表示画像のパス
            name:{ type: String, default: 'image', }, //インプット要素のname名

        },
        mounted() {
            //プロップの値をデータに保存 ※プロップの値は直接変更できないので、データに保存
            this.src = this.img_path;

        },
        methods:{

            onChange(event) {

                const file = event.target.files[0];
                const input_file = document.getElementById('file_input');
                // console.log( input_file.value );

                // this.src = URL.createObjectURL(file);

                if(
                    //ファイル形式
                    ( file.type==='image/jpeg' || file.type==='image/png' ) &&
                    //ファイルサイズ
                    file.size < 10*1000*1000
                ){
                    this.src = URL.createObjectURL(file); //表示画像の変更
                    this.err_message = ''

                }else{
                    this.src = this.img_path;
                    this.err_message = '※エラー：ファイルサイズか形式が異なります。'
                    input_file.value = ''; //インプット要素内を空にする。
                }


            },

        }
    }
</script>
