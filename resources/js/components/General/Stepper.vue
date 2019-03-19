<template>
    <div class="stepper-vue">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" :class="(active_view === 1) ? 'active' : ''">
                <a class="persistant-disabled tab-vue-stepper" @click="handleTabsClick(1)">
                    <span class="round-tab">1</span>
                </a>
            </li>
            <li role="presentation" :class="(active_view === 2) ? 'active' : ''">
                <a class="persistant-disabled tab-vue-stepper" @click="handleTabsClick(2)">
                    <span class="round-tab">2</span>
                </a>
            </li>
            <li role="presentation" :class="(active_view === 3) ? 'active' : ''">
                <a class="persistant-disabled tab-vue-stepper" @click="handleTabsClick(3)">
                    <span class="round-tab">3</span>
                </a>
            </li>
            <li role="presentation" :class="(active_view === 4) ? 'active' : ''">
                <a class="persistant-disabled tab-vue-stepper" @click="handleTabsClick(4)">
                    <span class="round-tab">4</span>
                </a>
            </li>
        </ul>
        <form role="form">
            <div class="tab-content">
                <div class="tab-pane" :class="(active_view === 1) ? 'active' : ''">
                    <cubacel_recharge :planes="planes" :product_value="product_value" @nextStep="nextStep"/>
                </div>
                <div class="tab-pane" :class="(active_view === 2) ? 'active' : ''">
                    <review_and_pay
                        :plan_data="plan_data"
                        @backStep="backStep"
                        :value_product="value_product"
                    />
                </div>
                <div class="tab-pane" :class="(active_view === 3) ? 'active' : ''">
                    <h3 class="hs">3. Procesar el Pago</h3>
                    <p>This is step 3</p>
                    <ul class="list-inline pull-right">
                        <li>
                            <a class="btn button button-default prev-step" @click="backStep">Back</a>
                        </li>
                        <li>
                            <a class="btn button button-default cancel-stepper">Cancel Payment</a>
                        </li>
                        <li>
                            <a class="btn button next-step">Submit Payment</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" :class="(active_view === 4) ? 'active' : ''">
                    <h3>4. All done!</h3>
                    <p>You have successfully completed all steps.</p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import CubacelRecharge from '../Front/FrontContent/components/CubacelRecharge'
    import ReviewAndPay from '../Front/FrontContent/components/ReviewAndPay'
    export default {
        components:{
            'cubacel_recharge': CubacelRecharge,
            'review_and_pay': ReviewAndPay
        },
        props:{
            planes: {
                required: true
            },
            product_value: {
                required: false,
                default: ''
            },
            product_selected:{
                required: true
            }
        },
        data: function(){
            return {
                active_view: 1,
                value_product: this.product_value,
                plan_data: {},
            }
        },
        created: function() {
            window.eventsHub.$on('removePlanFromOrder', (product) => this.removeFromOrder(product))
        },
        methods: {
            removeFromOrder(product){
                this.plan_data = this.plan_data.filter( plan => plan.plan_id !== product.plan_id);
            },
            handleTabsClick(view){
                this.active_view = view;
            },
            prepareDataToOrder(){
                let planes_aux;
                planes_aux = this.planes.filter((plan) => {
                    if (plan.is_selected) {
                        plan['product_value'] = this.value_product;
                        return plan;
                    }
                });
                return planes_aux
            },
            nextStep(product_value){
                console.log(product_value)
                this.value_product = product_value;
                this.prepareDataToOrder();
                this.plan_data = this.prepareDataToOrder();
                this.active_view++;
            },
            backStep(){
                this.active_view--;
            }
        },
        computed:{
            activePanel(){

            }
        },
        watch: {
            product_value:function(value){
                this.value_product = value;
            }
        }
    }
</script>

<style scoped>
    .hand{
        cursor: pointer;
    }
    .planes > .card{
        border:solid 1px #97c3e8;
        text-align: center;
        margin: 15px 20px;
        padding: 21px 20px;
        border-radius: 5px;
        cursor: pointer;
    }



    /**
    Steppers
    */
    .stepper-vue .nav-tabs {
        position: relative;
    }

    .stepper-vue .nav-tabs > li {
        width: 25%;
        position: relative;
    }

    .stepper-vue .nav-tabs > li:after {
        content: '';
        position: absolute;
        background: #f1f1f1;
        display: block;
        width: 100%;
        height: 5px;
        top: 30px;
        left: 50%;
        z-index: 1;
    }

    .stepper-vue .nav-tabs > li .completed{
        background: #34bc9b;
    }

    .stepper-vue .nav-tabs > li .completed:after{
        background: #34bc9b;
    }

    .stepper-vue .nav-tabs > li:last-child {
        background: transparent;
    }

    .stepper-vue .nav-tabs > li:last-child:after{
        background: transparent;
    }
    .stepper-vue .nav-tabs > li .active:last-child .round-tab{
        background: #34bc9b;
    }
    .stepper-vue .nav-tabs > li .active:last-child .round-tab::after{
        content: '✔';
        color: #fff;
        position: absolute;
        left: 0;
        right: 0;
        margin: 0 auto;
        top: 0;
        display: block;
    }

    .tab-vue-stepper{
        width: 25px;
        height: 25px;
        margin: 20px auto;
        border-radius: 100%;
        border: none;
        padding: 0;
        color: #f1f1f1;
    }

    .tab-vue-stepper:hover{
        background: transparent;
        border: none;
    }

    .stepper-vue .nav-tabs > .active > .tab-vue-stepper, .nav-tabs > .active > .tab-vue-stepper:hover, .nav-tabs > .active > .tab-vue-stepper:focus {
        color: #34bc9b;
        cursor: default;
        border: none;
    }

    .stepper-vue .tab-pane {
        position: relative;
        padding-top: 50px;
    }
    .stepper-vue .round-tab {
        width: 25px;
        height: 25px;
        line-height: 22px;
        display: inline-block;
        border-radius: 25px;
        background: #fff;
        border: 2px solid #34bc9b;
        color: #34bc9b;
        z-index: 2;
        position: absolute;
        left: 0;
        text-align: center;
        font-size: 14px;

    }
    .stepper-vue .completed .round-tab{
        background: #34bc9b;

    }

    .stepper-vue .completed .round-tab:after {
        content: '✔';
        color: #fff;
        position: absolute;
        left: 0;
        right: 0;
        margin: 0 auto;
        top: 0;
        display: block;
    }

    .stepper-vue .active .round-tab {
        background: #fff;
        border: 2px solid #34bc9b;
    }

    .stepper-vue .active .round-tab:hover{
        background: #fff;
        border: 2px solid #34bc9b;
    }
</style>