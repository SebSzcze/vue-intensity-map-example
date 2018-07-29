<script type="text/babel">
    export default {
        name: '',
        // properties defined with component
        props: {},
        // component variables
        data(){
            return {
                entities: ''
            }
        },
        // component methods
        methods: {},
        // executes when component is created
        beforeMount(){
            storage.$on('LatestEntitiesLoaded', entities => {
                this.entities = entities
            });
            storage.getLatestEntities();
        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>
<template>
    <section class="section p-t-80">
        <div class="container">
            <div class="has-text-centered">
                <h2 class="title is-2 is-light">Ostatnio aktualizowane</h2>
            </div>
            <div class="is-flex p-v-40 is-flex-space">
                <router-link class="entity is-big"
                             v-for="entity in entities"
                             :to="{ name: 'sidebar', params: { id: entity.id, slug: entity.slug } }"
                             :key="entity.id"
                >
                    <div class="entity-content">
                        <span v-if="entity.type" v-text="entity.type.name" class="entity-type" :class="entity.type.color_class"></span>
                            <strong class="entity-name">
                                {{ entity.name.substr(0, 65) }} {{ entity.name.length > 65 ? '...': '' }}
                            </strong>
                            <span class="entity-street" v-if="entity.street">
                                 <i class="icon-pin"></i>
                                {{ entity.street.name }}
                            </span>
                    </div>
                    <div class="entity-photo">
                        <div class="entity-gradient"></div>
                        <img :src="entity.photo.sizes.thumbnail.src" alt="" v-if="entity.photo.sizes.thumbnail">
                    </div>
                </router-link>
            </div>
        </div>
    </section>
</template>
