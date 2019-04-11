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
                <div class="products-card col-sm-12" >
                    <div class="input-group">
                        <span class="input-group-addon" v-html="prepend"></span>
                        <vue-autocomplete
                            :custom_class="customClass"
                            :placeholder="product.product_placeholder"
                            :custom_result="true"
                            :isAsync="true"
                            :suggestion="'cardSuggestion'"
                            :source="getSource"
                            :displayKey="'number'"
                            @input="updateData"
                        >
                        </vue-autocomplete>
                    </div>
                </div>
            </div>
            <div class="row button-row">
                <h3><a class="hand card-button" :class="isMouseOver" @click="handleProduct"> Recargar </a></h3>
            </div>
        </div>
    </div>
</template>
<script>
    //TODO: Change Product admin base on this
    export default {
        props: {
            product: {
                required: true
            },
            prepend:{
                required: false,
                default: '+53'
            }
        },
        data: function(){
            return {
                is_mouse_over: false,
                product_value_data: '',
                query: '',
                contact_selected: {}
            }
        },
        methods: {
            updateData(search){
                this.product_value_data = (typeof search.search_value !== 'undefined') ? search.search_value: search;
                this.contact_selected = search.all_object;
                this.$emit('updateContactSelected', this.contact_selected);
            },
            cardSuggestion(result){
                return `<div>
                            Contact: ${result.name}
                        </div>
                        <strong>${result.number}</strong>`;
            },

            handleProduct: function(){
                this.$emit('changeActiveView',{product: this.product, product_value: this.product_value_data,autocomplete_source:this.getSource});
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
            },
            customClass: function(){
                return 'autocomplete-custom-style';
            },
            getSource: function(){
                switch (this.product.name) {
                    case('Cubacel'):
                        return 'recharge/getCubacelContacts';
                    case('Nauta'):
                        return 'recharge/getNautaContacts';
                    case('SMS'):
                        return 'recharge/getSMSContacts';

                }
            }
        },
    }
</script>

<style scoped>
    .autocomplete-custom-style{
        border-radius: 0;
    }
    .button-row{
        margin-top:25px;
    }
    .hand_cursor{
        cursor: pointer;
    }
    .card-button{
        border-radius: 5px;
        padding: 5px 15px;
        color: #138fc2;
        border: solid 1px #138fc2;
    }
    .border_button{
        background-color: #138fc2;
        color: white;
    }
    .number-prefix{
        margin-top: 14px;
    }
    .number-prefix-container{
        vertical-align: middle;
        margin-right: 8px;
    }
</style>