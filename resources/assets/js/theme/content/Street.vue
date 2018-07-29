<template>
    <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
        <a href="/" is="router-link" :to="{ name: 'Search', params: {street: street.id} }" class="flex text-teal font-semibold mb-4">
            <span v-text="street.name"></span>
            <span class="ml-auto">({{ street.entities_count }})</span>
        </a>
        <a href="/" is="router-link" :to="{ name: 'Search', params: {street: street.id, type: type.id} }" class="flex mb-2" v-for="type in street.types">
            <span v-text="type.name"></span>
            <strong class="ml-auto" :class="">{{ type.entities_count }}</strong>
        </a>
    </div>
</template>

<script>
    export default {
        name: "Street",

        props: {
            street:{
                required: true
            }
        }
    }
</script>
