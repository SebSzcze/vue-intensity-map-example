<template>
    <article class="md:w-1/3 px-4">
        <figure class="relative inline-block">
            <div class="rounded p-2 text-center text-white leading-none absolute pin-t pin-r z-10 mt-2 mr-2 bg-teal">
                <strong class="block text-lg" v-text="event.date.day"></strong>
                <span class="block text-xs" v-text="event.date.month"></span>
                <span class="text-sm" v-text="event.date.year"></span>
            </div>
            <router-link :to="route">
                <img :src="event.photo.sizes.thumbnail.src" :alt="event.title" class="relative">
            </router-link>
            <h3 class="-mt-8 relative px-2 py-4 mr-8 bg-teal mb-0">
                <router-link :to="route" class="text-white font-semibold hover:text-teal-lighter"
                             v-text="event.title"></router-link>
            </h3>
        </figure>

        <div class="pl-2">
            <p class="text-grey text-base mb-8" v-text="event.excerpt"></p>
            <router-link :to="route" class="text-grey-light font-semibold hover:text-teal-lighter">Zobacz
                szczegóły
            </router-link>
        </div>
    </article>
</template>

<script>
    export default {
        name: "Event",
        props: ['event'],

        computed: {
            route() {
                return {name: 'EventView', params: this.event}
            }
        }
    }
</script>
