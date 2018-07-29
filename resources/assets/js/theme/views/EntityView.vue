<template>
    <single-view
            :cover="cover"
            :title="entity.name"
    >
        <template slot="title">
            <div class="flex-1">
                <t-label v-if="entity.type" :color="entity.type.color" :text="entity.type.name"></t-label>
                <h1 class="font-normal" v-text="entity.name"></h1>
                <pin-marker class="text-grey-dark" v-if="entity.street" :text="entity.street.name"></pin-marker>
            </div>
        </template>

        <div v-html="entity.body"></div>

        <template slot="content:after">
            <div class="self-start pl-16 md:w-1/3 content">

                <google-map class="h-100 -mt-24">
                    <template slot-scope="{map,loaded}" v-if="loaded">
                        <map-marker v-if="entity.location && entity.location.lat"
                                    :map="map"
                                    :position="entity.location"
                                    :title="entity.name"
                                    :icon="entity.icon"
                        ></map-marker>
                        <polygon-map v-else :map="map"></polygon-map>
                    </template>
                </google-map>

                <div class="py-8 flex items-center text-grey">
                    <strong class="text-grey mr-2">Udostępnij ten obiekt</strong>
                    <div class="social-btns">
                        <btn-facebook></btn-facebook>
                        <btn-google></btn-google>
                        <btn-linkedin></btn-linkedin>
                        <btn-twitter></btn-twitter>
                    </div>
                </div>
                <div class="py-8" v-html="entity.meta"></div>
            </div>
        </template>
    </single-view>
</template>
<script>
    import SingleView from './SingleView';
    const GoogleMap = require('./../elements/GoogleMap');
    const PolygonMap = require('./../elements/PolygonMap');

    export default {
        name: "EntityView",
        components: {SingleView, GoogleMap, PolygonMap},

        computed: {
            entity() {
                return this.$store.state.current.item;
            },
            cover(){
                if(!this.entity.photo) {
                    return;
                }
                return this.entity.photo.sizes.cover.src
            }
        },


        beforeCreate() {
            this.$store.dispatch('fetchEntity', this.$route.params.id)
        }
    }
</script>
