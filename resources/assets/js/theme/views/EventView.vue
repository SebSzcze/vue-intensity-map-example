
   <template>
    <single-view
            :cover="cover"
            :title="item.name"
            :lead="item.excerpt"
            :item="item"
    >
        <template slot="title" slot-scope="{item}">
            <div class="flex-1">
                <h1 class="font-normal" v-text="item.title"></h1>
            </div>
            <div>
                <div class="rounded p-2 text-center leading-none absolute pin-t pin-r z-10 mt-2 mr-2 bg-teal" v-if="item.date">
                    <strong class="block text-lg" v-text="item.date.day"></strong>
                    <span class="block text-xs" v-text="item.date.month"></span>
                    <span class="text-sm" v-text="item.date.year"></span>
                </div>
            </div>
        </template>
        <div class="text-center" v-if="!item.id">
            <h1>404 Nie znaleziono</h1>
            <p>Strona, której szukasz nie mogła zosta znaleziona</p>
        </div>

        <div v-html="item.body"></div>

        <template slot="content:after">
            <div class="self-start pl-16 md:w-1/3 content">

                <div class="py-8 flex items-center text-grey">
                    <strong class="text-grey mr-2 text-base">Udostępnij </strong>
                    <div class=" items-center flex">
                        <btn-facebook></btn-facebook>
                        <btn-google></btn-google>
                        <btn-linkedin></btn-linkedin>
                        <btn-twitter></btn-twitter>
                    </div>
                </div>
                <div class="py-8" v-html="item.meta"></div>
            </div>
        </template>
    </single-view>
</template>


<script>
    import SingleView from './SingleView';

    export default {
        name: "EventView",
        components: {SingleView},

        computed: {
            cover(){
                if(this.item.photo_id) {
                    return this.item.photo.sizes.cover.src
                }
            },
            item() {
                return this.$store.state.current.item;
            },
        },

        watch :{
            "$route.params.id"(id){
                this.$store.dispatch('fetchEvent', id)
            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchEvent', this.$route.params.id)
        }
    }
</script>

