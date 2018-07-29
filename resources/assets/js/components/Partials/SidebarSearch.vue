<script type="text/babel">
    export default {
        name: '',
        // properties defined with component
        props: {},
        // component variables
        data(){
            return {
                query: '',
                type: '',
                street: '',
                filtered: false
            }
        },
        watch: {
            route(){
                if(this.shouldFilter){
                    this.filter()
                }
            }
        },
        computed: {
            route(){
                return this.$route
            },
            types() {
                if(!storage.settings){
                    return;
                }
                return storage.settings.types;
            },
            streets(){
                if(!storage.settings){
                    return;
                }
                return storage.settings.streets;
            },
            shouldFilter(){
                return this.route.name == 'filter'
            },
        },
        // component methods
        methods: {
            search(){
                if(this.query == '' && this.street == '' && this.type == '') {
                    storage.fetchEntities()
                    return this.$router.push({ name: 'home' })
                }
                return this.$router.push({ name: 'filter', query: { street: this.street, type: this.type, query: this.query} });

            },
            filter(){
                
                this.filtered = true

                let query = this.query
                let type = this.type
                let street = this.street

                if(this.route.query.query) {
                   query = this.route.query.query
                }
                if(this.route.query.type) {
                    type = this.route.query.type
                }
                if(this.route.query.street) {
                    street = this.route.query.street
                }

                let params = `?query=${query}&type=${type}&street=${street}`;
                storage.fetchEntities(params);
                
                this.$nextTick(() => {
                    jump('body')
                })
            },
            reset(){
                storage.fetchEntities()
                this.filtered = false
                this.street = ''
                this.type = ''
                this.query = ''
                return this.$router.push({ name: 'home' })
            },
        },
        // executes when component is created
        created(){

        },
        // executes when component is boot and ready to use
        mounted(){
            if(this.shouldFilter) {
                this.filter()
            }
        }
    }
</script>
<template>
    <div class="sidebar-search">
        <div class="is-flex">
            <h3 class="title">Szukaj realizacji</h3>
            <a href="#" v-if="filtered" @click.prevent="reset" class="label is-red is-right">Usuń filtry</a>
        </div>

        <input type="text" placeholder="Słowo kluczowe" class="input" v-model="query" @keyup.enter="search">
        <div class="columns">
            <div class="column">
                <div class="control-select">
                    <select name="street" class="select" placeholder="Ulica" v-model="street">
                        <option selected value="">Ulica</option>
                        <option v-for="street in streets" :value="street.id" v-text="street.name"></option>
                    </select>
                </div>
            </div>
            <div class="column">
                <div class="control-select">
                    <select name="type" class="select" placeholder="Typ" v-model="type">
                        <option value="" selected>Typ</option>
                        <option v-for="type in types" :value="type.id" v-text="type.name"></option>
                    </select>
                </div>
            </div>
        </div>
        <button class="button is-green" @click.prevent="search">
            <i class="icon-search"></i>
        </button>
    </div>
</template>
