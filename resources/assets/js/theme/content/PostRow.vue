<template>
    <article class="flex md:px-4 w-full pb-8 md:pb-16">
        <router-link :to="route" class="block mr-8 flex-none">
            <img :src="post.photo.sizes.thumbnail.src" :alt="post.photo.title">
        </router-link>
        <div class="">
            <h3>
                <router-link :to="route" v-text="post.title"></router-link>
            </h3>
            <small class="text-grey block mb-2" v-text="post.published_at"></small>
            <p v-text="post.excerpt"></p>
        </div>

    </article>
</template>

<script>
    export default {
        name: "Post",

        props: {
            post: {
                require: true
            }
        },

        computed: {
            route() {
                return {name: 'PostView', params: Object.assign(this.post, {showBackBtn: true})}
            }
        }
    }
</script>
