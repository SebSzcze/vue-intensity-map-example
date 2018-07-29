<script type="text/babel">
    export default {
        name: 'Events',
        // properties defined with component
        props: {},
        // component variables
        data(){
            return {
            }
        },
        computed: {
            events(){
                return storage.events;
            }
        },
        // component methods
        methods: {},
        // executes when component is created
        created(){

        },
        // executes when component is boot and ready to use
        beforeMount(){
            storage.fetchEvents();
        }
    }
</script>
<template>
    <section class="section is-primary">
        <div class="container">
            <h2 class="title is-2 is-light has-text-centered">Wydarzenia</h2>
            <div class="is-flex p-v-40">
                <article class="event" v-for="event in events">
                    <div class="event-date">
                        <div class="event-date-frame">
                            <strong>{{ event.date.day }}</strong>
                            <span>{{ event.date.month }}</span>
                            <small>{{ event.date.year }}</small>
                        </div>
                    </div>
                    <div class="event-content">
                        <h3 class="title is-5">
                            <router-link :to="{ name: 'event', params: { id: event.id, slug: event.slug } }">
                                {{ event.title }}
                            </router-link>
                        </h3>
                        <small v-if="event.entity">{{ event.entity.name }}</small>
                        <p class="event-content-excerpt" v-text="event.excerpt"></p>
                        <router-link :to="{ name: 'event', params: { id: event.id, slug: event.slug } }" class="more">
                            Więcej</router-link>
                    </div>

                </article>
            </div>
        </div>
    </section>
</template>
