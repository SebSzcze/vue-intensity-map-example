<template>
    <div class="pt-18">
        <div class="container">
            <header class="py-8">
                <div class="container  flex justify-center">
                    <h1 class="font-normal">Aktualności</h1>
                </div>
            </header>
            <div class="py-8">
                <post-content v-for="post in posts.data" :post="post" :key="post.id"></post-content>

                <div class="flex items-center justify-center" v-if="showPaginator">
                    <button class="bg-grey-lighter text-teal px-8 rounded py-2 font-semibold leading-normal mr-4" v-if="page > 1" @click="page--">Nowsze</button>
                    <button class="bg-grey-lighter text-teal px-8 rounded py-2 font-semibold leading-normal" v-if="page != posts.last_page"  @click="page++">Starsze</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import PostContent from './../content/PostRow';
    const POSTS_PER_PAGE = 20;

    export default {
        name: "PostsIndexView",
        components: {PostContent},

        data(){
            return {
                page: 1
            }
        },

        watch: {
            page(){
                this.fetchPosts();
            }
        },

        computed: {
            posts() {
                return this.$store.state.posts
            },

            showPaginator(){
                return this.posts.last_page > 1
            }
        },

        methods: {
            fetchPosts(){
                this.$store.dispatch('fetchPosts', {
                    take: POSTS_PER_PAGE,
                    page: this.page,
                    cacheable: false
                }).then((data) => {
                    this.page = this.posts.current_page;
                })
            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchPosts', {
                take: POSTS_PER_PAGE,
                page: this.page,
                cacheable: false
            }).then((data) => {
                this.page = this.posts.current_page;
            })
        }
    }
</script>

