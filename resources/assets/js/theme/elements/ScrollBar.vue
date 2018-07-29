<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    import Scrollbar from 'perfect-scrollbar'

    export default {
        name: "ScrollBar",

        data() {
            return {
                scrollbar: false
            }
        },

        methods: {
            init(){
                this.scrollbar = new Scrollbar(this.$el)
            },

            destroy(){
                this.scrollbar.destroy();
            }
        },

        mounted(){
            this.init()
        },

        beforeDestroy(){
            this.destroy();
        },
        deactivated(){
            this.destroy();
        }
    }
</script>
