<template>
    <div class="modal is-page" ref="modal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="container">
                    <div class="is-flex">
                        <div class="modal-header-left">
                            <h1 class="title is-1">Aktualności</h1>
                        </div>
                        <div class="is-right">
                            <router-link to="/" class="button is-rounded is-outlined">Wróć do mapy</router-link>
                        </div>
                    </div>
                </div>

            </div>
            <!--<div class="modal-module">-->
            <!--<img src="http://lorempixel.com/1900/365/city/" alt="e">-->
            <!--</div>-->
            <div class="modal-body">
                <div class="container">
                    <div class="columns content entity-content">

                        <div class="column" :class="contentClass">
                            <div class="m-b-40" v-for="post in posts.data">
                                <div class="columns">
                                    <div class="column is-4">
                                        <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug } }" v-if="post.photo">
                                            <img :src="post.photo.sizes.thumbnail.src" :alt="post.photo.title">
                                        </router-link>
                                    </div>
                                    <div class="column">
                                        <h3>
                                            <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug } }" v-text="post.title"></router-link>
                                        </h3>
                                        <span class="is-fz-8 is-grey" v-text="post.published_at"></span>
                                        <p v-text="post.excerpt"></p>
                                        <router-link :to="{ name: 'post', params: { id: post.id, slug: post.slug } }" class="button is-rounded is-outlined">
                                            Czytaj więcej
                                        </router-link>
                                    </div>
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
        data() {
            return {}
        },

        watch: {
            '$route'(to, from) {
                this.fetchPost();
            }
        },

        computed: {
            posts() {
                return storage.posts
            },
            contentClass() {
                // if(this.page.menu) {
                //     return 'is-9'
                // }
                return 'is-10'
            }
        },

        // component methods
        methods: {
            hasChildren(item) {
                return item.children.length
            },
            buildUrl(el) {
                if (this.isRouterLink(el)) {
                    return el.url.substr(1)
                }

                return el.url;
            },
            isRouterLink(el) {
                if (el.url.includes('#')) {
                    return 'router-link';
                }
            },
            fetchPosts() {
                return storage.fetchPosts()
            }
        },
        // executes when component is created
        // executes when component is created
        beforeMount() {
            this.fetchPosts();
        },
        beforeDestroy() {
            document.body.classList.remove('is-modal-page')
            document.body.style.height = 'auto';
        },
        // executes when component is boot and ready to use
        mounted() {
            document.body.classList.add('is-modal-page')

            this.$nextTick(() => {
                let height = this.$refs.modal.offsetHeight
                document.body.style.height = height + 'px';
            })
        }
    }
</script>

