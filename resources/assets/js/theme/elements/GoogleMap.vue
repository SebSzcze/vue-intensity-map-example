<template>
    <div ref="map">
        <slot :map="map" :loaded="isMapLoaded"></slot>
    </div>
</template>

<script>
    import styles from './../utils/mapStyle'

    export default {
        name: "GoogleMap",

        props: {
            center: {
                default: () => {
                    return {
                        lat: 51.84594220807163,
                        lng: 16.569267557116735
                    }
                }
            },
        },

        data() {
            return {
                isMapLoaded: false,
                options: {
                    center: this.center,
                    zoom: 14,
                    mapTypeControl: false,
                    scrollwheel: false
                }
            }
        },

        computed: {
            isLoaded() {
                return typeof this.$google != 'undefined';
            },

            boundaries() {
                return this.$store.state.boundaries;
            },

            map() {
                return this.$store.state.map;
            }
        },

        methods: {
            listen() {
                this.$bus.listenOnce('google:maps.loaded', () => this.init())
            },
            init() {
                // if (!this.map) {
                let map = new this.$google.maps.Map(
                    this.$refs.map,
                    Object.assign({styles}, this.options)
                )

                this.$store.commit('SET_MAP', map);
                // }else{
                //     this.$el.replaceWith(this.map.getDiv())
                // }

                this.setBoundaries();

                this.isMapLoaded = true
            },

            setBoundaries() {
                let _t = this
                this.map.data.addGeoJson(this.boundaries);
                this.map.data.setStyle(function (feature) {
                    var color = 'rgba(0,0,0,.3)';
                    if (feature.getProperty('isColorful')) {
                        color = '#1F8994';
                    }
                    return /** @type {google.maps.Data.StyleOptions} */({
                        fillColor: color,
                        strokeColor: color,
                        strokeWeight: 4
                    });
                });
            }
        },
        beforeMount() {
            this.$store.dispatch('fetchMapBoundaries').then(() => {
                this.listen();
                if (this.isLoaded) {
                    this.init();
                }
            })
        },
    }
</script>
