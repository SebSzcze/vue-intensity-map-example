<template>
    <div class="wrapper">
        <div class="map">
            <googlemap
                    :markers="[]"
                    :style="style"
                    :zoom="18"
                    @loaded="loaded"
            ></googlemap>
        </div>
        <sidebar class="sidebar--green">

            <h3 class="title is-4 is-white m-b-40" v-if="legend" v-text="legend.name"></h3>
            <p class="description" v-text="legend.description" v-if="legend && legend.description"></p>

            <div class="sidebar-entities__scroller" v-if="legend">
                <div v-for="group in legend.groups">
                    <h4 class="title is-5 is-white" v-if="legend.groups.length > 1" v-text="group.name"></h4>
                    <div v-for="attribute in group.attributes">
                        <div class="radio-item">
                            <input type="radio" class="radio" v-model="activeAttribute" :id="attribute.id" :value="attribute.id">
                            <label v-text="attribute.name" :for="attribute.id"></label>
                        </div>

                        <div class="radio-item-desc" v-if="attribute.info" v-text="attribute.info"></div>
                    </div>
                </div>
            </div>

            <div class="flex m-v-10">
                <h5 class="title is-6 is-white m-b-0">Legenda</h5>
                <label class="toggler m-l-auto">
                    <input type="checkbox" class="is-hidden" v-model="numerical">
                    <span class="is-white is-fz-7">Dane Liczbowe</span>
                    <i></i>
                </label>
            </div>
            <footer class="flex is-white is-fz-8 bg-white">
                <div class="flex:inline flex:1 flex:center p-v-5"
                     v-if="ranges.ranges"
                     v-for="range in ranges.ranges"
                     v-text="range.label"
                     :style="{  background: range.color, color: range.text }"
                ></div>
            </footer>
        </sidebar>
    </div>
</template>
<script>
    import tinycolor from 'tinycolor2'
    import LegendRange from './../range'


    export default {
        name: 'IntensityMap',
        // component variables
        data() {
            return {
                map: false,
                numerical: false,
                legend: {},
                geojson: '',
                locations: [],
                polygons: {},
                timer: false,
                activeAttribute: false,
                points: [],
            }
        },

        watch: {
            '$route'(to, from) {
                this.setLegend();
            },
            activeAttribute($new) {
                this.locations = this.points[this.activeAttribute]
                this.iterateFeatures()
            },

            locations($new) {
                this.iterateLocations($new)
            },

            polygons($new) {
                this.iterateFeatures()
            },

            legend($new, $old) {
                if ($old.color) {
                    this.fetchIntensity()
                }
            },
            numerical(numerical) {
                Object.keys(this.polygons).forEach(key => {
                    this.togglePolygonCounter(this.polygons[key], key)
                });
            }
        },

        computed: {
            style() {
                return {
                    minHeight: `${window.innerHeight - 70}px`,
                    height: `calc(100vh - 70px)`
                }
            },

            max() {
                return Math.max.apply(Math, Object.keys(this.polygons).map(id => this.polygons[id].count))
            },

            ranges() {
                return new LegendRange(this.max, this.legend.color)
            },

            mapType() {
                if (!this.$route.params.name) {
                    return 'pomoc-spoleczna'
                }

                return this.$route.params.name
            }
        },

        methods: {
            setMapBounding() {
                var bounds = new this.$google.maps.LatLngBounds();
                let vm = this

                this.$google.maps.event.addListener(this.map.data, 'addfeature', function (e) {
                    if (e.feature.getGeometry().getType() === 'Polygon') {
                        var polys = e.feature.getGeometry().getArray();
                        for (var i = 0; i < polys.length; i++) {
                            for (var j = 0; j < polys[i].getLength(); j++) {
                                bounds.extend(polys[i].getAt(j));
                            }
                        }
                        this.map.fitBounds(bounds);

                        vm.$set(vm.polygons, e.feature.getId(), {
                            path: e.feature.getGeometry().getAt(0).getArray(),
                            polygon: new vm.$google.maps.Polygon({
                                paths: e.feature.getGeometry().getAt(0).getArray()
                            }),
                            count: 0,
                        })
                    }
                    vm.reset(e.feature)

                });

                this.map.data.addGeoJson(this.geojson, {
                    idPropertyName: "id"
                })
            },

            fetchIntensity() {
                return this.$http.get('/api/intensity/' + this.$route.params.name).then(({data}) => {
                    this.points = data

                    this.$nextTick(() => {
                        this.activeAttribute = this.legend.groups[0].attributes[0].id
                        this.$Progress.finish();
                    })
                })
            },

            reset(feature) {
                if (feature.getGeometry().getType() === 'LineString') {
                    return this.map.data.overrideStyle(feature, {
                        strokeColor: tinycolor('#000000').setAlpha(0.15)
                    });
                }
                return this.map.data.overrideStyle(feature, {
                    fillColor: '#fff',
                    fillOpacity: 0,
                    strokeColor: tinycolor('#ffffff').setAlpha(0),
                    strokeWidth: 2
                });
            },


            iterateLocations($new) {
                this.filteredLocations = $new
                Object.keys(this.polygons).forEach((p) => {
                    let item = this.polygons[p]
                    item.count = 0

                    this.filteredLocations.forEach((point, index) => {
                        let cords = new this.$google.maps.LatLng(point.lat, point.lng)

                        if (this.$google.maps.geometry.poly.containsLocation(cords, item.polygon)) {
                            item.count = parseInt(item.count) + parseInt(point.value);

                            this.$set(this.polygons, p, item)
                        }
                    })
                })
            },

            iterateFeatures() {
                this.$nextTick(() => {
                    this.map.data.forEach((feature) => {
                        this.reset(feature)
                        this.$nextTick(() => {
                            this.togglePolygonCounter(this.polygons[feature.getId()], feature.getId())
                        });

                        if (feature.getGeometry().getType() === 'Polygon' && this.ranges.get(this.polygons[feature.getId()].count)) {

                            this.setStyle(feature, {
                                fillColor: this.ranges.get(this.polygons[feature.getId()].count).color,
                                fillOpacity: 0.9
                            })
                        }
                    })
                })
            },

            togglePolygonCounter(polygon, key = null) {
                if (polygon.marker) {
                    polygon.marker.setMap(null)
                }

                if (polygon.count < 1) return;
                if (!this.numerical) return;

                const position = this.getCenter(polygon.polygon);

                polygon.marker = new this.$google.maps.Marker({
                    map: this.map,
                    position,
                    icon: `http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=${polygon.count}|FFFFFF|4a4a4a`,
                });

                this.$set(this.polygons, key, polygon)
            },


            setStyle(feature, style) {
                this.map.data.overrideStyle(feature, style);
            },

            getLegendBackground(i) {
                return tinycolor(this.legend.color).setAlpha(i / this.divider)
            },
            loaded(map) {
                this.map = map
                let vm = this

                this.$http.get('/js/map.geojson').then(({data}) => {
                    this.geojson = data
                    return this.setMapBounding();
                }).then(() => {
                    this.fetchIntensity()
                });


                return;

                this.fetchIntensity().then(() => {
                    this.$http.get('/api/intensity').then(({data}) => {
                        this.locations = data
                    }).then(() => {


                        this.map.data.forEach((feature) => {

                            if (feature.getGeometry().getType() === 'Polygon') {
                                var polyPath = feature.getGeometry().getAt(0).getArray();
                                var poly = new this.$google.maps.Polygon({
                                    paths: polyPath
                                });


                                this.intensity[feature.getId()] = {
                                    poly,
                                    path: polyPath,
                                    count: 0
                                }

                                this.locations.forEach((location) => {
                                    let l = new this.$google.maps.LatLng(location.lat, location.lng)
                                    if (this.$google.maps.geometry.poly.containsLocation(l, poly)) {
                                        this.intensity[feature.getId()].count = this.intensity[feature.getId()].count + location.value
                                    }
                                })


                                this.max = Math.max.apply(Math, Object.keys(this.intensity).map(id => this.intensity[id].count))

                                this.legend.range = new LegendRange(this.max, this.legend.color)


                                // let max = Object.keys(this.intensity).reduce((prev, current) => {
                                //     if(this.intensity[prev]) {
                                //         return this.intensity[prev].count > this.intensity[current].count ? this.intensity[prev] : this.intensity[current]
                                //     }
                                //
                                //     return this.intensity[current].count
                                // })
                                //
                                // console.log(this.intensity[max].count);
                                // console.log(markersData);


                                // this.locations.forEach((location) => {
                                //     console.log("jest");
                                //     if(vm.$google.maps.geometry.poly.containsLocation(location, poly)) {
                                //         console.log("true");
                                //     }
                                // })

                                // dataContains.forEach(function (data) {
                                //     var point = data[0];
                                //     var info = data[1];
                                //
                                //     if (vm.$google.maps.geometry.poly.containsLocation(point, poly)) {
                                //         for (m = 0; m < markersData.length; m++) {
                                //             markersData[m] += info[m];
                                //         }
                                //     }
                                // });

                                // console.log("Markers Data : " + markersData.toString());

                                var icon = {
                                    url: "api/images/marker_icon.png", // url
                                    scaledSize: new this.$google.maps.Size(25, 25), // scaled size
                                    origin: new this.$google.maps.Point(0, 0), // origin
                                    anchor: new this.$google.maps.Point(12.5, 12.5) // anchor
                                };

                                var marker = new this.$google.maps.Marker({
                                    // position: poly.getApproximateCenter(),
                                    visible: false,
                                    map: this.map,
                                    animation: vm.$google.maps.Animation.DROP,
                                    icon: icon
                                });

                                // let f = 0;
                                // for (f = 0; f < markersData.length; f++) {
                                //     feature.setProperty("Layer_" + f.toString(), markersData[f]);
                                // }

                                feature.setProperty("Marker", marker);


                            }

                            // if(feature.getGeometry().getType() === 'LineString') {
                            //     this.map.data.overrideStyle(feature, {
                            //         strokeColor: tinycolor('#b4b4b4'),
                            //         strokeWeight: 5
                            //     });
                            // }

                            let range = this.legend.range.get(this.intensity[feature.getId()].count);
                            this.map.data.overrideStyle(feature, {
                                fillColor: tinycolor(this.legend.color).setAlpha(0),
                                strokeColor: tinycolor(this.legend.color).setAlpha(0)
                            });

                            if (range) {
                                this.map.data.overrideStyle(feature, {
                                    fillColor: range.color,
                                    strokeColor: tinycolor(this.legend.color).setAlpha(0)
                                });
                            }


                            if (feature.getGeometry().getType() === 'LineString') {
                                this.map.data.overrideStyle(feature, {
                                    strokeColor: tinycolor('#b4b4b4'),
                                    strokeWeight: 5
                                });
                            }

                        })


                        if (feature.getGeometry().getType() === 'LineString') {
                            this.map.data.overrideStyle(feature, {
                                strokeColor: tinycolor('#b4b4b4'),
                                strokeWeight: 5
                            });
                        }
                        /// koniec
                    })
                })


                return;

                this.$http.get('/intensity/api/data/map.geojson').then(({data}) => {
                    this.geoJSON = data

                    var bounds = new this.$google.maps.LatLngBounds();

                    this.$google.maps.event.addListener(this.map.data, 'addfeature', function (e) {
                        if (e.feature.getGeometry().getType() === 'Polygon') {
                            var polys = e.feature.getGeometry().getArray();
                            for (var i = 0; i < polys.length; i++) {
                                for (var j = 0; j < polys[i].getLength(); j++) {
                                    bounds.extend(polys[i].getAt(j));
                                }
                            }
                            this.map.fitBounds(bounds);
                        }
                    });

                    this.map.data.addGeoJson(data)

                    this.$http.get('/api/intensity').then(({data}) => {
                        this.locations = data
                    });

                    this.$google.maps.Polygon.prototype.getBoundingBox = function () {
                        var bounds = new vm.$google.maps.LatLngBounds();
                        this.getPath().forEach(function (element, index) {
                            bounds.extend(element)
                        });
                        return (bounds);
                    };


                    this.map.data.forEach((feature) => {

                        if (feature.getGeometry().getType() === 'Polygon') {
                            var polyPath = feature.getGeometry().getAt(0).getArray();
                            var poly = new this.$google.maps.Polygon({
                                paths: polyPath
                            });

                            var markersData = Array(44).fill(0);
                            // console.log(markersData);


                            this.locations.forEach((location) => {
                                console.log("jest");
                                if (vm.$google.maps.geometry.poly.containsLocation(location, poly)) {
                                    console.log("true");
                                }
                            })

                            dataContains.forEach(function (data) {
                                var point = data[0];
                                var info = data[1];

                                if (vm.$google.maps.geometry.poly.containsLocation(point, poly)) {
                                    for (m = 0; m < markersData.length; m++) {
                                        markersData[m] += info[m];
                                    }
                                }
                            });

                            // console.log("Markers Data : " + markersData.toString());

                            var icon = {
                                url: "api/images/marker_icon.png", // url
                                scaledSize: new this.$google.maps.Size(25, 25), // scaled size
                                origin: new this.$google.maps.Point(0, 0), // origin
                                anchor: new this.$google.maps.Point(12.5, 12.5) // anchor
                            };

                            var marker = new this.$google.maps.Marker({
                                position: poly.getApproximateCenter(),
                                visible: false,
                                map: this.map,
                                animation: vm.$google.maps.Animation.DROP,
                                icon: icon
                            });

                            let f = 0;
                            for (f = 0; f < markersData.length; f++) {
                                feature.setProperty("Layer_" + f.toString(), markersData[f]);
                            }

                            feature.setProperty("Marker", marker);


                        }

                        if (feature.getGeometry().getType() === 'LineString') {
                            this.map.data.overrideStyle(feature, {
                                strokeColor: tinycolor('#b4b4b4'),
                                strokeWeight: 5
                            });
                        }

                    })


                    this.map.data.setStyle((feature) => {
                        if (feature.getGeometry().getType() === 'LineString') return;

                        let color = '#F9ACAA'

                        return ({
                            fillColor: color,
                            fillOpacity: 0.4,
                            strokeColor: tinycolor(color),
                            strokeWeight: 0.2
                        });

                    })
                })
            },

            setLegend() {
                this.$Progress.start()
                this.legend = storage.legends.filter((item) => {
                    return item.key == this.mapType
                }).shift()
            },

            getCenter(polygon) {

                let lowx, highx, lowy, highy,
                    lats = [],
                    lngs = [],
                    vertices = polygon.getPath();

                for (var i = 0; i < vertices.length; i++) {
                    lngs.push(vertices.getAt(i).lng());
                    lats.push(vertices.getAt(i).lat());
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
            }
        },

        beforeMount() {
            storage.fetchLegends().then(() => {
                this.setLegend();
            }).then(() => {


            })
        },
    }
</script>

