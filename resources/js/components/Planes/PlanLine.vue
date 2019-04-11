<template>
    <tr>
        <th scope="row">{{ plan.plan_id }}</th>
        <td>{{ plan.name }}</td>
        <td>{{ plan.description }}</td>
        <td>{{ plan.price }}</td>
        <td>{{ plan.balance }}</td>
        <td>{{ plan.product }}</td>
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
            plan: {
                required: true
            }
        },
        methods: {
            handleDelete(){
                window.eventsHub.$emit('deletePlan', this.plan);
            },
            handleEdit(){
                window.eventsHub.$emit('editPlan', this.plan);
            }
        }
    }
</script>

<style scoped>

</style>