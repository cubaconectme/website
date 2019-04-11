<template>
    <div class="stepper-vue">
        <div class="row" style="border-bottom: 1px solid #ddd;">
            <div class="col-sm-10 col-sm-offset-2">
                <ul class="nav nav-tabs text-center" >
                    <li role="presentation" :class="(active_view === 1) ? 'active' : ''">
                        <a class="tab-vue-stepper" :class="(active_view > 1) ? 'completed': ''">
                            <span class="round-tab">1</span>
                        </a>
                    </li>
                    <li role="presentation" :class="(active_view === 2) ? 'active' : ''">
                        <a class="tab-vue-stepper" :class="(active_view > 2) ? 'completed': ''">
                            <span class="round-tab">2</span>
                        </a>
                    </li>
                    <li role="presentation" :class="(active_view === 3) ? 'active' : ''">
                        <a class="tab-vue-stepper" :class="(active_view > 3) ? 'completed': ''">
                            <span class="round-tab">3</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <form role="form">
            <div class="tab-content">
                <div class="tab-pane" :class="(active_view === 1) ? 'active' : ''">
                    <cubacel_recharge
                        :planes="planes"
                        :product_value="product_value"
                        :autocomplete_source="autocomplete_source"
                        :contact_selected="selected_contact"
                        @nextStep="nextStep"
                        @updateValueProduct="updateValueProduct"
                        :product_selected="product_selected"
                    />
                </div>
                <div class="tab-pane" :class="(active_view === 2) ? 'active' : ''">
                    <review_and_pay
                        :plan_data="plan_data"
                        @backStep="backStep"
                        :value_product="value_product"
                        :contact_selected="selected_contact"
                        @nextStep="nextStep"
                    />
                </div>
                <div class="tab-pane" :class="(active_view === 3) ? 'active' : ''">
                    <recharge_sumary
                        :plan_data="plan_data"
                        :value_product="value_product"
                        :contact_selected="selected_contact"
                    />
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import CubacelRecharge from '../Front/FrontContent/components/CubacelRecharge'
    import ReviewAndPay from '../Front/FrontContent/components/ReviewAndPay'
    import RechargeSumary from '../Front/FrontContent/components/RechargeSummary'
    export default {
        components:{
            'cubacel_recharge': CubacelRecharge,
            'review_and_pay': ReviewAndPay,
            'recharge_sumary': RechargeSumary
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
            },
            autocomplete_source: {
                required: false,
                default: ''
            },
            contact_selected:{
                required: false,
            }
        },
        data: function(){
            return {
                active_view: 1,
                value_product: this.product_value,
                plan_data: {},
                selected_contact: this.contact_selected
            }
        },
        created: function() {
            window.eventsHub.$on('removePlanFromOrder', (product) => this.removeFromOrder(product))
        },
        methods: {
            updateValueProduct(value_product){
                this.value_product = value_product.value_product;
                this.$emit('updateContact', value_product.all_contact)
            },
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
            },
            contact_selected: function(value){
                this.selected_contact = value;
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
        border-bottom: none;
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
        content: none;
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
        background: #d2f1fb;
        border: 2px solid #9ab8c2;
        color: #9ab8c2;
        z-index: 2;
        position: absolute;
        left: 0;
        text-align: center;
        font-size: 14px;

    }

    .stepper-vue .completed .round-tab{
        background: #138fc2;
        border: 2px solid #138fc2;
        color: #138fc2;
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
        border: 2px solid #138fc2;
        color: #138fc2;
    }

    .stepper-vue .active .round-tab:hover{
        background: #fff;
        border: 2px solid #34bc9b;
    }
</style>