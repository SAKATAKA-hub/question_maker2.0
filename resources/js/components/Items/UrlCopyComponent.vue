<template>
    <div>
        <div class="">
            <!-- <input type="text" class="form-control border-0" style="font-size:11px;"
            :value="copy_url"  disabled > -->




            <button v-if=" !disabled "
            class="btn bg-light btn-sm border-secondary w-100 text-secondary" type="button" style="font-size:11px;"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="URLのコピー"
            @click="copy(copy_url)"
            >
                <i class="bi bi-link-45deg me-2"></i>
                URLコピー

            </button>


            <button v-else disabled
            class="btn text-white btn-sm border-success bg-success w-100" type="button" style="font-size:11px;"
            ><i class="bi bi-check me-2"></i>完　了
            </button>
        </div>
    </div>
</template>

<script>
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
