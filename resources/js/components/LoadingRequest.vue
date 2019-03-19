<template>
    <div class="loading_request align-center" style="display: block; text-align:center;">
        <font-awesome-icon icon="spinner" class="fa-spin" :class="iconSize" />
        <br />
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props:{
            size: {
                required: false,
                default: '3x'
            }
        },
        computed: {
            iconSize:function() {
                return 'fa-'+ this.size.trim();
            }
        }
    }
</script>

<style scoped>

</style>