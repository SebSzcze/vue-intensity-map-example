<template>
    <div class="h-screen flex overflow-hidden">
        <google-map class="flex-1 mt-18">
            <template slot-scope="{map,loaded}">
                <polygon-intensity
                        ref="pointsComponent"
                        :map="map"
                        :color="legend.color"
                        :numerical="numerical"
                        :active="active"
                        :type="$route.params.key" v-if="loaded"
                        @updateMaxCount="updateMaxCount"
                ></polygon-intensity>
            </template>
        </google-map>
        <slot>
            <router-view @input="update" :key="$route.params.key" :max-count="maxCount" @updateNumerical="updateNumerical"></router-view>
        </slot>
    </div>
</template>

<script>
    const GoogleMap = require('./../elements/GoogleMap');
    const PolygonIntensity = require('./../elements/PolygonIntensity');

    export default {
        name: "IntensityView",
        components: {GoogleMap, PolygonIntensity},

        data(){
            return {
                active: false,
                maxCount: 0,
                numerical: false
            }
        },

        computed: {
            legend() {
                return Object.assign({name: false}, this.$store.state.legends.filter(item => {
                    return item.key === this.$route.params.key
                }).pop())
            }
        },

        methods: {
            update(value){
                this.active = value
            },

            updateMaxCount(value){
                this.maxCount = value
            },

            updateNumerical(numerical){
                this.numerical = numerical
            }
        },
        
        beforeCreate(){
            this.$store.dispatch('fetchIntesityLegend')
        },
    }
</script>
