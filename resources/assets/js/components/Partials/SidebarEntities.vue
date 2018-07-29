<script>
    export default {
        name: '',
        // properties defined with component
        props: {},
        // component variables
        data() {
            return {}
        },
        computed: {
            entities() {
                return storage.entities;
            },
            counter() {
                return this.entities.length
            },
            heading() {
                if (this.$route.name == 'events') {
                    return storage.getHeading('events')
                }
                if (this.$route.name == 'projects') {
                    return storage.getHeading('projects')
                }
                return storage.getHeading('entities')
            },
        },

        methods: {
            getRoute(entity) {
                if (this.$route.name == 'events') {
                    return {name: 'event', params: {id: entity.id, slug: entity.slug}}
                }

                return {name: 'sidebar', params: {id: entity.id, slug: entity.slug}}
            }
        },
        mounted() {
            let totalHeight = this.$refs.container.offsetHeight
            let titleHeight = this.$refs.title.offsetHeight

            this.$refs.scroller.style.height = `${totalHeight - titleHeight}px`
        }
    }
</script>
<template>
    <div class="sidebar-entities" ref="container">
        <h2 class="title is-2 is-light p-b-20" ref="title">
            {{ heading }} <span class="is-fz-3">({{ counter }})</span>
            <router-link class="label is-green" v-if="$route.name == 'events'" to="/zglos">Dodaj</router-link>
        </h2>
        <div class="flex-1 is-relative">
        <div class="sidebar-entities__scroller" ref="scroller">

            <router-link class="entity" v-for="entity in entities"
                         :key="entity.id"
                         :to="getRoute(entity)">


                <h3 v-if="entity.name" class="title entity-title is-flex-1"><span class="label m-r-10 is-flex-none"
                                                                                  v-if="entity.type"
                                                                                  :class="entity.type.color_class"
                                                                                  v-text="entity.type.name"></span>
                    {{ entity.name }}</h3>
                <h3 v-if="entity.title" class="title entity-title is-flex-1" v-text="entity.title"></h3>
                <div class="entity-content">
                    <img class="entity-content-photo" v-if="entity.photo" :src="entity.photo.sizes.mini.src" :alt="entity.name">


                    <strong class="entity-street" v-if="entity.street">
                        <i class="icon-pin"></i>
                        {{ entity.street.name }}
                    </strong>


                    <p class="entity-excerpt" v-text="entity.excerpt"></p>
                </div>
            </router-link>

        </div>
        </div>
    </div>
</template>
