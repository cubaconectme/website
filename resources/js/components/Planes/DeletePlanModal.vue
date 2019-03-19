<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">Delete Plan</div>
        <div slot="modal_body">
           <div class="alert alert-warning"> Are you sure you want to delete this plan? </div>
        </div>
        <div slot="footer_buttons">
            <button type="button" class="btn btn-danger" @click="deletePlan" :disabled="sending_request">Delete Plan</button>
        </div>
    </bootstrap_modal>
</template>

<script>
    export default {
        props:{
            show_modal: {
                required: false
            },
            plan: {
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
            deletePlan(){
                console.log('deleting product');
                this.sending_request = true;
                window.axios.post('/planes/actions', {
                    action_type: 'deletePlan',
                    promotion_id: this.promotion.promotion_id,
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('deletedPlan',response.data.data.plan);
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