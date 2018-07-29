<script>
    import tinycolor from 'tinycolor2';
    import Range from './../utils/LegendRange';

    export default {
        name: "PolygonIntensity",
        props: {
            map: {required: true},
            color: {},
            type: {},
            active: {},
            numerical: {}
        },

        data() {
            return {
                centers: {}
            }
        },

        computed: {
            maxCount() {
                return Math.max.apply(Math, Object.keys(this.polygons).map(id => this.polygons[id].value))
            },

            ranges() {
                return new Range(this.maxCount, this.color)
            },

            polygons() {
                if (!this.$store.state.intensity[this.type]) {
                    return [];
                }

                return this.$store.state.intensity[this.type][this.active] || [{value: 0}]
            },

            geojson() {
                return this.$store.state.geojson
            },
            icon() {
                return {
                    url: "api/images/marker_icon.png", // url
                    scaledSize: new this.$google.maps.Size(25, 25), // scaled size
                    origin: new this.$google.maps.Point(0, 0), // origin
                    anchor: new this.$google.maps.Point(12.5, 12.5) // anchor
                };
            }
        },

        watch: {
            numerical(numerical){
                this.toggleCounter()
            },

            maxCount: {
                immediate: true,
                handler(max){
                    this.$emit('updateMaxCount', max);
                }
            },

            polygons() {
                this.iterate();

                if (this.numerical) {
                    this.resetCounters();
                    this.toggleCounter();
                }
            },
        },

        render() {},

        beforeCreate() {
            this.$store.dispatch('fetchGeoData');
        },

        methods: {
            init() {
                if (!Object.keys(this.geojson).length) {
                    return this.$store.dispatch('fetchGeoData').then(() => {
                        return this.init();
                    });
                }

                this.map.data.addGeoJson(this.geojson, { idPropertyName: "id" });
                this.createPaths();
                this.iterate();
            },

            createPaths(){
                this.map.data.forEach((feature) => {
                    if(feature.getGeometry().getType() === 'Polygon'){

                        this.centers[feature.getId()] = {
                            center: this.getCenter(feature.getGeometry().getAt(0).getArray()),
                            marker: false
                        };
                    }
                })
            },

            resetCounters(){
                Object.keys(this.centers).forEach((key) => {
                    if(this.centers[key].marker) {
                        this.centers[key].marker.setMap(null);
                        this.centers[key].marker = false;

                        return;
                    }
                })
            },

            toggleCounter(){
                Object.keys(this.centers).forEach((key) => {
                    if(this.centers[key].marker) {
                        this.centers[key].marker.setMap(null);
                        this.centers[key].marker = false;

                        return;
                    }
                    if(!this.numerical) return;

                    let point = this.polygons.filter((polygon) => {
                        return polygon.polygon_id == key
                    }).shift();

                    if(point) {
                        this.centers[key].marker = new this.$google.maps.Marker({
                            map: this.map,
                            position: this.centers[key].center,
                            icon: `https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=${point.value}|FFFFFF|4a4a4a`,
                        });
                    }
                })
            },


            // createPolygonsArray() {
            //     this.map.data.forEach((feature) => {
            //         if (feature.getGeometry().getType() === 'Polygon') {
            //             let count = 0;
            //             let path = feature.getGeometry().getAt(0).getArray();
            //             let poly = new this.$google.maps.Polygon({
            //                 paths: path
            //             });
            //
            //             this.polygons[feature.getId()] = {path, poly, count};
            //         }
            //
            //         this.reset(feature);
            //     });
            // },

            iterate() {
                this.$store.commit('LOADING', true);
                this.map.data.forEach((feature) => {
                    this.reset(feature);
                    if (feature.getGeometry().getType() === 'Polygon') {

                        let polygon = this.polygons.filter((item) => {
                            return item.polygon_id == feature.getId()
                        }).pop();
                        
                        if (polygon) {
                            this.setFeatureStyle(feature, {
                                fillColor: this.ranges.get(polygon.value).color,
                                fillOpacity: 0.9
                            });
                        }
                    }
                });
                this.$store.commit('LOADING', false);
            },

            reset(feature) {
                if (feature.getGeometry().getType() === 'LineString') {
                    return this.map.data.overrideStyle(feature, {
                        strokeColor: tinycolor('#000000').setAlpha(0.15)
                    });
                }

                return this.setFeatureStyle(feature, {
                    fillColor: '#fff',
                    fillOpacity: 0,
                    strokeColor: tinycolor('#ffffff').setAlpha(0),
                    strokeWidth: 2
                });
            },

            getCenter(points) {

                let lowx, highx, lowy, highy,
                    lats = [],
                    lngs = [],
                    vertices = points;

                for (var i = 0; i < vertices.length; i++) {
                    lngs.push(vertices[i].lng());
                    lats.push(vertices[i].lat());
                }

                lats.sort();
                lngs.sort();
                lowx = lats[0];
                highx = lats[vertices.length - 1];
                lowy = lngs[0];
                highy = lngs[vertices.length - 1];
                let center_x = lowx + ((highx - lowx) / 2);
                let center_y = lowy + ((highy - lowy) / 2);
                return (new this.$google.maps.LatLng(center_x, center_y));

            },

            setFeatureStyle(feature, style) {
                this.map.data.overrideStyle(feature, style);
            },
        },

        mounted() {
            this.init()
        }
    }
</script>

