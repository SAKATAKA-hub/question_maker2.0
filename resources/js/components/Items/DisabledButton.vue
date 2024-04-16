<template>
    <div>
        <button v-show="!disabled"
        @click="click()"
        :class="style_class"
        :type="type" :name="name" :value="value"
        >{{btn_text}}</button>

        <button v-show="disabled" :class="style_class" disabled type="button" >送信中・・・</button>
    </div>
</template>

<script>
import { valueToNode } from '@babel/types';

    export default {
        data() { return{ } },
        props: {
            //最初に表示する画像のパス
            // disabled: { type: Boolean, default: false, },
            btn_text: { type: String, default: 'ボタン', },
            style_class: { type: String, default: 'btn btn-primary', },
            name:     { type: String, default: '', },
            value:    { type: String, default: '', },
            type:     { type: String, default: 'submit', },
        },
        data() { return {

            disabled: false

        } },
        mounted() { },
        methods:{
            /* ボタンをクリックしたとき */
            click: function(){ this.disabled = true; },
        }
    }
</script>
