<template>
    <div>
        <div class="inline-input-content" ref="element">
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
                    toolbar: {

                        buttons: [
                            { name: 'bold',             contentDefault: '<i class="ei icon-bold"></i>' },
                            { name: 'italic',           contentDefault: '<i class="ei icon-italic"></i>' },
                            { name: 'underline',        contentDefault: '<i class="ei icon-underline"></i>' },
                            { name: 'h2',               contentDefault: '<i class="ei icon-h2"></i>' },
                            { name: 'h3',               contentDefault: '<i class="ei icon-h3"></i>' },
                            { name: 'quote',            contentDefault: '<i class="ei icon-quote"></i>' },
                            { name: 'unorderedlist',    contentDefault: '<i class="ei icon-unordered-list"></i>' },
                            { name: 'orderedlist',      contentDefault: '<i class="ei icon-ordered-list"></i>' },
                            { name: 'anchor',           contentDefault: '<i class="ei icon-link"></i>' },
                        ],
                    },

                    paste: {
                        cleanPastedHTML: true,
                        cleanAttrs: ['style', 'dir'],
                        cleanTags: ['label', 'meta']
                    },
                    anchor: {
                        placeholderText: 'Wklej lub wpisz adres linka',
                        targetCheckbox: true,
                        targetCheckboxText: 'Otwórz link w nowym oknie'
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

