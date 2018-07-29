<template>
    <div class="h-screen flex overflow-hidden">
        <google-map class="flex-1 mt-18">
            <template slot-scope="{map,loaded}">
                <map-marker v-for="entity in entities"
                            v-if="loaded"
                            :key="entity.id"
                            :map="map"
                            :position="entity.location"
                            :title="entity.name"
                            :data="entity"
                            @click="click"
                            :icon="entity.icon"
                ></map-marker>
            </template>
        </google-map>
        <slot>
            <router-view></router-view>
        </slot>
    </div>
</template>

<script>
    const GoogleMap = require('./../elements/GoogleMap');

    export default {
        name: "TheMap",

        components: {GoogleMap},

        computed: {
            entities() {
                return this.$store.state.entities
            },

            entities_count() {
                return this.entities.length
            }
        },

        methods: {
            click({data}) {
                this.$router.push({
                    name: 'SidebarEntity',
                    params: {
                        id: data.id,
                        slug: data.slug
                    },
                });
            },
            search() {

            }
        }
    }
</script>
