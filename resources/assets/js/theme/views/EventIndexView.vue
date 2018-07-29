<template>
    <div class="h-screen flex overflow-hidden">
        <google-map class="flex-1 mt-18">
            <template slot-scope="{map,loaded}">
                <map-marker v-for="event in events.data"
                            v-if="loaded && events.data"
                            :key="event.id"
                            :map="map"
                            :position="event.location"
                            :title="event.title"
                            @click="click"
                            :data="event"
                ></map-marker>
            </template>
        </google-map>
        <slot>
            <sidebar>
                <h2 class="text-white font-light">
                    {{ heading }}
                    <small class="opacity-25">({{ count }})</small>
                </h2>
                <scrollbar class="flex-1 relative mb-6 -mr-4" style="height: 400px">
                    <sidebar-event v-for="event in events.data" :event="event" :key="event.id"></sidebar-event>
                    <!--<entity v-for="entity in entities" :entity="entity" :key="entity.id"></entity>-->
                </scrollbar>
            </sidebar>
        </slot>
    </div>
</template>

<script>
    const GoogleMap = require('./../elements/GoogleMap');
    const SidebarEvent = require('./../sidebar/Event')

    export default {
        name: "EventsIndexView",
        components: {GoogleMap, SidebarEvent},

        data(){
            return {
                active: false
            }
        },

        computed: {
            events(){
                return this.$store.state.events;
            },
            heading(){
                if (!this.$store.state.settings.headings) return;

                return this.$store.state.settings.headings.events
            },

            count(){
                if (!this.events) return 0;

                return this.events.total
            }
        },

        methods: {
            update(value){
                this.active = value
            },
            click(item){
                this.$router.push({
                    name: 'EventView',
                    params: item.data
                })
            }
        },

        beforeCreate(){
            this.$store.dispatch('fetchEvents', 40)
        }
    }
</script>
