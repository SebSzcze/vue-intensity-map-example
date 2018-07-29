<template>
    <article class="pb-2 mb-2 mr-4 block" is="router-link" :to="route">
        <h3 class="text-white text-base font-bold mb-0" v-text="event.title"></h3>

        <div class="text-grey opacity-75 text-xs font-bold mb-2">
            <span>{{ event.date.day }}</span>
            <span>{{ event.date.month }}</span>
            <span>{{ event.date.year }}</span>
        </div>

        <div class="flex">
            <div class="flex-1">
                <p class="text-sm text-white opacity-50" v-text="event.excerpt"></p>
            </div>
            <div class="flex-none pl-2" v-if="event.photo_id">
                <figure class="inline-block relative">
                    <img :src="event.photo.sizes.mini.src">
                </figure>
            </div>
        </div>
        <div class="h-1 border-t-2 border-teal-darker w-16 opacity-25"></div>
    </article>
</template>

<script>
    export default {
        name: "Event",
        props: ['event'],

        computed: {
            route() {
                return {
                    name: 'EventView',
                    params: {
                        id: this.event.id,
                        slug: this.event.slug
                    }
                }
            }
        }
    }
</script>

