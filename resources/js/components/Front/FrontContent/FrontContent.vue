<template>
    <section class="gray-bg section-padding" id="service-page">
        <transition name="fade">
            <div class="container">
                <div class="row" v-if="active_view === 'products_cards'">
                    <div class="alert alert-info" v-if="!products.length">There is no products at this moment!!</div>
                    <front_content_card v-else
                        v-for="product in products"
                        :product="product"
                        :key="product.id"
                        @changeActiveView="handleChangeView"
                        :product_value="product_value"
                        :prepend="handlePrepend(product)"
                        @updateContactSelected="updateContactSelected"
                    />
                </div>
                    <login
                        v-if="active_view === 'login'"
                        @showHideRegister="showHideRegister"
                        @userLogged="handleUserLogged"
                    />
                    <register
                        v-if="active_view === 'register'"
                        @showHideRegister="showHideRegister"
                        @userRegister="userRegister"
                    />
                    <user_profile
                        :user="user_logged"
                        v-if="active_view === 'user_profile'"
                    />
                    <user_dashboard
                        :user="user_logged"
                        v-if="active_view === 'user_dashboard'"
                        :recharges="recharges"
                        :contacts="contacts"
                        :planes_cubacel="planes_cubacel"
                        :planes_nauta="planes_nauta"
                    />
                    <div class="row" v-if="active_view === 'Cubacel'" >
                        <back_buttons @goBackToCards="goBackToCards" />
                        <stepper
                                :planes="selected_product.planes"
                                :product_value="product_value"
                                :product_selected="selected_product"
                                :autocomplete_source="autocomplete_source"
                                :contact_selected="contact_selected"
                                @updateContact="updateContact"
                        />
                    </div>
                    <div class="row" v-if="active_view === 'Nauta'">
                        <back_buttons @goBackToCards="goBackToCards" />
                        <stepper
                                :planes="selected_product.planes"
                                :product_value="product_value"
                                :product_selected="selected_product"
                                :autocomplete_source="autocomplete_source"
                                :contact_selected="contact_selected"
                                @updateContact="updateContact"
                        />
                    </div>
                    <div class="row" v-if="active_view === 'SMS'">
                        <back_buttons @goBackToCards="goBackToCards" />
                        <stepper
                                :planes="selected_product.planes"
                                :product_value="product_value"
                                :product_selected="selected_product"
                                :autocomplete_source="autocomplete_source"
                                :contact_selected="contact_selected"
                                @updateContact="updateContact"
                        />
                    </div>
                </div>
        </transition>
    </section>
</template>
<script>
    import FrontContentCard from './components/FrontContentCard'
    import GoBack from './components/BackButtons'
    import Stepper from '../../General/Stepper'
    import Login from './components/LoginRecharge'
    import Register from './components/RegisterRecharge'
    import UserDashboard from './components/UserDashboard'
    import UserProfile from './components/UserProfile'
    export default {
        components:{
            'front_content_card': FrontContentCard,
            'back_buttons': GoBack,
            'stepper': Stepper,
            'login': Login,
            'register': Register,
            'user_dashboard': UserDashboard,
            'user_profile': UserProfile,
        },
        props: {
            products: {
                required: true,
            },
            user: {
                required:true
            },
            recharges_prop: {
                required: false
            },
            contacts_prop: {
                required: false
            },
            planes_cubacel_prop: {
                required: false
            },
            planes_nauta_prop: {
                required: false
            },
        },
        data: function(){
            return {
                active_view: 'products_cards',
                selected_product: {},
                product_value: '',
                is_login: false,
                user_logged: {},
                test: 'text ',
                recharges: [],
                contacts: [],
                planes_cubacel: [],
                planes_nauta: [],
                autocomplete_source: '',
                contact_selected: {}
            }
        },
        created: function(){
            this.initData();
            window.eventsHub.$on('handleSelectPlanCard', (plan) => {this.handleSelectedPlanCard(plan)});
            window.eventsHub.$on('removePlanFromOrder', plan => this.handleRemovePlanFromOrder(plan) );
            window.eventsHub.$on('showView', view => this.handleShowView(view) );
            window.eventsHub.$on('showUserProfile', () => this.showUserProfile() );
            window.eventsHub.$on('showNewRecharge', () => this.showNewRecharge() );
            window.eventsHub.$on('updateContact', contact => this.updateContact(contact));
            this.handleIsLogin();
        },
        methods: {
            updateContact(contact){
                console.log(contact);
                this.contact_selected = contact;
            },
            updateContactSelected(contact_selected){
                this.contact_selected = contact_selected;
            },
            handlePrepend(product){
                switch (product.name) {
                    case('Cubacel'):
                        return '+53';
                    case('Nauta'):
                        return '@';
                    case('SMS'):
                        return '+53';
                }
                console.log(product);
            },
            initData(){
                this.user_logged = this.user;
                this.recharges = this.recharges_prop;
                this.contacts = this.contacts_prop;
                this.planes_cubacel = this.planes_cubacel_prop;
                this.planes_nauta = this.planes_nauta_prop;
            },
            showNewRecharge(){
                this.active_view = 'products_cards';
            },
            handleIsLogin(){
              this.is_login = (this.user);
            },
            showUserProfile(){
                this.active_view = 'user_profile';
            },
            userRegister(data){
                this.active_view = 'login';
                window.eventsHub.showSuccessMsg({message: 'Ya puedes ininicar sesion!!', title: 'Hola ' + data.user.email });
            },
            handleUserLogged(data){
                console.log(data);
                this.active_view = 'user_dashboard';
                this.user_logged = data.user;
                this.is_login = true;
                this.recharges = data.recharges;
                this.contacts = data.user_contacts;
                this.planes_cubacel = data.planes_cubacel;
                this.planes_nauta = data.planes_nauta;
            },
            handleShowView(view){
                this.active_view = view;
            },
            showHideRegister(action){
                this.active_view =  (action === 'show') ? 'register' : 'login';
            },
            handleRemovePlanFromOrder(plan) {
                this.selected_product.planes.forEach(_plan_selected => {
                    if(_plan_selected.plan_id === plan.plan_id) {
                        _plan_selected.is_selected = false;
                    }
                });
            },
            handleSelectedPlanCard(plan){
                this.selected_product.planes.forEach( (plan_selected) => {
                    if(plan_selected.plan_id === plan.plan_id) {
                        plan_selected.is_selected = !plan_selected.is_selected;
                        console.log(plan_selected);
                    }
                });
            },
            handleChangeView(product) {
                if(this.is_login){
                    this.active_view = product.product.name;
                    this.selected_product = product.product;
                    this.product_value = product.product_value;
                    this.autocomplete_source = product.autocomplete_source
                } else {
                    this.active_view = 'login'
                }
            },
            goBackToCards(){
                this.active_view = 'products_cards';
            }
        },
        watch:{
            user: function(value){
                this.user_logged = value;
            }
        }
    }
</script>

<style scoped>

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }




</style>