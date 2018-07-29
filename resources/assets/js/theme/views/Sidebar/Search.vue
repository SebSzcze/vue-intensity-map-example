<template>
    <sidebar>
        <search-box :isSearchView="true"></search-box>
        <h2 class="text-white font-light">
            Wyniki wyszukiwania
            <small class="opacity-25">({{ entities_count }})</small>
        </h2>
        <scrollbar class="flex-1 relative mb-6 -mr-4" style="height: 400px">
            <entity v-for="entity in entities" :entity="entity" :key="entity.id"></entity>
        </scrollbar>
    </sidebar>
</template>

<script>
    const Entity = require('./../../sidebar/Entity');
    const SearchBox = require('./../../elements/SearchBox');

    export default {
        name: "SidebarSearch",
        components: { SearchBox, Entity },

        computed: {
            entities() {
                return this.$store.state.entities
            },

            entities_count() {
                return this.entities.length
            }
        },

        beforeMount(){
            this.$store.dispatch('searchEntities', this.$route.params)
        }
    }
</script>
