<template>
    <tr>
        <th scope="row">{{ product.product_id }}</th>
        <td>{{ product.name }}</td>
        <td>{{ product.description }}</td>
        <td>{{ product.image_url }}</td>
        <td>{{ product.product_placeholder }}</td>
        <td>
            <div>
                <button class="btn btn-warning btn-sm" @click="handleEdit">Edit</button>
                <button class="btn btn-danger btn-sm" @click="handleDelete">Delete</button>
            </div>
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
        methods: {
            handleDelete(){
                window.eventsHub.$emit('deleteProduct', this.product);
            },
            handleEdit(){
                window.eventsHub.$emit('editProduct', this.product);
            }
        }
    }
</script>

<style scoped>

</style>