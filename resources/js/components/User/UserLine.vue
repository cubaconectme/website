<template>
    <tr :class="isDeleted">
        <th scope="row">{{ user_data.user_id }}</th>
        <td>{{ user_data.name }}</td>
        <td>{{ user_data.email }}</td>
        <td><a class="badge badge-info hand view-roles" @click="showUserRolesModal">View</a></td>
        <td>
            <SwitchButton v-model="notificationValue" @handleChangeState="handleNotification" />
        </td>
        <td>
            <adorable_avatar :size="42"  :radius="50" :url="user_data.image"/>
        </td>
        <td>
            <div>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm" @click="handleDeleteUser">{{ deleteButtonText }}</button>
            </div>
        </td>
    </tr>
</template>
<script>
    import SwitchButton from '../General/SwitchButton';

    export default {
        components:{SwitchButton},
        props:{
            user: {
                required: true,
            }
        },
        data: function(){
            return {
                user_data: this.user,
                undeleting_text:  false
            }
        },
        methods: {
            handleDeleteUser: function(){
                if(this.user.deleted){
                    this.handleUnDelete();
                } else {
                    this.$emit('showDeleteModal',this.user);
                }
            },
            handleUnDelete: function(){
                this.undeleting_text = true
                window.axios.post('user/actions', {
                    user_id: this.user.user_id,
                    action_type: 'unDeleteUser'
                })
                    .then( (response) => {
                        if(response.data.has_error) {
                            window.eventsHub.showErrorMsg({
                                title: 'UnDelete',
                                message: 'Error doing undelete to this user!'
                            });
                        } else {
                            window.eventsHub.showSuccessMsg({
                                title: 'UnDelete',
                                message: 'User was un deleted!'
                            });
                            window.eventsHub.$emit('unDeletedUser',response.data.data.user);
                        }
                        this.undeleting_text = false;
                    })
                    .catch( (error) => {
                        console.log(error);
                    })
            },
            handleNotification: function(val){
                window.axios.post('user/actions', {
                    notification: val,
                    user: this.user_data.user_id,
                    action_type: 'updateUserNotification'
                })
                    .then( (response) => {
                        if(response.data.data.has_error) {
                            console.log(response.data.data.error_message);
                        } else {
                            this.user_data.notification = val;
                            console.log('test notification');
                            window.eventsHub.showSuccessMsg({
                                title: 'Notification',
                                message: 'Status Notification was changed!'
                            });
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    })
            },
            showUserRolesModal: function(){
                this.$emit('showUserRoles', this.user);
            }
        },
        computed: {
            notificationValue: function(){
                return (this.user_data.notification);
            },
            imageSrc: function(){
                return this.user_data.image;
            },
            isDeleted: function(){
                return (this.user.deleted) ? 'table-danger' : ''
            },
            deleteButtonText: function(){
               return (this.user.deleted) ? 'UnDelete' : 'Delete'
            }
        },
        watch: {
            user: function(value){
                this.user_data = value;
            }
        }
    }
</script>

<style>
    .view-roles, .view-roles:visited, .view-roles:hover  {
        color: white !important;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
</style>