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

                    // ターゲットキー
                    const targetKey = this.getRandomStr(16);

                    // URL正規表現
                    var regex = /(https?|http)(:\/\/[\w\/:%#\$&\?\(\)~\.=\+\-]+)/g; //
                    let result = body.match(regex) || [] ;

                    // ターゲットに印をつける
                    let array = [];
                    for (let index = 0; index < result.length; index++) {
                        const target  = result[index];
                        const replace =`{{${targetKey}${ index }}}`;
                        body = body.replace( target, replace);
                    }

                    // リンクタグに差替え
                    for (let index = 0; index < result.length; index++) {
                        const url     = result[index];
                        const target  = `{{${targetKey}${ index }}}`;
                        const replace =`<a href="${ url }" class="text-break">${ url }</a>`;
                        body = body.replace( target, replace);

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
