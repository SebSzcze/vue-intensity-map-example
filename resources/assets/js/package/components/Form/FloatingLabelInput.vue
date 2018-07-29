<template>
    <div class="control is-default">
        <div class="input-label" :class="cssClasses" @click="focus" v-html="label"></div>
        <div class="is-flex">
            <input ref="input"
                   type="text"
                   class="floating-label-input"
                   :id="id"
                   :class="css"
                   @blur="onBlur"
                   @focus="onBlur"
                   @input="update"
                   :name="name"
                   v-model="fieldValue"
            >
            <button class="button is-transparent" v-if="fieldValue" @click="clear">
                <lari-icon  :size="12" name="close"

                           class="floating-label-input-clear"
                ></lari-icon>
            </button>
        </div>
        <span class="is-danger input-error" v-if="error" v-text="error"></span>
    </div>
</template>
<script type="text/babel">
    export default {
        name: 'FloatingLabelInput',
        // properties defined with component
        props: {
            id: {
                type: String
            },
            css: {
                type: String
            },
            name: {
                type: String
            },
            value: {
                type: String
            },
            label: {
                type: String
            },
            error: {
                type: String,
                default: ''
            }
        },
        // component variables
        data(){
            return {
                isActive: false,
                fieldValue: this.value
            }
        },
        computed: {
            cssClasses(){
                return {
                    'input-label--has-value': this.fieldValue,
                    'input-label--focus': this.isActive
                }
            }
        },
        // component methods
        methods: {
            focus(){
                this.$refs.input.focus();
            },
            onBlur(e){
                this.isActive = e.target === document.activeElement;
            },
            update(e){
                this.$emit('input', e.target.value);
            },
            clear(){
                this.fieldValue = '';
                this.$emit('input', '');
                this.focus();
            }
        },

        // executes when component is created
        created(){

        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>
<style>
    .input-label {
        letter-spacing: -.5px;
        font-family: "Proxima Nova", sans-serif;
        color: #aeb1b5;
        font-weight: 600;
        padding-bottom: 3px;
    }
    .floating-label-input-clear{
        cursor: pointer;
    }
</style>