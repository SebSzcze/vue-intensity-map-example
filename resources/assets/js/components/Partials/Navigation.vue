<template>
    <div class="header-right">
        <div class="header-right-segment" v-for="menu in menus">
            <nav class="navigation">
                <ul>
                    <li v-for="item in menu.items">
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
    </div>
</template>
<script type="text/babel">
    export default {
        name: 'Navigation',

        // properties defined with component
        props: {},
        // component variables
        data(){
            return {
                menus: menus,
                items: menus.items
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
            }
        },
        // executes when component is created
        created(){

        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>
