<template>
    <div class="fixed z-50 bg-white pin-b pin-l pin-r p-4" v-if="show">
        <div class="flex lg:px-16">
            <div class="flex-1">
                <p class="mb-0 text-base">Korzystanie z niniejszej witryny oznacza zgodę na wykorzystywanie plików cookies. Zmiany warunków przechowywania lub uzyskiwania dostępu do plików cookies można dokonać w każdym czasie.</p>
            </div>
            <div class="px-8">
                <button type="button" @click.prevent="close" class="font-sans text-grey-darkest font-semibold px-6">Zamknij</button>
                <a is="router-link" href="/regulamin" to="/regulamin" class="text-xs text-grey">Więcej informacji</a>
            </div>
        </div>
    </div>
</template>
<script>
    const COOKIE_KEY_NAME = 'policy-closed'
    import cookie from 'js-cookie';
    export default {
        name: "PolicyBar",
        data(){
            return {
                show: false
            }
        },

        computed: {
            closed(){
                return cookie.get(COOKIE_KEY_NAME) == "true" ? true : false
            }
        },

        methods: {
            close(){
                let days = 60 * 60 * 24 * 1000 * 30
                cookie.set(COOKIE_KEY_NAME , true, { expires: new Date(Date.now() + days) });

                this.show = false
            }
        },


        mounted(){
            if(!this.closed) this.show = true
        }
    }
</script>

<style scoped>

</style>
