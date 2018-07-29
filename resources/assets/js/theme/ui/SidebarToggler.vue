<template>
    <button @click="toggleSidebar" class="text-grey-darkest">
        <svg v-if="showSidebar" width="20px" height="12px" viewBox="0 0 20 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path d="M20,6 L13,0 L13,5 L0,5 L0,7 L13,7 L13,12 L20,6 Z M0,2 L11,2 L11,0 L0,0 L0,2 Z M0,12 L11,12 L11,10 L0,10 L0,12 Z" class="fill-current"></path>
            </g>
        </svg>

        <svg v-if="!showSidebar" width="20px" height="12px" viewBox="0 0 20 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path d="M0,6 L7,12 L7,7 L20,7 L20,5 L7,5 L7,0 L0,6 Z M9,12 L20,12 L20,10 L9,10 L9,12 Z M9,2 L20,2 L20,0 L9,0 L9,2 Z" class="fill-current"></path>
            </g>
        </svg>
    </button>
</template>

<script>
    export default {
        name: "SidebarToggler",
        computed: {
            showSidebar(){
                return this.$store.state.sidebar;
            }
        },
        methods: {
            toggleSidebar(){
                this.$store.commit('TOGGLE_SIDEBAR')
            }
        }
    }
</script>

<style scoped>

</style>