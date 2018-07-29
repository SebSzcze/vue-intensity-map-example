<template>
    <article class="px-4 lg:w-1/3 w-full">
        <a href="" class="inline-block mb-4 relative">
            <img :src="entity.photo.sizes.thumbnail.src" :alt="entity.name">
            <div class="mr-8 bg-white p-4 relative -mt-8">
                <t-label v-if="entity.type" :color="entity.type.color" :text="entity.type.name"></t-label>
                <h3 v-text="entity.name"></h3>
                <pin-marker v-if="entity.street" :text="entity.street.name"></pin-marker>
            </div>
        </a>
    </article>
</template>

<script>
    export default {
        name: "Entity",

        props: {
            entity: {
                required: true
            }
        }
    }
</script>
