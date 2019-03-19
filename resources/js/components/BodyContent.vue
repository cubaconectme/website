<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="body">
               <div class="body-container">
                   <div class="row">
                       <option-card>
                           <template v-slot:card-content>
                               <div class="clearfix">
                                   <div class="float-left"><i class="mdi mdi-cube text-danger icon-lg"></i></div>
                                   <div class="float-right"><p class="card-text text-right">Recargas Cubacel</p>
                                       <div class="fluid-container">
                                           <h5 class="card-title font-weight-bold text-right mb-0">$10 usd = $10 cuc</h5>
                                           <h5 class="card-title font-weight-bold text-right mb-0">$20 usd = $20 cuc</h5>
                                           <h5 class="card-title font-weight-bold text-right mb-0">+ opciones...</h5>
                                       </div>
                                   </div>
                               </div>
                               <p class="text-muted mt-3">
                                   <i aria-hidden="true" class="mdi mdi-alert-octagon mr-1"></i>
                                   No hay promoción en este momento!!!
                               </p>
                           </template>
                       </option-card>
                       <option-card>
                           <template v-slot:card-content>
                                   <div class="clearfix">
                                       <div class="float-left"><i class="mdi mdi-receipt text-warning icon-lg"></i>
                                       </div>
                                       <div class="float-right"><p class="card-text text-right">Recargas Nauta</p>
                                           <div class="fluid-container">
                                               <h5 class="card-title font-weight-bold text-right mb-0">$10 usd = $10 cuc</h5>
                                               <h5 class="card-title font-weight-bold text-right mb-0">$20 usd = $20 cuc</h5>
                                               <h5 class="card-title font-weight-bold text-right mb-0">+ opciones...</h5>
                                           </div>
                                       </div>
                                   </div>
                                   <p class="text-muted mt-3">
                                       <i aria-hidden="true" class="mdi mdi-bookmark-outline mr-1"></i>
                                       Recargue Nauta, mantengase conectado!!
                                   </p>
                           </template>
                       </option-card>
                       <option-card>
                           <template v-slot:card-content>
                                   <div class="clearfix">
                                       <div class="float-left"><i class="mdi mdi-poll-box text-teal icon-lg"></i></div>
                                       <div class="float-right"><p class="card-text text-right">Mensajes</p>
                                           <div class="fluid-container">
                                               <h5 class="card-title font-weight-bold text-right mb-0">30 free SMS</h5>
                                               <h5 class="card-title font-weight-bold text-right mb-0">Mensajes Ilimitados desde la app...</h5>
                                               <h5 class="card-title font-weight-bold text-right mb-0">+ opciones ...</h5>
                                           </div>
                                       </div>
                                   </div>
                                   <p class="text-muted mt-3"><i aria-hidden="true" class="mdi mdi-calendar mr-1"></i>

                                   </p>
                           </template>
                       </option-card>
                       <option-card>
                           <template v-slot:card-content>
                                   <div class="clearfix">
                                       <div class="float-left"><i
                                               class="mdi mdi-account-location text-info icon-lg"></i></div>
                                       <div class="float-right"><p class="card-text text-right">Más Opciones</p>
                                           <div class="fluid-container">
                                               <font-awesome-icon class="fa-4x" icon="coffee" />
                                           </div>
                                       </div>
                                   </div>
                                   <p class="text-muted mt-3"><i aria-hidden="true" class="mdi mdi-reload mr-1"></i>
                                      More Comunication and another functions ...
                                   </p>
                           </template>
                       </option-card>
                   </div>
                   <div  class="row" style="margin-top: 15px;">
                       <div  class="col-12 grid-margin">
                           <div  class="card">
                               <div class="card-body">
                                   <h5 class="card-title mb-4">
                                       Recargas Recientes
                                   </h5>
                                   <div   class="table-responsive">
                                       <table   class="table center-aligned-table">
                                           <thead  >
                                           <tr  >
                                               <th class="border-bottom-0">Order No</th>
                                               <th class="border-bottom-0">Product Name</th>
                                               <th class="border-bottom-0">Purchased On</th>
                                               <th class="border-bottom-0">Shipping Status</th>
                                               <th class="border-bottom-0">Payment Method</th>
                                               <th class="border-bottom-0">Payment Status</th>
                                               <th class="border-bottom-0"></th>
                                               <th class="border-bottom-0"></th>
                                               <th class="border-bottom-0"></th>
                                           </tr>
                                           </thead>
                                           <tbody  >
                                           <tr  >
                                               <td >034</td>
                                               <td >Iphone 7</td>
                                               <td >12 May 2017</td>
                                               <td >Dispatched</td>
                                               <td >Credit card</td>
                                               <td ><label
                                                                             class="badge badge-teal">Approved</label>
                                               </td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-success btn-sm">View
                                                   Order</a></td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-danger btn-sm">Cancel</a>
                                               </td>
                                           </tr>
                                           <tr  >
                                               <td  >035</td>
                                               <td  >Galaxy S8</td>
                                               <td  >15 May 2017</td>
                                               <td  >Dispatched</td>
                                               <td  >Internet banking</td>
                                               <td  ><label  
                                                                             class="badge badge-warning">Pending</label>
                                               </td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-success btn-sm">View
                                                   Order</a></td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-danger btn-sm">Cancel</a>
                                               </td>
                                           </tr>
                                           <tr  >
                                               <td  >036</td>
                                               <td  >Amazon Echo</td>
                                               <td  >17 May 2017</td>
                                               <td  >Dispatched</td>
                                               <td  >Credit card</td>
                                               <td  ><label  
                                                                             class="badge badge-teal">Approved</label>
                                               </td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-success btn-sm">View
                                                   Order</a></td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-danger btn-sm">Cancel</a>
                                               </td>
                                           </tr>
                                           <tr  >
                                               <td  >037</td>
                                               <td  >Google Pixel</td>
                                               <td  >17 May 2017</td>
                                               <td  >Dispatched</td>
                                               <td  >Cash on delivery</td>
                                               <td  ><label  
                                                                             class="badge badge-danger">Rejected</label>
                                               </td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-success btn-sm">View
                                                   Order</a></td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-danger btn-sm">Cancel</a>
                                               </td>
                                           </tr>
                                           <tr  >
                                               <td  >038</td>
                                               <td  >Mac Mini</td>
                                               <td  >19 May 2017</td>
                                               <td  >Dispatched</td>
                                               <td  >Debit card</td>
                                               <td  ><label  
                                                                             class="badge badge-teal">Approved</label>
                                               </td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-success btn-sm">View
                                                   Order</a></td>
                                               <td  ><a   href="#"
                                                                         class="btn btn-outline-danger btn-sm">Cancel</a>
                                               </td>
                                           </tr>
                                           </tbody>
                                       </table>
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
        props: {
            card_type:{
                required: false,
                default: 'primary'
            },
        },
        mounted() {
            console.log('car content mounted.')
        },
        computed: {
            classCard() {
                switch (this.card_type) {
                    case('primary'):
                        return 'primary color';
                    case('warning'):
                        return 'warning';
                    case('danger'):
                        return 'danger' ;
                    case('success'):
                        return 'success';
                }
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
</style>
