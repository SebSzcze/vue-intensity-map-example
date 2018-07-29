<template>
    <googlemap
            :markers="[]"
            :zoom="18"
            @loaded="init"
    ></googlemap>
</template>
<script type="text/babel">
    import tinycolor from 'tinycolor2'
    export default {
        name: 'PolyMap',
        props: {
            color: {
                default: "#000"
            }
        },
        // component variables
        data() {
            return {
                map: false
            }
        },

        computed: {},
        methods: {
            init(map){
                this.map = map
                this.$http.get('/js/map.geojson').then(({data}) => {
                    this.geojson = data
                    return this.setMapBounding();
                })
            },
            reset(feature) {
                if (feature.getGeometry().getType() === 'LineString') {
                    return this.map.data.overrideStyle(feature, {
                        strokeColor: tinycolor('#000000').setAlpha(0.15)
                    });
                }

                return this.map.data.overrideStyle(feature, {
                    fillColor: this.color,
                    fillOpacity: .6,
                    strokeColor: tinycolor(this.color).setAlpha(.8),
                    strokeWidth: 2
                });
            },
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
                    }
                    vm.reset(e.feature)

                });

                this.map.data.addGeoJson(this.geojson, {
                    idPropertyName: "id"
                })
            },
        },
    }
</script>

