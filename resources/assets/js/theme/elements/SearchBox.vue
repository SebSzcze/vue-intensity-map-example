<template>
    <form class="bg-white p-4 relative mb-8 pb-8 relative" @submit.prevent="search">
        <a href="/" @click.prevent="reset" class="absolute font-sans text-white pin-r pin-t m-4 bg-red rounded text-xs font-semibold leading-normal px-1" v-show="isSearchView">Usuń
            filtry</a>
        <strong class="text-teal">Szukaj realizacji</strong>

        <input type="text" v-model="form.query" class="border-b border-grey-light w-full p-2 my-2" placeholder="Wpisz szukaną frazę">

        <div class="flex -mx-2">
            <div class="px-2 w-1/2 relative">
                <select class="border-b border-grey-light w-full p-2 my-2 block appearance-none w-full bg-white text-grey-darker pr-8 leading-tight" v-model="form.street">
                    <option :value="null" selected>Ulica</option>
                    <option v-for="street in streets" :value="street.id" v-text="street.name"></option>
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                </div>
            </div>
            <div class="px-2 relative w-1/2">
                <select class="border-b border-grey-light w-full p-2 my-2 block appearance-none w-full bg-white text-grey-darker pr-8 leading-tight" v-model="form.type">
                    <option :value="null" selected>Typ</option>
                    <option v-for="type in types" :value="type.id" v-text="type.name"></option>
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                </div>

            </div>
        </div>

        <button class="h-12 w-12 bg-green rounded-full absolute pin-r pin-b -mb-6 mr-6 text-white" type="submit" @click="search">
            <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path d="M20,18.586 L18.586,20 L12.929,14.343 L14.343,12.929 L20,18.586 Z M2,7 C2,4.243 4.243,2 7,2 C9.757,2 12,4.243 12,7 C12,9.757 9.757,12 7,12 C4.243,12 2,9.757 2,7 Z M0,7 C0,10.866 3.134,14 7,14 C10.866,14 14,10.866 14,7 C14,3.134 10.866,0 7,0 C3.134,0 0,3.134 0,7 Z" class="fill-current"></path>
                </g>
            </svg>
        </button>
    </form>
</template>

<script>
    export default {
        name: "SearchBox",
        props: ['isSearchView'],

        data() {
            return {
                form: {
                    query: null,
                    street: null,
                    type: null
                }
            }
        },
        computed: {
            streets(){
                return this.$store.state.settings.streets;
            },

            types(){
                return this.$store.state.settings.types;
            }
        },

        watch: {
            '$route.params': function (params) {
                this.$nextTick(() => {
                    this.extractParams();

                    if (this.isSearchView) {
                        this.$store.dispatch('searchEntities', params)
                    }

                })
            }
        },

        methods: {
            search() {
                this.$router.push({
                    name: 'Search',
                    params: this.form
                })
            },

            extractParams() {
                let keys = Object.keys(this.$route.params);

                keys.forEach((key) => {
                    this.form[key] = this.$route.params[key]
                })
            },

            reset(){
                this.$store.dispatch('fetchEntities');
                this.$router.push('/')
            }
        },
        mounted() {
            this.extractParams()
        }
    }
</script>
