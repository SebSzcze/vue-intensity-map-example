<template>
    <div>
        <the-map>
            <router-view :key="$route.name + $route.params.slug"></router-view>
        </the-map>
        <posts-row v-show="isHome"></posts-row>
        <events-row v-show="isHome"></events-row>
        <entities-row v-show="isHome"></entities-row>
        <street-list></street-list>
    </div>
</template>

<script>
    const TheMap = require('./../elements/TheMap')

    const StreetList = require('./../sections/StreetList')
    const PostsRow = require('./../sections/PostRow')
    const EventsRow = require('./../sections/EventsRow')
    const EntitiesRow = require('./../sections/EntitiesRow')

    export default {
        name: "HomeView",

        components: {
            TheMap, StreetList, PostsRow, EntitiesRow, EventsRow
        },

        computed: {
            isHome(){
                return this.$route.name === 'Home'
            }
        },

        created() {

        }
    }
</script>

