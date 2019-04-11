<template>
    <div class="mainmenu-area" data-spy="affix"  :style="(user) ? 'background-color: #138fc2;' : ''">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">
                    <h2>{{ app_name }}</h2>
                </a>
            </div>
            <nav class="collapse navbar-collapse" id="primary-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="#home-page" @click="showLoginView('inicio','inicio')">Inicio</a></li>
                    <li><a href="#service-page" @click="showLoginView('products_cards','recargas')">Recargas</a></li>
                    <!--<li><a href="#contact-page">Contact</a></li>-->
                    <li v-if="!user_logged">
                        <a href="#service-page" @click="showLoginView('login','login')">
                            Login
                        </a>
                    </li>
                    <li class="nav-item dropdown" v-else>
                        <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="true" class="nav-link dropdown-toggle">
                            {{ userViewName }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li>
                               <a href="#" class="dropdown-menu-child" @click="showUserProfile">
                                   <font-awesome-icon icon="cog" />
                                   Perfil
                               </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-menu-child" @click="showNewRecharge">
                                    <font-awesome-icon icon="mobile-alt" />
                                    Nueva Recarga
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#" class="dropdown-menu-child" @click="logoutUser">
                                    <font-awesome-icon icon="sign-out-alt" />
                                    Logout
                                </a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" id="csrf-token" :value="token_csrf" />
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            app_name:{
                required: false,
                default: 'Recargas'
            },
            user:{
                required: false,
                default: null
            }
        },
        data: ()=>{
            return {
                user_logged: null,
                token_csrf: window.axios.defaults.headers.common['X-CSRF-TOKEN']
            }
        },
        created: function(){
            this.initUserLogged();
        },
        methods:{
            showNewRecharge(){
                window.eventsHub.$emit('showNewRecharge');
            },
            showUserProfile(){
                window.eventsHub.$emit('showUserProfile');
            },
            initUserLogged(){
                this.user_logged = this.user;
            },
            showLoginView(view){
                let status = (!this.user_logged && view === 'inicio');
                let temp_view = '';
                if(view === 'inicio'){
                    temp_view = (this.user_logged) ? 'user_dashboard' : 'products_cards';
                } else {
                    temp_view = view;
                }

                window.eventsHub.$emit('showView',temp_view );
                window.eventsHub.$emit('showPrincipalView',status);
            },
            logoutUser(){
                let form = document.querySelector('#logout-form');
                form.submit();
            }
        },
        computed:{
            userViewName: function(){
                if(!this.user_logged) {
                    return 'Desconocido';
                }
                if(this.user_logged.name){
                    return this.user_logged.name;
                } else {
                    return this.user_logged.email
                }
            }
        },
        watch: {
            user: function(value){
                this.user_logged = value;
            }
        }
    }
</script>

<style scoped>
    .mainmenu-area{
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
    }
    .mainmenu-area #primary-menu > ul > li > a {
        padding-top: 15px;
        padding-bottom: 15px;
    }
    .dropdown-menu-child:hover{
        color: blueviolet;
    }
</style>