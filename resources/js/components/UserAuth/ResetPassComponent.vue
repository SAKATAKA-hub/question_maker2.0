<template>
    <div>

        <!----- [ APIテストボタン ] --------------------->
        <div v-if="test.form" class="card card-body mb-3">

            <h2 class="text-danger fw-bold">APIテスト</h2>

            <div class="d-flex flex-wrap">

                <form :action="api_route.step01" method="post" class="mb-3 me-3">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="patch">
                    <input v-for="(value, name) in inputs" :key="name" :name="name" :value="value" type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ステップ01テスト</button>
                </form>

                <form :action="api_route.step02" method="post" class="mb-3 me-3">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="patch">
                    <input v-for="(value, name) in inputs" :key="name" :name="name" :value="value"  type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ステップ02テスト</button>
                </form>

                <form :action="route.login" method="post" class="mb-3 me-3">
                    <input type="hidden" :value="token" name="_token">
                    <input v-for="(value, name) in inputs" :key="name" :name="name" :value="value" type="hidden">
                    <button type="submit" class="btn btn-danger text-white">ログイン</button>
                </form>

            </div>
        </div>
        <!------------------------------------------------>

        <!----- [ ステップ１ ] ----->
        <div v-if="card_num === 1" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-3">{{ 'パスワード変更' }}</h3>

                    <div class="mb-5">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email"
                        v-model="inputs.email" :class="{'border-danger' : errors.email }"
                        required autocomplete="email" autofocus>

                        <div v-if="errors.email" class="text-danger" role="alert">※{{ errors.email }}</div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="submit" @click="nextToStep01"
                            class="btn rounded-pill btn-success text-white w-100">
                                次へ
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!----- [ ステップ２ ] ----->
        <div v-if="card_num === 2" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-3">{{ 'パスワード変更' }}</h3>

                    <div class="mb-5">
                        <p class="bg-light p-3">
                            入力されたメールアドレス宛にメールをお送りしました。<br>
                            メールに記載された6ケタの認証番号を入力してください。
                        </p>

                        <label for="reset_pass_code">{{ '認証番号（半角数字）' }}</label>
                        <input id="reset_pass_code" type="text" class="form-control w-50" name="reset_pass_code"
                        v-model="inputs.reset_pass_code" :class="{'border-danger' : errors.reset_pass_code }"
                        required autocomplete="current-reset_pass_code">

                        <div v-if="errors.reset_pass_code">
                            <div v-for="(error, key) in errors.reset_pass_code" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="password" class="d-flex justify-content-between align-items-center">
                            {{ 'パスワード' }}
                            <a href="" class="btn btn-link" @click.prevent="toggleDisplayPassword"
                            style="font-size:.5rem; text-decoration:none;">{{ input_password.text }}</a>
                        </label>
                        <p class="mb-0" style="font-size:.8rem;">※8文字以上20文字以下の半角英数字</p>

                        <input id="password" class="form-control" name="password"
                        :type=" input_password.type" :class="{'border-danger' : errors.password }"
                        v-model="inputs.password" required autocomplete="current-password">

                        <div v-if="errors.password">
                            <div v-for="(error, key) in errors.password" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="password_confirmation">{{ 'パスワードの確認' }}</label>
                        <p class="mb-0" style="font-size:.8rem;">※8文字以上20文字以下の半角英数字</p>

                        <input id="password_confirmation" class="form-control" name="password_confirmation"
                        :type="input_password.type"
                        v-model="inputs.password_confirmation" required autocomplete="current-password_confirmation">

                        <div v-if="errors.password_confirmation">
                            <div v-for="(error, key) in errors.password_confirmation" :key="key" class="text-danger"
                            role="alert">※{{ error }}</div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="submit" @click="nextToStep02" class="btn rounded-pill btn-success text-white w-100">
                                次へ
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!----- [ ステップ３ ] ----->
        <div v-if="card_num === 3" class="anima-fadein-bottom">
            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <h3 class="text-secondary fw-bold mb-5">{{ 'パスワード変更' }}</h3>

                    <h5 class="text-secondary fw-bold text-center">新しいパスワードに変更しました。</h5>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-8 offset-md-2">
                            <form :action="route.login" method="post" class="mb-3"
                             onsubmit="stopOnbeforeunload()"
                            >

                                <input type="hidden" :value="token"           name="_token">   <!-- token -->
                                <input type="hidden" :value="inputs.email"    name="email" >   <!-- email -->
                                <input type="hidden" :value="inputs.password" name="password"> <!-- password -->

                                <button type="submit"
                                class="btn rounded-pill btn-success w-100">{{ 'ログインする' }}</button>

                            </form>
                        </div>
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

                /* test用フォーム・データの利用 */
                test : { form : false,},


                /* token ( ログイン処理のページ遷移時に利用 )*/
                token : document.querySelector('[name="csrf_token"]').content,

                /* ルート */
                api_route : {
                    step01 : document.querySelector('[name="api_route_step01"]').content,
                    step02 : document.querySelector('[name="api_route_step02"]').content,
                },
                route : {
                    login : document.querySelector('[name="route_login"]').content,// ログイン
                },


                /* 表示中カード番号 */
                card_num : 1,


                /* 入力内容 */
                inputs : {
                    email: '',
                    reset_pass_code : '',//認証コード(入力)
                    reset_pass_code_confirmation : '',//認証コード
                    password : '',
                    password_confirmation : '',
                },
                /* エラー内容 */
                errors : {},


                /* パスワード入力の表示形式 */
                input_password :{
                    type : 'password', text : 'パスワードを表示',
                },


            }
        },
        mounted() {
            //
        },
        methods:{

            /* ステップ01の次へメソッド */
            nextToStep01 :function(){

                // [ 非同期通信 ]
                fetch(this.api_route.step01, {

                    method: 'POST',
                    body: new URLSearchParams({
                        _token  : this.token, //token
                        _method : 'patch',    //method
                        ...this.inputs,      //入力データ一式
                    }),

                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {
                    if(!json.errors) //[ バリデーション・成功 ]
                    {
                        this.addCardNum();
                        this.errors = {};
                        // console.log( json );
                    }
                    else //[ バリデーション・失敗 ]
                    {
                        this.errors = json.errors;
                        // console.log( json );
                    }
                })

            },
            /* ステップ02の次へメソッド */
            nextToStep02 :function(){

                // [ 非同期通信 ]
                fetch(this.api_route.step02, {

                    method: 'POST',
                    body: new URLSearchParams({
                        _token  : this.token, //token
                        _method : 'patch',    //method
                        ...this.inputs,      //入力データ一式
                    }),

                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                // [ 非同期通信・成功処理 ]
                .then(json => {
                    if(!json.errors) //[ バリデーション・成功 ]
                    {
                        this.addCardNum();
                        this.errors = {};
                        // console.log( json );
                    }
                    else //[ バリデーション・失敗 ]
                    {
                        this.errors = json.errors;
                        console.log( json );
                    }
                })

            },


            /* 次へメソッド */
            addCardNum : function(){
                this.card_num ++;
                window.scroll({top: 0, behavior: 'smooth'});
            },


            /* パスワード入力の表示切替 */
            toggleDisplayPassword : function(){

                let type = this.input_password.type;
                if( type === 'password' )
                {
                    this.input_password.text = 'パスワードを非表示';
                    this.input_password.type = 'text';
                }
                else
                {
                    this.input_password.text = 'パスワードを表示';
                    this.input_password.type = 'password';
                }
            },
        }
    }
</script>
