<template>
    <div class="table">
        <div class="alert alert-info" v-if="!products.length"> There is no products!!!!</div>
        <table class="table table-hover" v-else>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Product Image</th>
                <th scope="col">Placeholder</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr is="products_line" v-for="product in products" :product="product" :key="product.product_id"></tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary" @click="showModalAddProduct">Add Product</button>
        </div>
        <add_edit_product_modal
            :show_modal="show_modal_add"
            @closeAddEditModal="handleCloseModal"
            :product="product"
            @cleanProduct="resetProduct"
        ></add_edit_product_modal>
        <delete_product_modal
            :show_modal="show_modal_delete_product"
            @closeDeleteModal="handleDeleteCloseModal"
            :product="product"
        ></delete_product_modal>
    </div>
</template>
<script>
    export default {
        props: {
            products: {
                required: true
            }
        },
        data: function(){
            return {
                show_modal_add: false,
                show_modal_delete_product: false,
                product: {}
            }
        },
        created: function(){
            window.eventsHub.$on('createdProduct',() => {this.handleCloseModal()});
            window.eventsHub.$on('deletedProduct',() => {this.handleCloseDeleteModal()});
            window.eventsHub.$on('editedProduct',() => {this.handleCloseEditModal()});
            window.eventsHub.$on('deleteProduct',(product) => {this.handleOpenDeleteModal(product)});
            window.eventsHub.$on('editProduct',(product) => {this.showModalAddEditProduct(product)});
        },
        methods: {
            resetProduct(){
                this.product = {}
            },
            handleCloseEditModal() {
                this.show_modal_add = false;
            },
            showModalAddProduct(){
                this.show_modal_add = true;
            },
            showModalAddEditProduct(product){
                this.show_modal_add = true;
                this.product = product
            },
            handleCloseModal(){
                this.show_modal_add = false;
            },
            handleOpenDeleteModal(product){
                this.product = product;
                this.show_modal_delete_product = true;
            },
            handleDeleteCloseModal(){
                this.show_modal_delete_product = false;
            },
            handleCloseDeleteModal(){
                this.show_modal_delete_product = false;
            }

        }
    }
</script>

<style scoped>

</style>