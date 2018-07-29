<template>
        <div ref="map" :style="style">
        </div>
</template>
<script type="text/babel">

    export default {
        name: 'GoogleMap',

        // component variables
        props: {
            height: {
                default: '500'
            },
            width: {
                default: '100%'
            },

            options: {
                default: () => {
                    return {
                        styles:[
                            {
                                "featureType": "administrative.locality",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "hue": "#2c2e33"
                                    },
                                    {
                                        "saturation": 7
                                    },
                                    {
                                        "lightness": 19
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "hue": "#ffffff"
                                    },
                                    {
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": 100
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "hue": "#ffffff"
                                    },
                                    {
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": 100
                                    },
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "hue": "#bbc0c4"
                                    },
                                    {
                                        "saturation": -93
                                    },
                                    {
                                        "lightness": 31
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "labels",
                                "stylers": [
                                    {
                                        "hue": "#bbc0c4"
                                    },
                                    {
                                        "saturation": -93
                                    },
                                    {
                                        "lightness": 31
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "labels",
                                "stylers": [
                                    {
                                        "hue": "#bbc0c4"
                                    },
                                    {
                                        "saturation": -93
                                    },
                                    {
                                        "lightness": -2
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "hue": "#e9ebed"
                                    },
                                    {
                                        "saturation": -90
                                    },
                                    {
                                        "lightness": -8
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "hue": "#e9ebed"
                                    },
                                    {
                                        "saturation": 10
                                    },
                                    {
                                        "lightness": 69
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "all",
                                "stylers": [
                                    {
                                        "hue": "#e9ebed"
                                    },
                                    {
                                        "saturation": -78
                                    },
                                    {
                                        "lightness": 67
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            }
                        ]
                    }
                }
            },
            markers: {
                default: false
            },
            markersOptions: {
                default: () => {
                    return {
                        draggable: false
                    }
                }
            },
            center: {
                default: () => {
                    return {
                        lat: 51.84594220807163,
                        lng: 16.569267557116735
                    }
                }
            },


        },

        data(){
            return {
                map: '',
                geocoder: '',
                mapOptions: {
                    center: this.center,
                    zoom: 14,
                    mapTypeControl: false,
                    scrollwheel: false
                },
                gMarkers: []
            }
        },
        computed: {
            isLibraryLoaded(){
                return typeof this.$google != 'undefined'
            },
            calculatedHeight(){
                let isPercentage = this.height.includes('%');

                if(!isPercentage) {
                    return `${this.height}px`
                }
                return this.height
            },
            calculatedWidth(){
                let isPercentage = this.width.includes('%');

                if(!isPercentage) {
                    return `${this.width}px`
                }
                return this.width
            },
            style(){
                let height = this.calculatedHeight;
                let width = this.calculatedWidth;

                return {
                    width,
                    height
                }
            },
        },
        watch: {
            markers($new, $old){
                if(this.isLibraryLoaded) {
                }
                this.resetMarkers();
            }
        },
        /**
         * Methods
         */
        methods: {
            init(){
                let options = Object.assign(this.mapOptions, this.options)

                this.map = new this.$google.maps.Map(this.$refs.map, options);

                this.resetMarkers();
                this.bounds();

                this.$emit('loaded', this.map)
            },
            setCenter(location){
                this.map.setCenter(location)
            },
            removeMarker(marker){
                marker.setMap(null)
            },

            resetMarkers(){
                this.gMarkers.forEach((marker) => {
                    this.removeMarker(marker);
                });
                this.markers.forEach((marker) => {
                    this.gMarkers.push(
                        this.createMarker(marker.position, marker)
                    );
                })
            },

            createMarker(position, m, loop = true){

                const defaultIcon = {
                    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
                    fillColor: "#1f8994",
                    fillOpacity: 1,
                    strokeColor: '#186d76',
                    strokeWeight: 2,
                    scale: 1,
                }

                let icon = m.icon ? m.icon : defaultIcon
                let title = m.title

                let marker = new this.$google.maps.Marker({
                    map: this.map,
                    draggable: this.markersOptions.draggable,
                    animation: google.maps.Animation.DROP,
                    position,
                    title,
                    icon
                });
                marker.addListener('click', (e) => {
                    this.$emit('markerclicked', m)


                    this.gMarkers.forEach((_marker) => {
                        _marker.setAnimation(null)
                    })
                    marker.setAnimation(google.maps.Animation.BOUNCE)
                });
                this.$emit('marker.added', marker);

                if(this.markersOptions.draggable) {
                    this.$google.maps.event.addListener(marker, "dragend", event => {
                        let location = {
                            lat: event.latLng.lat(),
                            lng: event.latLng.lng(),
                            title: marker.title
                        };
                        this.$emit('dragend', location)
                    });
                }


                if(m.locations && loop) {
                    m.locations.forEach((child) => {
                        this.gMarkers.push(
                            this.createMarker(child.position, m, false)
                        );
                    })
                }

                return marker;
            },

            listen(){
                    Event.listenOnce('googlemaps.loaded', () => {
                        this.init();
                    });


                this.$parent.$on('locate', (point) => {
                    this.setCenter(point);
                    this.marker = [];

                    this.markers.push(point);
                })

                this.$on('center', point => {
                    this.setCenter(point)
                })

                this.$parent.$on('map.center', (point) => {
                    this.setCenter(point)
                })
            },

            bounds(){
                let _t = this
                this.map.data.loadGeoJson('/api/boundaries.json');
                this.map.data.setStyle(function(feature) {
                    var color = 'rgba(0,0,0,.4)';
                    if (feature.getProperty('isColorful')) {
                        color = '#1F8994';
                    }
                    return /** @type {google.maps.Data.StyleOptions} */({
                        fillColor: color,
                        strokeColor: color,
                        strokeWeight: 4
                    });
                });

                this.map.data.addListener('click', function(event) {
                    if(event.feature.getProperty('isColorful')) {
                        return event.feature.setProperty('isColorful', false);
                    }
                    _t.$router.push({
                        name: 'sidebar',
                        params: {
                            id: 1,
                            slug: "nowe-tory-centrum-leszna-po-kolei"
                        }
                    });
                    event.feature.setProperty('isColorful', true);
                });

            },

        },
        beforeMount(){

            this.listen()

        },
        mounted(){
            if(this.isLibraryLoaded) {
                this.init()
            }
        },
    }
</script>

