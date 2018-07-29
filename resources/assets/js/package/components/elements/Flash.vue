<template>
    <transition name="fade">
        <div class="li-flash" :class="classes">
            <div class="li-flash__icon" v-if="parameters.icon">
                <lari-icon :name="parameters.icon"></lari-icon>
            </div>
            <div class="li-flash__body">
                <h5 class="title" v-if="parameters.title">{{ parameters.title }}</h5>
                <p v-html="message"></p>
            </div>
            <button class="li-flash__close" @click="close">
            </button>
        </div>
    </transition>
</template>
<script type="text/babel">
    export default {
        name: 'FlashMessages',
        props: {
            flash: {
                required: true
            },
        },
        // component variables
        data(){
            return {
                id: this.flash.id,
                message: this.flash.message,
                type: this.flash.type,
                parameters: this.flash.parameters
            }
        },
        computed: {
            classes(){
                return `is-${this.type}`
            }
        },
        methods: {
            close(){
                this.$emit('close', this.id)
            },
            startTimer(){
                if(this.parameters.important) {
                    return false; // do not close
                }

                setTimeout(() => {
                    this.close();
                }, this.parameters.timeout)
            },
        },
        mounted(){
            this.startTimer();
        }
    }
</script>

