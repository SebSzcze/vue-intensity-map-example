<template>
    <sidebar>
        <search-box @update="search"></search-box>
        <h2 class="text-white font-light">
            Przedsięwzięcia
            <small class="opacity-25">({{ entities_count }})</small>
        </h2>
        <scrollbar class="flex-1 relative mb-6 -mr-4" style="height: 400px">
            <entity v-for="entity in entities" :entity="entity" :key="entity.id"></entity>
        </scrollbar>
    </sidebar>
</template>

<script>
    const Entity = require('./../../sidebar/Entity')
    const SearchBox = require('./../../elements/SearchBox')

    export default {
        name: "SidebarPartial",

        components: {
            SearchBox, Entity
        },

        computed: {
            entities() {
                return this.$store.state.entities
            },

            entities_count() {
                return this.entities.length
            }
        },

        beforeCreate(){
            this.$store.dispatch('fetchEntities')
        },

        methods: {
            search(){

            }
        }
    }
</script>
