<template>
    <div id="front_component_template">
        <pre_loader />
        <front_nav_bar :app_name="app_name" :user="user_logged" />
        <principal_section v-if="!user_logged || active_principal"/>
        <front_content
            :products="products"
            :user="user_logged"
            :recharges_prop="recharges"
            :contacts_prop ="contacts"
            :planes_cubacel_prop="planes_cubacel"
            :planes_nauta_prop="planes_nauta"
        />
        <front_footer />
    </div>
</template>

<script>
    import PreLoader from './PreLoader'
    import FrontNavBar from './FrontNavBar'
    import PrincipalSection from './PrincipalSection'
    import FrontContent from './FrontContent/FrontContent'
    import FrontFooter from './FrontFooter'
    export default {
        components: {
          'pre_loader': PreLoader,
          'front_nav_bar': FrontNavBar,
          'principal_section': PrincipalSection,
          'front_content': FrontContent,
          'front_footer': FrontFooter,
        },
        props:{
            app_name:{
                required: false,
                default: 'Recargas'
            },
            products:{
                required: true,
            },
            user:{
                required: false
            },
            recharges: {
                required: false
            },
            contacts: {
                required: false
            },
            planes_cubacel: {
                required: false
            },
            planes_nauta: {
                required: false
            }
        },
        data: () =>{
            return {
                user_logged: {},
                active_principal: false
            }
        },
        created:function(){
            window.eventsHub.$on('userLogged', data => this.userLogged(data));
            window.eventsHub.$on('showPrincipalView',status => this.active_principal = status);
            this.initUserLogged();
        },
        methods: {
            initUserLogged(){
              this.user_logged = this.user;
            },
            userLogged(data){
                this.user_logged = data.user;
            }
        },
        watch: {
            user: function(value){
                this.user_logged = value;
            }
        }
    }
</script>

<style scoped lang="sass">
    @import '~pretty-checkbox/src/pretty-checkbox.scss'
</style>