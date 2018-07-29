<template>
    <aside v-if="show" class="sidebar" :class="{ 'sidebar--white': showEntity() }">
        <slot>
            <partial-sidebar-search v-if="showSearch()"></partial-sidebar-search>
            <partial-sidebar-entities v-if="!showEntity()"></partial-sidebar-entities>
            <sidebar-entity v-if="showEntity()"></sidebar-entity>
        </slot>
    </aside>
</template>
<script>
    import SidebarEntity from './../../Modules/SidebarEntity.vue'

    export default {
        name: 'Sidebar',
        components: {
            SidebarEntity
        },
        // properties defined with component
        props: {},
        // component variables
        data() {
            return {}
        },
        computed: {
            show() {
                return storage.sidebar
            },
            route() {
                return this.$route.name
            },
            style() {

                let height = `${window.innerHeight - 70}px`

                return {
                    height
                }
            },
        },
        // component methods
        methods: {
            showEntity() {
                return this.route == 'sidebar';
            },
            showSearch() {
                return !this.showEntity() && this.route != 'events' && this.route != 'projects'
            }
        },
    }
</script>

