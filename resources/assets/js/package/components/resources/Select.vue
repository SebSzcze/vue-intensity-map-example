<script>
    export default {
        data: function() {
            return  {
                items: [],
                q: '',
                show: false,
                input: ''
            }
        },
        computed: {
            filteredItems(){
                /// item.items | filterBy q
                console.log(this.items)
                // return this.items.filter((item) => {
                //     let filter = this.q.toUpperCase()
                //     return item.name.toUpperCase().indexOf(filter) > -1
                // })
                return this.items
            }
        },
        methods: {

            fetchData: function(){

                this.$http.get('/urls').then(response => {
                    this.items = response.data
                })
            },
            setInput(input){
                this.input = input
            },
            toggle: function(){
                this.show = !this.show

                return this;
            },
            toggleItem: function(item){
                jQuery("#items-list-" + item).toggle()
            },
            insert: function(value){

                console.log(value)
                this.input.value = value
                this.toggle()
            },
            getUrl: function(url){
                return frontend_url + url
            }


        },
        mounted: function(){
            this.fetchData();

        },
        created: function(){
        }
    }
</script>
<template>
    <div>
        <div class="modal" :class="{ 'is-active' : show }">
            <div class="modal-card is-wide">

                <section class="modal-card-body">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="panel-title">Adres url</div>
                            <p><small>Rozpocznij szukanie po prawej stronie</small></p>
                            <p class="p-v-10"><small>W przypadku dużej liczy elementów, możesz skorzystać z poniższej opcji filtrowania</small></p>
                            <p class="control">
                                <input type="text" class="input" v-model="q" placeholder="Rozpocznij wpisywanie...">
                            </p>
                        </div>
                        <div class="column">
                            <div v-for="(item, index) in items" class="panel">
                                <div class="panel-body is-clickable" @click="toggleItem(index)">
                                    <div class="panel-title">
                                        {{ item.title }}
                                    </div>
                                    <i class="icon is-pulled-right angle down"></i>
                                </div>
                                <div class="panel-body item-list"  style="display: none;" :id="'items-list-' + index">
                                    <div v-for="link in item.items" class="p-v-5">
                                        <div class="columns">
                                            <div class="column is-9">
                                                <strong>{{ link.name }}</strong>
                                                <small class="is-block">{{ link.url }}</small>
                                            </div>
                                            <div class="column has-text-right">
                                                <a :href="getUrl(link.url)" target="_blank"><i class="icon external"></i></a>
                                                <a href="#" class="tag is-dark is-pulled-right" @click.prevent="insert(link.url)">wstaw</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
            </div>
            <div class="modal-background" @click="toggle"></div>
        </div>

    </div>
</template>