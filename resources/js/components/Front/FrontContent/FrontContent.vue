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
                    />
                    <div class="row" v-if="active_view === 'Cubacel'" >
                        <back_buttons @goBackToCards="goBackToCards" />
                        <stepper
                                :planes="selected_product.planes"
                                :product_value="product_value"
                                :product_selected="selected_product"
                        />
                    </div>
                    <div class="row" v-if="active_view === 'Nauta'">
                        <back_buttons @goBackToCards="goBackToCards" />
                        Nauta
                    </div>
                    <div class="row" v-if="active_view === 'SMS'">
                        <back_buttons @goBackToCards="goBackToCards" />
                        SMS
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
            }
        },
        created: function(){
            this.user_logged = this.user;
            window.eventsHub.$on('handleSelectPlanCard', (plan) => {this.handleSelectedPlanCard(plan)});
            window.eventsHub.$on('removePlanFromOrder', plan => this.handleRemovePlanFromOrder(plan) );
            window.eventsHub.$on('showView', view => this.handleShowView(view) );
            window.eventsHub.$on('showUserProfile', () => this.showUserProfile() );
            window.eventsHub.$on('showNewRecharge', () => this.showNewRecharge() );
            this.handleIsLogin();
            console.log('test123');
        },
        data: function(){
            return {
                active_view: 'products_cards',
                selected_product: {},
                product_value: '',
                is_login: false,
                user_logged: {},
                test: 'text '
            }
        },
        methods: {
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
                    this.product_value = product.product_value
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