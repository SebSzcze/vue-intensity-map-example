<template>
    <p class="switch">
        <input type="hidden" value="0" :name="name">
        <input type="checkbox" :name="name" value="1" v-model="value" :id="fieldId">
        <label :for="fieldId"> </label>
        <label class="text" :for="fieldId" v-if="label"> {{ label }}</label>
        <small class="text-danger" v-if="error">{{ error }}</small>
    </p>
</template>
<script type="text/babel">
    import Switch from './switch'
    export default {
        name: 'Switch',

        mixins: [Switch]
    }
</script>