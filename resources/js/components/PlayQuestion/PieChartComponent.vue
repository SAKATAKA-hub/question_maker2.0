<template>
    <div class="">
        <div class="pie-chart-box">
            <div class="percent">
                <svg>

                    <circle class="base" cx="75" cy="75" r="70"></circle>
                    <circle class="line" cx="75" cy="75" r="70"
                    :style=" 'stroke-dashoffset:'+strokeDashoffset+';'+
                    'stroke:'+stroke+';'
                    "></circle>

                </svg>
                <div class="number text-dark">
                    <h5 class="title">{{point}}<span>%</span></h5>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data : function() {
            return{
                strokeDashoffset: 0,
                stroke: '',
                point: 0,

            }
        },
        props: {
            percent_value: { type: String, default: '100', },
            line_color: { type: String, default: '#ED5565', },
        },
        mounted() {
            this.strokeDashoffset = 440 - ( 440 * (this.percent_value/100) );
            this.stroke = this.percent_value != '0' ? this.line_color : '';

            const intervalId = setInterval( ()=>{
                this.point += 1;

                if( this.point +1 > this.percent_value){

                    this.point = this.percent_value;
                    this.changeColor( this.point ); //色の変更

                    clearInterval(intervalId);
                }

            }, 10 )

        },
        methods:{

            /* 色の変更 */
            changeColor: function(point){

                let color = this.line_color;
                if(point >= 100){
                    color = '#14CFA0';
                }else if(point >= 80){
                    color = '#2CBED2 ';
                }else if
                ( point >= 60 ){
                    color = '#FFA833';
                }else{
                    color = '#ED5565';
                }


                this.stroke = color;
            },
        }
    }
</script>
<style scoped>
    .pie-chart-box .percent {
        position: relative;
        width:  150px;
        height: 150px;
    }
    .pie-chart-box .percent svg {
        position: relative;
        width:  150px;
        height: 150px;
        -webkit-transform: rotate(-90deg);
                transform: rotate(-90deg);
    }
    .pie-chart-box .percent svg circle {
        position: relative;
        fill: none;
        stroke-width: 10;
        stroke: #f3f3f3;
        stroke-dasharray: 440;
        stroke-dashoffset: 0;
        stroke-linecap: round;
    }
    .pie-chart-box .percent .number {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        color: #111;
    }
    .pie-chart-box .percent .number .title {
        font-size: 40px;
    }
    .pie-chart-box .percent .number .title span {
        font-size: 22px;
    }
    .pie-chart-box .text {
        padding: 10px 0 0;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
    }
    .pie-chart-box .percent .line {
        -webkit-animation: circleAnim 1s forwards;
                animation: circleAnim 1s forwards;
    }

    @-webkit-keyframes circleAnim {
        0% {
            stroke-dasharray: 0 440;
        }
        99.9%, to {
            stroke-dasharray: 440 440;
        }
    }

    @keyframes circleAnim {
        0% {
            stroke-dasharray: 0 440;
        }
        99.9%, to {
            stroke-dasharray: 440 440;
        }
    }
</style>
