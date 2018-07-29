<template>
    <section class="py-16">
        <div class="container py-16 border-t border-grey-lighter">
            <h2 class="text-center">Realizacje wg ulic</h2>

            <div class="flex flex-wrap -mx-4 mt-8">
                <street v-for="street in streets" :street="street" :key="street.id"></street>
            </div>
        </div>
    </section>
</template>

<script>
    const Street = require('./../content/Street')

    export default {
        name: "StreetList",

        components: {
            Street
        },

        computed: {
            streets(){
                return this.$store.state.settings.streets
            },
        }
    }
</script>
