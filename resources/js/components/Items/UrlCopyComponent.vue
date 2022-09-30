<template>
    <div>
        <div class="input-group border" style=" border-radius:5px;">
            <input type="text" class="form-control border-0" style="font-size:11px;"
            :value="copy_url"  disabled >




            <button v-if=" !disabled "
            class="btn bg-white btn-sm border-white" type="button" style="font-size:11px;"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="URLのコピー"
            @click="copy(copy_url)"
            ><i class="bi bi-files"></i>コピー
            </button>


            <button v-else disabled
            class="btn bg-white btn-sm border-success text-success" type="button" style="font-size:11px;"
            ><i class="bi bi-check"></i>　完了
            </button>
        </div>
    </div>
</template>

<script>
    /*
    --------------------------------------------------------------------------
        [ 使い方 ]
        <submit-button-component
            style_class="btn btn-danger" // スタイルクラスの指定
            text="確定"                  // ボタンテキストの指定
        />
    --------------------------------------------------------------------------
    */

    export default {
        data : function() {
            return{

                disabled: false,

            }
        },
        props: {
            // ボタンのスタイルクラス
            copy_url: { type: String, default: 'http://---',},
        },
        methods:{

            copy : function(text) {
                navigator.clipboard.writeText(text)
                .then(() => {
                    this.disabled = true;
                    window.setTimeout( this.disabled_false , 2000);
                })
                .catch(e => {
                    console.error(e)
                })
            },

            disabled_false: function(){ this.disabled = false }

        }
    }
</script>
