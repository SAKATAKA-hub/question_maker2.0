<template>
    <div>
        <textarea :class="style_class"
        :id="id" :rows="rows"  v-model="body"
        @change="change"
        placeholder="自己紹介の文章を入力しましょう！"></textarea>

        <input type="hidden" :name="name" :value="urlEncoded(body)">
    </div>
</template>

<script>
    export default {
        props: {
            //最初に表示する画像のパス
            style_class: { type: String, default: 'form-control', },
            placeholder: { type: String, default: '', },
            name:        { type: String, default: '', },
            id:          { type: String, default: '', },
            rows:        { type: String, default: '6', },
            default_body:{ type: String, default: '', },
        },

        data : function() {
            return{
                body : '',
            }
        },
        mounted() {

            this.body = this.default_body;

            this.change();


        },
        methods:{

            /* 文字列のエスケープ処理 */
            escapeHTML: function(string){

                return string.replace(/&/g, '&lt;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, "&#x27;");
            },

            urlEncoded: function(){
                return encodeURIComponent(this.body);
            },


            change: function(){
                console.log(this.body);
                console.log(this.escapeHTML(this.body));
                console.log( encodeURIComponent(this.body) );
            },
        }
    }
</script>
