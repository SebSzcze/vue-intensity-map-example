<template>
    <div>
        <slot name="clickable"></slot>
        <slot v-if="show">

        </slot>
    </div>
</template>
<script type="text/babel">
    export default {
        name: '',
        // properties defined with component
        props: {

        },
        // component variables
        data(){
            return {
                show: false
            }
        },
        // component methods
        methods: {
            toggle(){
                this.show = !this.show
            }
        },
        // executes when component is created
        created(){

        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>

