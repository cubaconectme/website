<template>
    <div class="grid-margin stretch-card" :class="class_size_card">
        <div class="card card-statistics" :class="shadow_level_card">
            <div class="card-body principal-options">
                <slot name="card-content">
                </slot>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            class_size: {
                required: false,
                default: 'col-xl-3 col-lg-3 col-md-3 col-sm-6'
            },
            shadow_level: {
                required: false,
                default: 'shadow-1'
            }
        },
        data: function(){
            return {
                class_size_card: this.class_size,
                shadow_level_card: this.shadow_level
            }
        }
    }
</script>

<style>
    .principal-options{
        cursor: pointer
    }
    .principal-options:hover {
        box-shadow: 3px 4px #d4d4cd;
        transition-duration: 15ms;
    }
</style>