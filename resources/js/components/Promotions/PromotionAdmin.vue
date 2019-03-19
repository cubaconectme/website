<template>
    <div class="table">
        <div class="alert alert-info" v-if="!promotions.length"> There is no promotions!!!!</div>
        <table class="table table-hover" v-else>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Plan</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr is="promotion_line" v-for="promotion in promotions" :promotion="promotion" :key="promotion.promotion_id"></tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary" @click="showModalAddPromotion">Add Promotion</button>
        </div>
        <add_edit_promotion_modal
            :show_modal="show_modal_add"
            @closeAddEditModal="handleCloseModal"
            :promotion="promotion"
            :planes="planes"
            @cleanPromotion="resetPromotion"
        ></add_edit_promotion_modal>
        <delete_promotion_modal
            :show_modal="show_modal_delete_promotion"
            @closeDeleteModal="handleDeleteCloseModal"
            :promotion="promotion"
        ></delete_promotion_modal>
    </div>
</template>
<script>
    export default {
        props: {
            promotions: {
                required: true
            },
            planes: {
                required: true
            }
        },
        data: function(){
            return {
                show_modal_add: false,
                show_modal_delete_promotion: false,
                promotion: {}
            }
        },
        created: function(){
            window.eventsHub.$on('createdPromotion',() => {this.handleCloseModal()});
            window.eventsHub.$on('deletedPromotion',() => {this.handleCloseDeleteModal()});
            window.eventsHub.$on('editedPromotion',() => {this.handleCloseEditModal()});
            window.eventsHub.$on('deletePromotion',(promotion) => {this.handleOpenDeleteModal(promotion)});
            window.eventsHub.$on('editPromotion',(promotion) => {this.showModalAddEditPromotion(promotion)});
        },
        methods: {
            resetPromotion(){
                this.promotion = {}
            },
            handleCloseEditModal() {
                this.show_modal_add = false;
            },
            showModalAddPromotion(){
                this.show_modal_add = true;
            },
            showModalAddEditPromotion(promotion){
                this.show_modal_add = true;
                this.promotion = promotion
            },
            handleCloseModal(){
                this.show_modal_add = false;
            },
            handleOpenDeleteModal(promotion){
                this.promotion = promotion;
                this.show_modal_delete_promotion = true;
            },
            handleDeleteCloseModal(){
                this.show_modal_delete_promotion = false;
            },
            handleCloseDeleteModal(){
                this.show_modal_delete_promotion = false;
            }

        }
    }
</script>

<style scoped>

</style>