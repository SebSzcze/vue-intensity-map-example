<template>
    <div class="flex items-center">
        <ul v-for="(menu, index) in menus" class="px-4 flex items-center font-sans m-0" :class="{'border-l border-grey-lighter': index == 'primary'}">
            <navigation-item :parent="true"  class="py-2" v-for="item in menu.items" :key="item.id" :item="item"></navigation-item>
        </ul>
        <router-link v-if="showBackBtn" to="/" class="bg-grey-lighter rounded px-4 py-2 font-bold text-grey-dark text-sm ml-4">
            Wróć
        </router-link>
        <sidebar-toggler v-if="showSidebarToggler" class="ml-4"></sidebar-toggler>
    </div>
</template>

<script>
    import SidebarToggler from './../ui/SidebarToggler';
    import NavigationItem from './NavigationItem';

    export default {
        name: "Navigation",
        components: {SidebarToggler, NavigationItem},

        computed: {
            menus(){
                return this.$store.state.menus;
            },

            showBackBtn(){
                return !!this.$route.meta.showBackBtn
            },

            showSidebarToggler(){
                return !!this.$route.meta.hasSidebar
            }
        }

    }
</script>
