<template>
    <div>
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  v-if="user.id">
            <adorable_avatar :size="42"  :radius="50" :id="user.id"/>
        </a>
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-else>
            {{ user.name }}
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
            </div>
            <div class="clearfix"></div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                </div>
                <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-medium text-dark" style="display: inline-block">
                        Profile
                        <small class="font-weight-light small-text">
                            Edit your profile
                        </small>
                    </h6>

                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" >
                <div class="preview-thumbnail">
                </div>
                <div class="preview-item-content flex-grow" v-if="isAdmin">
                    <h6 class="preview-subject ellipsis font-weight-medium text-dark" @click.prevent="openAdminDashboard"> Admin Dashboard
                    </h6>
                </div>
            </a>
            <a class="dropdown-item" href="/logout" @click.prevent="proceedLogOut">
                Logout
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" id="csrf-token" :value="token_csrf" />
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                required:false
            },
            roles: {
                required: false
            },
            token_csrf: {
                required: false
            }
        },
        computed: {
            isAdmin: function(){
                let is_admin = false;
                this.roles.forEach((rol) => {
                    if(rol.rol === 'admin') {
                        is_admin = true;
                    }
                });
                return is_admin;
            }
        },
        methods: {
            proceedLogOut(){
               let form = document.querySelector('#logout-form');
               form.submit();
            },
            openAdminDashboard(){
                window.location.href = '/admin';
            }
        }
    }
</script>

<style scoped>

</style>