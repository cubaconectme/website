<template>
    <div class="autocomplete">
        <input
                type="text"
                @input="onChange"
                v-model="search"
                @keydown.down="onArrowDown"
                @keydown.up="onArrowUp"
                @keydown.enter="onEnter"
                class="form-control"
                :class="custom_class"
                :placeholder="placeholder"

        />
        <ul
                id="autocomplete-results"
                v-show="isOpen"
                class="autocomplete-results"
        >
            <li
                    class="loading autocomplete-result"
                    v-if="isLoading"
            >
                Loading results...
            </li>
            <li v-else v-for="(result, i) in results" :key="i" @click="setResult(result)"  class="autocomplete-result">
                <div v-if="!suggestion">
                    <span>
                        <strong>{{(!displayKey) ? result : result[displayKey]  }}</strong>
                    </span>
                </div>
                <div v-else>
                    <div v-html="createSuggestion(result)" ></div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'autocomplete',
        props: {
            items: {
                type: Array,
                required: false,
                default: () => [],
            },
            limit: {
                required: false,
                default: 5
            },
            isAsync: {
                type: Boolean,
                required: false,
                default: false,
            },
            custom_class:{
                required: false,
                default: ''
            },
            placeholder:{
                required: false,
                default: ''
            },
            custom_result:{
                required:false
            },
            suggestion: {
                required: false,
                default: ''
            },
            displayKey: {
                type: [String, Array],
                required: false,
                default: ''
            },
            source: {
                required: false,
                default: ''
            },
            complete_value:{
                required: false,
                default:''
            },
        },
        data() {
            return {
                isOpen: false,
                results: [],
                search: this.complete_value,
                isLoading: false,
                arrowCounter: 0,
            };
        },

        methods: {
            onChange() {
                // Let's warn the parent that a change was made
                this.$emit('input', this.search);

                // Is the data given by an outside ajax request?
                if (this.isAsync) {
                    if(this.search.length > 3) {
                        this.isLoading = true;
                        this.isOpen = true;
                        this.searchResult();
                    }
                } else {
                    // Let's  our flat array
                    this.filterResults();
                    this.isOpen = true;
                }
            },
            searchResult(){
                console.log('search');
                window.axios.get(this.source + '/' + this.search + '/' + this.limit,{
                })
                    .then( response => {
                        if(response.data.has_error){
                            window.events.showErrorMsg({message:'Server Error!'});
                        } else {
                            this.results = response.data.result;
                            this.isLoading = false;
                        }
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            filterResults() {
                // first uncapitalize all the things
                this.results = this.items.filter((item) => {
                    return item.toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                });
            },
            setResult(result) {
                this.search = (typeof this.displayKey !== 'undefined') ? result[this.displayKey] : result;
                this.isOpen = false;
                this.$emit('input', {search_value: this.search, all_object: result});
            },
            onArrowDown(evt) {
                if (this.arrowCounter < this.results.length) {
                    this.arrowCounter = this.arrowCounter + 1;
                }
            },
            onArrowUp() {
                if (this.arrowCounter > 0) {
                    this.arrowCounter = this.arrowCounter -1;
                }
            },
            onEnter() {
                this.search = this.results[this.arrowCounter];
                this.isOpen = false;
                this.arrowCounter = -1;
            },
            handleClickOutside(evt) {
                if (!this.$el.contains(evt.target)) {
                    this.isOpen = false;
                    this.arrowCounter = -1;
                }
            },
            createSuggestion(result){
                return this.$parent.$options.methods[this.suggestion](result,this.source);
            }
        },
        watch: {
            items: function (val, oldValue) {
                // actually compare them
                if (val.length !== oldValue.length) {
                    this.results = val;
                    this.isLoading = false;
                }
            },
            complete_value: function(value){
                this.search = value
            }
        },
        mounted() {
            document.addEventListener('click', this.handleClickOutside)
        },
        destroyed() {
            document.removeEventListener('click', this.handleClickOutside)
        }
    };
</script>


<style>
    .autocomplete-custom-style{
        border-radius:0 !important;
        border-top-right-radius: 4px !important;
        border-bottom-right-radius: 4px !important;
    }
    .autocomplete {
        position: relative;
    }

    .autocomplete-results {
        padding: 0;
        margin: 0;
        height: 100%;
        min-height: 200px;
        overflow: auto;
        width: 100%;
        position: absolute;
        z-index: 10;
        top:50px;
    }

    .autocomplete-result {
        list-style: none;
        text-align: left;
        padding: 4px 2px;
        cursor: pointer;
        border: 1px solid #eeeeee;
        background-color: white;
        border-top: none;
    }

    .autocomplete-result.is-active,
    .autocomplete-result:hover {
        background-color: #138fc2;
        color: white;
    }
    #autocomplete-results > li:last-child{
        border-bottom-right-radius: 3px !important;
        border-bottom-left-radius: 3px !important;
    }

    .number-input{
        font-size: 26px;
        letter-spacing: 4px;
        padding: 8px;
        padding-left: 27px;
        color: #989898a3;
    }

</style>