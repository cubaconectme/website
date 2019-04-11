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
                    <label for="product_placeholder">Product PlaceHolder</label>
                    <input type="text" class="form-control" v-model="product_placeholder" id="product_placeholder" placeholder="Product Placeholder">
                    <span class="text-danger" v-if="error_placeholder">The product placeholder is required</span>
                </div>
                <div v-if="product_image.length">
                <span v-for="image in product_image" :key="image.id" style="list-style: none">
                    <img width="80px" height="80px" :src="image_url"/>
                </span>
                </div>
                <div class="form-group">
                    <label for="product_image" class="btn btn-primary" style="margin-top: 5px;">Select Image</label>
                    <input type="file" class="form-control"  id="product_image" @change="uploadProductImage" style="display:none">
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
                product_placeholder: '',
                product_image: '',
                error_name: false,
                error_description: false,
                error_placeholder: false,
                sending_request: false,
                image_url: ''
            }
        },
        methods:{
            uploadProductImage(event){
                this.product_image = [];
                let image = event.target.files[0];
                console.log(image);
                if(image.type !== 'image/jpeg' && image.type !== 'image/png' && image.type !== 'image/svg+xml') {
                    this.error_image = true;
                    return false;
                }
                this.product_image.push(image);
                let image_reader = new FileReader();
                image_reader.readAsDataURL(this.product_image[0]);
                image_reader.onload =  (e) => {
                    this.image_url =  e.target.result;
                };
                console.log(image_reader.result);
                this.image_url = image_reader.result;
            },
            cleanModal(){
                this.product_name = '';
                this.product_description = '';
                this.product_placeholder = '';
                this.product_image = '';
                this.error_name = false;
                this.error_description = false;
                this.error_placeholder = false;
                this.sending_request = false;
                this.$emit('cleanProduct');
            },
            closeAddModal(){
                this.cleanModal();
                this.$emit('closeAddEditModal')
            },
            createProduct(){
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
                let form = new FormData();
                form.append('action_type',action_type);
                form.append('product_name',this.product_name);
                form.append('product_description',this.product_description);
                form.append('product_placeholder',this.product_placeholder);
                form.append('product_id',(this.product) ? this.product.product_id : 0);
                form.append('product_image',this.product_image[0]);
                console.log(form);
                window.axios.post('/products/actions', form,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
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