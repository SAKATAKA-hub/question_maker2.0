<template>
    <div v-html="replaceBody( text )"></div>
</template>

<script>
    /**
     * 文章置換え（改行・リンクタグ対応）
     *
     *
    */
    export default {
        props: {

            text:{ type: String, default: 'test', }, //
            replace_url:{ type: String, default: '1', }, //


        },
        data : function() {
            return{
                //
            }
        },
        mounted() { },
        methods:{


            /* 本文の表示変換 */
            replaceBody : function( body ){

                //[文字列のエスケープ処理]
                    body = this.escapeHTML( body );


                //[リンクタグへの変換]
                    if(this.replace_url==1){
                        body = this.replaceUrl( body );
                    }

                //[改行の変換]
                    body = body.replace(/\r?\n/g, '<br>');

                return body;
            },


            /* 文字列のエスケープ処理 */
            escapeHTML: function(string){

                return string.replace(/&/g, '&lt;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, "&#x27;");
            },

            //[リンクタグへの変換]
            replaceUrl: function(string){

                // ターゲットキー
                const targetKey = this.getRandomStr(16);

                // URL正規表現
                var regex = /(https?|http)(:\/\/[\w\/:%#\$&\?\(\)~\.=\+\-]+)/g; //
                let result = string.match(regex) || [] ;

                // ターゲットに印をつける
                let array = [];
                for (let index = 0; index < result.length; index++) {
                    const target  = result[index];
                    const replace =`{{${targetKey}${ index }}}`;
                    string = string.replace( target, replace);
                }

                // リンクタグに差替え
                for (let index = 0; index < result.length; index++) {
                    const url     = result[index];
                    const target  = `{{${targetKey}${ index }}}`;
                    const replace =`<a href="${ url }" class="text-break">${ url }</a>`;
                    string = string.replace( target, replace);
                }


                return string;
            },



            /* ランダム文字列の生成 */
            getRandomStr: function (LENGTH = 16){


                const SOURCE = "abcdefghijklmnopqrstuvwxyz0123456789" //元になる文字
                let result = ''

                for(let i=0; i<LENGTH; i++){
                    result += SOURCE[Math.floor(Math.random() * SOURCE.length)];
                }

                return result;
            },

        }

    }
</script>
