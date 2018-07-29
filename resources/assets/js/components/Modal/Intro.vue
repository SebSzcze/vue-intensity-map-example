<template>
    <div class="modal is-intro" v-show="show" :class="{ 'is-closed': !show }">
        <div class="modal-box has-content-centered">
            <div class="modal-header">
                <div class="visual">
                    <div class="visual-top"></div>
                    <div class="visual-box">
                        <div class="visual-box-icon --social"><img src="/images/social.svg" alt=""></div>
                        <div class="visual-box-icon --building"><img src="/images/building.svg" alt=""></div>
                        <div class="visual-box-logo"><img src="/images/rewitalizacja-leszna.svg" alt=""></div>
                        <div class="visual-box-icon --park"><img src="/images/park.svg" alt=""></div>
                        <div class="visual-box-icon --cog"><img src="/images/cog.svg" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <slot></slot>
                <p class="p-40"><a @click.prevent="hideModal" href="#" class="button is-primary is-large"
                                   v-text="this.btnLabel"></a></p>
            </div>
        </div>
    </div>
</template>
<script type="text/babel">
    export default {
        name: 'IntroModal',
        // properties defined with component
        props: {
            btnLabel: {
                default: 'Rozpocznij zwiedzanie'
            }
        },
        // component variables
        data(){
            return {
                show: false
            }
        },
        // component methods
        methods: {
            showModal(){
                this.show = true
            },
            hideModal(){
                this.show = false
            },
            checkIfNeedsToBeShown(){
                let show = this.$cookie.get('modal.seen');

                this.$cookie.set('modal.seen', true, 30);

                return !show;
            }
        },
        // executes when component is created
        created(){

        },
        mounted() {
            this.$nextTick(() => {
                if (this.checkIfNeedsToBeShown()) {
                    this.showModal()
                }
            })

        }
    }
</script>

