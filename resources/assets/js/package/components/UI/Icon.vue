<template>
    <i :class="classes"></i>
</template>
<script type="text/babel">
    import Icon from './../../utils/icons'
    export default {
        name: 'LariIcon',
        // properties defined with component
        props: {
            name: {
                type: String
            },
            size: {},
        },
        // component variables
        data(){
            return {}
        },
        computed: {
            classes() {
                let sizeClass = '';
                if(this.size){
                    sizeClass = `is-${this.size}`;
                }
                return [ Icon[this.name], sizeClass]
            },
        }
    }
</script>

