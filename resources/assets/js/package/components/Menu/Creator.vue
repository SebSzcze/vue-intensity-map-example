<template>
    <div>
        <input type="hidden" name="items" v-model="output">
        <div class="menu-creator p-b-20" v-dragula="$storage.items" drake="first" service="first">
            <item v-for="item in $storage.items"
                  :key="item.id"
                  :additionalAttributes="additionalAttributes"
                  :data="item"
                  @remove="removeItem"
            ></item>
        </div>
        <a href="#" class="button is-info" @click.prevent="addItem">Dodaj Element</a>
    </div>
</template>

<script type="text/babel">
    import Item from './Item.vue';
    export default {
        name: 'MenuCreator',
        // properties defined with component
        props: {
            data: {
                default: () => []
            },
            openOnPush: {
                default: true
            },
            additionalAttributes: {
                type: Object,
                default: () => {
                    return {}
                }
            }
        },
        components: { Item },

        // component variables
        computed: {
            output(){
                return JSON.stringify(this.items, null, 2);
            },
            items(){
                return Store.get('items');
            }
        },
        // component methods
        methods: {
            addItem(){
                let count = this.items.length + 1;

                let schema = {
                    id: count,
                    anchor: "",
                    url: "",
                    class: "",
                    children: [],
                };

                schema = Object.assign(schema, this.additionalAttributes);

                Store.push('items', schema);
                Event.fire('menu.item.created');
            },
            removeItem(item){
                Store.removeFrom('items', item);
            }
        },
        beforeMount(){
            if(this.data.length){
                Store.set('items', this.data);
            }
        }
    }
</script>

<style>
    .gu-mirror{position:fixed!important;margin:0!important;z-index:9999!important;opacity:.8;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";filter:alpha(opacity=80)}.gu-hide{display:none!important}.gu-unselectable{-webkit-user-select:none!important;-moz-user-select:none!important;-ms-user-select:none!important;user-select:none!important}.gu-transit{opacity:.2;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";filter:alpha(opacity=20)}
</style>
