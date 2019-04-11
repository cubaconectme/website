<template>
    <div class="col-sm-3 card" :class="(plan.is_selected) ? 'card_selected' : ''" @click="handleSelectCard">
        <div :class="(plan.is_selected) ? 'text-success' : ''">
            <h4>
                <span class="dn-currency" data-testid="internationalCurrency-1">USD</span>
                <span class="dn-amount" data-testid="internationalAmount-1"> {{ plan.price }}</span>
            </h4>
            <div>
                <div class="dn-radio">
                    <font-awesome-icon icon="check" />
                </div>
            </div>
            <div>
                <p>
                    <!--<span class="dn-currency" data-testid="localCurrency-1">CUC</span>-->
                    <span class="dn-amount" data-testid="localAmount-1"> {{ plan.balance }}</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            plan:{
                required: true
            }
        },
        methods:{
            handleSelectCard(){
                window.eventsHub.$emit('handleSelectPlanCard',this.plan)
            }
        }
    }
</script>

<style scoped>
    .hand{
        cursor: pointer;
    }
    .card{
        border:solid 1px #97c3e8;
        text-align: center;
        margin: 15px 20px;
        padding: 21px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .card_selected{
        border:solid 1px #1cc88a;
    }
</style>