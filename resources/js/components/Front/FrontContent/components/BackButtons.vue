<template>
    <div class="row">
        <a class="cursor_hand" @click="goBackToCards">
            <font-awesome-icon icon="arrow-left" class="fa-2x" />
        </a>
    </div>
</template>

<script>
    export default {
        methods: {
            goBackToCards(){
                this.$emit('goBackToCards');
            }
        }
    }
</script>

<style scoped>
    .cursor_hand{
        cursor:pointer;
    }
</style>