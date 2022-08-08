<template>
    <div>{{ formatTime }}
        <!-- <div id="timer">
            <div class="timer">
                <div class="time">
                    {{ formatTime }}
                </div>
                <button v-on:click="start" v-if="!timerOn">Start</button>
                <button v-on:click="stop" v-if="timerOn">Stop</button>
            </div>
        </div> -->
    </div>
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

        const times = this.time_limit.split(':')
        this.hour = times[0];
        this.min  = times[1];
        this.sec  = times[2];

        // カウントの開始
        this.start();

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
            } else if(this.sec <= 0 && this.min <= 0) {
                this.complete();
            } else {
                this.sec --;
            }
        },

        start: function() {
            let self = this;
            this.timerObj = setInterval(function() { self.count() }, 1000)
            this.timerOn = true; //timerがONであることを状態として保持
        },

        // stop: function() {
        //     clearInterval(this.timerObj);
        //     this.timerOn = false; //timerがOFFであることを状態として保持
        // },

        complete: function() {
            clearInterval(this.timerObj)
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

            return "残り時間：" +timeStrings[0] + "時間" + timeStrings[1] + "分" + timeStrings[2] + "秒";
        }
    }
}
</script>

<style scoped>
#timer {
  display: flex;
  align-items: center;
  justify-content: center;
}
.time {
  font-size: 100px;
}
</style>
