<template>
    <div class="header-con">
        <div class="logo">
            <img src="@/assets/logo.png" />
        </div>
        <div style="flex: 1;"></div>
        <div class="right-con">
            <img class="btn" src="@/assets/header-btn-1.png" @click="toggleWallet" />
        </div>
    </div>
</template>

<script>
export default {
    name: 'SelfHeader',
    data() {
        return {
            showWallet: false
        }
    },
    mounted(){
        const that = this;
        this.$emitBus.$on('WALLET_HIDED', res=>{
            that.showWallet = false;
        });
    },
    methods:{
        toggleWallet(){
            this.showWallet = !this.showWallet;
            this.$emitBus.$emit(this.showWallet ? 'SHOW_WALLET' : 'HIDE_WALLET');
        }
    }
}
</script>

<style scoped>
    .header-con{
        display: flex;
        flex-direction: row;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        height: 150px;
    }
    .header-con .logo{
        height: 100px;
    }
    .header-con .logo img{
        height: 100%;
    }
    .header-con .right-con{
        width: auto;
    }
    .header-con .right-con .btn{
        height: 40px;
        margin-left: 50px;
    }

    @media(max-width:1200px){
        .header-con{
            padding: 0 50px;
            height: 100px;
        }
        .header-con .logo{
            height: 80px;
        }
    }
    @media(max-width:720px){
        .header-con{
            padding: 0 20px;
            height: 50px;
        }
        .header-con .logo{
            height: 30px;
        }
        .header-con .right-con .btn{
            height: 24px;
            margin-left: 15px;
        }
    }
</style>
