<template>
    <div class="relative">
        <lari-input
                :size="size"
                :name="name"
                :data-value="selected"
                :label="label"
                :description="description"
                :data-class="dataClass"
                :readonly="true"
                :error="error"

        >
            <template slot="badge">
                <div class="w-12 p-2 bg-white flex cursor-pointer" @click="show = true">
                    <div class="rounded flex-1 flex items-center justify-center" :style="{background: selected,color: textColor}">
                            <icon name="arrow-down"></icon>
                    </div>
                </div>
            </template>
        </lari-input>
        <div class="absolute z-50 pin-r -mt-4" style="top: 100%" v-if="show">
            <material-picker v-model="color" :presetColors="presets"></material-picker>
        </div>

        <div v-if="show" class="fixed pin z-40" @click="show = false"></div>
    </div>
</template>
<script type="text/babel">
    import tinycolor from 'tinycolor2'
    import MaterialPicker from 'vue-color/src/components/Sketch'
    const presets = [
        '#EDA038', '#D5234C', '#158995', '#6EB245', '#235C98'
    ]
    export default {
        name: 'ColorPicker',
        props: {
            name: {},
            description: {},
            presets: {
                default: () => presets
            },
            value: {
                default: '#000'
            },
            size: {
                default: 'base'
            },
            dataClass: {
                default: 'text-grey'
            },
            error: {
                default: false
            },

            label: {
                default: ''
            },

        },
        components: {MaterialPicker},
        // component variables
        data() {
            return {
                color: this.value,
                show: false
            }
        },

        computed: {
            selected() {
                return this.color.hex || this.color
            },

            textColor(){
                return tinycolor(this.selected).darken(10)
            }
        },
        methods: {},
    }
</script>

