<template>
    <lari-input label="Wpisz wyszukiwany adres" @input="update">
        <button class="button is-transparent" @click.prevent="removeMarker">
            <icon name="delete"></icon>
        </button>
    </lari-input>
</template>
<script type="text/babel">
    export default {
        name: 'GoogleMapGeocoder',
        props: {
            prefix: {
                default: ''
            }
        },
        // component variables
        data(){
            return {
                geocoder: '',
                timer: '',
                query: ''
            }
        },
        watch: {
            query($new, $old){
                if(this.timer) {
                   clearTimeout(this.timer)
                }
                this.timer = setTimeout(() => {
                        this.locate()
                }, 500)
            },
        },
        computed: {
            address(){
                return this.prefix + this.query
            },

        },
        methods: {
            locate(){
                let component = this
                this.geocoder = new this.$google.maps.Geocoder();
                this.geocoder.geocode({ address: this.address }, (results, status) => {
                    if(status !== component.$google.maps.GeocoderStatus.OK){
                        return;
                    }
                    
                    component.$emit('locate', {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    });
                });
            },

            removeMarker(){
                this.$emit('remove');
            },

            update(value){
                this.query = value
            }
        },

    }
</script>

