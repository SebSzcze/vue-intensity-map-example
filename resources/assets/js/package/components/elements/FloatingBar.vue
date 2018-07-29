<script type="text/babel">
    import EventListener from './../EventListener'

    export default {
        // properties defined with component
        props: {
            offset: {
                type: Number,
                default: 0
            }
        },
        // component variables
        data(){
            return {
                affixed: false,
                styles: {}
            }
        },
        // component methods
        methods: {
            scrolling() {
                const scrollTop = this.getScroll(window, true)
                const elementOffset = this.getOffset(this.$el)
                if (!this.affixed && scrollTop > 70) {
                    this.affixed = true
                    this.styles = {
                        top: this.offset + 'px',
                        left: elementOffset.left + 'px',
                        width: this.$el.offsetWidth + 'px'
                    }
                }
                if (this.affixed && scrollTop < 50) {
                    this.affixed = false
                    this.styles = {}
                }

            },
            // from https://github.com/ant-design/ant-design/blob/master/components/affix/index.jsx#L20
            getScroll(w, top) {
                let ret = w['page' + (top ? 'Y' : 'X') + 'Offset']
                const method = 'scroll' + (top ? 'Top' : 'Left')
                if (typeof ret !== 'number') {
                    const d = w.document
                    // ie6,7,8 standard mode
                    ret = d.documentElement[method]
                    if (typeof ret !== 'number') {
                        // quirks mode
                        ret = d.body[method]
                    }
                }
                return ret
            },
            getOffset(element) {
                const rect = element.getBoundingClientRect()
                const body = document.body
                const clientTop = element.clientTop || body.clientTop || 0
                const clientLeft = element.clientLeft || body.clientLeft || 0
                const scrollTop = this.getScroll(window, true)
                const scrollLeft = this.getScroll(window)
                return {
                    top: rect.top + scrollTop - clientTop,
                    left: rect.left + scrollLeft - clientLeft
                }
            }

        },
        // executes when component is boot and ready to use
        mounted(){
            this._scrollEvent = EventListener.listen(window, 'scroll', this.scrolling)
            this._resizeEvent = EventListener.listen(window, 'resize', this.scrolling)
        },
        beforeDestroy() {
            if (this._scrollEvent) {
                this._scrollEvent.remove()
            }
            if (this._resizeEvent) {
                this._resizeEvent.remove()
            }
        }
    }
</script>
<template>
    <transition name="HeaderSlideDown">
        <header class="actionbar" v-bind:class="{'vue-affix': affixed}" v-bind:style="styles">
            <div class="bar-left">
                <div class="bar-item bar-title">
                    <slot name="title"></slot>
                </div>
            </div>
            <slot></slot>
            <div class="bar-right">
                <slot name="actions"></slot>
            </div>
        </header>
    </transition>    
</template>
<style>
    .vue-affix {
        position: fixed !important;
        z-index: 10
    }
</style>
