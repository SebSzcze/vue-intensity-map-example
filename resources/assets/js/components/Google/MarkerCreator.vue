<template>
    <div class="is-relative">
        <input type="hidden" name="locations" v-if="multiple" :value="json">
        <input type="hidden" :name="field">
        <input v-for="key in fields" type="hidden" :name="field + '[' + key + ']'" v-if="form[key]"  v-model="form[key]">
        <geocoder v-if="geocoderOptions.enabled"
                  :prefix="geocoderOptions.prefix"
                  @locate="locate"
                  @remove="removeMarkers"
        ></geocoder>
        <div class="mt-2 mr-12 pin-r absolute z-1" v-if="markers.length">
         <button v-if="multiple" @click.prevent="addMarker" class="bg-grey-light rounded text-xs px-2 leading-loose text-grey-dark  ">
            <icon name="pin_plus"></icon> Dodaj
        </button>
            <button class="bg-grey-light rounded text-xs px-2 leading-loose text-grey-dark" @click.prevent="removeMarkers">
                <icon name="delete"></icon> Wyczyść
            </button>
        </div>

        <googlemap
                :options="{ zoom: 15, mapTypeControl: true }"
                :markers="markers"
                :markers-options="{ draggable: true }"
                :center="center"
                @markerclicked="clicked"
                @dragend="update"
        ></googlemap>
    </div>
</template>
<script type="text/babel">
    import Geocoder from './Geocoder';
    export default {
        name: 'GoogleMarkerCreator',
        components: {
            Geocoder
        },
        props: {
            geocoderOptions: {
                default: () => {
                    return {
                        enabled: false,
                        prefix: ''
                    }
                }
            },
            field: {
                default: 'position'
            },
            height: {},
            width: {},
            marker: {},
            center: {},
            multiple: {
                default: false
            },
            locations: {}
        },
        // component variables
        data(){
            return {
                markers: [],
                form: {
                    lat: '',
                    lng: ''
                },
                fields: ['lat', 'lng']
            }
        },

        computed: {
            count(){
                return this.markers.length + 1;
            },

            json(){
                let list = this.markers.filter((item) => {
                    if(!this.form.title && this.count === 2) {
                        return;
                    }
                    if(!this.form.title && this.count > 2) {
                        return item.title !== 'id-1';
                    }
                    return item.title !== this.form.title;
                });

                return JSON.stringify(list)
            },
        },

        methods: {
            locate(marker){
                this.$emit('locate', marker)
                this.removeMarkers()
                this.markers.push({ title: "id-1",  position: marker })
                this.update(marker)
            },

            addMarker(){

                this.markers.push({ title: `id-${this.count}`, position: {
                    lat: 51.8338643,
                    lng: 16.5727437
                }})
            },

            removeMarkers(){
                this.markers = [];
                this.form = {
                    lat: '',
                    lng: ''
                }
            },

            update(position){
                this.form = position

                let item = this.markers.filter((item) => {
                    return item.title === position.title
                }).shift();

                
                let index = this.markers.indexOf(item);
                if(this.markers[index]) {
                this.markers[index].position = {
                    lat: position.lat,
                    lng: position.lng
                }
                }
            },

            clicked($m){
            },
        },
        mounted(){
            if(this.marker) {
                this.markers.push({ title: "id-0", position: this.marker })
                this.update(this.marker)
            }
            if(this.locations && this.multiple) {
                this.locations.forEach((m, index) => {
                    this.markers.push(m)
                })
            }
        }
    }
</script>

