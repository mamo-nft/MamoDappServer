<template>
    <section class="section-con">
        <div class="left-con">
            <div class="happy-go-lucky linear-border">
                <div class="title">Happy Go Lucky</div>
                <div class="sub-title">Round #20 Contract Drained in</div>
                <div class="countdown">{{secondToTime(countdownTime)}}</div>
                <div class="active-pot">Active Pot (Mamo)</div>
                <div class="active-pot-num">{{activePot}}</div>
            </div>
            <div class="purchase">
                <img src="@/assets/purchase.png"/>
            </div>
            <div class="lucky-con">
                <div class="lucky-mamo">
                    <img src="@/assets/lucky-pic.png"/>
                </div>
                <div class="lucky-one-con">
                    <img class="lucky-title" src="@/assets/lucky-title.png"/>
                    <div class="lucky-one linear-border">
                        <div class="address">
                            {{luckyAddress}}
                        </div>
                        <div class="account">
                            <label>Buy Amount</label>
                            <span>{{luckyAmount}} BUSD</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-con">
            <div class="how-to-play" @click="howToPlay">
                <img src="@/assets/how-to-play.png"/>
            </div>
            <div class="reward-pool-con">
                <div class="title">
                    <img src="@/assets/reward-pool.png"/>
                </div>
                <div class="contract-address-con">
                    <div class="top">
                        <div class="title">CONTRACT ADDRESS</div>
                        <div class="copy-btn" @click="copyAddress(contractAddress)">COPY</div>
                    </div>
                    <div class="address">
                        {{contractAddress}}
                    </div>
                </div>
            </div>
            <div style="height: 50px;"></div>
            <trade-log :list="dexList"></trade-log>
        </div>
    </section>
</template>

<script>
import TradeLog from './tradeLog';
import {getDex} from '@/api/common';
import Clipboard from 'clipboard';
import swal from 'sweetalert';

let prevTxtoken = '';

export default {
    components: {
        TradeLog
    },
    data () {
        return {
            dexList: [],
            // timer
            countDownTimer: null,
            countdownTime: 60*15,
            dexTimer: null,
            contractAddress: '0x6e321536eCb4AdE7186f9680701C4A7eAb3919Bf',
            luckyAddress: '0x6e321536eCb4AdE7186f9680701C4A7eAb3919Bf',
            luckyAmount: '895384.94',
            activePot: '9487394.0953'
        }
    },
    async mounted () {
        const that = this;
        // load new trade
        that.loadDexList();
        this.dexTimer = setInterval(function(){
            that.loadDexList();
        }, 10*1000);
    },
    beforeDestroy(){
        this.dexTimer && clearInterval(this.dexTimer);
    },
    methods: {
        loadDexList(){
            const that = this;
            getDex({}).then(res=>{
                if(!res || res.length <= 0){
                    return;
                }
                let dexList = [];
                for(let i in res) {
                    let item = res[i];
                    if (item[3] == 'Sell') {
                        continue;
                    }
                    dexList.push(item);
                }
                this.dexList = dexList;
                const firstDex = res[0][0];
                if(firstDex && prevTxtoken != firstDex){
                    prevTxtoken = firstDex;
                    that.runTimer();
                }
            })
        },
        runTimer(){
            const that = this;
            // 倒计时
            clearInterval(this.countDownTimer);
            this.countdownTime = 60*15;
            this.countDownTimer = setInterval(() => {
                that.countdownTime--
                if (that.countdownTime === 0) {
                    clearInterval(this.countDownTimer)
                }
            }, 1000)
        },
        // 秒转时间
        secondToTime(second){
            let s = Math.floor(second%60);
            s = s < 10 ? '0' + s : s;
            let m = Math.floor((second / 60) % 60);
            m = m < 10 ? '0' + m : m;
            let h = Math.floor((second / 3600) % 24);
            h = h < 10 ? '0' + h : h;
            let d = Math.floor((second / 3600) / 24);

            return h + ":" + m + ":" + s;
        },
        // how to play
        howToPlay(){
            swal({
                title: "How to play!",
                text: "content...!",
                button: "OK",
            });
        },
        // copy
        copyAddress(text){
            const clipboard = new Clipboard(event.target, {
                text: () => text
            });
            clipboard.on('success', () => {
                swal("Successfully copied", "You can paste it!", "success");
                clipboard.off('error')
                clipboard.off('success')
                clipboard.destroy()
            })
            clipboard.on('error', () => {
                console.log('error');
                swal("Successfully copied", "You clicked the button!", "error");
                clipboard.off('error')
                clipboard.off('success')
                clipboard.destroy()
            })
        }
    }
}
</script>

<style scoped>
    .section-con{
        display: flex;
        flex-direction: row;
        width: 1200px;
        margin: 0 auto;
        margin-top: 50px;
    }
    .section-con .left-con{
        flex: 1;
    }
    .section-con .right-con{
        flex: 1;
        margin-left: 50px;
    }

    .how-to-play{
        text-align: right;
        margin-bottom: 20px;
    }
    .how-to-play img{
        height: 30px;
    }
    .happy-go-lucky{
        border-radius: 10px;
        background-image: linear-gradient(135deg, #FFF944, #F8AB31);
        padding: 40px 20px;
    }
    .happy-go-lucky:before{
        background-color: #000;
        margin: 10px;
    }
    .happy-go-lucky div{
        position: relative;
        z-index: 1;
    }
    .happy-go-lucky .title{
        font-size: 28px;
        color: #fff;
        text-align: center;
        font-weight: bold;
    }
    .happy-go-lucky .sub-title{
        font-size: 28px;
        color: #fff;
        text-align: center;
        font-weight: bold;
        margin-top: 20px;
    }
    .happy-go-lucky .countdown{
        font-size: 56px;
        text-align: center;
        font-weight: bold;
        margin-top: 20px;
        background-image: linear-gradient(135deg, #9FFD00, #00FF68);
        -webkit-background-clip: text;
        color: transparent;
    }
    .happy-go-lucky .active-pot{
        font-size: 22px;
        text-align: center;
        font-weight: bold;
        margin-top: 25px;
        background-image: linear-gradient(45deg, #9FFD00, #00FF68);
        -webkit-background-clip: text;
        color: transparent;
    }
    .happy-go-lucky .active-pot-num{
        font-size: 26px;
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
        color: #fff;
    }

    .purchase{
        margin-top: -40px;
        position: relative;
        z-index: 3;
    }
    .purchase img{
        height: 180px;
    }
    .lucky-con{
        display: flex;
        flex-direction: row;
    }
    .lucky-con .lucky-mamo{
        margin-left: -50px;
    }
    .lucky-con .lucky-mamo img{
        max-width: 100%;
    }
    .lucky-con .lucky-one-con{
        width: 420px;
        margin-left: -50px;
    }
    .lucky-con .lucky-one-con .lucky-title{
        width: 100%;
        position: relative;
        z-index: 9;
    }
    .lucky-con .lucky-one-con .lucky-one{
        border-radius: 10px;
        overflow: hidden;
        background-image: linear-gradient(-90deg, #FD00FB, #FA00EC);
        padding: 40px 20px 30px 20px;
        margin-top: -20px;
        margin-left: 19.5%;
        position: relative;
    }
    .lucky-con .lucky-one-con .lucky-one:before{
        margin: 6px;
    }
    .lucky-con .lucky-one-con .lucky-one div{
        position: relative;
        z-index: 2;
    }
    .lucky-con .lucky-one-con .lucky-one .address{
        color: #fff;
        max-width: 100%;
        margin-bottom: 15px;
        word-wrap: break-word;
        word-break: normal;
        text-align: center;
        line-height: 1.4em;
    }
    .lucky-con .lucky-one-con .lucky-one .account label{
        color: rgba(255, 255, 255, .6);
        font-size: 15px;
        padding-right: 20px;
    }
    .lucky-con .lucky-one-con .lucky-one .account span{
        color: #fff;
        font-size: 15px;
    }

    .reward-pool-con{

    }
    .reward-pool-con .title{
        font-size: 30px;
        color: #fff;
        font-weight: bold;
    }
    .reward-pool-con .title img{
        height: 50px;
    }
    .contract-address-con{
        background-color: #fff;
        padding: 2px;
    }
    .contract-address-con .top{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .contract-address-con .top .title{
        flex: 1;
        font-size: 28px;
        color: #fff;
        background-color: #FF395F;
        height: 50px;
        line-height: 50px;
        padding-left: 15px;
    }
    .contract-address-con .top .copy-btn{
        width: 150px;
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        background-color: #FF00FF;
        color: #fff;
        height: 50px;
        line-height: 50px;
        border-left: 2px solid #fff;
        cursor: pointer;
    }
    .contract-address-con .address{
        height: 50px;
        line-height: 50px;
        color: #FF395F;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
</style>
