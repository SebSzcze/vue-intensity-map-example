<template>
    <div class="li-notifications" v-if="notifications.length">
        <flash v-for="flash in notifications"
               :key="flash.id"
               :flash="flash"
               @close="remove"
        ></flash>
    </div>
</template>
<script type="text/babel">
    import uuid from 'uuid'
    import Flash from './Flash.vue'

    export default {
        name: 'FlashNotifications',
        // child components
        components: { Flash },
        // component variables
        data(){
            return {
                notifications: [],
            }
        },
        methods: {
            listen(){
                Event.listen('flash', (flash) => {
                    flash.id = uuid.v1();
                    this.notifications.push(flash);
                })
            },
            remove(index){
                this.notifications.splice(index, 1);
            }
        },

        mounted() {
            this.listen();
        },
    }
</script>

