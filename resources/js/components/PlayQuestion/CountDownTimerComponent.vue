<template>
    <div class="d-inline">{{ formatTime }}</div>
</template>

<script>

export default {
    name: 'timer',
    data() {
        return {

            hour: 0, min: 0, sec: 0,
            timerOn: false,
            timerObj: null,

        }
    },
    props: {
        //制限時間
        time_limit: { type: String, default: '01:00:00', },

    },
    mounted() {

        // 制限時間が指定されているとき
        if(this.time_limit){
            const times = this.time_limit.split(':')
            this.hour = times[0];
            this.min  = times[1];
            this.sec  = times[2];

            // カウントの開始
            this.start();
        }

    },
    methods: {

        count: function() {

            if (this.sec <= 0 && this.min <= 0 && this.hour >= 1) {
                this.hour  --;
                this.min = 59;
                this.sec = 59;
            } else if (this.sec <= 0 && this.min >= 1) {
                this.min --;
                this.sec = 59;
            } else if(this.sec <= 1 && this.min <= 0 && this.hour <= 0) {
                this.complete();
            } else {
                this.sec --;
            }
        },

        start: function() {
            let self = this;
            this.timerObj = setInterval(function() { self.count() }, 1000);
            this.timerOn = true; //timerがONであることを状態として保持
        },

        // stop: function() {
        //     clearInterval(this.timerObj);
        //     this.timerOn = false; //timerがOFFであることを状態として保持
        // },

        complete: function() {

            this.sec = 0;
            clearInterval(this.timerObj);

            //親コンポーネントの'time_up'関数を実行
            this.$emit('time_up');
        }
    },
    computed: {
        formatTime: function() {

            let timeStrings = [

                this.hour.toString(),
                this.min.toString(),
                this.sec.toString(),

            ].map( function(str) {

                if (str.length < 2) {
                    return "0" + str;
                } else {
                    return str;
                }

            })

            // return timeStrings[0] + ":" + timeStrings[1] + ":" + timeStrings[2] ;
            return timeStrings[0] + "時間" + timeStrings[1] + "分" + timeStrings[2] + "秒" ;
        }
    }
}
</script>
