<template>
    <div class="table">
        <div class="alert alert-info" v-if="!planes.length"> There is no products!!!!</div>
        <table class="table table-hover" v-else>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Product</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr is="plan_line" v-for="plan in planes" :plan="plan" :key="plan.plan_id"></tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary" @click="showModalAddPlan">Add Plan</button>
        </div>
        <add_edit_plan_modal
            :show_modal="show_modal_add"
            @closeAddEditModal="handleCloseModal"
            :plan="plan"
            :products="products"
            @cleanPlan="resetPlan"
        ></add_edit_plan_modal>
        <delete_plan_modal
            :show_modal="show_modal_delete_plan"
            @closeDeleteModal="handleDeleteCloseModal"
            :plan="plan"
        ></delete_plan_modal>
    </div>
</template>
<script>
    export default {
        props: {
            planes: {
                required: true
            },
            products: {
                required: true
            }
        },
        data: function(){
            return {
                show_modal_add: false,
                show_modal_delete_plan: false,
                plan: {}
            }
        },
        created: function(){
            window.eventsHub.$on('createdPlan',() => {this.handleCloseModal()});
            window.eventsHub.$on('deletedPlan',() => {this.handleCloseDeleteModal()});
            window.eventsHub.$on('editedPlan',() => {this.handleCloseEditModal()});
            window.eventsHub.$on('deletePlan',(plan) => {this.handleOpenDeleteModal(plan)});
            window.eventsHub.$on('editPlan',(product) => {this.showModalAddEditPlan(product)});
        },
        methods: {
            resetPlan(){
                this.plan = {}
            },
            handleCloseEditModal() {
                this.show_modal_add = false;
            },
            showModalAddPlan(){
                this.show_modal_add = true;
            },
            showModalAddEditPlan(plan){
                this.show_modal_add = true;
                this.plan = plan
            },
            handleCloseModal(){
                this.show_modal_add = false;
            },
            handleOpenDeleteModal(plan){
                this.plan = plan;
                this.show_modal_delete_plan = true;
            },
            handleDeleteCloseModal(){
                this.show_modal_delete_plan = false;
            },
            handleCloseDeleteModal(){
                this.show_modal_delete_plan = false;
            }

        }
    }
</script>

<style scoped>

</style>