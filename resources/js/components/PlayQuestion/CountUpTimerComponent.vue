<template>
    <div class="d-inline">{{ formatTime }}</div>
</template>

<script>

export default {
    name: 'timer',
    data() {
        return {
            //経経過時間
            hour: 0, min: 0, sec: 0,
            //制限時間
            limit_hour: 0, limit_min: 0, limit_sec: 0,

            timerOn: false,
            timerObj: null,

        }
    },
    props: {

        //制限時間
        time_limit: { type: String, default: '00:00:00', },
    },
    mounted() {

        // 制限時間が指定されているとき
        if(this.time_limit){

            //制限時間の登録
            const times = this.time_limit.split(':')
            this.limit_hour = times[0];
            this.limit_min  = times[1];
            this.limit_sec  = times[2];

        } else {
            this.limit_hour = 99;
            this.limit_min  = 99;
            this.limit_sec  = 99;
        }

        // カウントの開始
        this.start();

    },
    methods: {

        count: function() {
            if(this.limit_hour==this.hour && this.limit_min==this.min && this.limit_sec==this.sec){
                this.stop();
            } else if (this.sec >= 59 && this.min >= 59) {
                this.hour  ++;
                this.min = 0;
                this.sec = 0;
            } else if (this.sec >= 59) {
                this.min ++;
                this.sec = 0;
            } else {
                this.sec ++;
            }

            /*経過時間フォーマットを渡す*/
            this.$emit('getElapsedTime', this.formatTime);
        },

        start: function() {
            let self = this;
            this.timerObj = setInterval(function() { self.count() }, 1000);
            this.timerOn = true; //timerがONであることを状態として保持
        },
        stop: function() {
            clearInterval(this.timerObj);
            this.timerOn = false; //timerがOFFであることを状態として保持
        },

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
