<template>
    <div class="text-right">
        <input :type="type" class="form-control input-style" v-model="edit_value" :class="class_input" >
        <button class="button button-xs" @click.prevent="saveEdit">Save</button>
        <button class="button button-xs button-danger" @click.prevent="cancelEdit">Cancel</button>
    </div>
</template>

<script>
    export default {
        props: {
            type: {
                required: false,
                default:'text'
            },
            source: {
                required: true
            },
            attribute:{
                required: true
            },
            class_input: {
                required: false,
                default: ''
            },
            entity_id:{
                required: true
            }
        },
        data: function(){
            return {
                edit_value: ''
            }
        },
        methods: {
            saveEdit(){
                window.axios.post(this.source,{
                    attribute: this.attribute,
                    value: this.edit_value,
                    entity_id: this.entity_id
                })
                    .then(response => {
                        if(response.data.has_error){
                            window.eventsHub.showErrorMsg({message: response.data.error_message});
                        } else {
                            this.$emit('successEdit',response.data.data.contact);
                            window.eventsHub.showSuccessMsg({message: response.data.error_message});
                        }
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            cancelEdit(){
                this.$emit('cancelEdit');
            }
        },
        name: "VueEdit"
    }
</script>

<style scoped>
    .button {
        border-radius: 0;
        background-color: #138fc2;
    }

    .button[disabled="disabled"], .button[disabled="true"]{
        cursor: no-drop;
        background-color: #ceced6;
    }

    .button-xs{
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.5;
    }

    .button-danger{
        background-color: #a42d11;
    }

    .input-style{
        margin-bottom: 0;
    }
</style>