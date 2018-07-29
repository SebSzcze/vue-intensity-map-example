<template>
    <transition name="slideToLeft">
        <div class="w-100  shadow-lg pt-24 px-4 flex flex-col leading-normal relative" v-show="show && showSidebar" :class="classes">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "Sidebar",
        props: {
            color: {
                default: 'teal'
            },

            text: {
                default: 'white'
            }
        },

        data(){
            return {
                show: false
            }
        },

        computed: {
            classes() {
                let classes = [
                    `bg-${this.color}`,
                    `bg-${this.color}-gradient`,
                ]

                if (this.text) {
                    classes.push(`text-${this.text}`)
                }

                return classes;
            },
            showSidebar(){
                return this.$store.state.sidebar;
            }
        },

        methods: {
            toggle(){
                this.show = !this.show
            }
        },

        beforeCreate(){
            this.$set(this.$route.params, 'hasSidebar', true)
        },
        mounted(){
            this.show = true
        }
    }
</script>
