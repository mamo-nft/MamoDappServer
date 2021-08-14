<template>
    <div class="log-page-con linear-border">
        <div class="title">Last Purchase Log</div>
        <div class="list-con">
            <div class="item" v-for="(item, idx) in list.slice(0, 2)">
                <div class="row-title">TxToken</div>
                <div class="address">{{item[0]}}</div>
                <div class="row">
                    <div class="col">
                        <div class="col-title">Buy Account</div>
                        <div class="col-value">{{item[4]}}</div>
                    </div>
                    <div class="col">
                        <div class="col-title">Trade Time</div>
                        <div class="col-value">{{item[1]}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['list']
}
</script>

<style scoped lang="less">
    .log-page-con{
        border-radius: 10px;
        background-color: #000;
        padding: 40px 30px;
        height: auto;
        background-image: linear-gradient(45deg, #00FFF9, #099DFE);

        &:before{
            margin: 10px;
        }
        div{
            position: relative;
            z-index: 2;
        }

        .title{
            color: #fff;
            font-size: 24px;
            text-align: center;
            font-weight: bold;
        }
        .list-con{
            margin: 0 20px;
        }
        .item{
            margin-top: 25px;

            .row-title{
                color: rgba(255, 255, 255, .6);
                font-size: 16px;
                margin-bottom: 5px;
            }
            .address{
                color: #fff;
                font-size: 18px;
                margin-bottom: 10px;
                max-width: 500px;

                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
            .row{
                display: flex;
                flex-direction: row;

                .col{
                    flex: 1;

                    .col-title{
                        color: rgba(255, 255, 255, .6);
                        font-size: 16px;
                        margin-bottom: 5px;
                    }
                    .col-value{
                        color: #fff;
                        font-size: 18px;
                    }
                }
            }
        }
    }
</style>
