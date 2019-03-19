<template>
    <div class="table">
        <div class="alert alert-info" v-if="!products.length">No hay productos en su Orden!!!</div>
        <table class="table table-condensed"  v-else>
            <thead>
            <tr class="dn-mobile-hide">
                <th>Número de Teléfono</th>
                <th>Operator</th>
                <th>Receive amount</th>
                <th></th>
                <th class="dn-align-right">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr is="order-review-line" v-for="product in products" :key="product.plan_id" :product="product"></tr>
            <tr>
                <td colspan="4" class="text-right">
                    <strong>
                        Total:
                    </strong>
                </td>
                <td>
                    <strong>
                        $ {{ total_amount }}
                    </strong>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import OrderReviewLine from './OrderReviewLine'
    export default {
        components:{
            'order-review-line': OrderReviewLine
        },
        props:{
            products: {
                required: true
            },
            total_amount:{
                required: false,
                default: '0'
            }
        },
        data: ()=>{
            return {}
        },
        methods: {},

    }
</script>

<style scoped>

</style>