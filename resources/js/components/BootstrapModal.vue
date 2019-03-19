<template>
    <div class="modal fade" >
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <slot name="modal_title">Modal title</slot>
                    </h5>
                    <button type="button" class="close" aria-label="Close" @click="handleClose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="modal_body"></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="handleClose">Close</button>
                    <slot name="footer_buttons"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            open: {
                required: false,
                default: false
            }
        },
        methods: {
            handleClose(){
                this.$emit('close');
            }
        },
        watch:{
            open: function(value){
                if(value){
                    $(this.$el).modal('show');
                } else {
                    $(this.$el).modal('hide');
                }
            }
        }
    }
</script>

<style scoped>

</style>