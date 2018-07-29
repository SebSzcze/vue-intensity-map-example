<template>
    <div>
        <div class="inline-input-content" :class="{ 'is-bold' : bold }" ref="element">
            <slot></slot>
        </div>
        <input ref="input" type="hidden" :name="name" v-model="value">
    </div>
</template>

<script type="text/babel">
    require('babel-loader!medium-editor/dist/css/medium-editor.css');
    import MediumEditor from 'medium-editor'

    export default {
        // properties defined with component
        props: {
            name: {
                required: true
            },
            styles: {
                default: false
            },
            placeholder: {
                default: 'Tu wpisz tekst'
            },
            bold: {
                default: false
            },
            html: {
                default: false
            },
            clean: {
                default: true
            }
        },
        // component variables
        data(){
            return {
                editor: '',
                content: '',
                value: ''
            }
        },

        // component methods
        methods: {
            initMediumEditor() {
                let self = this;
                this.editor = new MediumEditor(this.$refs.element, {
                    toolbar: self.html,

                    paste: {
                        cleanPastedHTML: true,
                        cleanAttrs: ['style', 'dir'],
                        cleanTags: ['label', 'meta', 'p', 'div']
                    },

                    placeholder: {
                        text: self.placeholder
                    }
                });

                this.$refs.element.addEventListener('DOMSubtreeModified', () => {
                    this.$emit('editInlineInput', this.$refs.element.innerHTML );
                });

            },
        },
        // executes when component is created
        created(){
            let self = this;
            this.$nextTick(() => {
                self.value = self.$refs.element.innerHTML;
                this.initMediumEditor();
            });
            this.$on('editInlineInput', () => {
                self.value = self.$refs.element.innerHTML;
            })
        },
    }
</script>

