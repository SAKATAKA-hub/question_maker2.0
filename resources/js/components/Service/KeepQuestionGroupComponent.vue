<template>
    <div>

        <form :action="route" v-show="test" method="POST">
            <input v-for="(input, key) in inputs" :key="key"
            type="text" :name="key" :value="input"
            >
            <button type="submit" class="btn btn-primary btn-sm">お気に入り</button>
        </form>


        <button class="like_btn btn btn-sm" :class="{'show':!inputs.keep}" @click="click" type="button">
            <div class="icon w-100">
                <i class="fs-5 bi bi-heart"></i>
                <i class="fs-5 bi bi-heart-fill text-danger"></i>
            </div>
            <div style="font-size:.6rem;">いいね</div>
        </button>

    </div>
</template>
<script>
    export default {
        data : function() {
            return{

                test: false,


                inputs:{
                    _token: document.querySelector('[name="csrf_token"]').content,
                    user_id: '',
                    question_group_id: '',
                    keep: 1,// keepの状態が１のとき、送信内容は0（状態と送信内容は逆に登録）
                },


            }
        },
        props: {
            route:           { type: String, default: '', },
            user_id:           { type: String, default: '', },
            question_group_id: { type: String, default: '', },
            keep:              { type: String, default: '1', },

        },
        mounted() {

            this.inputs.user_id = this.user_id;
            this.inputs.question_group_id = this.question_group_id;
            this.inputs.keep = (this.keep==1) ? 0 : 1 ;// keepの状態が１のとき、送信内容は0（状態と送信内容は逆に登録）

        },
        methods:{

            click: function(){

                // [ 非同期通信 ]
                fetch( this.route, {
                    method: 'POST',
                    body: new URLSearchParams( this.inputs ),
                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    // return response.json();
                })
                .then(json => {
                    // 表示の切り替え
                    this.inputs.keep = !this.inputs.keep ? 1 : 0 ;

                    // console.log( json );
                })


            },
        }
    }
</script>
<style scoped>
    .like_btn>.icon{
        position: relative;
    }
    .like_btn>.icon>.bi-heart{
        display: block;
        width: 100%;
    }

    .like_btn>.icon>.bi-heart-fill{
        display: none;
    }
    .show >.icon>.bi-heart{
        visibility: hidden;
    }
    .show >.icon>.bi-heart-fill{
        display: block;
        position: absolute;
        width: 100%;
        top:0;left:0;
        animation: icon .5s;
        transform-origin: center center;
    }
    @keyframes icon{
        0% {
            transform: scale(1);
        }
        50%{
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
