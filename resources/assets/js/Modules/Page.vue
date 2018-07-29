<template>
    <div class="modal is-page" ref="modal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="container">
                    <div class="is-flex">
                        <div class="modal-header-left">
                            <h1 class="title is-1" v-text="page.title"></h1>
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
                        <div class="column is-3" v-if="page.menu">
                            <h3 class="title is-4" v-text="page.menu.heading"></h3>
                            <nav class="page-navigation">
                                <ul>
                                    <li v-for="item in page.menu.items">
                                        <a v-if="!isRouterLink(item)" :href="buildUrl(item)" v-text="item.anchor" :class="item.class" exact></a>
                                        <a v-if="isRouterLink(item)" :is="isRouterLink(item)" :to="buildUrl(item)" v-text="item.anchor" :class="item.class" exact></a>
                                        <ul class="navigation-sub" v-if="hasChildren(item)">
                                            <li v-for="child in item.children">
                                                <a v-if="!isRouterLink(child)"  :href="buildUrl(child)" :class="child.css">
                                                    <span v-text="child.anchor"></span>
                                                    <span class="navigation-sub__background"></span>
                                                </a>
                                                <router-link v-if="isRouterLink(child)" :to="buildUrl(child)" :class="child.css" exact>
                                                    <span v-text="child.anchor"></span>
                                                    <span class="navigation-sub__background"></span>
                                                </router-link>

                                                <ul class="navigation-sub__nested" v-if="hasChildren(child)">

                                                    <li v-for="nested in child.children">
                                                        <a v-if="!isRouterLink(nested)"  :href="buildUrl(nested)" :class="nested.css">
                                                            <span v-text="nested.anchor"></span>
                                                            <span class="navigation-sub__background"></span>
                                                        </a>
                                                        <router-link v-if="isRouterLink(nested)" :to="buildUrl(nested)" :class="nested.css" exact>
                                                            <span v-text="nested.anchor"></span>
                                                            <span class="navigation-sub__background"></span>
                                                        </router-link>
                                                    </li>
                                                </ul>

                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="column" :class="contentClass" v-html="page.body">
                        </div>
                        <div class="attachments" v-if="page.attachments">
                            <h3 class="title is-5">Załączniki</h3>
                            <ul>
                                <li v-for="attachment in page.attachments">
                                    <a :href="attachment.src" v-text="attachment.caption"></a>
                                </li>
                            </ul>
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
        watch: {
            '$route'(to, from) {
                this.fetchPage();
            }
        },
        computed: {
            page(){
                return storage.page
            },
            contentClass(){
                if(this.page.menu) {
                    return 'is-9'
                }
                return 'is-10'
            }
        },

        // component methods
        methods: {
            hasChildren(item){
                return item.children.length
            },
            buildUrl(el){
                if(this.isRouterLink(el)) {
                    return el.url.substr(1)
                }

                return el.url;
            },
            isRouterLink(el){
                if(el.url.includes('#')) {
                    return 'router-link';
                }
            },
            fetchPage(){
                return this.page = storage.fetchPage(this.$route.params.slug)
            }
        },
        // executes when component is created
        // executes when component is created
        beforeMount(){
            this.fetchPage();
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

