<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">Delete User</div>
        <div slot="modal_body">
           <div class="alert alert-warning"> Are you sure you want to delete this user? </div>
        </div>
        <div slot="footer_buttons">
            <button type="button" class="btn btn-danger" @click="deleteUser" :disabled="sending_request">Delete user</button>
        </div>
    </bootstrap_modal>
</template>
<script>
    export default {
        props:{
            show_modal: {
                required: false
            },
            user: {
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
                this.$emit('closeUserDeleteModal')
            },
            deleteUser(){
                this.sending_request = true;
                window.axios.post('/user/actions', {
                    action_type: 'deleteUser',
                    user_id: this.user.user_id,
                })
                    .then( (response) => {
                        this.sending_request = false;
                        if(response.data.has_error){
                            window.eventsHub.showErrorMsg({title:'Delete Error',message: response.data.error_message});
                        } else {
                            window.eventsHub.$emit('deletedUser',response.data.data.user);
                            this.$emit('closeUserDeleteModal');
                            window.eventsHub.showSuccessMsg({title:'Delete User',message: response.data.error_message});
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