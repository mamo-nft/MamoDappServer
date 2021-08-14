<template>
    <div class="page-con">
        <div class="content-con">
            <self-header></self-header>
            <div style="height:200px;"></div>
            <div class="start-btn" @click="startRun">{{isRun ? '停止' : '启动'}}</div>
            <div class="run-num">运行次数：{{runNum}}</div>
            <div style="height:500px;"></div>
        </div>
        <wallet></wallet>
    </div>
</template>

<script>
import NCWeb3 from '@/utils/web3';
import SelfHeader from '@/components/header';
import Wallet from '@/components/wallet';
import {getDex} from '@/api/common';

export default {
    name: 'Index',
    components:{
        SelfHeader,
        Wallet
    },
    data () {
        return {
            // 倒计时
            countDownTimer: null,
            countdownTime: 5,
            isRun: false,
            runNum: 0
        }
    },
    async mounted () {
        const that = this;
    },
    methods: {
        startRun(){
            const that = this;
            if(!this.isRun){
                setInterval(()=>{
                    that.isRun = true
                    getDex().then(res => {
                        if(!res || typeof res.state == 'undefined'){
                            return
                        }
                        that.runNum = that.runNum + 1
                        if(res.state == 0){
                            // 可以开奖
                            console.log('可以开奖')
                            that.sendAddress(res.address);
                        } else if(res.state == 1) {
                            // 时间没到
                            console.log('时间没到')
                        } else if(res.state == 3) {
                            // 数据异常
                            console.log('数据异常')
                        }
                    });
                }, that.countdownTime*1000)
            } else {
                that.isRun = false
                that.runNum = 0
                this.countDownTimer && clearInterval(this.countDownTimer)
            }
        },
        // 调用ABI，发送address
        async sendAddress(address){
            const PhotoNFTDataAbi = require("@/abi/PhotoNFTData.json");
            const web3 = this.$web3;
            const instance = await NCWeb3.loadAbi(PhotoNFTDataAbi, web3);// 加载ABI通用方法
            if(instance){
                // 这里调接口发送address
                const res = await instance.methods.sendAddress({address}).call();// 调用ABI接口
                console.log(res);
            }
        }
    }
}
</script>

<style lang="less" scoped>
    .page-con{
        background-color: #efa344;
    }
    .content-con{
        position: relative;
        z-index: 1;
    }

    .start-btn{
        border: 1px solid #ddd;
        padding: 10px 0;
        width: 100px;
        margin: 0 auto;
        border-radius: 6px;
        text-align: center;
        color: #fff;
        cursor: pointer;
    }
    .run-num{
        text-align: center;
        padding-top: 20px;
        font-size: 16px;
    }
</style>
