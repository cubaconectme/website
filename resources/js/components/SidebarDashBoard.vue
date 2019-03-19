<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(120deg, #5983e8, #00e4d0 )">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Settings
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link hand" @click="loadUsers">
                <font-awesome-icon icon="users" />
                <span>Users</span>
            </a>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <font-awesome-icon icon="cogs" />
                <i class="fas fa-fw fa-wrench"></i>
                <span>Roles</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <font-awesome-icon icon="lock" />
                <span>Routes Permission</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Recargas
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed hand" @click="loadProducts">
                <font-awesome-icon icon="folder" />
                <span>Products</span>
            </a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item collapsed hand" @click="loadPlanes">
            <a class="nav-link" href="#">
                <font-awesome-icon icon="shopping-cart" />
                <span>Planes</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed hand" @click="loadPromotions">
                <font-awesome-icon icon="bullhorn" />
                <span>Promotions</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
</template>

<script>
    export default {
        props: {

        },
        data: function(){
            return {
            }
        },
        methods: {
            loadUsers(){
                console.log('click User');
                window.eventsHub.$emit('loading', 'Loading User...');
                window.axios.post('/user', {})
                    .then(function (response) {
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('loadedUser',response.data);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadProducts(){
                window.eventsHub.$emit('loading', 'Loading Products...');
                window.axios.post('/products', {})
                    .then(function (response) {
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('loadedProducts',response.data);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadPlanes(){
                console.log('load planes');
                window.eventsHub.$emit('loading', 'Loading Planes...');
                window.axios.post('/planes', {})
                    .then(function (response) {
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('loadedPlanes',response.data);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            loadPromotions(){
                console.log('load promotion');
                window.eventsHub.$emit('loading', 'Loading Promotions...');
                window.axios.post('/promotion', {})
                    .then(function (response) {
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('loadedPromotion',response.data);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }
</script>

<style>

</style>
