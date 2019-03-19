<template>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="items">
            <h1 class="h3 mb-0 text-gray-800" >
                <span v-for="(list,index) in list_menu" :key="list.order">
                    <a :href="list.link" v-if="index+1 < list_menu.length">{{ list.label }}</a>
                    <span v-else>{{ list.label }}</span>

                    <span v-if="index+1 < list_menu.length"> \ </span>
                </span>

            </h1>
        </div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>
</template>
<script>
    export default {
        props: {
            list_menu:{
                required:true,
            }
        },
        data: function(){
            return {
            }
        },
        mounted() {
            console.log('BreadCrumbs mounted.')
        }
    }
</script>

<style>

</style>
