<template>
    <div class="page-least">
        <section class="feast-con linear-border">
            <div class="title-con">
                <span class="title">LP FEAST</span>
            </div>
            <div class="bar-con">
                <div class="left-bar">
                    ROUND #20
                </div>
                <img class="bar-bg" src="@/assets/least-title-bg.png"/>
                <div class="right-bar">
                    Joined 240 LP
                </div>
            </div>
            <div class="price">
                $ {{price}}
            </div>
            <div class="ending-con">
                <div class="txt">7 Minutes 30 Second</div>
                <div class="btn">Ending In</div>
            </div>
            <div class="next-reward-con">
                <div class="btn">
                    <img src="@/assets/least-point.png"/>
                </div>
                <div class="txt">Next Reward: {{nextReward}} MaMo</div>
            </div>
        </section>
        <div class="least-pic">
            <img src="@/assets/least-pic.png"/>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            price: '83833.95',
            nextReward: '254875'
        }
    }
}
</script>

<style lang="less" scoped>
    .page-least{
        width: 1100px;
        display: flex;
        flex-direction: row;
        margin: 50px auto 0 auto;
    }
    .least-pic{
        width: 360px;
        margin-left: -150px;
        margin-top: -50px;
        position: relative;
        z-index: 9;

        img{
            width: 100%;
            height: auto;
            max-height: 150%;
        }
    }
    .feast-con{
        flex: 1;
        height: 450px;
        padding-right: 100px;
        border-radius: 10px;
        background-image: linear-gradient(45deg, #00FFF9, #099DFE);

        div{
            position: relative;
            z-index: 999;
        }
        .price{
            font-size: 56px;
            text-align: center;
            font-weight: bold;
            margin: 40px 0;
            background-image: linear-gradient(135deg, #9FFD00, #00FF68);
            -webkit-background-clip: text;
            color: transparent;
        }
        .ending-con{
            width: 380px;
            height: 44px;
            line-height: 44px;
            border-radius: 22px;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            border: 1px solid #9FFD00;

            .txt{
                flex: 1;
                text-align: center;
                color: #fff;
                font-weight: bold;
                font-size: 18px;
            }
            .btn{
                width: 120px;
                text-align: center;
                color: #000;
                font-weight: bold;
                font-size: 18px;
                background-image: linear-gradient(135deg, #9FFD00, #00FF68);
                border-radius: 20px;
            }
        }
        .next-reward-con{
            width: 380px;
            height: 40px;
            line-height: 40px;
            border-radius: 22px;
            margin: 30px auto;
            display: flex;
            flex-direction: row;

            .txt{
                flex: 1;
                text-align: center;
                color: #000;
                font-weight: bold;
                font-size: 18px;
                background-image: linear-gradient(135deg, #FAF345, #FFA738);
                border-radius: 20px;
                padding-left: 30px;
                margin-left: -30px;
            }
            .btn{
                z-index: 9999;
                width: 50px;

                img{
                    max-height: 120%;
                }
            }
        }
    }
    .feast-con:before{
        margin: 10px;
    }
    .feast-con .title-con{
        width: 200px;
        height: 50px;
        overflow: hidden;
        position: relative;
        z-index: 999;
        left: 50px;
        top: -22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url(/static/images/least-con-title.png);
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }
    .feast-con .title-con .title{
        color: #fff;
        text-align: center;
        font-size: 26px;
        font-weight: bold;
        padding-right: 10px;
    }

    .bar-con{
        color: #fff;
        font-size: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        position: relative;
        z-index: 9;
        margin: 20px auto 0 auto;
        width: 400px;
        height: 44px;
        line-height: 44px;
        border-radius: 10px;
        overflow: hidden;

        .left-bar{
            background-color: #3399FF;
            flex: 1;
            text-align: center;
            padding-left: 10px;
        }
        .bar-bg{
            height: 100%;
            max-height: 100%;
        }
        .right-bar{
            background-color: #FF00FF;
            flex: 1;
            text-align: center;
            padding-right: 10px;
        }
    }

</style>
