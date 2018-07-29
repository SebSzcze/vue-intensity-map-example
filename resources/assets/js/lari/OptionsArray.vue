<template>
    <div>
        <input type="hidden" :name="name" :value="json">
        <div v-dragula="values" drake="first">
            <div class="flex items-center mb-2" v-for="value in values" :key="value.id">
                <div class="flex-1">
                    <slot :value="value" :replace="replace">
                        <div class="p-2">
                            <input type="text" :value="value">
                        </div>
                    </slot>
                </div>
                <div class="pl-4 flex self-stretch items-center">
                    <button @click.prevent="remove(value)" class="rounded bg-grey-light px-2 py-1 text-grey-dark">
                        <icon name="delete"></icon>
                    </button>
                </div>
            </div>
        </div>

        <slot name="btn" :push="push" v-if="isAllowed">
            <button @click.prevent="push"
                    :disabled="!isAllowed"
                    class="mt-4 block rounded text-sm font-medium px-4 py-2"
                    :class="buttonClass"
                    v-html="buttonText"></button>
        </slot>

    </div>
</template>
<script type="text/babel">
    import uuid from 'uuid/v4';

    export default {
        name: 'OptionsArray',
        props: {
            name: {},
            dataValues: {
                default: () => []
            },
            buttonText: {
                default: 'Dodaj'
            },
            buttonClass: {
                default: 'bg-grey-lighter'
            },
            node: {
                default: ''
            },
            max: {
                default: false
            },
            keyField: {
                default: 'name'
            }
        },
        // component variables
        data() {
            return {
                values: this.dataValues
            }
        },

        computed: {
            json() {
                return JSON.stringify(this.values)
            },

            isAllowed(){
                if (!this.max) return true

                return this.values.length < this.max
            }
        },
        methods: {
            push() {
                if(!this.isAllowed) return;

                this.node.id = uuid();
                this.values.push(JSON.parse(JSON.stringify(this.node)));
            },
            replace(data){
                let index = this.values.indexOf(data.old)

                this.$set(this.values, index, data.new)
            },
            canAdd(){
                if (!this.max) return true


                return this.values.length < this.max
            },

            remove(value) {
                let index = this.values.indexOf(value)
                this.values.splice(index, 1)
            },
        },
    }
</script>
<style>
    .gu-mirror{position:fixed!important;margin:0!important;z-index:9999!important;opacity:.8;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";filter:alpha(opacity=80)}.gu-hide{display:none!important}.gu-unselectable{-webkit-user-select:none!important;-moz-user-select:none!important;-ms-user-select:none!important;user-select:none!important}.gu-transit{opacity:.2;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";filter:alpha(opacity=20)}
</style>
