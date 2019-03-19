<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">{{ modalTitle }}</div>
        <div slot="modal_body">
            <form>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" v-model="product_name" id="product_name" placeholder="Product Name">
                    <span class="text-danger" v-if="error_name">The product name is required</span>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" v-model="product_description" id="product_description" rows="3"></textarea>
                    <span class="text-danger" v-if="error_description">The product description is required</span>

                </div>
            </form>
        </div>
        <div slot="footer_buttons">
            <button
                type="button"
                class="btn btn-primary"
                :class="buttonClass"
                @click="createProduct"
                :disabled="sending_request"
            >
                {{ buttonText }}
            </button>
        </div>
    </bootstrap_modal>
</template>

<script>
    export default {
        props:{
            show_modal: false,
            product: {
                required: false
            }
        },
        data: function() {
            return {
                product_name: '',
                product_description: '',
                error_name: false,
                error_description: false,
                sending_request: false,
            }
        },
        methods:{
            cleanModal(){
                this.product_name = '';
                this.product_description = '';
                this.error_name = false,
                this.error_description = false;
                this.sending_request = false;
                this.$emit('cleanProduct');
            },
            closeAddModal(){
                this.cleanModal();
                this.$emit('closeAddEditModal')
            },
            createProduct(){
                console.log('creating product');
                if(!this.product_name){
                    console.log('Error name');
                    this.error_name = true;
                    return false;
                }

                if(!this.product_description){
                    console.log('Error description');
                    this.error_description = true;
                    return false;
                }
                this.sending_request = true;
                let action_type = (Object.keys(this.product).length) ? 'editProduct' : 'createProduct';
                window.axios.post('/products/actions', {
                    action_type: action_type,
                    product_name: this.product_name,
                    product_description: this.product_description,
                    product_id: this.product.product_id
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            if(action_type === 'createProduct') {
                                window.eventsHub.$emit('createdProduct',response.data.data.product)
                            } else {
                                window.eventsHub.$emit('editedProduct',response.data.data.product)
                            }
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    });

            }
        },
        watch: {
            product: function(value){
                if(value && Object.keys(value).length) {
                    this.product_name = value.name;
                    this.product_description = value.description;
                }
            },
            product_name: function(value){
                if(value.length){
                    this.error_name = false;
                }
            },
            product_description: function(value){
                if(value.length){
                    this.error_description = false;
                }
            }
        },
        computed: {
            modalTitle: function(){
                return (Object.keys(this.product).length) ? 'Edit Product ' : 'Add New Product';
            },
            buttonText: function(){
                return (Object.keys(this.product).length) ? 'Edit Product ' : 'Add Product';
            },
            buttonClass: function(){
                return (Object.keys(this.product).length) ? 'btn-warning' : 'btn-primary';
            }
        }

    }
</script>

<style scoped>

</style>