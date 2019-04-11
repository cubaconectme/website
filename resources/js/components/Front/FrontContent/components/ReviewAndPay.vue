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
                            <span v-if="card_error" class="text text-danger">{{ card_error_message }}</span>
                            <div ref="card"></div>
                            <button @click="purchase" class="button pull-right" style="margin-top: 5px" :disabled="processing_card">
                                <span v-if="!processing_card">
                                    Pagar {{ totalAmount | currency }}
                                </span>
                                <span v-else>
                                    <font-awesome-icon icon="sync" class="fa-spin"/>
                                </span>
                            </button>
                        </div>
                    </div>
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
                        @payment-completed="paymentCompleted"
                    />
                </fieldset>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li>
                <a class="btn button button-default hand prev-step" @click="backStep">Back</a>
            </li>
        </ul>
    </div>
</template>
<script>
    import Paypal from 'vue-paypal-checkout'
    import OrderReview from './OrderReview'
    import VueCreditCard from 'vue-credit-card'

    let stripe = Stripe(`pk_test_sLeOVUkXhyDmZMk1w64xDIhF`),
        elements = stripe.elements(),
        card = undefined;

    let style = {
        base: {
            border: '1px solid #D8D8D8',
            borderRadius: '4px',
            color: "#000",
        },

        invalid: {
            // All of the error styles go inside of here.
        }

    };

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
            },
            contact_selected: {
                required: false
            }
        },
        data: () => {
            return {
                card_value: defaultProps,
                paypal_credentials: paypalCredentials,
                paypal_button_style: buttonsStyle,
                card_error: false,
                card_error_message: '',
                processing_card: false
            }
        },
        mounted: function(){
            if(typeof card === 'undefined'){
                card = elements.create('card',{style: style});
            }

            card.mount(this.$refs.card);
            card.addEventListener('change',() => {
                this.handleCardError();
            });
        },
        methods: {
            handleCardError(){
                this.card_error = false;
                this.card_error_message = '';
            },
            purchase(e){
                console.log('aqui',e);
                e.preventDefault();
                stripe.createToken(card).then((result) => {
                    if(typeof result.error !== 'undefined'){
                        this.card_error = true;
                        this.card_error_message = result.error.message;
                    } else {
                        this.payWithCard(result);
                    }
                });
            },
            payWithCard(result){
                if(!result.token){
                    this.card_error = true;
                    this.card_error_message = 'Error procesando la tarjeta, intentelo mas tarde';
                    return false;
                }
                this.processing_card = true;
                window.axios.post('recharge/action', {
                    action_type: 'payWithCard',
                    recharges: this.plan_data,
                    card_response: result.token,
                    type: this.plan_data[0].product
                })
                    .then(response_data => {
                        this.processing_card = false;
                        if(!response_data.data.has_error){
                            window.eventsHub.$emit('updateContact',response_data.data.data.contact);
                            this.nextStep();
                        } else {
                            window.eventsHub.showErrorMsg({message: 'Card Error, please try again!!!'});
                        }
                    })
                    .catch( error => {
                        console.log(error);
                    });
               console.log(result);
            },
            paymentCompleted(response){
                if(response.state === 'approved'){
                    window.axios.post('recharge/action', {
                        action_type: 'payWithPaypal',
                        recharges: this.plan_data,
                        paypal_response: response,
                        type: this.plan_data[0].product
                    })
                        .then(response_data => {
                            console.log(response_data.data);
                            if(!response_data.data.has_error){
                               this.nextStep();
                                window.eventsHub.$emit('updateContact',response_data.data.data.contact);
                               console.log('asui')
                            } else {
                                window.eventsHub.showErrorMsg({message: 'Paypal Error, please try again!!!'});
                            }
                        })
                        .catch(error=> {
                            console.log(error);
                        });
                } else {
                    window.eventsHub.showErrorMsg({message: 'Paypal Error, please try again!!!'});
                }
            },
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
        background-color: #138fc2;
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
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>