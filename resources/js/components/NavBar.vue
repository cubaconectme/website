<template>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background: linear-gradient(120deg, #00e4d0, #5983e8);">
            <div class="container">
                <a class="navbar-brand" :href="home_url">
                    {{ app_name }}
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label=""
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <ul class="navbar-nav ml-auto" >
                        <li class="nav-item" v-if="is_guest">
                            <a class="nav-link" href="/login">
                                Login
                            </a>
                        </li>
                        <li class="nav-item" v-if="is_guest">
                            <a class="nav-link" href="/Register">
                                Register
                            </a>
                        </li>
                        <li class="nav-item dropdown" v-if="!is_guest">
                            <nav-bar-dropdown :user="user" :roles="roles_data" :token_csrf="token_csrf">

                            </nav-bar-dropdown>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</template>

<script>
    export default {
        props: {
            home_url: {
                required: false,
                default:"/"
            },
            app_name: {
                required: false,
                default:"Laravel"
            },
            is_guest: {
                required: true,
            },
            roles: {
                required:false,
            },
            user: {
                required:false
            },
            token_csrf:{
                required: false
            }
        },
        data: function(){
            return {
                roles_data: this.roles
            }
        },
        mounted() {
            console.log('NavBar mounted.')
        }
    }
</script>

<style>
    .navbar-light .navbar-brand {
        color: rgba(255, 255, 255, 0.9);
    }
    .navbar-light .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.5);
    }
    .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
        color: rgba(255, 255, 255, 0.7);
    }
    .navbar-light .navbar-brand:hover, .navbar-light .navbar-brand:focus {
        color: rgba(255, 255, 255, 0.7);
    }
</style>
