<template>
    <section class="bg-teal py-16">
        <div class="container">
            <h2 class="text-center text-white">Wydarzenia</h2>
            <div class="flex flex-wrap pt-4 -mx-4">
                <event-content v-for="event in events.data" :key="event.id" :event="event"></event-content>
            </div>
        </div>
    </section>
</template>

<script>
    import EventContent from './../content/Event.vue'
    export default {
        name: "EventsRow",

        components: {EventContent},

        computed: {
            events(){
                return this.$store.state.events
            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchEvents', 3)
        }

    }
</script>
