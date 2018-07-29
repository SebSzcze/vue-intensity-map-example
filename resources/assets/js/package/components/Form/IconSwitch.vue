<template>
    <div class="switch">
        <label class="text"  v-if="label"> {{ label }}</label>
        <input type="hidden" value="0" :name="name">
        <input type="checkbox" :name="name" value="1" v-model="value" :id="fieldId">
        <label :for="fieldId">
            <small class="text-danger" v-if="error">{{ error }}</small>
            <span v-if="showIcon"><lari-icon :name="iconUnchecked"></lari-icon></span>
            <span v-if="showIcon" class="checked"><lari-icon :name="iconChecked"></lari-icon></span>
        </label>

    </div>
</template>
<script type="text/babel">
    import Switch from './switch'
    export default {
        name: 'Switch',

        mixins: [Switch],

        props: {
            showIcon: {
                default: true
            },
            iconUnchecked: {
                default: 'eye_closed'
            },
            iconChecked: {
                default: 'eye'
            }
        }

    }
</script>

