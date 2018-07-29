<template>
    <div>
        <div class="rounded bg-white border border-grey-light absolute z-20 mt-1" style="min-width: 175px">
            <div class="p-px m-px flex items-center mb-1">
                <input
                        type="text"
                        name="search"
                        class="w-full border-0 rounded bg-grey-lighter text-sm font-medium p-2 text-grey-dark"
                        v-model="search"
                        @keydown.esc="escape"
                        @keydown.down.prevent="down"
                        @keydown.up.prevent="up"
                        @keydown.enter.prevent="select"
                        :placeholder="dataPlaceholder"
                        ref="input"
                >
                <lari-loader v-if="loading" size="18px" class="absolute pin-r mr-6"></lari-loader>
            </div>
            <ul>
                <li
                        v-for="(item, i) in items"
                        :key="item.id"
                        :class="{ 'bg-grey-lighter font-medium' : index == i }"
                        class="cursor-pointer text-grey-dark leading-loose px-4 text-sm"
                        @click.prevent="clickSelect(i)"
                        @mouseover="index = i"
                >
                    <slot name="item" :item="item" :data-field="dataField">
                        {{ item[dataField] }}
                    </slot>
                </li>
                <li v-if="!count" class="p-4 font-normal text-grey text-sm">
                    Brak wyników
                </li>
            </ul>
        </div>
        <div class="fixed pin z-10" @click="escape"></div>
    </div>
</template>
<script type="text/babel">
    const CONFIG = {
        debounce: 500,
        once: false
    }

    export default {
        name: 'SelectDropdown',
        props: {
            dataResources: {
                deafult: () => []
            },
            dataUrl: {},
            dataField: {
                default: 'name'
            },
            dataKeyField: {
                default: 'id'
            },
            dataPlaceholder: {
                default: 'Szukaj ...'
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
                resources: this.dataResources,
                search: '',
                index: 0,
                loading: false,
                timeout: '',
                CONFIG: Object.assign(CONFIG, this.dataConfig)
            }
        },

        watch: {
            loading($value) {
                if ($value) {
                    return Event.fire('loader:show')
                }
                return Event.fire('loader:hide')
            },

            search() {
                if (this.CONFIG.once) {
                    return;
                }

                if (this.timeout) clearTimeout(this.timeout)

                this.timeout = setTimeout(() => {
                    this.fetch()
                }, this.CONFIG.debounce);
            }
        },

        computed: {
            items() {
                if (this.CONFIG.once) {
                    return this.resources.filter((item) => {
                        let filter = this.search.toUpperCase()
                        return item.name.toUpperCase().indexOf(filter) > -1
                    }).slice(0, 10)
                }

                return this.resources
            },

            count() {
                return this.items.length
            },

            url() {
                return `${this.dataUrl}?query=${this.search}&order=id,asc&take=20&page=1&query_props=${this.dataField},like,`
            }
        },
        methods: {
            init() {
                if (!this.dataUrl) {
                    return;
                }

                this.$refs.input.focus()

                this.fetch();
            },
            fetch() {
                this.loading = true
                this.index = 0
                axios.get(this.url).then(({data}) => {
                    this.resources = data.data
                    this.loading = false
                })
            },


            clickSelect(i) {
                this.index = i

                this.select()
            },
            select() {
                this.$emit('select', this.items[this.index]);
            },

            escape() {
                this.search = ''
                this.$emit('close')
            },
            // handle move down action
            down() {
                if (this.index < this.count - 1) {
                    this.index++
                }
            },
            // handle move up action
            up() {
                if (this.index > 0) {
                    this.index--
                }
            },
        },
        mounted() {
            this.init()
        }
    }
</script>


