<template>
    <div>
        <div class="row">
            <h1> Bienvenido {{ user.name }}</h1>
            <hr>
            <h4>Mis Recargas</h4>
            <div class="col-sm-8">
                <div class="col-sm-12">
                    <div class="bs-example" data-example-id="striped-table">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Número</th>
                                <th>Contacto</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                <th>Recargar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>20 usd</td>
                                <td>@mdo</td>
                                <td>
                                    <button class="button btn-xs">
                                        Repetir
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>20 usd</td>
                                <td>@fat</td>
                                <td>
                                    <button class="button btn-xs">
                                        Repetir
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>20 usd</td>
                                <td>@twitter</td>
                                <td>
                                    <button class="button btn-xs">
                                        Repetir
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <h4>Bonos activos (18 al 23 de marzo de 2019)</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card-bonus text-white bg-primary">
                                        <div class="card-body pb-0">
                                            <div class="text-value text-right bonus-card-title">Cubacel</div>
                                            <div class="bonus-card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Saldo
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        20 cuc
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 min
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 sms
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right price-bonus" style="">Precio <span> 20.00 usd </span></div>


                                            <div class="text-right bonus-card-footer"> vence 30 de abril</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card-bonus text-white bg-primary">
                                        <div class="card-body pb-0">
                                            <div class="text-value text-right bonus-card-title">Cubacel</div>
                                            <div class="bonus-card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Saldo
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        20 cuc
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 min
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 sms
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right price-bonus" style="">Precio <span> 20.00 usd </span></div>


                                            <div class="text-right bonus-card-footer"> vence 30 de abril</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3" title="Mas popular">
                                    <div class="card-bonus card-bonus-gold text-white bg-primary">
                                        <div class="card-body pb-0">
                                            <div class="text-value text-right bonus-card-title">
                                                <font-awesome-icon icon="fire" title="Mas popular"/>
                                                Cubacel
                                            </div>
                                            <div class="bonus-card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Saldo
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        20 cuc
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 min
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 sms
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right price-bonus" style="">Precio <span> 20.00 usd </span></div>


                                            <div class="text-right bonus-card-footer"> vence 30 de abril</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card-bonus text-white bg-primary">
                                        <div class="card-body pb-0">
                                            <div class="text-value text-right bonus-card-title">
                                                Cubacel
                                            </div>
                                            <div class="bonus-card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Saldo
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        20 cuc
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 min
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        extra
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        +50 sms
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right price-bonus" style="">Precio <span> 20.00 usd </span></div>
                                            <div class="text-right bonus-card-footer"> vence 30 de abril</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4 text-right" style="margin-top: 30px">
                            Escoge un bonus o una <button class="button"> Nueva Recarga</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <h4>Mis Contactos</h4>
                <div class="contact-section">
                    <div class="list-group list-group-accent">
                        <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">
                            Contactos
                        </div>
                        <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar" style="display:inline-block;">
                                        <img
                                                class="img-avatar"
                                                src="https://api.adorable.io/avatars/64/6.png"
                                                alt="admin@bootstrapmaster.com"
                                                style="border-radius: 50%"
                                                width="42"
                                                height="42"
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div style="display:inline-block;">(783)123 1234
                                                <strong>name</strong>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="display:inline-block;">
                                                <button class="btn btn-primary btn-xs">Recargar</button>
                                                <button class="btn btn-primary btn-xs">Enviar Mensaje</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar" style="display:inline-block;">
                                        <img
                                                class="img-avatar"
                                                src="https://api.adorable.io/avatars/64/7.png"
                                                alt="admin@bootstrapmaster.com"
                                                style="border-radius: 50%"
                                                width="42"
                                                height="42"
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div style="display:inline-block;">(783)123 1234
                                                <strong>name</strong>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="display:inline-block;">
                                                <button class="btn btn-primary btn-xs">Recargar</button>
                                                <button class="btn btn-primary btn-xs">Enviar Mensaje</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar" style="display:inline-block;">
                                        <img
                                                class="img-avatar"
                                                src="https://api.adorable.io/avatars/64/15.png"
                                                alt="admin@bootstrapmaster.com"
                                                style="border-radius: 50%"
                                                width="42"
                                                height="42"
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div style="display:inline-block;">(783)123 1234
                                                <strong>name</strong>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div style="display:inline-block;">
                                                <button class="btn btn-primary btn-xs">Recargar</button>
                                                <button class="btn btn-primary btn-xs">Enviar Mensaje</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            user:{
               required: true
            }
        },
        name: "UserDashboard"
    }
</script>

<style scoped>
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

    .card-bonus{
        border-radius: 5px;
    }
    .bonus-card-title{
        margin-right: 10px;
        padding-top: 5px;
    }
    .card-bonus:hover{
         -webkit-box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
         box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
         -webkit-transform: translateY(-5px);
         transform: translateY(-5px);
        cursor: pointer;
     }
    .bonus-card-footer{
        margin-right: 10px;
        padding-bottom: 5px;
        color: #f3cfcf;
        font-size: 0.7em;
    }
    .price-bonus{
        border-top: solid 1px #f3cfcf;
        margin: 0 5px;
    }
    .bonus-card-body{
        margin: 5px;
        padding: 5px;
    }
    .card-bonus-gold{
        background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                    radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
    }
    .contact-section{
        //border: solid 1px black;
        max-height: 500px;
    }

</style>