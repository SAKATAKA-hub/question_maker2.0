<template>
    <div>
        <div  class="input-group overflow-hidden border" style="border-radius:1.6rem;">
            <input type="text" name="seach_keywords" class="form-control bg-white border-0 ps-3"
            v-model="value" placeholder="キーワード" aria-label="SeachKeywords" aria-describedby="basic-addon1">
            <!--delete btn-->
            <span class="py-0 input-group-text bg-transparent border-0 px-0" id="basic-addon1">
                <button type="button" class="btn btn-sm" @click="click"><i class="bi bi-x-circle"></i></button>
            </span>
            <!--seach btn-->
            <span class="py-0 input-group-text bg-success border-0" id="basic-addon1">
                <button type="submit" class="btn btn-sm text-white fs-5"><i class="bi bi-search"></i></button>
            </span>
        </div>
    </div>
</template>

<script>

export default {
    name: 'timer',
    data() {
        return {

            value: '',

        }
    },
    props: {
        //制限時間
        keywords: { type: String, default: '', },
    },
    mounted() {
        this.value = this.keywords;
    },
    methods: {
        click: function() {
            this.value = '' ;
        }
    },
}
</script>
