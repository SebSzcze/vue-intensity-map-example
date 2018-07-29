<template>
    <section class="p-t-80">
        <div class="container">
            <div class="has-text-centered">
                <h2 class="title is-2 is-light">Aktualności</h2>
            </div>
            <div class="columns p-v-40 ">
                <div class="column is-4 has-text-centered" v-for="post in posts">
                    <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug } }" v-if="post.photo">
                        <img :src="post.photo.sizes.thumbnail.src" :alt="post.photo.title">
                    </router-link>
                    <h3 class="m-t-20 m-b-5 is-fz-3">
                        <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug } }" v-text="post.title"></router-link>
                    </h3>
                    <span class="is-fz-8 is-grey" v-text="post.published_at"></span>
                    <p class="is-fz-5 m-t-10 m-b-40" v-text="post.excerpt"></p>
                    <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug } }" class="button is-rounded is-outlined">
                        Czytaj więcej
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>
<script type="text/babel">
    export default {
        name: 'SectionPosts',
        props: {},
        // component variables
        data() {
            return {
            }
        },

        computed: {
            posts(){
                return storage.posts.data;
            }
        },
        methods: {},
        beforeCreate(){
            storage.fetchPosts(3)
        }

    }
</script>

