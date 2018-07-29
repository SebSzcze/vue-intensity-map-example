<template>
    <div class="modal is-page" ref="modal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="container">
                    <div class="is-flex">
                        <div class="modal-header-left">
                            <h1 class="title is-1">{{ event.title }}</h1>
                            <span class="label">{{ event.date.day }} {{ event.date.month }} {{ event.date.year }}</span>
                        </div>
                        <div class="is-right">
                            <router-link to="/wydarzenia" class="button is-rounded is-outlined">Wróć do wydarzeń</router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-module has-text-centered" v-if="event.photo">
                <img :src="event.photo.sizes.cover.src" :alt="event.title">
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-8">
                            <h2 class="title is-3">Informacje</h2>
                            <div v-html="event.body"></div>
                        </div>
                        <div class="column is-4">
                            <div class="entity-share">
                                <h4 class="title is-6">Udostępnij</h4>

                                <social-sharing url="/" inline-template>
                                    <div class="entity-share-links">
                                        <network network="facebook">
                                            Facebook
                                        </network>
                                        <network network="googleplus">
                                            Google +
                                        </network>
                                        <network network="linkedin">
                                            LinkedIn
                                        </network>

                                        <network network="twitter">
                                            Twitter
                                        </network>
                                    </div>
                                </social-sharing>

                                <div class="m-t-40" v-if="event.attachments && event.attachments.length">
                                    <h4 class="title is-6">Załączniki</h4>
                                    <ul>
                                        <li v-for="attachment in event.attachments">
                                            <a :href="attachment.src" v-text="attachment.caption"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>
<script type="text/babel">
    export default {
        // properties defined with component
        props: {},
        // component variables
        data(){
            return {}
        },
        computed: {
            event(){
                return storage.activeModel
            },
        },
        // component methods
        methods: {},
        // executes when component is created
        // executes when component is created
        beforeMount(){
            storage.fetchEvent(this.$route.params.id)
        },
        beforeDestroy(){
            document.body.classList.remove('is-modal-page')
            document.body.style.height = 'auto';
        },
        // executes when component is boot and ready to use
        mounted(){
            document.body.classList.add('is-modal-page')
            jump('body');
            this.$nextTick(() => {
                let height = this.$refs.modal.offsetHeight
                document.body.style.height = height + 'px';
            })
        }
    }
</script>

