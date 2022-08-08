<template>
    <div>
        <!----- [ APIテストボタン ] --------------------->
        <div v-if="test.form" class="card card-body mb-3">

            <h2 class="text-danger fw-bold">APIテスト</h2>

            <div class="d-flex flex-wrap">

                <form :action="route.email_unique_api" method="post" class="mb-3 me-3">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="email" v-model="inputs.email">
                    <button type="submit" class="btn btn-danger text-white">登録済メールアドレスか確認</button>
                </form>

                <form :action="route.register_api" method="post" class="mb-3 me-3">
                    <input type="hidden" name="_token" :value="token">
                    <input v-for="(value, name) in inputs" :key="name" :name="name" :value="value" type="hidden">
                    <button type="submit" class="btn btn-danger text-white">会員登録処理テスト</button>
                </form>

            </div>
        </div>
        <!------------------------------------------------>

        <h3 class="text-secondary fw-bold mb-3">{{ '会員登録' }}</h3>



        <!----- [ ステップ１ ] ----->
        <div v-if="card_num===1" class="anima-fadein-bottom">

            <div class="mb-5">
                <div class="steps flex-row w-100">
                    <div class="step bg-warning text-white">
                        <h5>1</h5><p>入力</p>
                    </div>
                    <div class="step">
                        <h5>2</h5><p>確認</p>
                    </div>
                    <div class="step">
                        <h5>3</h5><p>完了</p>
                    </div>
                </div>
            </div>


            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">


                    <div class="mb-3">
                        <label for="name01">
                            {{ '氏　名' }}
                        <span class="badge bg-danger ms-1" style="transform:translateY(-2px);">必須</span>
                        </label>
                        <input id="name" type="name" class="form-control" v-model="inputs.name" maxlength="50"
                        @change="changeInputName" :class="{'border-danger' : errors.name!=''}"
                        name="name" required placeholder="山田　太郎">

                        <div v-if="errors.name.length">
                            <div class="text-danger">※{{ errors.name }}</div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="email">
                            {{ 'メールアドレス' }}
                            <span class="badge bg-danger ms-1" style="transform:translateY(-2px);">必須</span>
                        </label>
                        <input id="email" type="email" class="form-control" v-model="inputs.email" maxlength="150"
                        @change="changeInputEmail" :class="{'border-danger' : errors.email!=''}"
                        name="email" required  placeholder="yamada@email.co.jp">

                        <div v-if="errors.email.length">
                            <div class="text-danger">※{{ errors.email }}</div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="password">
                            {{ 'パスワード' }}
                            <span class="badge bg-danger ms-1" style="transform:translateY(-2px);">必須</span>
                        </label>
                        <p class="mb-0" style="font-size:.8rem;">※8文字以上20文字以下の半角英数字</p>

                        <input id="password" class="form-control" name="password"
                        :type="input_password.type"
                        @change="changeInputPassword" :class="{'border-danger' : errors.password!=''}"
                        v-model="inputs.password" required autocomplete="current-password">

                        <div v-if="errors.password.length">
                            <div class="text-danger">※{{ errors.password }}</div>
                        </div>

                        <a href="" class="" @click.prevent="toggleDisplayPassword"
                        style="font-size:.5rem; text-decoration:none;">{{ input_password.text }}</a>

                    </div>


                    <div class="mb-5">
                        <label for="password_confirmation">
                            {{ 'パスワードの確認' }}
                            <span class="badge bg-danger ms-1" style="transform:translateY(-2px);">必須</span>
                        </label>
                        <p class="mb-0" style="font-size:.8rem;">※8文字以上20文字以下の半角英数字</p>

                        <input id="password_confirmation" class="form-control" name="password_confirmation"
                        :type="input_password.type"
                        @change="changeInputPasswordConfirmation" :class="{'border-danger' : errors.password_confirmation!=''}"
                        v-model="inputs.password_confirmation" required autocomplete="current-password_confirmation">

                        <div v-if="errors.password_confirmation.length">
                            <div class="text-danger">※{{ errors.password_confirmation }}</div>
                        </div>


                    </div>

                    <div class="card border-light  mb-5">
                        <div class="card-body text-center">
                            <div class="card-title fw-bold  text-center">個人情報の取り扱いについて</div>
                            <p class="card-text" style="font-size:11px;">
                                <a href="#" @click.prevent="windowOpen(route.privacy_policy)">プライバシーポリシー</a>

                                をご確認ください。<br>
                                同意いただけた場合のみ次のステップへお進みください。
                            </p>
                        </div>
                    </div>



                    <div class="row mb-3">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="button" @click="nextToStep01" :disabled="conf_btn_disabled"
                            class="btn rounded-pill btn-warning text-white w-100">
                                {{ '確認' }}
                            </button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!----- [ ステップ２ ] ----->
        <div v-if="card_num===2" class="anima-fadein-bottom">

            <div class="mb-5">
                <div class="steps flex-row w-100">
                    <div class="step bg-warning text-white">
                        <h5>1</h5><p>入力</p>
                    </div>
                    <div class="step  bg-warning text-white">
                        <h5>2</h5><p>確認</p>
                    </div>
                    <div class="step">
                        <h5>3</h5><p>完了</p>
                    </div>
                </div>
            </div>

            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">

                    <h5 class="card-title fw-bold  text-center mb-3">入力内容の確認</h5>
                    <p class="bg-light p-3">
                        入力内容にお間違いなければ登録完了へお進みください。<br>
                        ※登録内容はマイページから変更可能です。
                    </p>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">氏　名</div>
                        <div class="col-md-8 text-secondary">{{inputs.name}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">メールアドレス</div>
                        <div class="col-md-8 text-secondary">{{inputs.email}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">password</div>
                        <div class="col-md-8 text-secondary">
                            <span v-for="( star ,key ) in inputs.password.length" :key="key">*</span>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3">
                            <button type="button" @click="nextToStep02"
                            class="btn rounded-pill btn-warning text-white w-100">
                                {{ '登録' }}
                            </button>
                        </div>

                        <div class="col-sm-8 offset-sm-2">
                            <button @click="subCardNum" type="button"
                            class="btn rounded-pill btn-secondary text-white w-100">
                                {{ '戻る' }}
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!----- [ ステップ３ ] ----->
        <div v-if="card_num===3" class="anima-fadein-bottom">

            <div class="mb-5">
                <div class="steps flex-row w-100">
                    <div class="step bg-success text-white">
                        <h5>1</h5><p>入力</p>
                    </div>
                    <div class="step bg-success text-white">
                        <h5>2</h5><p>確認</p>
                    </div>
                    <div class="step bg-success text-white">
                        <h5>3</h5><p>完了</p>
                    </div>
                </div>
            </div>


            <div class="card shadow w-100 p-3 mb-3">
                <div class="card-body">

                    <h5 class="text-secondary fw-bold mb-3 text-center">会員登録が完了しました。</h5>

                    <h3 class="text-secondary fw-bold mb-3 text-center">
                        ようこそ、{{inputs.name}}さん！
                    </h3>

                    <div class="row mt-5 mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3">
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
                test : { form : false, data : false, },

                /* token ( ログイン処理のページ遷移時に利用 )*/
                token : document.querySelector('[name="csrf_token"]').content,

                /* ルート */
                route : {
                    email_unique_api: document.querySelector('[name="rote_email_unique_api"]').content, //登録済メールアドレスか確認するAPI
                    register_api    : document.querySelector('[name="rote_register_api"]').content,     //会員登録API
                    login           : document.querySelector('[name="route_login"]').content,           // ログイン
                    privacy_policy  : document.querySelector('[name="route_privacy_policy"]').content,  //プライバシーポリシー
                },


                /* 表示中カード番号 */
                card_num : 1,


                /* 入力内容 */
                inputs : {
                    name: '',
                    email: '',
                    password : '',
                    password_confirmation : '',
                },

                /* 確認ボタン */
                conf_btn_disabled: true,


                /* エラー内容 */
                errors : {
                    name: '',
                    email: '',
                    password : '',
                    password_confirmation : '',
                },


                /* パスワード入力の表示形式 */
                input_password : {
                    type : 'password', text : 'パスワードを表示',
                }

            }
        },
        mounted() {

            //* テスト用入力データの挿入 */
            if( this.test.data ){
                this.inputs.name      = '山田　太郎';
                this.inputs.email     = 'yamada@mail.co.jp';
                this.inputs.password  = 'password';
                this.inputs.password_confirmation  = 'password';

                this.conf_btn_disabled = false;
            }
        },
        methods:{
            /* ステップ01の次へメソッド */
            nextToStep01 :function(){

                this.addCardNum();

            },
            /* ステップ02の次へメソッド */
            nextToStep02 :function(){

                // 新規会員情報の登録[ 非同期通信 ]
                fetch( this.route.register_api, {
                    method: 'POST',
                    body: new URLSearchParams({
                        _token : this.token, //token
                        ...this.inputs,      //入力データ一式
                    }),
                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    return response.json();
                })
                .then(json => {
                    this.addCardNum();
                    // console.log( json );
                })

            },

            /*
            | --------------------------------------
            |  入力内容のバリデーション
            | --------------------------------------
            */
            /* 入力の変更[ 氏名 ] */
            changeInputName :function(){

                // 入力必須
                this.errors.name = this.inputs.name == ''
                ? 'メールアドレスの入力は必須です。' : '' ;

                this.confInputs();
            },
            /* 入力の変更[ メールアドレス ] */
            changeInputEmail :function(){

                // 入力必須
                this.errors.email = this.inputs.email == ''
                ? 'メールアドレスの入力は必須です。' : '' ;

                // メール形式
                var pattern = /^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/g;;
                this.errors.email = !this.inputs.email.match(pattern)
                ? 'メール形式で入力してください。' : this.errors.email ;

                this.confInputs();



                // メールの重複確認[ 非同期通信 ]

                    // 他にバリデーションエラーがあれば、以下の処理は実行しない。
                    if( this.errors.email ){ return; }

                    // 非同期通信の通信待ち対策
                    this.errors.email = '確認中・・・';
                    this.confInputs();

                    fetch( this.route.email_unique_api, {
                        method: 'POST',
                        body: new URLSearchParams({
                            _token : this.token,        //token
                            email  : this.inputs.email,
                        }),
                    })
                    .then(response => {
                        if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                        return response.json();
                    })
                    // [ 非同期通信・成功処理 ]
                    .then(json => {

                        this.errors.email = json.email_ique
                        ? 'このメールアドレスは、すでに登録されています。' : '' ;

                        this.confInputs();
                        // console.log( json.email_ique );
                    })

                //

            },
            /* 入力の変更[ パスワード ] */
            changeInputPassword :function(){

                // 入力必須
                this.errors.password = this.inputs.password == ''
                ? 'パスワードの入力は必須です。' : '' ;

                // 8文字以上20文字以下の半角英数字
                var pattern = /^[a-zA-Z0-9_+-]{8,20}$/g;;
                this.errors.password = !this.inputs.password.match(pattern)
                ? '8文字以上20文字以下の半角英数字で入力してください。' : '' ;

                // 入力内容が一致すれば、確認用エラーメッセージの削除
                this.errors.password_confirmation = this.inputs.password_confirmation != this.inputs.password
                ? this.errors.password_confirmation : this.errors.password_confirmation ;

                this.confInputs();
            },
            /* 入力の変更[ パスワードの確認 ] */
            changeInputPasswordConfirmation :function(){

                // 入力必須
                this.errors.password_confirmation = this.inputs.password_confirmation == ''
                ? ' パスワードの確認の入力は必須です。' : '' ;

                // 入力内容が一致するか
                this.errors.password_confirmation = this.inputs.password_confirmation != this.inputs.password
                ? ' 入力内容が一致しません。' : this.errors.password_confirmation ;

                this.confInputs();
            },

            /* 入力内容の確認 */
            confInputs :function(){

                // 全ての入力内容が正しければ、確認ボタンが押せる。
                this.conf_btn_disabled =
                    this.inputs.name && this.inputs.email && this.inputs.password && this.inputs.password_confirmation
                    &&
                    !this.errors.name && !this.errors.email && !this.errors.password && !this.errors.password_confirmation
                ? false : true ;
            },





            /* 次へメソッド */
            addCardNum : function(){
                this.card_num ++;
                window.scroll({top: 0, behavior: 'smooth'});
            },


            /* 前へメソッド */
            subCardNum : function(){
                this.card_num --;
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


            /* 別タブでページを開く */
            windowOpen : function(url){
                window.open(url, '_blank');
            }
        }
    }
</script>
