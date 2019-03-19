import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import PrettyInput from 'pretty-checkbox-vue/input';
import PrettyCheck from 'pretty-checkbox-vue/check';
import PrettyRadio from 'pretty-checkbox-vue/radio';



require('./bootstrap');

window.Vue = require('vue');


library.add(fas);
library.add(fab);

/**
 * Vue Notifications
 */

import VueNotifications from 'vue-notifications'
import iziToast from 'izitoast'// https://github.com/dolce/iziToast
import 'izitoast/dist/css/iziToast.min.css'


function toast ({title, message, type, timeout, position, transitionIn, transitionOut, cb}) {
    if (type === VueNotifications.types.warn) type = 'warning';
    return iziToast[type]({title, message, timeout, position, transitionIn, transitionOut})
}

const options = {
    success: toast,
    error: toast,
    info: toast,
    warn: toast
};

Vue.use(VueNotifications, options);

import FBSignInButton from 'vue-facebook-signin-button'
Vue.use(FBSignInButton);

import GSignInButton from 'vue-google-signin-button'
Vue.use(GSignInButton);


window.eventsHub = new Vue({
    notifications: {
        showSuccessMsg: {
            type: VueNotifications.types.success,
            title: 'Hello there',
            message: 'That\'s the success!',
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX'
        },
        showInfoMsg: {
            type: VueNotifications.types.info,
            title: 'Hey you',
            message: 'Here is some info for you',
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX'
        },
        showWarnMsg: {
            type: VueNotifications.types.warn,
            title: 'Wow, man',
            message: 'That\'s the kind of warning',
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX'
        },
        showErrorMsg: {
            type: VueNotifications.types.error,
            title: 'Wow-wow',
            message: 'That\'s the error',
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX'
        }
    }
});



Vue.component('font-awesome-icon',FontAwesomeIcon);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('p-input', PrettyInput);
Vue.component('p-check', PrettyCheck);
Vue.component('p-radio', PrettyRadio);




// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('nav-bar-admin', require('./components/NavBarAdmin.vue').default);
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('body-content', require('./components/BodyContent.vue').default);
Vue.component('body-content-admin', require('./components/BodyContentAdmin.vue').default);
Vue.component('option-card', require('./components/OptionCard').default);
Vue.component('nav-bar-dropdown', require('./components/NavBarDropdown.vue').default);
Vue.component('side-bar', require('./components/SidebarDashBoard.vue').default);
Vue.component('breadcrumbs', require('./components/BreadCrumbs.vue').default);
Vue.component('loading_request', require('./components/LoadingRequest.vue').default);
Vue.component('admin_dashboard', require('./components/AdminDashboard.vue').default);
Vue.component('users_admin', require('./components/User/UsersAdmin.vue').default);
Vue.component('user_line', require('./components/User/UserLine.vue').default);
Vue.component('products_admin', require('./components/Products/ProductsAdmin.vue').default);
Vue.component('products_line', require('./components/Products/ProductLine.vue').default);
Vue.component('bootstrap_modal', require('./components/BootstrapModal.vue').default);
Vue.component('add_edit_product_modal', require('./components/Products/AddEditProductModal.vue').default);
Vue.component('delete_product_modal', require('./components/Products/DeleteProductModal.vue').default);

Vue.component('plan_admin', require('./components/Planes/PlanesAdmin.vue').default);
Vue.component('plan_line', require('./components/Planes/PlanLine.vue').default);
Vue.component('add_edit_plan_modal', require('./components/Planes/AddEditPlanModal.vue').default);
Vue.component('delete_plan_modal', require('./components/Planes/DeletePlanModal.vue').default);

Vue.component('promotion_admin', require('./components/Promotions/PromotionAdmin.vue').default);
Vue.component('promotion_line', require('./components/Promotions/PromotionLine.vue').default);
Vue.component('add_edit_promotion_modal', require('./components/Promotions/AddEditPromotionModal.vue').default);
Vue.component('delete_promotion_modal', require('./components/Promotions/DeletePromotionModal.vue').default);
Vue.component('adorable_avatar', require('./components/General/AdorableAvatar.vue').default);
/**
 * Front End Part
 */
Vue.component('front_dashboard', require('./components/Front/FrontDashboard.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    data: {
        token_csrf:window.axios.defaults.headers.common['X-CSRF-TOKEN']
    },
    created: function() {
        console.log('Mounted Vue');
    }
});
