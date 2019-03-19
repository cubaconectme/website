<template>
    <tr>
        <th scope="row">{{ promotion.promotion_id }}</th>
        <td>{{ promotion.name }}</td>
        <td>{{ promotion.description }}</td>
        <td>{{ promotion.status }}</td>
        <td>{{ promotion.plan }}</td>
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
            promotion: {
                required: true
            }
        },
        methods: {
            handleDelete(){
                window.eventsHub.$emit('deletePromotion', this.promotion);
            },
            handleEdit(){
                window.eventsHub.$emit('editPromotion', this.promotion);
            }
        }
    }
</script>

<style scoped>

</style>