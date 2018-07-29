<template>
    <button ref="button" class="button button--delete" :class="{ 'button--delete--working': isWorking() }"
            @touchend="cancel"
            @touchstart.prevent="trigerCounter"
            @mouseup="cancel"
            @mousedown.prevent="trigerCounter"
    >
        <lari-icon name="delete" v-show="!isWorking()"></lari-icon>
        <span class="button__counter is-strong" v-if="isWorking()" v-text="left"></span>
    </button>
</template>
<script type="text/babel">
    export default {
        name: 'DeleteItemAction',
        // properties defined with component
        props: {
            duration: {
                type: Number,
                default: 3
            },
            url: {
                required: true
            }
        },
        // component variables
        data(){
            return {
                counter: 0,
                status: 'init',
                timer: 0,
                secondaryTimer: 0
            }
        },
        // component methods
        methods: {
            handle(){
                this.$http.delete(this.url).then((response) => {
                    if(response.status == 200 && response.data.success){
                        this.$refs.button.closest('tr').classList.add('fadeOut')
                    }
                })
            },
            cancel(){
                if(this.status === 'execute'){
                    return;
                }

                this.reset();
            },
            isWorking(){
                return this.status === 'execute' || this.status === 'counting'
            },
            trigerCounter(){
                if(this.isWorking()){
                    return;
                }
                this.status = 'counting';
                this.countDown();
            },
            countDown(){
                this.timer = setTimeout(() => {
                    ++this.counter;

                    if (this.counter >= this.duration) {
                        this.status = 'execute';
                        clearTimeout(this.timer);
                        setTimeout(_ => {
                            this.reset();
                            this.handle();

                        }, 1000);
                        return;
                    }

                    this.countDown();
                },1000);
            },
            reset(){
                this.status = 'init';
                this.counter = 0;
                clearTimeout(this.timer);
            }
        },
        computed: {
            left(){
                return this.duration - this.counter;
            }
        },
        // executes when component is created
        created() {
            document.addEventListener('mouseup', () => this.cancel());
        },
        destroyed() {
            document.removeEventListener('mouseup', () => this.cancel());
        }
    }
</script>

<style>
    .button__counter{
        display: inline-block;
        padding: 0 3px;
    }
</style>