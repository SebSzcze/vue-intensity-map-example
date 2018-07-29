<template>
    <div>
        <div class="wrapper">
            <div class="map">
                <googlemap
                        :markers="entities"
                        :style="mapStyle"
                        @markerclicked="pushEntity"
                        :zoom="18"
                ></googlemap>
            </div>
            <sidebar></sidebar>
        </div>
        <section-latest-posts v-cloak></section-latest-posts>
        <section-events v-cloak></section-events>
        <section-latest-entities v-cloak></section-latest-entities>
        <section-streets v-cloak></section-streets>
    </div>
</template>
<script>
    export default {
        name: '',
        // properties defined with component
        props: {},
        computed: {
            route() {
                return this.$route.name
            },
            entities() {
                return storage.entities;
            },
            mapStyle() {
                return {
                    minHeight: `${window.innerHeight - 70}px`,
                    height: `calc(100vh - 70px)`
                }
            },
        },
        watch: {
            "$route.name"($name) {
                this.fetch()
            },
        },
        // component variables
        data() {
            return {}
        },
        // component methods
        methods: {
            pushEntity(entity) {
                if(!entity) return;

                router.push({name: 'sidebar', params: {id: entity.id, slug: entity.slug}})
            },

            fetch(){
                if (this.$route.name == 'events') {
                    return storage.fetchEventsAsEntities()
                }
                if (this.$route.name == 'home') {
                    return storage.fetchEntities()
                }
            }
        },
        // executes when component is created
        created() {

        },
        // executes when component is boot and ready to use
        mounted() {
            this.fetch()
        }
    }
</script>

