<template>
    <bootstrap_modal :open="show_modal" @close="closeModal">
        <div slot="modal_title">User Rol</div>
        <div slot="modal_body">
            <form>
                <div class="form-group">
                    <label for="promotion_name">User Name</label>
                    <input type="text" class="form-control" v-model="user_name" id="promotion_name" placeholder="User Name" disabled>
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label>
                    <VueSelect :options="roles" v-model="rol_id" class="form-control" id="roles"></VueSelect>
                    <span class="text-danger" v-if="error_rol">You must have at least one selected role!!!</span>
                </div>
            </form>
        </div>
        <div slot="footer_buttons">
            <button
                type="button"
                class="btn btn-primary"
                @click="assignRol"
                :disabled="sending_request"
            >
                Assign Rol
            </button>
        </div>
    </bootstrap_modal>
</template>

<script>
    import VueSelect from '../General/VueSelect';

    export default {
        components:{
          VueSelect
        },
        props:{
            show_modal: false,
            user: {
                required: false
            },
            roles:{
                required: true
            }
        },
        data: function() {
            return {
                user_name: '',
                rol_id: [],
                error_rol: false,
                sending_request: false,
            }
        },
        methods: {
            cleanModal: function(){
                this.user_name = '';
                this.rol_id = [];
                this.error_rol = false;
                this.sending_request = false;
            },
            closeModal: function(){
                this.cleanModal();
                this.$emit('closeModal');
            },
            assignRol: function() {
                this.sending_request = true;
                if(!this.rol_id.length){
                    this.error_rol = true;
                    return false;
                }
                window.axios.post('/user/actions', {
                    action_type: 'updateRol',
                    user: this.user.user_id,
                    roles: this.rol_id
                })
                    .then( (response) => {
                        this.sending_request = false;
                        if(response.data.data.has_error){
                            console.log(response);
                        } else {
                            this.$emit('rolUpdate',response.data.data.user);
                            this.cleanModal();
                            window.eventsHub.showSuccessMsg({
                                title: 'Rol',
                                message: 'Rol changed!'
                            });
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    });
            },
            convertRolesToArray: function(){
                return Object.keys(this.roles).map((key) => {
                    return this.roles[key]
                });
            }
        },
        watch: {
            user: function(value){
                if(value){
                    this.user_name = value.name;
                    if(value.roles){
                        for(let i in value.roles){
                            this.rol_id.push(value.roles[i].id);
                        }
                    }
                }
            }
        },
        computed: {
            rolesToArray: function(){
                return this.convertRolesToArray();
            }
        }

    }
</script>

<style scoped>

</style>