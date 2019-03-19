<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">{{ modalTitle }}</div>
        <div slot="modal_body">
            <form>
                <div class="form-group">
                    <label for="user_name">Name</label>
                    <input type="text" class="form-control" v-model="user_name" id="user_name" placeholder="User Name">
                    <span class="text-danger" v-if="error_name">The user name is required</span>
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="email" class="form-control" v-model="user_email" id="user_email" placeholder="Email">
                    <span class="text-danger" v-if="error_email">The user email is required</span>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <font-awesome-icon :icon="icon_password" class="hand" @click="viewPlainPassword('password')" v-if="user_password.length"/>
                    <input :type="password_type" class="form-control" v-model="user_password" id="user_password" placeholder="Password">
                    <span class="text-danger" v-if="error_password">Repeat password field error</span>
                </div>
                <div class="form-group">
                    <label for="repeat_password">Repeat Password</label>
                    <font-awesome-icon :icon="repeat_icon_password" class="hand" @click="viewPlainPassword('repeat_password')" v-if="repeat_password.length"/>
                    <input :type="repeat_password_type" class="form-control" v-model="repeat_password" id="repeat_password" placeholder="Repeat Password">
                    <span class="text-danger" v-if="error_password">Repeat password field error</span>
                </div>
            </form>
        </div>
        <div slot="footer_buttons">
            <button
                type="button"
                class="btn btn-primary"
                :class="buttonClass"
                @click="createUser"
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
            user: {
                required: false
            }
        },
        data: function() {
            return {
                user_name: '',
                user_email: '',
                user_password: '',
                repeat_password: '',
                error_name: false,
                error_email: false,
                error_password: false,
                sending_request: false,
                password_type: 'password',
                repeat_password_type: 'password',
                icon_password: 'eye',
                repeat_icon_password: 'eye'
            }
        },
        methods:{
            validateUserName(){
                return !(!this.user_name || this.user_name.length < 3);
            },
            validateUserEmail(){
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(this.user_email);
            },
            validatePassword(){
                return !(!this.user_password || this.user_password.length < 3 || this.user_password !== this.repeat_password);
            },
            viewPlainPassword(field){
                if(field === 'password') {
                    if(this.password_type === 'password') {
                        this.password_type = 'text';
                        this.icon_password = 'eye-slash';
                    } else {
                        this.password_type = 'password';
                        this.icon_password = 'eye';
                    }
                } else if(field === 'repeat_password'){
                    console.log('asdasd123')
                    if(this.repeat_password_type === 'password') {
                        this.repeat_password_type = 'text';
                        this.repeat_icon_password = 'eye-slash';
                    } else {
                        this.repeat_password_type = 'password';
                        this.repeat_icon_password = 'eye';
                    }
                }
            },
            cleanModal(){
                this.user_name = '';
                this.user_description = '';
                this.user_password = '';
                this.repeat_password = '';
                this.error_name = false,
                this.error_email = false;
                this.sending_request = false;
                this.$emit('cleanUser');
            },
            closeAddModal(){
                this.cleanModal();
                this.$emit('closeAddEditModal')
            },
            createUser(){
                if(!this.validateUserName()){
                    console.log('Error name');
                    this.error_name = true;
                    return false;
                }

                if(!this.validateUserEmail()){
                    console.log('Error email');
                    this.error_email = true;
                    return false;
                }

                if(!this.validatePassword()){
                    console.log('Error description');
                    this.error_password = true;
                    return false;
                }
                this.sending_request = true;


                let action_type = (this.user && Object.keys(this.user).length) ? 'editUser' : 'createUser';
                window.axios.post('/user/actions', {
                    action_type: action_type,
                    user_name: this.user_name,
                    user_email: this.user_email,
                    user_password: this.user_password,
                    user_id: (this.user && Object.keys(this.user).length) ? this.user.user_id : null
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response.data.has_error);
                        if(response.data.has_error){
                            window.eventsHub.showErrorMsg({message: response.data.error_message});
                        } else {
                            if(action_type === 'createUser') {
                                window.eventsHub.$emit('createdUser',response.data.data.user);
                                window.eventsHub.showSuccessMsg({title: 'User' ,message: response.data.error_message});
                                this.cleanModal();
                                this.$emit('closeAddEditModal');
                            } else {
                                window.eventsHub.$emit('editedUser',response.data.data.user)
                            }
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    });

            }
        },
        watch: {
            user: function(value){
                if(value && Object.keys(value).length) {
                    this.user_name = value.name;
                    this.user_email = value.email;
                }
            },
            user_name: function(value){
                if(value.length){
                    this.error_name = false;
                }
            },
            user_email: function(value){
                if(value.length){
                    this.error_email = false;
                }
            }
        },
        computed: {
            modalTitle: function(){
                return (this.user && Object.keys(this.user).length) ? 'Edit User ' : 'Add New User';
            },
            buttonText: function(){
                return (this.user && Object.keys(this.user).length) ? 'Edit User ' : 'Add User';
            },
            buttonClass: function(){
                return (this.user && Object.keys(this.user).length) ? 'btn-warning' : 'btn-primary';
            }
        }

    }
</script>

<style scoped>

</style>