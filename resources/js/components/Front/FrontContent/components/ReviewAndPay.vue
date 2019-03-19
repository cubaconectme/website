<template>
    <div>
        <h3 class="h2">2. Revise y pague </h3>
        <h4>Order</h4>
        <small>Revise toda la informacion de su order por favor!!</small>
        <order_review :products="plan_data" :total_amount="totalAmount"/>
        <h4>Pago</h4>
        <div class="row">
            <div class="col-sm-6">
                <fieldset >
                    <legend style="width:auto; padding-right: 3px">Tarjeta de Credito/Debito</legend>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-input col-sm-6" style="margin-right: 0; padding-right: 0;">
                                <input name="number" placeholder="Numero" type="tel" class="form-control" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" v-model="card_value.number" v-card-focus>
                            </div>
                            <div class="form-input col-sm-6" style="margin-left: 0; padding-left: 0;">
                                <input name="name" placeholder="Nombre en la tarjeta" type="text" class="form-control" style="border-left: none; border-top-left-radius: 0;border-bottom-left-radius: 0;" v-model="card_value.name" v-card-focus>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-6" style="margin-left: 0; padding-left: 0;">
                                <div class="form-input col-sm-6" style="margin-right: 0; padding-right: 0;">
                                    <input name="expiry" placeholder="MM/YY" type="tel" class="form-control" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" v-model="card_value.expiry" v-card-focus>
                                </div>
                                <div class="form-input col-sm-6" style="margin-left: 0; padding-left: 0;">
                                    <input name="cvc" placeholder="CVC" type="number" class="form-control" style="border-left: none; border-top-left-radius: 0;border-bottom-left-radius: 0;" v-model="card_value.cvc" v-card-focus>
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <input name="zip_code" placeholder="12345" type="tel" class="form-control" v-model="card_value.zip_code" v-card-focus>
                            </div>
                        </div>
                    </div>
                    <credit_card :value="card_value"/>
                </fieldset>
            </div>
            <div class="col-sm-6">
                <fieldset >
                    <legend style="width:auto; padding-right: 3px">Paypal</legend>
                    <paypal
                        :amount="totalAmount"
                        currency="USD"
                        :client="paypal_credentials"
                        env="sandbox"
                        :button-style="paypal_button_style"
                    />
                </fieldset>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li>
                <a class="btn button button-default hand prev-step" @click="backStep">Back</a>
            </li>
            <li>
                <a class="btn button next-step hand" @click="nextStep">Next</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import Paypal from 'vue-paypal-checkout'
    import OrderReview from './OrderReview'
    import VueCreditCard from 'vue-credit-card'


    let defaultProps = {
        number: '',
        name: '',
        expiry: '',
        cvc: '',
        zip_code:''
    };

    const paypalCredentials = {
        sandbox: 'AZ8EhwFVGbDYQZ7xw-Nz0uBe1PpG7UoZYy_xK94-o39d5lSOvNuEgjfmqL8z82y6H7kUMGsucmuL2wUX',
        production: 'not yet'
    };

    const buttonsStyle = {
        label: 'pay',
        size:  'responsive',
        shape: 'pill',
        color: 'blue'
    };

    export default {
        components: {
            Paypal,
            'order_review':OrderReview,
            'credit_card': VueCreditCard,

        },
        props:{
            plan_data: {
                required: true
            },
            value_product:{
                required: true
            }
        },
        data: () => {
            return {
                card_value: defaultProps,
                paypal_credentials: paypalCredentials,
                paypal_button_style: buttonsStyle
            }
        },
        methods: {
            backStep(){
                this.$emit('backStep')
            },
            nextStep(){
                this.$emit('nextStep', this.value_product)
            }
        },
        computed: {
            totalAmount: function(){
                let amount = 0;
                if(Object.keys(this.plan_data).length){
                    this.plan_data.forEach(product => {
                        amount +=  parseInt(product.price);
                    });
                    return amount.toFixed(2);
                } else {
                    return "0";
                }
            }
        }
    }
</script>

<style scoped>
    .button {
        border-radius: 0;
    }

    .button[disabled="disabled"], .button[disabled="true"]{
        cursor: no-drop;
        background-color: #ceced6;
    }

    .button-default{
        background: #87a6cd;
        color: #1c294e;
    }

    .button-default:hover{
        transition: 0.5s;
        background: white;
        color: #1d68a7;
    }
</style>