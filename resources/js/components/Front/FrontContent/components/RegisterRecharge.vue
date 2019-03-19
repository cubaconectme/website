<template>
    <div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4" style="padding-left:0;">
                <div class="row">
                    <h3 class="h3" >Registrate</h3>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span class="text-muted">Email </span>
                        <input
                            type="text"
                            class="form-control"
                            v-model="username"
                            style="margin-bottom: 5px;"
                            @focus="removeErrors"
                        >
                        <span class="text-danger" v-if="error_username"> El usuario es requerido</span>
                        <br />
                        <span class="text-muted">Password</span>
                        <input
                            type="password"
                            class="form-control"
                            v-model="password"
                            style="margin-bottom: 5px;"
                            @focus="removeErrors"
                        >
                        <span class="text-danger" v-if="error_password"> La Contraseña es requerido</span>
                        <br />
                        <span class="text-muted">Repetir Password</span>
                        <input
                                type="password"
                                class="form-control"
                                v-model="repeat_password"
                                style="margin-bottom: 5px;"
                                @focus="removeErrors"
                        >
                        <span class="text-danger" v-if="error_repeat_password"> Error al repetir el password</span>
                    </div>
                    <p-check class="p-default p-curve p-fill" color="success" v-model="notification">Recibir Notificaciones</p-check>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="button button-primary " style="width: 100%" @click="registerUser">Registrate</button>
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
                        Tienes Cuenta? <a class="register-link" @click="showHideRegister">Iniciar!!</a>
                    </div>
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
                repeat_password:'',
                error_repeat_password: false,
                error_password: false,
                error_username: false,
                notification: true
            }
        },
        created: function() {
        },
        methods: {
            removeErrors(){
                this.error_repeat_password = false;
                this.error_password = false;
                this.error_username = false;
            },
            showHideRegister(){
                this.$emit('showHideRegister','hide');
            },
            getUserData(user){
                console.log(user);
            },
            onLogout(user){
                console.log(user);
            },
            registerUser(){
                if(!this.username){
                    this.error_username = true
                    return false
                }
                if(!this.password){
                    this.error_password = true
                    return false
                }
                if(!this.repeat_password || this.password !== this.repeat_password){
                    this.error_repeat_password = true
                    return false
                }

                this.sending_request = true;
                window.axios.post('registerUserAjax', {
                    'email': this.username,
                    'password': this.password,
                    'notification': this.notification
                })
                    .then(response => {
                        if(response.data.has_error){
                            this.login_error = true;
                            window.eventsHub.showErrorMsg({message: response.data.error_message});
                        } else {
                            this.$emit('userRegister', response.data.data);
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