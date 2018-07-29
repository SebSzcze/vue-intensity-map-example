<template>
    <div class="editor-media editor-dz" ref="dropzone">
        <div class="editor-media-frame" :style="{height: height+'px'}">
            <div class="editor-media-message dropzone-message" ref="message">
                <div class="main" v-show="!loading">
                    <div class="dropzone-icon">
                        <lari-icon name="cloud_up"></lari-icon>
                    </div>
                    <p>Przeciągnij plik lub kliknij <strong>tutaj</strong> w poszukiwaniu pliku na dysku</p>
                </div>
                <div v-show="meta" class="meta" v-text="meta"></div>
            </div>
        </div>
        <div class="dropzone-background-preview" v-show="preview"
             :style="{ backgroundImage: 'url(' + preview  + ')' }"></div>
    </div>
</template>
<script type="text/babel">
    import Dropzone from 'dropzone'
    export default {
        name: 'Upload',
        props: {
            endpoint: {
                default: '/media'
            },
            height: {
                default: 400,
            },
            meta: {
                deafult: ''
            },
            single: {
                default: null
            },
            attributes: {
                default: () => {
                    return {}
                }
            }
        },

        // component variables
        data(){
            return {
                dropzone: '',
                preview: '',
                loading: false,
                imageTypes: [
                    'image/png', 'image/jpeg', 'image/pjpeg'
                ],
                files: []
            }
        },

        methods: {
            initDropZone (){
                const _t = this;
                this.dropzone = new Dropzone(this.$refs.dropzone, {
                    url: _t.endpoint,
                    maxFiles: _t.single,
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    clickable: _t.$refs.message,
                    previewsContainer: '.dropzone-message',
                    previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div></div>',
                    init: function () {
                        this.on("sending", (file, xhr, data) => {
                            _t.$emit('sending', file);
                            _t.loading = true;
                            data.append('attributes', JSON.stringify(_t.attributes));

                            if (_t.isImageType(file.type)) {
                                let reader = new FileReader();
                                reader.readAsDataURL(file);
                                reader.onload = (e) => {
                                    _t.preview = e.target.result
                                }
                            }
                        });

                        this.on('success', (file, xhr) => {
                            _t.onSuccess(file, xhr);
                        });

                        this.on('error', (file, xhr) => {
                            flash().error('Nie udało się wysłać pliku na serwer. Spróbuj ponownie za chwilę', {
                                icon: 'cloud_close',
                                title: 'Wystąpił problem'
                            });
                            this.removeAllFiles();
                        });

                        this.on('queuecomplete', () => {
                            this.removeAllFiles();
                            if (_t.files.length > 3) {
                                flash().success(
                                    `Pomyślnie wysłano <strong>${_t.files.length} plików</strong> na serwer`,
                                    {
                                        title: 'Udało się!',
                                        icon: 'cloud_ok',
                                        timeout: 5000
                                    }
                                );
                            }
                        })
                    }
                });
            },

            onSuccess (file, response){
                this.loading = false;
                this.preview = false;
                this.$emit('success', response);
                this.files.push(response);
                flash().success(
                    `Pomyślnie wysłano plik <strong>${file.name}</strong> na serwer`,
                    {
                        title: 'Udało się!',
                        icon: 'cloud_ok'
                    }
                );
            },

            isImageType($type){
                return this.imageTypes.indexOf($type) >= 0;
            },
        },

        mounted(){
            this.$nextTick(() => {
                this.initDropZone()
            });
        },
    }
</script>

