<template>
    <section class="py-8">
        <div class="container py-8 my-8">
            <h2 class="text-center">Aktualności</h2>
            <div class="flex md:-mx-4 py-8 flex-wrap">
                <post-content v-for="post in posts" :post="post" :key="post.id"></post-content>
            </div>
        </div>
    </section>
</template>

<script>
    import PostContent from './../content/Post'

    export default {
        name: "PostRow",

        components: {PostContent},

        computed: {
            posts() {
                return this.$store.state.posts.data
            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchPosts', {
                take: 3,
                cacheable: true
            })
        }
    }
</script>

