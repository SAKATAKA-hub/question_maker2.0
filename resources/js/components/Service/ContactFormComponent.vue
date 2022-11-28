<template>
    <div>
        <!----- [ APIテストボタン ] --------------------->
        <div v-if="test.form" class="card card-body mb-3">

            <h2 class="text-danger fw-bold">APIテスト</h2>

            <div class="d-flex flex-wrap">
                <form :action="route.post_api" method="post" class="mb-3 me-3">
                    <input type="hidden" name="_token" :value="token">
                    <input v-for="(value, name) in inputs" :key="name" :name="name" :value="value" type="hidden">
                    <button type="submit" class="btn btn-danger text-white">会員登録テスト</button>
                </form>
            </div>

        </div>
        <!------------------------------------------------>

        <!----- [ ステップ1 ] ----->
        <div v-if="card_num===1" class="anima-fadein-bottom">

            <!-- step -->
            <div class="mb-3">
                <div class="steps flex-row w-100">
                    <div class="step bg-success text-white">
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

            <!-- form -->
            <div class="card">
                <div class="card-body">


                    <!-- 氏名 -->
                    <div class="mb-3">
                        <label for="contact_name" class="form-label">
                            氏名<small class="text-danger ms-3">※必須</small>
                        </label>
                        <input type="text" name="name" class="form-control" id="contact_name"
                        @input="changeInputName" :class="{'border-danger' : errors.name!=''}" v-model="inputs.name"
                        placeholder="山田　太郎" maxlength="50" required>

                        <div v-if="errors.name.length">
                            <div class="text-danger">※{{ errors.name }}</div>
                        </div>
                    </div>


                    <!-- メールアドレス -->
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">
                            メールアドレス<small class="text-danger ms-3">※必須</small>
                        </label>
                        <input type="email" name="email" class="form-control" id="contact_email"
                        @input="changeInputEmail" :class="{'border-danger' : errors.email!=''}" v-model="inputs.email"
                        placeholder="yamada@mail.co.jp" maxlength="50" required>

                        <div v-if="errors.email.length">
                            <div class="text-danger">※{{ errors.email }}</div>
                        </div>
                    </div>


                    <!-- 本文 -->
                    <div class="mb-3">
                        <label for="contact_body" class="form-label">
                            本文<small class="text-danger ms-3">※必須</small>
                        </label>

                        <textarea class="form-control" name="body" id="contact_body" rows="6"
                        @input="changeInputBody" :class="{'border-danger' : errors.body!=''}" v-model="inputs.body"
                        placeholder="お問い合わせ内容をご入力ください。" required></textarea>

                        <div v-if="errors.body.length">
                            <div class="text-danger">※{{ errors.body }}</div>
                        </div>
                    </div>

                    <div class="card border mb-5">
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
                            class="btn rounded-pill btn-success text-white w-100">
                                {{ '確認' }}
                            </button>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <!----- [ ステップ2 ] ----->
        <div v-if="card_num===2" class="anima-fadein-bottom">


            <div class="mb-3">
                <div class="steps flex-row w-100">
                    <div class="step bg-success text-white">
                        <h5>1</h5><p>入力</p>
                    </div>
                    <div class="step bg-success text-white">
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
                        入力内容にお間違いなければ登録完了へお進みください。
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
                        <div class="col-md-4 fw-bold">本文</div>
                        <div class="col-md-8 text-secondary">
                            <div v-html="inputs.body.replace(/\r?\n/g, '<br>')"></div>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3">
                            <button type="button" @click="nextToStep02"
                            class="btn rounded-pill btn-success text-white w-100" :disabled="conp_btn_disabled">
                                {{ '登録' }}
                            </button>
                        </div>

                        <div class="col-sm-8 offset-sm-2">
                            <button @click="subCardNum" type="button"
                            class="btn rounded-pill btn-light border w-100">
                                {{ '戻る' }}
                            </button>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <!----- [ ステップ3 ] ----->
        <div v-if="card_num===3" class="anima-fadein-bottom">


            <div class="mb-3">
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

                    <h5 class="text-secondary fw-bold mb-3 text-center">お問い合わせの受付が完了しました。</h5>

                    <p class="text-center" style="line-height:2rem;">
                        お問い合わせいただき、ありがとうございました。<br>
                        確認の為、自動編メールをお送りいたします。
                    </p>

                    <div class="row mt-5 mb-3">
                        <div class="col-sm-8 offset-sm-2 mb-3 text-center">

                            <a href="#" class="text-decoration-none text-success" @click.prevent="windowOpen(route.home)">Homeに戻る</a>

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
                token       : document.querySelector('[name="csrf_token"]').content,
                company_key : document.querySelector('[name="company_key"]').content,

                /* ルート */
                route : {
                    post_api        : document.querySelector('[name="route_post_api"]').content,        // ログイン
                    admin_send_email : document.querySelector('[name="route_admin_send_email"]').content, // 管理者メール送信
                    privacy_policy  : document.querySelector('[name="route_privacy_policy"]').content,  //プライバシーポリシー
                    home  : document.querySelector('[name="route_home"]').content,                      //Home
                },


                /* 表示中カード番号 */
                card_num : 1,


                /* 入力内容 */
                inputs : {
                    name: '',
                    email: '',
                    body : '',
                },


                /* 確認ボタン */
                conf_btn_disabled: true,

                /* 完了ボタン */
                conp_btn_disabled: false,


                /* エラー内容 */
                errors : {
                    name: '',
                    email: '',
                    body : '',
                },



            }
        },
        mounted() {

            // test data
            if( this.test.data ){
                this.inputs = {  name: 'テスト　太郎',  email: 'contact@next-arrow.co.jp',  body : 'テストテキスト',  };
                this.card_num = 2;
            }

        },
        methods:{
            /* ステップ01の次へメソッド */
            nextToStep01 :function(){

                this.addCardNum();

            },
            /* ステップ02の次へメソッド */
            nextToStep02 :function(){

                //完了ボタン
                this.conp_btn_disabled = true;

                // 新規会員情報の登録[ 非同期通信 ]
                fetch( this.route.post_api, {
                    method: 'POST',
                    body: new URLSearchParams({
                        _token : this.token, //token
                        ...this.inputs,      //入力データ一式
                    }),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {

                    // 次のページ
                    this.addCardNum();

                    /* 管理者へメール送信 */
                    this.SendAdminEmail();

                    // console.log( json );
                })
                .catch(err=>{
                    alert('データ送信エラーが発生しました。再読み込みします。');
                    location.reload();
                })



            },
            /* 管理者へメール送信 */
            SendAdminEmail :function(){

                // 新規会員情報の登録[ 非同期通信 ]
                fetch( this.route.admin_send_email, {
                    method: 'POST',
                    body: new URLSearchParams({
                        app_key: this.company_key, //app_key
                        ...this.inputs,      //入力データ一式
                    }),
                })
                .then(response => {
                    if(!response.ok){ throw new Error('送信エラー'); }
                    return response.json();
                })
                .then(json => {
                    // this.addCardNum();
                    console.log( json );
                })
                .catch(err=>{
                    alert('データ送信エラーが発生しました。再読み込みします。');
                    location.reload();
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
                ? '氏名の入力は必須です。' : '' ;

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

            },
            /* 入力の変更[ 本文 ] */
            changeInputBody :function(){

                // 入力必須
                this.errors.body = this.inputs.body == ''
                ? '本文の入力は必須です。' : '' ;

                this.confInputs();
            },
            /* 入力内容の確認 */
            confInputs :function(){

                // 全ての入力内容が正しければ、確認ボタンが押せる。
                this.conf_btn_disabled =
                    this.inputs.name && this.inputs.email && this.inputs.body
                    &&
                    !this.errors.name && !this.errors.email && !this.errors.body
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




            /* 別タブでページを開く */
            windowOpen : function(url){
                window.open(url, '_blank');
            }
        }
    }
</script>
