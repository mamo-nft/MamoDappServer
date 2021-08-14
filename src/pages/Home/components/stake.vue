<template>
    <section class="stake-lp-con">
        <div class="title-con">
            <div class="logo">
                <img src="@/assets/feast-logo.png" />
            </div>
            <div class="col">
                <span class="title">MaMo Earned</span>
                <span class="number">{{mamoEarned}}</span>
            </div>
            <div class="col">
                <span class="title">APR</span>
                <span class="number">{{apr}}</span>
            </div>
            <div class="col">
                <span class="title">Total Staked</span>
                <span class="number">{{totalStaked}}</span>
            </div>
            <div class="col">
                <span class="title">Ends In</span>
                <span class="number">{{endsIn}}</span>
            </div>
            <div class="col">
                <span class="number pointer" @click="showDetail = !showDetail">Details<img class="arrow-icon" :class="showDetail ? 'active' : ''" src="@/assets/arrow-top.png"/></span>
            </div>
        </div>
        <div class="content-con" v-if="showDetail">
            <div class="head-logo">
                <img src="@/assets/head-icon.png" />
            </div>
            <div class="link-to">
                <a href="#">Add Liquidity<img src="@/assets/share-btn.png"/></a>
                <div style="height: 20px;"></div>
                <a href="https://pancakeswap.finance/" target="_blank">Go To Pancake Swap<img src="@/assets/share-btn.png"/></a>
            </div>
            <div class="box-con">
                <div class="box-title">MaMo Earned</div>
                <div class="earned">
                    <span>--</span>
                    <button @click="harvest">Harvest</button>
                </div>
            </div>
            <div class="box-con">
                <div class="box-title">LP Staked</div>
                <button class="approve-btn" @click="approve">Approve</button>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            showDetail: false,
            mamoEarned: '83833.95',
            apr: '25.86%',
            totalStaked: '98948',
            endsIn: '86943'
        }
    },
    mounted(){
        // TODO
    },
    methods:{
        harvest(){
            // TODO
        },
        approve(){
            // TODO
        }
    }
}
</script>

<style lang="less" scoped>
    .stake-lp-con{
        width: 1200px;
        margin: 50px auto 0 auto;
        border-radius: 10px;
        overflow: hidden;
    }
    .stake-lp-con .title-con{
        background-color: #FF00FF;
        height: 100px;
        display: flex;
        flex-direction: row;
        align-items: center;

        .logo{
            margin: 0 50px;

            img{
                height: 60px;
            }
        }
        .col{
            flex: 1;

            span{
                display: block;
                text-align: center;
            }
            .title{
                color: rgba(255, 255, 255, .6);
                font-size: 15px;
            }
            .number{
                color: #fff;
                font-size: 16px;
                font-weight: bold;
                margin-top: 15px;

                .arrow-icon{
                    height: 15px;
                    margin-left: 10px;
                    vertical-align: middle;

                    &.active{
                        transform: rotate(180deg);
                        margin-top:-3px;
                    }
                }
                &.pointer{
                    cursor: pointer;
                }
            }
        }
    }
    .stake-lp-con .content-con{
        background-color: #151515;
        height: 150px;
        display: flex;
        flex-direction: row;
        align-items: center;
        padding-right: 50px;

        .head-logo{
            margin-left: 50px;

            img{
                height: 80px;
            }
        }
        .link-to{
            margin-left: 20px;
            a{
                display: block;
                color: #fff;
                font-size: 18px;
                font-weight: bold;
                text-decoration: none;

                img{
                    height: 20px;
                    vertical-align: middle;
                    margin-left: 15px;
                }
            }
        }
        .box-con{
            flex: 1;
            border: 1px solid #3D3D3D;
            border-radius: 5px;
            padding: 15px;
            margin-left: 40px;

            .box-title{
                font-size: 16px;
                color: #F2A438;
                font-weight: bold;
            }

            .earned{
                margin-top: 10px;

                span{
                    color: rgba(255, 255, 255, .6);
                    font-size: 15px;
                    padding-top: 8px;
                    display: block;
                    float: left;
                }
                button{
                    background-color: #3D3D3D;
                    padding: 6px 15px;
                    border-radius: 5px;
                    color: rgba(255, 255, 255, .6);
                    font-size: 14px;
                    border: none;
                    float: right;
                }
            }
            .approve-btn{
                margin-top: 10px;
                border: 1px solid #F2A438;
                background-color: transparent;
                color: #F2A438;
                font-size: 14px;
                padding: 6px 15px;
                border-radius: 5px;
                width: 100%;
            }
        }
    }

</style>
