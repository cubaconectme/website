<template>
    <div>
        <fb-signin-button
                :params="fbSignInParams"
                @success="onSignInSuccess"
                @error="onSignInError"
                class="button button-facebook"
        >
            <font-awesome-icon  :icon="['fab',button_icon]" />
            {{ button_label }}
        </fb-signin-button>
    </div>
</template>
<script>
    export default {
        props: {
            button_label:{
                required: false,
                default: 'Iniciar con Facebook'
            },
            button_icon: {
                required: false,
                default: 'facebook'
            }
        },
        data: () => {
            return {
                fbSignInParams: {
                    scope: 'email,user_likes',
                    return_scopes: true
                }
            }
        },
        methods: {
            onSignInSuccess (response) {
                FB.api('/me', dude => {
                    console.log(`Good to see you, ${dude.name}.`)
                })
            },
            onSignInError (error) {
                console.log('OH NOES', error)
            }
        },
        name: "FacebookLogin"
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

    .button-facebook{
        background: #1d68a7;
        color: white;
    }

    .button-facebook:hover{
        transition: 0.5s;
        background: white;
        color: #1d68a7;
    }
    .fb-signin-button {
        /* This is where you control how the button looks. Be creative! */
        display: inline-block;
        padding: 4px 8px;
        border-radius: 3px;
        background-color: #4267b2;
        color: #fff;
    }
</style>