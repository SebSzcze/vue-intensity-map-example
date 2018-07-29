<template>
    <article class="pt-18">
        <header class="py-8" v-if="header">
            <div class="container  flex justify-center">
                <slot name="title" :item="item">
                    <div class="md:w-2/3" v-if="title">
                        <h1 class="font-normal" v-text="title"></h1>
                    </div>
                </slot>

            </div>
        </header>
        <slot name="cover">
            <figure class="text-center" v-if="cover">
                <img :src="cover" alt="title">
            </figure>
        </slot>

        <div class="py-8">
            <div class="container flex justify-center">
                <slot name="content:before"></slot>
                <slot name="content">


                    <div class="md:w-2/3 content">
                        <slot name="lead:before"></slot>
                        <p class="text-2xl" v-if="lead" v-html="lead"></p>
                        <slot></slot>

                        <div class="mt-8 pt-8" v-if="attachments.length">
                            <h3> Załączniki</h3>
                            <ul>
                                <li v-for="attachment in attachments">
                                    <a :href="attachment.src">
                                        {{ attachment.caption }}

                                        <small class="text-grey">[ pobierz ]</small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </slot>
                <slot name="content:after"></slot>

            </div>
        </div>
    </article>
</template>

<script>
    export default {
        name: "SingleView",
        props: {
            title: {},
            lead: {},
            cover: {},
            attachments: {
                default: () => []
            },
            header: {
                default: true
            },

            item: {}
        },

        beforeDestroy(){
            this.$store.commit('SET_CURRENT', {type: '', item: {}});
        }
    }
</script>
