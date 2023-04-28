<template>
    <div class="inline-block" @click="click">{{text}}</div>
</template>

<script>

export default {
    props: {
        open: { type: [String,Number], default: 0, },
    },
    data() {
        return {

            text: '詳しく見る',
            view: 0,

        }
    },
    mounted() {
        this.view = this.open;
        this.text = this.view ?  '閉じる' : '詳しく見る' ;
    },
    methods: {
        click: function() {
            this.text = this.view ? '詳しく見る' : '閉じる' ;
            this.view = this.view ? 0 : 1 ;
        }
    },
}
</script>
