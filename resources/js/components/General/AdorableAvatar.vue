<template>
    <img :src="imageSrc" alt="Image Avatar" :height="size" :width="size" :style="borderRadius" :class="rounded_class">
</template>

<script>
    export default {
        props:{
            url: {
                required: false
            },
            id: {
                required: false
            },
            size: {
                required: false,
                default: 65
            },
            radius: {
                required: false,
                default: 50
            },
            rounded_class: {
                required: false,
                default: 'img-responsive img-circle'
            }
        },
        data: function(){
            return {
                final_url: 0
            }
        },
        computed: {
            imageSrc: function(){
                if(this.url) {
                    return this.url;
                }

                if(this.id){
                    return 'https://api.adorable.io/avatars/64/' + this.id + '.png';
                }

                return 'https://api.adorable.io/avatars/64/'+ Math.random() +'.png';
            },
            borderRadius: function(){
                return 'border-radius: '+ this.radius +'%';
            }
        }
    }
</script>

<style scoped>

</style>