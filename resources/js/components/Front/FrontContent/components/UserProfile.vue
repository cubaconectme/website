<template>
    <div class="component">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 perfil-box">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-4 text-center">
                            <img src="https://api.adorable.io/avatars/64/3.png" alt="Image Avatar" height="80" width="80" style="border-radius: 50%;">
                            <span style="display:block">{{ user_logged.email }}</span>
                            <span><a class="change-password-link">Cambiar Password</a></span>
                            <div class="change-image">

                            </div>
                        </div>
                    </div>
                    <h3 >
                        Cuenta
                    </h3>
                    <div class="row">
                        <div class="col-sm-10">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Nombre
                        </div>
                        <div class="col-sm-6">
                            <input type="text" v-model="user_logged.name" class="form-control" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Telefono
                        </div>
                        <div class="col-sm-6">
                            <input type="text" v-model="user_logged.phone_number" class="form-control" placeholder="Número de Telefono">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Imagen
                        </div>
                        <div class="col-sm-6">
                            <upload_file :formatSize="100"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            Recibir Notificacion
                        </div>
                        <div class="col-sm-6">
                            <p-check class="p-default p-curve p-fill profile-checkbox" color="primary" v-model="user_logged.notification" >
                            </p-check>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 50px">
                        <div class="col-sm-2 col-sm-offset-8 text-right">
                            <button class="button">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import UploadFile from '../../../General/UploadFile'

    export default {
        components:{
          'upload_file': UploadFile
        },
        props:{
            user: {
                required: true
            }
        },
        data: () => {
            return {
                user_logged: {}
            }
        },
        created: function(){
            this.user_logged = this.user;
        },
        methods: {

        },
        watch: {
            user: function(value){
                this.user_logged = value;
            }
        },
        name: "UserProfile"
    }
</script>

<style scoped>
    .change-password-link{
        text-decoration: underline;
        cursor:pointer
    }
    .change-password-link:hover{
        color: #1d68a7;
        font-size: 1.2em;
    }
    .perfil-box{
        padding-top: 25px;
        padding-bottom: 25px;
    }
    .perfil-box:hover{
        -webkit-box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        -webkit-transform: translateY(-5px);
        transform: translateY(-5px);
    }
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
</style>