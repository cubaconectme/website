<template>
    <tr >
        <td>
            {{ product.product_value }}
        </td>
        <td>{{ product.product }}</td>
        <td>
            <em >CUC {{ product.balance }}</em>
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
            <span>USD {{ product.price }}</span>
            <span></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props:{
            product: {
                required: true
            }
        },
        data: () => {
            return {
                show_remove_buttons: false
            }
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
        }
    }
</script>

<style scoped>

</style>