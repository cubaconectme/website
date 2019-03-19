<template>
    <div id="content" class="admin-content">
        <side-bar></side-bar>
        <div class="container-fluid admin-container-fluid">
            <loading_request v-if="loading_data" :size="'5x'">
                <h1> {{ loading_text }}</h1>
            </loading_request>
            <template v-else>
                <!-- Page Heading -->
                <breadcrumbs :list_menu="dashboard_breadcrumbs"></breadcrumbs>
                <!-- Content Row -->
                <admin_dashboard v-if="active_view === 'dashboard'"/>
                <users_admin
                    v-if="active_view === 'users'"
                    :users="actual_data"
                    :roles="users_roles"
                    @updateRolesUser="updateRolesUser"
                />
                <products_admin v-if="active_view === 'products'" :products="actual_data"/>
                <plan_admin v-if="active_view === 'planes'" :planes="actual_data" :products="plan_products"/>
                <promotion_admin v-if="active_view === 'promotions'" :promotions="actual_data" :planes="promotion_planes"/>
            </template>
        </div>
        <!-- /.container-fluid -->
    </div>
</template>
<script>
    import BreadCrumbs from "./BreadCrumbs";
    export default {
        components: {BreadCrumbs},
        props: {
            breadcrumbs: {
                required: true,
            }
        },
        data: function(){
            return {
                loading_data: false,
                loading_text: '',
                active_view: 'dashboard',
                actual_data: [],
                plan_products: [],
                promotion_planes: [],
                users_roles: [],
                dashboard_breadcrumbs: this.breadcrumbs
            }
        },
        created() {
            window.eventsHub.$on('loadedUser',(data) => {this.proceedLoadedUser(data)});
            window.eventsHub.$on('loadedProducts',(data) => {this.proceedLoadedProducts(data)});
            window.eventsHub.$on('loading',(data) => { this.loadUser(data) });

            window.eventsHub.$on('createdProduct',(el) => {this.addedElementToData(el)});
            window.eventsHub.$on('deletedProduct',(product) => {this.deleteProducts(product)});
            window.eventsHub.$on('editedProduct',(product) => {this.editedProducts(product)});

            window.eventsHub.$on('createdUser',(el) => {this.addedElementToData(el)});
            window.eventsHub.$on('deletedUser',(user) => {this.deleteUser(user)});
            window.eventsHub.$on('unDeletedUser',(user) => {this.unDeleteUser(user)});
            window.eventsHub.$on('editedProduct',(product) => {this.editedProducts(product)});

            window.eventsHub.$on('loadedPlanes',(data) => {this.proceedLoadedPlanes(data)});
            window.eventsHub.$on('createdPlan',(el) => {this.addedElementToData(el)});
            window.eventsHub.$on('deletedPlan',(product) => {this.deletePlan(product)});
            window.eventsHub.$on('editedPlan',(product) => {this.editedPlan(product)});

            window.eventsHub.$on('loadedPromotion',(data) => {this.proceedLoadedPromotion(data)});
            window.eventsHub.$on('createdPromotion',(el) => {this.addedElementToData(el)});
            window.eventsHub.$on('deletedPromotion',(promotion) => {this.deletePromotion(promotion)});
            window.eventsHub.$on('editedPromotion',(promotion) => {this.editedPromotion(promotion)});
        },
        methods: {
            deleteUser: function(user){
                for(let i in this.actual_data){
                    if(this.actual_data[i].user_id === user.user_id){
                        this.actual_data[i].deleted = 1;
                    }
                }
            },
            unDeleteUser: function(user){
                for(let i in this.actual_data){
                    if(this.actual_data[i].user_id === user.user_id){
                        this.actual_data[i].deleted = 0;
                    }
                }
            },
            updateRolesUser: function(user){
                for(let i in this.actual_data){
                    if(this.actual_data[i].user_id === user.user_id){
                        this.actual_data[i] = user;
                    }
                }
            },
            proceedLoadedPromotion(data){
                this.loading_data = false;
                this.loading_text = '';
                this.active_view = 'promotions';
                this.actual_data = data.data.promotions;
                this.promotion_planes = data.data.planes;
                this.dashboard_breadcrumbs = data.data.breadcrumbs;
            },
            deletePromotion(promotion){
                this.actual_data = this.actual_data.filter((promo) => {
                    return promo.promotion_id !== promotion.promotion_id;
                });
            },
            editedPromotion(promotion){
                for(let i in this.actual_data){
                    if(this.actual_data[i].promotion_id === promotion.promotion_id){
                        this.actual_data[i] = promotion;
                    }
                }
            },
            proceedLoadedPlanes(data) {
                this.loading_data = false;
                this.loading_text = '';
                this.active_view = 'planes';
                this.actual_data = data.data.planes;
                this.plan_products = data.data.products;
                this.dashboard_breadcrumbs = data.data.breadcrumbs;

            },
            deletePlan(product){
                console.log(this.actual_data,product);
                this.actual_data = this.actual_data.filter((prod) => {
                    return prod.product_id !== product.product_id;
                });
            },
            editedPlan(product){
                console.log(product, this.actual_data, '12');
                for(let i in this.actual_data){
                    if(this.actual_data[i].product_id === product.product_id){
                        this.actual_data[i] = product;
                    }
                }
            },
            loadUser(data){
                this.loading_data = true;
                this.loading_text = data
            },
            proceedLoadedUser(data){
                this.loading_data = false;
                this.loading_text = '';
                this.active_view = 'users';
                this.actual_data = data.data.user;
                this.users_roles = data.data.roles;
            },
            proceedLoadedProducts(data){
                this.loading_data = false;
                this.loading_text = '';
                this.active_view = 'products';
                this.actual_data = data.data.products;
                this.dashboard_breadcrumbs = data.data.breadcrumbs;
            },
            addedElementToData(el){
                this.actual_data.push(el);
            },
            deleteProducts(product){
                console.log(this.actual_data,product);
                this.actual_data = this.actual_data.filter((prod) => {
                    return prod.product_id !== product.product_id;
                });
            },
            editedProducts(product){
                console.log(product, this.actual_data, '12');
                for(let i in this.actual_data){
                    if(this.actual_data[i].product_id === product.product_id){
                        this.actual_data[i] = product;
                    }
                }
            }
        },
        watch: {
            breadcrumbs: function(value){
                this.dashboard_breadcrumbs = value;
            }
        }
    }
</script>
<style>
    .body-container{
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .body{
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #f6f8fa;
        background-clip: border-box;
        /*border: 1px solid rgba(0, 0, 0, 0.125);*/
       /* border-radius: 0.25rem;*/
    }
    .badge-teal {
        background-color: #58d8a3;
        border: 1px solid #58d8a3;
        color: #fff;
    }
    .badge-warning {
        background-color: #ffc105;
        border: 1px solid #ffc105;
        color: #fff;
    }
    .badge {
        border-radius: .25rem;
        font-size: .75rem;
        font-weight: 400;
        line-height: 1;
        padding: .25rem .375rem;
        font-family: Poppins,sans-serif;
    }
    .shadow-1{
        box-shadow: 1px 2px #d4cccc94;
    }
    .shadow-2{
        box-shadow: 2px 3px #d4cccc94;
    }
    .shadow-3{
        box-shadow: 3px 4px #d4cccc94;
    }
    .admin-content{
        display: flex
    }
    .admin-container-fluid{
        margin-top: 15px;
    }
</style>
