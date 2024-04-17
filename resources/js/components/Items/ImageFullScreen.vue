<template>
    <div class="w-100">
        <!-- Button trigger modal -->
        <button :class="'btn p-0 '+style_class"
        type="button"
        data-bs-toggle="modal" :data-bs-target="'#'+target_key">

            <img v-if="type=='image'"
            :src="src" class="w-100" :alt="alt"/>

            <div v-else class="w-100" style="
            background: no-repeat center center / cover;
            border-radius: .5rem; "
            :style="'background-image:url('+src+');'"
            ></div>

        </button>
        <div class="d-flex align-items-center gap-2" style="font-size: 11px;">
            <i class="bi bi-exclamation-circle"></i>クリックで拡大
        </div>

        <!-- Modal -->
        <div class="modal fade" :id="target_key"
        tabindex="-1" :aria-labelledby="target_key+'Label'" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">

                <div class="modal-content">
                    <div class="modal-body bg-dark border-0">
                        <div class="container" style="max-width:900px;">


                            <div class="text-end mt-">
                                <button type="button" class="btn text-white px-0" data-bs-dismiss="modal">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-x-lg fs-3"></i>閉じる
                                    </div>
                                </button>
                            </div>

                            <img :src="src" class="w-100" alt="問題画像"/>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() { return{} },
        props: {
            //最初に表示する画像のパス
            src:  { type: String, default: '', },
            target_key:  { type: String, default: 'imageModalHoge', },
            alt:  { type: String, default: '画像', },
            type:  { type: String, default: 'image', },
            style_class: { type: String, default: '', },
        },
        mounted() {},
        methods:{}
    }
</script>
