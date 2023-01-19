<template>
    <div class="">


        <!-- table card -->
        <div v-if="!users_list.length"
        class="my-5 d-flex justify-content-center">

            <div class="spinner-border text-secondary" role="status">
                <span class="visually-hidden ">Loading...</span>
            </div>
        </div>
        <div v-else
        class="card mb-3" style="max-height: 50vh; overflow:auto;">
            <table class="table bg-white mb-0" style="min-width:600px;">
                <tbody>
                    <!-- header -->
                    <tr class="bg-light">
                        <th scope="col"></th>
                        <th scope="col">名前</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">入会日</th>
                        <th scope="col">問題作成数</th>
                    </tr>
                    <!-- body -->
                    <tr v-for="( user , key ) in users_list" :key="key">

                        <!--チェックボックス-->
                        <th scope="row" class="text-warning text-center">
                            <input :value="user.id" v-model="list_checkes.user_ids"
                            name="user_ids[]" class="form-check-input m-0" type="checkbox" >
                        </th>
                        <th scope="row" class="p-0">
                            {{user.name}}
                        </th>
                        <td class="text-start">
                            {{user.email}}
                        </td>
                        <td class="text-start">
                            {{user.created_at.substring(0,10)}}
                        </td>
                        <td class="text-center">
                            {{ user.question_groups_count }}
                        </td>

                    </tr>
                    <!-- footer -->
                    <!-- <tr class="bg-white">
                        <th scope="col" colspan="6" class="border-0">
                            <div class="row g-3">
                                <button class="col-auto btn btn-link text-decoration-none">メールアドレス一括表示 ></button>
                            </div>
                        </th>
                    </tr> -->

                </tbody>
            </table>
        </div><!-- end table card -->

    </div>
</template>

<script>
    export default {
        data : function() {
            return{


                users_list_inputs:{ api_key: '', },

                users_list: {},

                // テーブルのチェックボックス
                list_checkes: {
                    api_key: '',
                    user_ids: []
                },

            }
        },
        props: {
            //最初に表示する画像のパス
            api_key: { type: String, default: '', },
            route_user_list:{ type: String, default: '', }, //一覧情報

        },
        mounted() {


            /* api_keyの保存 */
            this.setApiKey();

            /* 求職者一覧情報の取得 */
            this.getUsersList();



        },
        methods:{


            /* api_keyの保存 */
            setApiKey: function(){
                this.users_list_inputs.api_key = this.api_key;
                this.list_checkes.api_key = this.api_key;
            },


            /* 求職者リスト情報の取得 */
            getUsersList: function(){

                // [ 非同期通信 ]
                fetch( this.route_user_list, {
                    method: 'POST',
                    body: new URLSearchParams( this.users_list_inputs ),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {
                    console.log( json );
                    this.users_list = json.users;
                })
                .catch(err=>{

                    // リロード
                    // alert('通信エラーが発生しました。再読みを行います。');
                    this.getUsersList();
                })

            },

        }
    }
</script>
