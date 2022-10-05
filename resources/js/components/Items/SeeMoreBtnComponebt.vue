<template>
    <div class="inline-block" @click="click">{{text}}</div>
</template>

<script>

export default {
    name: 'timer',
    data() {
        return {

            text: '詳しく見る',
            open: false,

        }
    },
    props: {
        //制限時間
        btn_text: { type: String, default: '詳しく見る', },
        class:    { type: String, default: 'text-decoration-none text-success', },
    },
    mounted() {
        this.text = this.btn_text;
    },
    methods: {
        click: function() {
            this.text = this.open ? '詳しく見る' : '閉じる' ;
            this.open = this.open ? false : true ;
        }
    },
}
</script>
