<template>
    <sidebar>
        <h1 class="text-white text-xl font-bold mt-0 mb-2">Natężenia</h1>
        <scrollbar class="flex-1 relative mb-8 -mr-2" style="height: 400px">
            <router-link class="mt-4" :to="{name: 'IntesityView', params: {key:legend.key}}" v-for="legend in legends" :key="legend.id">
                <h2 class="text-white font-semibold text-lg mb-1" v-text="legend.name"></h2>
                <p class="text-grey-light text-xs" v-text="legend.description"></p>
            </router-link>
        </scrollbar>
    </sidebar>
</template>

<script>
    export default {
        name: "IntesityList",


        computed: {
            legends() {
                return this.$store.state.legends
            }
        }
    }
</script>
