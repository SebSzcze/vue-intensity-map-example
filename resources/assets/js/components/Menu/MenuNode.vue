<template>
    <div>
        <div class="mb-2">
            <div class="bg-white rounded" :class="{ 'shadow':show }">
                <div class="flex items-center">
                    <div class="text-grey-dark font-semibold p-4">
                        <div v-if="item.anchor" class="">
                            <span v-text="item.anchor"></span>
                            <span class="block text-grey-light text-xs" v-text="item.url"></span>
                        </div>

                        <span class="text-grey-light" v-if="!item.anchor">Wprowadź treść odnośnika</span>
                    </div>
                    <div class="ml-auto">
                        <button v-if="show" class="inline-flex items-center text-blue font-bold text-sm px-2 py-2 rounded" type="button" @click.prevent="add">
                            <icon name="plus_mini"></icon>
                            <span>Dodaj poziom niżej</span>
                        </button>
                        <button v-if="show" class="inline-flex items-center  text-red-light font-bold text-sm px-2 py-2 bg-transparent mr-2 rounded hover:text-white hover:bg-red-light" type="button" @click.prevent="$emit('remove', item)">
                            <icon name="close_mini"></icon>
                            <span>Usuń</span>
                        </button>
                        <button v-if="!show" type="button" @click.prevent="toggle" class="text-grey-dark text-xs font-medium">
                            Rozwiń
                        </button>
                        <button v-else type="button" @click.prevent="toggle" class="text-grey-dar text-xs font-medium">
                            Zwiń
                        </button>
                    </div>
                    <div class="relative mr-2 cursor-move p-4 text-grey">
                        <svg class="cursor-move w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M14 4h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zM8 4h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm6 6h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm-6 0h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm6 6h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm-6 0h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1z"/>
                        </svg>
                    </div>
                </div>
                <div class="p-4 bg-white" v-if="show">
                    <div class="mb-4">
                        <lari-input
                                label="Treść linka"
                                size="xl"
                                :data-value="item.anchor"
                                v-model="item.anchor"
                        >

                        </lari-input>
                    </div>
                    <div class="flex">
                        <div class="w-2/3 pr-4">
                            <lari-input
                                    label="Adres odnośnika"
                                    :data-value="item.url"
                                    v-model="item.url"
                            >

                            </lari-input>
                        </div>
                        <div class="w-1/3">
                            <lari-input
                                    label="Klasa css"
                                    :data-value="item.class"
                                    v-model="item.class"
                            >

                            </lari-input>
                        </div>
                    </div>
                </div>

                <div class="pl-8 pr-2 py-4 bg-grey-lighter" v-if="show && item.children">
                    <div class="" v-dragula="item.children" drake="first">
                        <menu-node
                                v-if="item.children"
                                v-for="child in item.children"
                                :key="child.id"
                                :item="child"
                                :add="add"
                                @remove="remove"
                        >
                        </menu-node>
                    </div>
                    <div class="flex justify-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import MenuNode from './MenuNode'

    export default {
        inject: ['defaultNodeTemplate'],
        components: {MenuNode},
        props: ['item'],
        name: "MenuNode",

        data() {
            return {
                show: false
            }
        },

        methods: {
            toggle() {
                this.show = !this.show
            },
            add() {
                if (!this.item.children) {
                    this.$set(this.item, 'children', [])
                }

                this.item.children.push(Object.assign({}, this.defaultNodeTemplate))
            },

            remove(item) {
                const index = this.item.children.indexOf(item)
                this.item.children.splice(index, 1)
            }
        }
    }
</script>
