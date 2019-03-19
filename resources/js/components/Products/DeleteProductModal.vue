<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">Add New User</div>
        <div slot="modal_body">
           <div class="alert alert-warning"> Are you sure you want to delete this product? </div>
        </div>
        <div slot="footer_buttons">
            <button type="button" class="btn btn-danger" @click="deleteProduct" :disabled="sending_request">Delete Product</button>
        </div>
    </bootstrap_modal>
</template>

<script>
    export default {
        props:{
            show_modal: {
                required: false
            },
            product: {
                required: false,
            }
        },
        data: function() {
            return {
                sending_request: false
            }
        },
        methods:{
            closeAddModal(){
                this.$emit('closeDeleteModal')
            },
            deleteProduct(){
                console.log('creating product');
                this.sending_request = true;
                window.axios.post('/products/actions', {
                    action_type: 'deleteProduct',
                    product_id: this.product.product_id,
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('deletedProduct',response.data.data.product);
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    });
            }
        },
    }
</script>

<style scoped>

</style>