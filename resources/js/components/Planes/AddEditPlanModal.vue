<template>
    <bootstrap_modal :open="show_modal" @close="closeAddModal">
        <div slot="modal_title">{{ modalTitle }}</div>
        <div slot="modal_body">
            <form>
                <div class="form-group">
                    <label for="plan_name">Plan Name</label>
                    <input type="text" class="form-control" v-model="plan_name" id="plan_name" placeholder="Plan Name">
                    <span class="text-danger" v-if="error_name">The plan name is required</span>
                </div>
                <div class="form-group">
                    <label for="product">Product</label>
                    <select v-model="product_id" id="product" class="form-control">
                        <option disabled value="">Please select one</option>
                        <option v-for="(product,index) in products"  :value="index">{{ product }}</option>
                    </select>
                    <span class="text-danger" v-if="error_name">The plan name is required</span>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" v-model="price" id="price" placeholder="$0.00">
                    <span class="text-danger" v-if="error_name">The plan price is required</span>
                </div>
                <div class="form-group">
                    <label for="price">Balance</label>
                    <input type="text" class="form-control" v-model="balance" id="balance" placeholder="$0.00">
                    <span class="text-danger" v-if="error_balance">The plan balance is required</span>
                </div>
                <div class="form-group">
                    <label for="plan_description">Plan Description</label>
                    <textarea class="form-control" v-model="plan_description" id="plan_description" rows="3"></textarea>
                    <span class="text-danger" v-if="error_description">The plan description is required</span>

                </div>
            </form>
        </div>
        <div slot="footer_buttons">
            <button
                type="button"
                class="btn btn-primary"
                :class="buttonClass"
                @click="createPlan"
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
            plan: {
                required: false
            },
            products:{
                required: true
            }
        },
        data: function() {
            return {
                plan_name: '',
                plan_description: '',
                product_id: 0,
                price: '',
                balance: '',
                error_name: false,
                error_description: false,
                error_balance: false,
                sending_request: false,
            }
        },
        methods:{
            cleanModal(){
                this.plan_name = '';
                this.plan_description = '';
                this.product_id = 0;
                this.price = '';
                this.error_name = false,
                this.error_description = false;
                this.sending_request = false;
                this.$emit('cleanPlan');
            },
            closeAddModal(){
                this.cleanModal();
                this.$emit('closeAddEditModal')
            },
            createPlan(){
                console.log('creating plan');
                if(!this.plan_name){
                    console.log('Error name');
                    this.error_name = true;
                    return false;
                }

                if(!this.plan_description){
                    console.log('Error description');
                    this.error_description = true;
                    return false;
                }
                this.sending_request = true;
                let action_type = (Object.keys(this.plan).length) ? 'editPlan' : 'createPlan';
                window.axios.post('/planes/actions', {
                    action_type: action_type,
                    plan_name: this.plan_name,
                    plan_description: this.plan_description,
                    product_id: this.product_id,
                    price: this.price,
                    balance: this.balance,
                    plan_id: this.plan.plan_id
                })
                    .then( (response) => {
                        this.sending_request = false;
                        console.log(response);
                        if(response.has_error){
                            console.log(response);
                        } else {
                            if(action_type === 'createPlan') {
                                window.eventsHub.$emit('createdPlan',response.data.data.plan)
                            } else {
                                window.eventsHub.$emit('editedPlan',response.data.data.plan)
                            }
                        }
                    })
                    .catch( (error) => {
                        console.log(error);
                    });

            }
        },
        watch: {
            plan: function(value){
                if(value && Object.keys(value).length) {
                    console.log(this.plan);
                    this.plan_name = value.name;
                    this.plan_description = value.description;
                    this.price = value.price;
                    this.product_id = value.product_id
                }
            },
            plan_name: function(value){
                if(value.length){
                    this.error_name = false;
                }
            },
            plan_description: function(value){
                if(value.length){
                    this.error_description = false;
                }
            }
        },
        computed: {
            modalTitle: function(){
                return (Object.keys(this.plan).length) ? 'Edit Plan ' : 'Add New Plan';
            },
            buttonText: function(){
                return (Object.keys(this.plan).length) ? 'Edit Plan ' : 'Add Plan';
            },
            buttonClass: function(){
                return (Object.keys(this.plan).length) ? 'btn-warning' : 'btn-primary';
            }
        }

    }
</script>

<style scoped>

</style>