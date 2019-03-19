<template>
    <div class="col-xs-12 col-sm-4 hand_cursor" @mouseenter="handleMouseEnter" @mouseleave="handleMouseOut">
        <div class="box">
            <div class="box-icon" style="margin-bottom: 95px;">
                <img :src="product.image_url" alt="" @click="handleProduct">
            </div>
            <div class="clearfix"></div>
            <h4 @click="handleProduct">{{ product.name }}</h4>
            <p @click="handleProduct">{{ product.description }}</p>
            <slot name="input"></slot>
            <div class="row text-center">
                <div class="col-sm-1 number-prefix-container" v-if="product.name !== 'Nauta'">
                    <h4 class="text-muted number-prefix"> +53</h4>
                </div>
                <div :class="(product.name === 'Nauta') ? 'col-sm-12': 'col-sm-10'">
                    <input type="text" id="product_name" name="product_name" v-model="product_value_data" :placeholder="product.product_placeholder" class="form-control" >
                </div>
            </div>
            <h3><a class="hand card-button" :class="isMouseOver" @click="handleProduct"> Recargar </a></h3>
        </div>
    </div>
</template>

<script>
    //TODO: Change Product admin base on this
    //front/images/undraw_calling_kpbp.svg
    export default {
        props: {
            product: {
                required: true
            },
        },
        data: function(){
            return {
                is_mouse_over: false,
                product_value_data: ''
            }
        },
        methods: {
            handleProduct: function(){
                this.$emit('changeActiveView',{product: this.product, product_value: this.product_value_data});
            },
            handleMouseEnter: function(){
                this.is_mouse_over = true;
            },
            handleMouseOut: function(){
                this.is_mouse_over = false;
            }
        },
        computed: {
            isMouseOver:function(){
                if(this.is_mouse_over){
                    return 'border_button'
                }
                return '';
            }
        },
    }
</script>

<style scoped>
    .hand_cursor{
        cursor: pointer;
    }
    .card-button{
        border-radius: 5px;
        padding: 5px 15px;
    }
    .border_button{
        border: solid 1px #06cec4;
    }
    .number-prefix{
        margin-top: 14px;
    }
    .number-prefix-container{
        vertical-align: middle;
        margin-right: 8px;
    }
</style>