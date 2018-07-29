<template>
    <single-view
            cover=""
            :attachments="post.attachments"
            :header="false"
    >
        <template slot="lead:before">
            <small class="text-grey" v-text="post.published_at"></small>
            <h1 class="font-normal mb-8" v-text="post.title"></h1>
        </template>
            <div class="text-center" v-if="!post.id">
                <h1>404 Nie znaleziono</h1>
                <p>Strona, której szukasz nie mogła zosta znaleziona</p>
            </div>
        <div v-html="post.body"></div>
    </single-view>
</template>

<script>
    import SingleView from './SingleView';

    export default {
        name: "PageView",
        components: {SingleView},

        computed: {
            post() {
                return this.$store.state.current.item;
            },
        },

        watch :{
            "$route.params.slug"(slug){
                this.$store.dispatch('fetchPage', slug).catch((res) => {
                })
            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchPage', this.$route.params.slug)
        }
    }
</script>

