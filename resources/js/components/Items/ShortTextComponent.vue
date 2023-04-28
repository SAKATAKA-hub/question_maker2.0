<template>
    <div>


       <!-- <div class="">{{ view_text }}</div> -->
       <replace-text-component :text="view_text"></replace-text-component>

        <a href="" @click.prevent="changeView" style="font-size:11px;">{{ btn_text }}</a>


    </div>
</template>

<script>
    /**
     * 文章置換え（改行・リンクタグ対応）
     *
     *
    */
    export default {
        props: {

            text:   { type: String, default: 'test', },     //テキストの原文
            length: { type: [String,Number], default: 16, }, //テキスト省略時の文字数
            open:   { type: [String,Number], default: 0, },

        },
        data : function() {
            return{
                view: 0,
                view_text: 'hoge',//表示するテキスト
                btn_text: '',
            }
        },
        mounted() {
            this.view = this.view ? 0 : 1 ;
            this.changeView();
        },
        methods:{

            /* 表示の切り替え */
            changeView: function() {
                this.view      = this.view ? 0 : 1 ;
                this.btn_text  = this.view ? '閉じる' : '詳しく見る' ;
                this.view_text = this.view ? this.text : this.text.substring(0, Number( this.length ) )+'...' ;
            },


        }

    }
</script>
