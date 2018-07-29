<template>
    <div>
        <file-pond
                name="file"
                ref="pond"
                label-idle="Dodaj załączniki"
                allow-multiple="true"
                :server="server"
                v-bind:files="myFiles"
                v-on:init="handleFilePondInit"
                v-on:addfile="addFile"

        />

    </div>
</template>

<script>
    // Import Vue FilePond
    import vueFilePond from 'vue-filepond';

    // Import FilePond styles
    import 'filepond/dist/filepond.min.css';

    // Import image preview plugin styles
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

    // Import image preview and file type validation plugins
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

    // Create component
    const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

    export default {
        name: "Attachments",

        props: {
            model: {},
            id: {}
        },

        data: function() {
            return {
                myFiles: [],
                server: {
                    url: `/media?attributes[collection]=attachments&attributes[model]=${this.model}&attributes[modelId]=${this.id}`,
                    process: {
                        headers: {
                            'X-CSRF-TOKEN': csrf_token
                        }
                    }
                }
            };
        },
        methods: {
            handleFilePondInit: function() {
                console.log('FilePond has initialized');

                // FilePond instance methods are available on `this.$refs.pond`
            },

            addFile(file){

            }
        },
        components: {
            FilePond
        }
    }
</script>

<style scoped>

</style>