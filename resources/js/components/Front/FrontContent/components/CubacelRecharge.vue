<template>
    <div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        <h3 class="h2">1. Recarga Cubacel</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-1">
                            <div class="input-group">
                                <span class="input-group-addon text-muted number-prefix" >
                                    +53
                                </span>
                                <input
                                    type="text"
                                    class="form-control number-input"
                                    v-model="value_product"
                                    @blur="checkNumber"
                                    @focus="removeError"
                                />
                            </div>
                            <span :class="(error_value_product) ? 'text-danger' : 'text-muted'">{{ errorText }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="planes">
                    <div class="alert alert-info" v-if="!planes.length">
                        No hay recargas en este momento!
                    </div>
                    <div v-else>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <planes_card v-for="plan in planes" :key="plan.id" :plan="plan" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li>
                <button class="button button-primary next-step hand" @click.prevent="nextStepEmit" :disabled="isDisabledToSecond">Next</button>
            </li>
        </ul>
    </div>
</template>

<script>
    import PlanesCard from './PlanesCard'

    export default {
        components:{
            'planes_card': PlanesCard,
        },
        props: {
            planes: {
                required: true
            },
            product_value: {
                required: false,
                default: ''
            }
        },

        data: () => {
            return {
                value_product: '',
                error_value_product: false
            }
        },
        created: function() {
            this.initProductValue();
        },
        methods: {
            removeError(){
                this.error_value_product = false
            },
            checkNumber(){
                if(this.isCorrectPhone()){
                    this.error_value_product = true;
                }
            },
            nextStepEmit(){
                this.$emit('nextStep',this.value_product);
            },
            initProductValue() {
                this.value_product = this.product_value;
            },
            isCorrectPhone(){
                console.log((!this.value_product || isNaN(this.value_product) || this.value_product.length !== 8 || this.value_product[0] != 5));
                if(!this.value_product || isNaN(this.value_product) || this.value_product.length !== 8 || this.value_product[0] != 5) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        computed: {
            isDisabledToSecond(){
                let disabled_buttons = true;
                this.planes.forEach((plan)=>{
                    if(plan.is_selected){
                        disabled_buttons = false;
                    }
                });

                return disabled_buttons || this.isCorrectPhone();
            },
            errorText(){
                if(!this.error_value_product){
                    return 'Por favor revise el destinatario de la recarga';
                } else {
                    return 'Error, número incorrecto, por favor corrígelo';
                }
            }
        },
        watch: {
            product_value: function(value){
                this.value_product = value;
            },
        },
        name: "CubacelRecharge"
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
    .number-prefix{
        background: #f2f3f5;
        color: #34bc9b;
        letter-spacing: 4px;
        font-size: 26px;
        font-family: Nunito, sans-serif;
    }
    .number-input{
        font-size: 26px;
        letter-spacing: 4px;
        padding: 8px;
        padding-left: 27px;
        color: #989898a3;
    }
</style>