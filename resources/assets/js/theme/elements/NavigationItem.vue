<template>
    <li class="navigation-item" @mouseover="show" ref="item">
        <router-link class="font-semibold text-grey-darkest px-2" v-text="item.anchor" :to="item.url"></router-link>
        <ul v-if="hasChildren" class="z-10" ref="popper">
            <navigation-item v-for="child in item.children" :key="item.id + '-' +child.id +child.anchor"
                             :item="child"></navigation-item>
        </ul>
    </li>
</template>

<script>
    import NavigationItem from './NavigationItem';

    export default {
        name: "NavigationItem",
        components: {NavigationItem},
        props: ['item', 'parent'],

        computed: {
            hasChildren() {
                return this.item.children.length
            },
            placement() {
                return 'left'
                if (!this.parent) {
                    return 'left'
                }

                return 'bottom'

            }
        },

        methods: {
            show(){
                if(!this.hasChildren) {
                    return;
                }
                let bounds = this.$refs.popper.getBoundingClientRect()
                if(bounds.right >= window.innerWidth) {
                    let item = this.$refs.item.getBoundingClientRect()
                    let right = window.innerWidth - 25 - item.right;

                    this.$refs.popper.style.right = `-${right}px`;
                }

            }
        }
    }
</script>
