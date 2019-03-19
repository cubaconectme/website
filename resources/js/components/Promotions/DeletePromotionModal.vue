<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">Delete Promotion</div>
        <div slot="modal_body">
           <div class="alert alert-warning"> Are you sure you want to delete this promotion? </div>
        </div>
        <div slot="footer_buttons">
            <button type="button" class="btn btn-danger" @click="deletePromotion" :disabled="sending_request">Delete promotion</button>
        </div>
    </bootstrap_modal>
</template>

<script>
    export default {
        props:{
            show_modal: {
                required: false
            },
            promotion: {
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
            deletePromotion(){
                console.log('deleting product');
                this.sending_request = true;
                window.axios.post('/promotion/actions', {
                    action_type: 'deletePromotion',
                    promotion_id: this.promotion.promotion_id,
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            window.eventsHub.$emit('deletedPromotion',response.data.data.promotion);
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