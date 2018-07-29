<template>
    <div class="modal is-page" ref="modal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="container">
                    <div class="is-flex">
                        <div class="modal-header-left">
                            <span class="label" v-if="entity.type" :class="entity.type.color_class" v-text="entity.type.name"></span>
                            <h1 class="title is-1">{{ entity.name }}</h1>
                            <strong class="entity-street" v-if="entity.street">
                                <i class="icon-pin"></i>
                                {{ entity.street.name }}
                            </strong>

                        </div>
                        <div class="is-right">
                            <router-link to="/" class="button is-rounded is-outlined">Wróć do mapy</router-link>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-module has-text-centered" v-if="entity.photo.sizes.cover">
                <img :src="entity.photo.sizes.cover.src" :alt="entity.name">
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-8">
                            <h2 class="title is-2">Informacje</h2>
                            <div class="content entity-body" v-html="entity.body"></div>
                            <h2 class="title is-2">Wydarzenia związane z tym miejscem</h2>
                        </div>
                        <div class="column is-4 entity-sidebar">
                            <googlemap
                                    v-if="entity.location && entity.location.lat"
                                    :markers="[ entity ]"
                                    :center="entity.location"
                                    height="300" ></googlemap>
                            <div v-else>
                                <polygon-map height="300" :color="entity.type ? entity.type.color : '#1f8994'"></polygon-map>
                            </div>

                            <div class="entity-share">
                                <h4 class="title is-6">Udostępnij ten obiekt</h4>

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
                            </div>
                            <div class="entity-meta content is-smaller" v-html="entity.meta"></div>
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
            entity(){
                return storage.activeEntity
            },
        },
        // component methods
        methods: {},
        // executes when component is created
        // executes when component is created
        beforeMount(){
            storage.fetchEntity(this.$route.params.id)
        },
        beforeDestroy(){
            document.body.classList.remove('is-modal-page')
            document.body.style.height = 'auto';
        },
        // executes when component is boot and ready to use
        mounted(){
            document.body.classList.add('is-modal-page')

            this.$nextTick(() => {
                let height = this.$refs.modal.offsetHeight
                document.body.style.height = height + 'px';
            })
        }
    }
</script>

