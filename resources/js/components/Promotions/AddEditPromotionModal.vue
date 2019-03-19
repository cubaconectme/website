<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">{{ modalTitle }}</div>
        <div slot="modal_body">
            <form>
                <div class="form-group">
                    <label for="promotion_name">Promotion Name</label>
                    <input type="text" class="form-control" v-model="promotion_name" id="promotion_name" placeholder="Promotion Name">
                    <span class="text-danger" v-if="error_name">The Promotion name is required</span>
                </div>
                <div class="form-group">
                    <label for="product">Plan</label>
                    <select v-model="plan_id" id="product" class="form-control">
                        <option disabled value="">Please select one</option>
                        <option v-for="(plan,index) in planes"  :value="index">{{ plan }}</option>
                    </select>
                    <span class="text-danger" v-if="error_name">The plan name is required</span>
                </div>
                <div class="form-group">
                    <label for="promotion_description">Promotion Description</label>
                    <textarea class="form-control" v-model="promotion_description" id="promotion_description" rows="3"></textarea>
                    <span class="text-danger" v-if="error_description">The Promotion description is required</span>

                </div>
            </form>
        </div>
        <div slot="footer_buttons">
            <button
                type="button"
                class="btn btn-primary"
                :class="buttonClass"
                @click="createPromotion"
                :disabled="sending_request"
            >
                {{ buttonText }}
            </button>
        </div>
    </bootstrap_modal>
</template>

<script>
    export default {
        props:{
            show_modal: false,
            promotion: {
                required: false
            },
            planes:{
                required: true
            }
        },
        data: function() {
            return {
                promotion_name: '',
                promotion_description: '',
                plan_id: 0,
                error_name: false,
                error_description: false,
                sending_request: false,
            }
        },
        methods:{
            cleanModal(){
                this.promotion_name = '';
                this.promotion_description = '';
                this.plan_id = 0;
                this.error_name = false,
                this.error_description = false;
                this.sending_request = false;
                this.$emit('cleanPromotion');
            },
            closeAddModal(){
                this.cleanModal();
                this.$emit('closeAddEditModal')
            },
            createPromotion(){
                console.log('creating promotion');
                if(!this.promotion_name){
                    console.log('Error name');
                    this.error_name = true;
                    return false;
                }

                if(!this.promotion_description){
                    console.log('Error description');
                    this.error_description = true;
                    return false;
                }
                this.sending_request = true;
                let action_type = (Object.keys(this.promotion).length) ? 'editPromotion' : 'createPromotion';
                window.axios.post('/promotion/actions', {
                    action_type: action_type,
                    promotion_name: this.promotion_name,
                    promotion_description: this.promotion_description,
                    plan_id: this.plan_id,
                    promotion_id: this.promotion.promotion_id
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            if(action_type === 'createPromotion') {
                                window.eventsHub.$emit('createdPromotion',response.data.data.promotion)
                            } else {
                                window.eventsHub.$emit('editedPromotion',response.data.data.promotion)
                            }
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    });

            }
        },
        watch: {
            promotion: function(value){
                if(value && Object.keys(value).length) {
                    console.log(this.promotion);
                    this.promotion_name = value.name;
                    this.promotion_description = value.description;
                    this.plan_id = value.plan_id
                }
            },
            promotion_name: function(value){
                if(value.length){
                    this.error_name = false;
                }
            },
            promotion_description: function(value){
                if(value.length){
                    this.error_description = false;
                }
            }
        },
        computed: {
            modalTitle: function(){
                return (Object.keys(this.promotion).length) ? 'Edit Promotion ' : 'Add New Promotion';
            },
            buttonText: function(){
                return (Object.keys(this.promotion).length) ? 'Edit Promotion ' : 'Add Promotion';
            },
            buttonClass: function(){
                return (Object.keys(this.promotion).length) ? 'btn-warning' : 'btn-primary';
            }
        }

    }
</script>

<style scoped>

</style>