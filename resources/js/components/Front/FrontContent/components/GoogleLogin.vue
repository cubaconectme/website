<template>
    <g-signin-button
            :params="googleSignInParams"
            @success="onSignInSuccess"
            @error="onSignInError"
            class="button button-google"
    >
        <font-awesome-icon  :icon="['fab',button_icon]" />
        {{ button_label }}
    </g-signin-button>
</template>

<script>
    export default {
        props: {
            button_label:{
                required: false,
                default: 'Iniciar con Google'
            },
            button_icon: {
                required: false,
                default: 'google'
            }
        },
        data(){
            return {
                /**
                 * The Auth2 parameters, as seen on
                 * https://developers.google.com/identity/sign-in/web/reference#gapiauth2initparams.
                 * As the very least, a valid client_id must present.
                 * @type {Object}
                 */
                googleSignInParams: {
                    client_id: '385644307479-153ubll82ck2uhk57vf7ng0cq5lflrld.apps.googleusercontent.com'
                }
            }
        },

        methods: {
            onSignInSuccess (googleUser) {
                // `googleUser` is the GoogleUser object that represents the just-signed-in user.
                // See https://developers.google.com/identity/sign-in/web/reference#users
                const profile = googleUser.getBasicProfile() // etc etc
            },
            onSignInError (error) {
                // `error` contains any error occurred.
                console.log('OH NOES', error)
            }
        },
        name: "GoogleLogin"
    }
</script>

<style scoped>
    .button {
        border-radius: 0;
    }

    .button[disabled="disabled"], .button[disabled="true"]{
        cursor: no-drop;
        background-color: #ceced6;
    }

    .button-google{
        background: #a42d11;
        color: white;
    }

    .button-facebook:hover{
        transition: 0.5s;
        background: white;
        color: #a42d11;
    }
</style>