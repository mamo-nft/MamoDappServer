<template>
    <div class="page-footer">
        <div class="footer-con">
            <div class="left-con">
                <div class="logo">
                    <img src="@/assets/logo.png" />
                </div>
                <div class="title">
                    Help Document
                </div>
                <div class="sub-title">
                    Copyright © MaMo Experiment 2021-Now. <br/>All Rights reserved.
                </div>
            </div>
            <div class="middle-con">
                <div class="title">Reward Pool</div>
                <div class="title">LP Feast</div>
                <div class="title">MaMo Hub</div>
                <div class="title">Puzzle Beater</div>
                <div class="title">Personal Center</div>
                <div class="title">MaMo Stats</div>
            </div>
            <div class="right-con">
                <div class="title">Join MaMo Community Channels</div>
                <div class="link-con">
                    <a href="#" target="_blank" class="link-item">
                        <img src="@/assets/third-1.png"/>
                    </a>
                    <a href="#" target="_blank" class="link-item">
                        <img src="@/assets/third-2.png"/>
                    </a>
                    <a href="#" target="_blank" class="link-item">
                        <img src="@/assets/third-3.png"/>
                    </a>
                    <a href="#" target="_blank" class="link-item">
                        <img src="@/assets/third-4.png"/>
                    </a>
                    <a href="#" target="_blank" class="link-item">
                        <img src="@/assets/third-5.png"/>
                    </a>
                </div>

                <div class="email-title">
                    Join Mamo Experiment
                </div>
                <div class="send-email-con">
                    <input type="email" placeholder="Your Email Address"/>
                    <div class="send-email-btn">Subscribe</div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="less" scoped>
    .page-footer{
        background-color: #151515;
        margin-top: 50px;
    }
    .footer-con{
        width: 1200px;
        display: flex;
        flex-direction: row;
        margin: 0 auto;
        padding: 50px 0;

        .left-con{
            flex: 1;

            .logo{
                padding-bottom: 20px;

                img{
                    height: 50px;
                }
            }
        }
        .middle-con{
            flex: 1;
            text-align: center;
            margin-right: 50px;

            .title{
                padding-bottom: 5px;
            }
        }
        .right-con{
            width: 500px;

            .link-con{
                display: flex;
                flex-direction: row;
                padding: 30px 0 30px 0;

                .link-item{
                    flex: 1;
                    display: block;

                    img{
                        height: 50px;
                    }
                }
            }
            .email-title{
                color: #fff;
                font-size: 1em;
                padding-bottom: 1em;
            }
            .send-email-con{
                display: flex;
                flex-direction: row;
                padding-bottom: 2em;
                width: 450px;

                input{
                    flex: 1;
                    padding: 0 15px;
                    margin: 0;
                    height: 40px;
                    font-size: 0.9em;
                    color: #fff;
                    background-color: #000;
                    border: none;
                }
                .send-email-btn{
                    width: 120px;
                    height: 40px;
                    font-size: 0.9em;
                    background-color: #1563A6;
                    text-align: center;
                    line-height: 40px;
                    color: #fff;
                }
            }
        }

        .title{
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }
        .sub-title{
            color: rgba(255, 255, 255, .6);
            font-size: 15px;
            margin-top: 10px;
            line-height: 1.6em;
        }
    }
</style>
