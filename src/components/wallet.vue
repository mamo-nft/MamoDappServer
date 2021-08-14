<template>
    <div>
        <div class="mask animate__animated animate__fadeIn" @click="hideWallet" v-if="show"></div>
        <div class="wallet-con" :class="show ? 'active animate__animated animate__slideInRight' : 'animate__animated animate__slideOutRight'">
            <div class="current-account">
                <span class="title">Current Account</span>
                <span class="address">{{currentAccount || '--'}}</span>
            </div>
            <div v-if="isConnected">
                <div class="balance-title">Balance</div>
                <div class="balance">{{balance}} {{chainId && symbolList[chainId] ? symbolList[chainId] : ''}}</div>
            </div>
            <div v-else>
                <div class="no-connected">
                    Wallet is not connected!
                </div>
                <div class="connect-btn" @click="initWallet">Connect</div>
            </div>
        </div>
    </div>
</template>

<script>
import MyWeb3 from '@/utils/web3';
import web3Utils from 'web3-utils';

export default {
    name: 'Wallet',
    data() {
        return {
            show: false,
            web3: null,
            isConnected: false,
            currentAccount: null,
            balance: 0,
            toAddress: null,
            txHash: null,
            chainId: null,
            symbolList: {
                '0x539': 'ETH',
                '0x61': 'BNB'
            }
        }
    },
    async mounted () {
        const that = this;
        that.isConnected = that.$store.state.isConnectedWallet
        console.log(that.$store.state)

        that.$emitBus.$on('SHOW_WALLET', res=>{
            that.show = true;
        });
        that.$emitBus.$on('HIDE_WALLET', res=>{
            that.show = false;
        });
    },
    methods: {
        hideWallet(){
            this.show = false;
            this.$emitBus.$emit('WALLET_HIDED');
        },
        async initWallet(){
            // const providerOptions = {
            //     /* See Provider Options Section */
            // };
            // const web3Modal = new Web3Modal({
            //     network: "mainnet", // optional
            //     cacheProvider: true, // optional
            //     providerOptions // required
            // });
            // const provider = await web3Modal.connect();
            // const web3 = new Web3(provider);

            // const web3 = that.$web3;

            const that = this;
            MyWeb3.init().then(web3 => {
                if(web3 && web3.isConnected()){
                    that.web3 = web3;
                    that.isConnected = true;
                    that.$store.dispatch("setWeb3", that.web3);
                    that.$store.dispatch("setIsConnectWallet", that.isConnected);
                    that.initAccount(web3);
                }
            })
        },
        async initAccount(web3){
            const that = this;
            if(!that.isConnected){
                return;
            }
            web3.eth.getAccounts((err, accounts) => {
                if(!err){
                    that.currentAccount = accounts && accounts.length > 0 ? accounts[0] : null;
                    if(that.currentAccount){
                        that.$store.dispatch("setCurrentAccount", that.currentAccount);
                        web3.eth.getBalance(that.currentAccount, (err, res) => {
                            if(!err && res.c[0]) {
                                // console.log(web3.currentProvider.chainId)
                                that.chainId = web3.currentProvider.chainId;
                                const balance = res.c[0]
                                that.balance = balance/10000
                                // that.balance = web3Utils.fromWei(balance + '', 'ether');
                            }else{
                                console.log(err);
                            }
                        });
                    }
                }
            });
        }
    }
}
</script>

<style lang="less" scoped>
    .wallet-con{
        width: 450px;
        position: fixed;
        right: -450px;
        top: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 99999;
        padding: 0 15px;
        box-shadow: -3px 3px 5px rgba(0,0,0,.6);

        &.active{
            right: 0;
        }
    }
    .mask{
        position: fixed;
        right: 0;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 99999;
        background-color: rgba(0,0,0,.6);
    }
    .current-account{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        border-bottom: 1px solid #ddd;

        .title{
            font-weight: bold;
            color: #000;
            font-size: 16px;
        }
        .address{
            flex: 1;
            font-size: 14px;
            color: rgba(0,0,0,.8);
            text-align: right;
            padding-left: 100px;
            overflow: hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
    }
    .balance-title{
        text-align: center;
        font-size: 20px;
        padding-top: 200px;
    }
    .balance{
        text-align: center;
        font-size: 20px;
        padding-top: 20px;
    }
    .no-connected{
        text-align: center;
        font-size: 20px;
        padding-top: 200px;
    }
    .connect-btn{
        border: 1px solid #ddd;
        padding: 10px 20px;
        border-radius: 6px;
        width: 100px;
        text-align: center;
        font-size: 15px;
        margin: 15px auto 0 auto;
        cursor: pointer;
    }
</style>
