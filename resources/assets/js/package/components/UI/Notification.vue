<script type="text/babel">
    export default {
        props: {
            type: {
                default: 'info'
            },
            time: {
                default: 3
            },
            important: {
                default: false
            },
            absolute: {
                default: false
            }
        },
        data() {
            return {
                visible: true
            }
        },
        methods: {
            show(){
                this.visible = true
            },
            hide(){
                this.visible = false
            }
        },
        computed: {
            css_class(){
                return `is-${this.type}`
            }
        },
        mounted(){
            if (!this.important) {
                const self = this
                setTimeout(() => {
                    self.hide();
                }, self.time * 1000)
            }
        }
    }
</script>
<template>
    <transition name="box-slide-down">
    <div class="notification" v-show="visible" :class="[css_class, absolute ? 'is-absolute' : '']">
        <slot></slot>
        <button @click.prevent="hide" class="delete"></button>
    </div>
    </transition>
</template>
