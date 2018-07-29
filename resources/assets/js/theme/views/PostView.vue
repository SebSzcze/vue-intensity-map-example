<template>
    <single-view
            :cover="cover"
            :lead="post.excerpt"
            :attachments="post.attachments"
            :header="false"
    >
        <template slot="lead:before">
            <small class="text-grey" v-text="post.published_at"></small>
            <h1 class="font-normal mb-8" v-text="post.title"></h1>
        </template>
        <div v-html="post.body"></div>
    </single-view>
</template>
<script>
    import SingleView from './SingleView';

    export default {
        name: "PostView",
        components: {SingleView},

        computed: {
            post() {
                return this.$store.state.current.item;
            },
            cover(){
                if(!this.post.photo) {
                    return;
                }
                return this.post.photo.sizes.cover.src
            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchPost', this.$route.params.id)
        }
    }
</script>
