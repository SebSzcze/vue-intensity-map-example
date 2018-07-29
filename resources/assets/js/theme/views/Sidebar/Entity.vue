<template>
    <sidebar color="white" text="grey-dark" v-if="entity">
        <scrollbar class="flex-1 relative mb-6 -mr-4" style="height: 400px">
            <div>
                <t-label v-if="entity.type" :color="entity.type.color" :text="entity.type.name"></t-label>
            </div>
            <h3 class="font-normal leading-normal text-2xl" v-text="entity.name"></h3>
            <pin-marker v-if="entity.street" :text="entity.street.name"></pin-marker>
            <img :src="entity.photo.sizes.thumbnail.src" alt="Przedsięwzięcie nr 20. Leszczyńska Szkoła Aktywności Obywatelskiej" class="my-4">
            <h4 class="text-xl text-grey-darker">Informacje</h4>
            <p v-text="entity.excerpt" class="pr-2 text-sm"></p>
        </scrollbar>
        <footer class="py-4">
            <router-link :to="{name: 'EntityView', params: Object.assign(entity, {'showBackBtn': true}) }" class="bg-teal rounded block text-center text-white font-medium py-2 hover:bg-grey-lighter">
                Zobacz szczegóły
            </router-link>

            <div class="pt-6 flex items-center text-grey">
                <strong class="text-grey mr-2">Udostępnij ten obiekt</strong>
                <div class="ml-auto items-center flex">
                    <btn-facebook></btn-facebook>
                    <btn-google></btn-google>
                    <btn-linkedin></btn-linkedin>
                    <btn-twitter></btn-twitter>
                </div>
            </div>
        </footer>
    </sidebar>
</template>

<script>

    export default {
        name: "SidebarEntityView",

        computed: {
            entity() {
                return this.$store.state.current.item
            }
        },

        beforeCreate() {
            window.scrollTo(0,0)
            document.body.classList.add('overflow-hidden');
            const routeId = this.$route.params.id
            if (this.$store.state.current.item && routeId == this.$store.state.current.item.id) {
                return;
            }
            this.$store.dispatch('fetchEntity', routeId)
        },

        beforeDestroy(){
            document.body.classList.remove('overflow-hidden');
        }
    }
</script>

