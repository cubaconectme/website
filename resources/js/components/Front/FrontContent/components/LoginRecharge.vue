<template>
    <div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4" style="padding-left:0;">
                <div class="row">
                    <h3 class="h3" >Bienvenido a CubaConectme</h3>
                </div>
                <div class="alert alert-danger" v-if="login_error">Usuario o password incorrectos</div>
                <div class="row">
                    <form @submit.prevent="loginUser">
                        <div class="form-group">
                            <span class="text-muted">Email o Número de Teléfono</span>
                            <input
                                type="text"
                                class="form-control"
                                v-model="username"
                                style="margin-bottom: 5px;"
                                @focus="removeUsernameError"
                            >
                            <span class="text-danger" v-if="error_username"> El usuario es requerido</span>
                            <br/>
                            <span class="text-muted">Password</span>
                            <input
                                type="password"
                                class="form-control"
                                v-model="password"
                                style="margin-bottom: 5px;"
                                @focus="removePasswordError"
                            >
                            <span class="text-danger" v-if="error_password"> La Contraseña es requerido</span>
                        </div>
                        <p-check class="p-default p-curve p-fill" color="success" v-model="remember_me">Recordar</p-check>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="button button-primary" style="width: 100%" type="submit">Iniciar Session</button>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-sm-6 ">
                                <facebook-login  :button_label="'Facebook'" style="width: 100%"/>
                            </div>
                            <div class="col-sm-6 ">
                                <google-login :button_label="'Google'" style="width: 100%"/>
                            </div>
                        </div>
                        <div class="row text-center" style="margin-top: 20px">
                            No tienes Cuenta? <a class="register-link" @click="showHideRegister">Registrate!!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FacebookLogin from './FacebookLogin'
    import GoogleLogin from './GoogleLogin'
    export default {
        components: {
            FacebookLogin,
            GoogleLogin,
        },
        props: {

        },

        data: () => {
            return {
                username: '',
                password:'',
                error_username: false,
                error_password: false,
                sending_request: false,
                login_error: false,
                remember_me: true
            }
        },
        created: function() {
        },
        methods: {
            removeUsernameError(){
                this.error_username = false;
                this.login_error = false;
            },
            removePasswordError(){
                this.error_password = false;
                this.login_error = false;
            },
            showHideRegister(){
                this.$emit('showHideRegister','show');
            },
            getUserData(user){
                console.log(user);
            },
            onLogout(user){
                console.log(user);
            },
            loginUser(){
                if(!this.username){
                    this.error_username = true
                    return false
                }
                if(!this.password){
                    this.error_password = true
                    return false
                }
                this.sending_request = true;
                window.axios.post('loginUserAjax', {
                    'username': this.username,
                    'password': this.password,
                    'remember_me': this.remember_me
                })
                    .then(response => {
                        if(response.data.has_error){
                            this.login_error = true;
                            window.eventsHub.showErrorMsg({message: response.data.error_message});
                        } else {
                            this.$emit('userLogged', response.data.data);
                            window.eventsHub.$emit('userLogged', response.data.data);
                        }
                        this.sending_request = false;
                    })
                    .catch(error=> {
                        console.log(error);
                        this.sending_request = false;
                    });

                //TODO: Send Ajax request
            }
        },
        computed: {

        },
        watch: {

        },
    }
</script>
<style lang="scss" scoped>
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
    .register-link{
        text-decoration: underline;
    }
    .register-link:hover{
        margin-left: 2px;
        color: #1c294e;
        cursor: pointer;
    }
    .register-link:visited{
        color: #942d73;
    }

</style>