<template></template>
<script>
    export default {
        name: "MapMarker",

        props: {
            data: {},
            draggable: {
                default: false
            },
            animation: {
                default: 'DROP'
            },
            title: {},
            icon: {},
            position: {
                required: true
            },

            map: {},

            options: {
                default: () => {
                    return {}
                }
            }
        },

        data() {
            return {
                marker: false
            }
        },

        computed: {
            deafultIcon(){
                return {
                    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
                    fillColor: "#1f8994",
                    fillOpacity: 1,
                    strokeColor: '#186d76',
                    strokeWeight: 2,
                    scale: 1,
                }
            }
        },

        methods: {
            create() {
                if (!this.position || !this.position.lat) return;
                const map = this.map || this.$store.state.map
                const icon = this.icon || this.deafultIcon

                this.marker = new this.$google.maps.Marker({
                    map,
                    draggable: this.draggable,
                    animation: this.$google.maps.Animation[this.animation],
                    position: this.position,
                    icon
                });


                this.marker.addListener('click',(e) => {
                    this.$emit('click', { marker: this.marker, data: this.data })
                })
            },

            destroy() {
                if (!this.marker) return;

                this.marker.setMap(null)
            }
        },

        beforeDestroy(){
            this.destroy()
        },

        created() {
            this.create()
        }
    }
</script>
