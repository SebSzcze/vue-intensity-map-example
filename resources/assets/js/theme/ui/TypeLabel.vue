<template>
    <span class="inline-block mr-2 rounded text-xs px-2 font-semibold text-white" :class="`bg-${color}`" v-text="text"></span>
</template>

<script>
    export default {
        name: "TypeLabel",
        props: ['color', 'text']
    }
</script>

