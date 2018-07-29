<template>
    <div class="relative">
        <input type="hidden" :name="name" :value="selected[dataKeyField]">
        <div @click="open">
            <slot name="selected" :show="show" :item="selected" :data-field="dataField">
                <div
                        class="rounded cursor-pointer flex items-center text-sm px-4 py-2 bg-white border border-grey-lighter relative"
                        :class="{ 'bg-white border-grey-light text-grey-light' : show }"
                >
                    <span class="flex-1" v-if="!selected">Wybierz element</span>
                    <span class="flex-1" v-else>{{ selected[dataField] }}</span>
                    <icon name="arrow_down" class="text-xs text-grey mx-1"></icon>
                </div>
            </slot>
        </div>
        <dropdown
                v-if="show"
                :data-resources="dataResources"
                :data-field="dataField"
                :data-key-field="dataKeyField"
                :data-url="dataUrl"
                :data-config="dataConfig"
                @close="show = false"
                @select="select"
        >
            <template slot="item" slot-scope="{item}">
                <slot name="item" :item="item"></slot>
            </template>
        </dropdown>
    </div>
</template>
<script type="text/babel">
    import Dropdown from './SelectDropdown';

    export default {
        name: 'Select',
        components: {Dropdown},
        props: {
            name: {},
            dataField: {
                default: 'name'
            },
            dataKeyField: {
                default: 'id'
            },
            dataResources: {
                default: () => []
            },
            dataUrl: {
                default: false
            },
            dataPlaceholder: {},
            dataSelected: {
                default: () => {
                    return {}
                }
            },
            dataConfig: {
                default: () => {
                    return {}
                }
            }
        },
        // component variables
        data() {
            return {
                show: false,
                selected: this.dataSelected
            }
        },

        computed: {},
        methods: {
            open() {
                this.show = true
            },

            select(item){
                this.show = false
                this.selected = item
                this.$emit('input', item)
                this.$emit('replace', {old: this.dataSelected, new: item})
            }
        },
    }
</script>

