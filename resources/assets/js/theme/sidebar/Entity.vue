<template>
    <a href="#" is="router-link" :to="route" class="py-4 block pr-2 text-white hover:text-teal-darkest">
        <div class="mb-4">
            <t-label v-if="entity.type" :color="entity.type.color" :text="entity.type.name"></t-label>
            <strong v-text="entity.name"></strong>
        </div>
        <div class="clearfix">
            <img :src="entity.photo.sizes.mini.src" :alt="entity.name" class="float-left mr-4 mb-2">
            <pin-marker v-if="entity.street" :text="entity.street.name"></pin-marker>
            <p class="text-white text-sm opacity-50 leading-tight" v-text="entity.excerpt"></p>
        </div>
    </a>
</template>

<script>
    export default {
        name: "SidebarEntity",

        props: {
            entity: {
                required: true
            }
        },
        
        computed: {
            route(){
                return {
                    name: 'SidebarEntity',
                    params: this.entity
                }
            }
        }
    }
</script>
