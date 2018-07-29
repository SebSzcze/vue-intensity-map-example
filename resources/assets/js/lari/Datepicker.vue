<template>
    <div>
        <flat-pickr v-model="date" :config="config" :name="name"></flat-pickr>
    </div>
</template>
<script type="text/babel">
    import { pl } from 'flatpickr/dist/l10n/pl';
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';

    export default {
        name: 'LariDatepicker',
        // properties defined with component

        components: {flatPickr},

        props: {
            value: {
                default: ''
            },
            name: {

            }
        },
        // component variables
        data(){
            return {
                date: this.value,
                config: {
                    locale: pl,
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                }
            }
        },
        // component methods
        methods: {},
        // executes when component is created
        created(){

        },
        mounted() {
        }
    }
</script>

