<template>
    <tr >
        <td>
            {{ phone }}
        </td>
        <td>{{ product_value.product }}</td>
        <td>
            <em >{{ product_value.balance }}</em>
        </td>
        <td>
            <a class="btn btn-danger btn-xs" @click="showRemoveButtons" v-if="!show_remove_buttons">Remove</a>
            <div class="action-remove" v-if="show_remove_buttons">
                <button class="btn btn-success btn-xs" @click="removePlanFromOrder">
                    <font-awesome-icon icon="check" />
                </button>
                <button class="btn btn-danger btn-xs" style="padding:1px 8px;" @click="cancelRemoveButton">
                    <font-awesome-icon icon="times" />
                </button>
            </div>
        </td>
        <td >
            <span class="fa fa-tags ng-scope" ></span>
            <span>{{ product_value.price }} USD</span>
            <span></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props:{
            product: {
                required: true
            },
            phone: {
                required: false,
                default: ''
            }
        },
        data: function(){
            return {
                show_remove_buttons: false,
                phone_number: this.product.product_value,
                product_value: {}
            }
        },
        created(){
            this.product_value = this.product;
        },
        mounted () {
            //this.props.forceUpdate = true;
        },
        methods: {
            showRemoveButtons(){
                this.show_remove_buttons = true;
            },
            cancelRemoveButton(){
                this.show_remove_buttons = false;
            },
            removePlanFromOrder(){
                window.eventsHub.$emit('removePlanFromOrder', this.product);
            }
        },
        watch:{
            product: function(value){
                //this.product_value = value;
                this.phone_number = value.product_value;
            }
        }
    }
</script>

<style scoped>

</style>