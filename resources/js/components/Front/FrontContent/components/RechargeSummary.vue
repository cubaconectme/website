<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <h3 class="h2">3. Resumen de la recarga </h3>
                <h4>Numero:</h4>
                <div class="row">
                    <div
                        class="col-sm-12"
                        v-if="contact.number"
                    >
                        +53 {{ contact.number }}
                    </div>
                    <div class="edit-email col-sm-6" v-else>
                        <label v-if="!editing_number" @dblclick="addNumber">Doble Click para Adicionar</label>
                        <vue-edit
                                :source="'contact/edit'"
                                :entity_id="contact.contact_id"
                                :attribute="'number'"
                                v-if="editing_number"
                                @cancelEdit="editing_number = false"
                                @successEdit="handleSuccessEdit"
                        />
                    </div>
                </div>
                <h4>Contacto:</h4>
                <div class="row">
                    <div class="name-section col-sm-12">
                        <span class="col-sm-2">Name:</span>
                        <span v-if="contact && contact.name" >{{ contact.name }}</span>
                        <div class="edit-name col-sm-6" v-else>
                            <label v-if="!editing_name" @dblclick="addName">Doble Click para Adicionar</label>
                            <vue-edit
                                    :source="'contact/edit'"
                                    :entity_id="contact.contact_id"
                                    :attribute="'name'"
                                    v-if="editing_name"
                                    @cancelEdit="editing_name = false"
                                    @successEdit="handleSuccessEdit"
                            />
                        </div>
                    </div>
                    <div class="email-section col-sm-12">
                        <span class="col-sm-2">E-mail:</span>
                        <span v-if="contact && contact.email" >{{ contact.email }}</span>
                        <div class="edit-email col-sm-6" v-else>
                            <label v-if="!editing_email" @dblclick="addEmail">Doble Click para Adicionar</label>
                            <vue-edit
                                :source="'contact/edit'"
                                :entity_id="contact.contact_id"
                                :attribute="'email'"
                                v-if="editing_email"
                                @cancelEdit="editing_email = false"
                                @successEdit="handleSuccessEdit"
                            />
                        </div>

                    </div>

                </div>
                <h4>Tipo de Pago: {{ payment_method }}</h4>
            </div>
            <div class="col-sm-6">
                <h4>Enviar SMS</h4>
                <textarea name="SMS" id="" cols="35" rows="3" class="send-sms">
                </textarea>
                <br>
                <button class="button button-xs">
                    Enviar
                </button>
            </div>
        </div>

        <hr>
        <h4>Recarga:</h4>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Price</th>
                <th>Saldo</th>
                <th>Bono</th>
                <th>Nro. Seguimiento</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="plan in plan_data" :key="plan.id">
                    <th scope="row">{{ plan.price }}</th>
                    <td>{{ plan.balance }}</td>
                    <td>{{plan.bono}}</td>
                    <td>{{plan.plan_id}}</td>
                    <td>Today</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row text-center">
            <div class="col-sm-12" style="font-size: 6em;color: #c1cccc;">
                Gracias!
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li>
                <a class="btn button next-step hand" @click="newRecharge">Nueva Recarga</a>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        props:{
            plan_data: {
                required: true
            },
            value_product: {
                required:true
            },
            contact_selected: {
                required: false
            }

        },
        data: function(){
            return {
                contact: this.contact_selected,
                payment_method: 'paypal',
                editing_email: false,
                editing_name: false,
                editing_number: false,
            }
        },
        methods: {
            handleSuccessEdit(contact){
                this.contact = contact ;
            },
            addNumber(){
                this.editing_number = true
            },
            addName(){
                this.editing_name = true
            },
            addEmail(){
                this.editing_email = true
            },
            newRecharge(){
                window.eventsHub.$emit('showView', 'products_cards');
            }
        },
        watch: {
            contact_selected: function (value) {
                this.contact = value;
            }
        }
    }
</script>

<style scoped>
    .table .table{
        background: none;
    }
    .send-sms{
        resize: none;
        border: #a4bfc8 solid 1px;
        border-radius: 5px;
        background-color: #c2e3ec;
    }
    .button {
        border-radius: 0;
        background-color: #138fc2;
    }

    .button[disabled="disabled"], .button[disabled="true"]{
        cursor: no-drop;
        background-color: #ceced6;
    }

    .button-xs{
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.5;
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