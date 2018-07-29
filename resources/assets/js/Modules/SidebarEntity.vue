<template>
    <div class="entity --side">
        <div class="entity-head">
            <router-link to="/" class="button is-right">Wróć</router-link>
        </div>
        <div class="entity-name">
            <span class="label" v-if="entity.type" :class="entity.type.color_class" v-text="entity.type.name"></span>
            <h3 class="title is-2">{{ entity.name }}</h3>
            <strong class="entity-street" v-if="entity.street">
                <i class="icon-pin"></i>
                {{ entity.street.name }}
            </strong>

        </div>
        <div class="entity-photo" v-if="entity.photo.sizes.thumbnail">
            <img :src="entity.photo.sizes.thumbnail.src" :alt="entity.name">
        </div>
        <div class="entity-content content">
            <h4 class="title">Informacje</h4>
            <p>{{ entity.excerpt }}</p>
        </div>

        <div class="entity-foot">
            <router-link :to="{ name: 'entity', params: { id: entity.id, slug: entity.slug } }" class="button is-primary is-rounded is-small">Zobacz szczegóły</router-link>
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
        watch: {
            entity($new, $old){

                jump('body')
            },
            id(){
                storage.fetchEntity(this.$route.params.id)
            },
        },
        computed: {
            entity(){
                return storage.activeEntity
            },
            id(){
                return this.$route.params.id
            }
        },
        // component methods
        methods: {},
        // executes when component is created
        created(){
            storage.fetchEntity(this.$route.params.id)
        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>

