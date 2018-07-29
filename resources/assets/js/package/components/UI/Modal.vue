<template>
    <div class="modal" v-if="opened" ref="modal" :class="{ 'modal--closing' : closing }">
        <slot name="before-header"></slot>
        <div class="modal-header">
            <div class="modal-header-row">
                <slot name="header"></slot>
            </div>
            <button class="modal-close" @click.prevent="close" v-if="showClose">
                <lari-icon name="close" :size="iconSize"></lari-icon>
            </button>
        </div>
        <div class="modal-content">
            <slot></slot>
        </div>
        <div class="modal-footer">
            <slot name="footer"></slot>
        </div>
        <slot name="after-footer"></slot>
    </div>
</template>
<script type="text/babel">
    const MODAL_BODY_CLASS = 'has-modal';
    export default {

        name: 'LariModal',
        // properties defined with component
        props: {
            iconSize: {
                type: Number,
                default: 36
            },
            show: {
                default: false
            },
            showClose: {
                default: true
            }
        },
        // component variables
        data(){
            return {
                opened: this.show,
                closing: false
            }
        },
        watch: {
            opened($new){
                if ($new) {
                    Event.fire('modal.opened', this.$refs.modal);
                    return document.body.classList.add(MODAL_BODY_CLASS);
                }
                this.closing = false;
                return document.body.classList.remove(MODAL_BODY_CLASS);
            },

            show($new) {
                this.opened = $new
            }
        },
        // component methods
        methods: {
            open(){
                this.opened = true
            },
            close(){
                this.closing = true
                setTimeout(() => {
                    this.opened = false
                },500)
            }
        },
        // executes when component is created
        created(){
            Event.listen('modal.open', this.open);
            Event.listen('modal.close', this.close);
        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>

