<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{title}}{{prop1}}</div>

                    <div class="card-body">{{body}}{{count}}</div>
                    <div>
                        <button @click="countUp">加算</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function() {
            return{


                title : 'タイトル',
                body : '本文ほげほげ',
                count: 0,


            }
        },
        props: {
            //最初に表示する画像のパス
            prop1: { type: String, default: 'prop1', },
            prop2: { type: String, default: 'prop2', },

        },
        mounted() {


            console.log('Component mounted.')


        },
        methods:{

            countUp : function(){ this.count++; }
        }
    }
</script>
