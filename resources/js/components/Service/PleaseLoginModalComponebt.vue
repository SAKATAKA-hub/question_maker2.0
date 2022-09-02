<template>
    <div>
        <!-- Button trigger modal -->
        <!--

            <button type="button" class="btn btn-primary"
            data-bs-toggle="modal" data-bs-target="#PleaseLoginModal"
            >ログインモーダル</button>

        -->
        <!-- Modal -->
        <div class="modal fade" id="PleaseLoginModal" tabindex="-1" aria-labelledby="PleaseLoginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h5 class="modal-title mb-3" id="PleaseLoginModalLabel">
                            この操作にはログインが必要です。
                        </h5>
                        <a :href="login_form_route"  class="btn btn-success">ログイン・無料会員登録</a>
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

            }
        },
        props: {
            // ログインフォームルート
            login_form_route: { type: String, default: '#', },
        },
        mounted() {
            // ~
        },
        methods:{
            // ~
        },
    }
</script>
