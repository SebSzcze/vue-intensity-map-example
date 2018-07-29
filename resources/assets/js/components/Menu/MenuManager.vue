<template>
    <div>
        <input type="hidden" :name="name" :value="json">

        <div :class="listClass" v-dragula="items" drake="first" service="first">
            <menu-node
                    v-for="item in items"
                    :key="item.id"
                    :item="item"
                    :add="add"
                    @remove="remove"
            >

            </menu-node>
        </div>

        <slot name="addButton" :add="add">
            <button type="button" @click.prevent="add" class="mt-4 text-white font-bold text-sm px-4 py-2 bg-blue rounded">Dodaj</button>
        </slot>
    </div>
</template>

<script>
    import MenuNode from './MenuNode'
    import uuid from 'uuid'

    const ITEM = {
        id: uuid.v4(),
        anchor: '',
        class: '',
        url: '',
        attributes: {}
    }

    export default {
        name: "MenuManager",

        components: {MenuNode},

        provide: {
            defaultNodeTemplate: ITEM
        },

        props: {
            dataItems: {
                default: () => []
            },
            name: {
                required: true
            },

            listClass: {
                default: ''
            }
        },

        data() {
            return {
                items: this.dataItems
            }
        },

        computed: {
            json() {
                return JSON.stringify(this.items)
            }
        },

        methods: {
            add(item = null) {
                this.items.push(Object.assign({}, ITEM))
            },

            addChild(item) {
                if (!item.children) {
                    this.$set(item, 'children', []);
                }

                item.children.push(Object.assign({}, ITEM))
            },

            remove(item) {
                const index = this.items.indexOf(item)
                this.items.splice(index, 1)
            }
        },

        mounted() {
            this.items.forEach((item) => {
                if (!item.id) {
                    this.$set(item, 'id', uuid.v4())
                }
            })
        }

    }
</script>

<style>
    .gu-mirror{position:fixed!important;margin:0!important;z-index:9999!important;opacity:.8;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";filter:alpha(opacity=80)}.gu-hide{display:none!important}.gu-unselectable{-webkit-user-select:none!important;-moz-user-select:none!important;-ms-user-select:none!important;user-select:none!important}.gu-transit{opacity:.2;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";filter:alpha(opacity=20)}
</style>