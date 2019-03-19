<template>
    <div class="table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Notification</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr
                is="user_line"
                v-for="user in users"
                :user="user"
                :key="user.user_id"
                @showUserRoles="showUserRolModal"
                @showDeleteModal="showDeleteModal"
            >

            </tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary" @click="handleShowAddEditModal">Add user</button>
        </div>
        <user-rol-modal
            :user="user_rol"
            :roles="roles"
            :show_modal="show_user_rol_modal"
            @closeModal="handleCloseRolModal"
            @rolUpdate="updateRol"
        />
        <add_edit_user_modal
            :show_modal="show_add_edit_modal"
            @closeAddEditModal="handleCloseAddEditModal"
            :user_edit="user_edit"
            @cleanUser="resetUser"
        ></add_edit_user_modal>
        <delete_user_modal
                :show_modal="show_delete_modal"
                @closeUserDeleteModal="handleDeleteCloseModal"
                :user="user_edit"
        ></delete_user_modal>
    </div>
</template>
<script>
    import UserRol from './UserRolModal'
    import AddEditUser from './AddEditUserModal'
    import DeleteUser from './DeleteUserModal'

    Vue.component('user-rol-modal',UserRol);
    Vue.component('delete_user_modal',DeleteUser);
    export default {
        components:{
            'add_edit_user_modal': AddEditUser
        },
        props: {
            users: {
                required: true
            },
            roles: {
                required:true
            }
        },
        data: function(){
            return {
                user_rol: {},
                show_user_rol_modal: false,
                show_add_edit_modal: false,
                show_delete_modal: false,
                user_edit: {}
            }
        },
        methods:{
            showDeleteModal(user){
                this.user_edit = user;
                this.show_delete_modal = true;
            },
            handleDeleteCloseModal() {
                this.show_delete_modal = false;
            },
            resetUser(){
                this.user_edit = {};
            },
            handleCloseAddEditModal: function(){
                this.show_add_edit_modal = false;
            },
            handleShowAddEditModal: function(){
                this.show_add_edit_modal = true
            },
            updateRol: function(user){
                this.$emit('updateRolesUser', user);
                this.show_user_rol_modal = false;
            },
            showUserRolModal: function(user){
                this.user_rol = user;
                this.show_user_rol_modal = true;
            },
            handleCloseRolModal: function(){
                this.user_rol = {};
                this.show_user_rol_modal = false;
            }
        }
    }
</script>

<style scoped>

</style>