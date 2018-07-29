<script type="text/babel">
    import Dropzone from 'dropzone';
    Dropzone.autoDiscover = false;

    export default {
        // properties defined with component
        props: {
            url:                { default: '/media' },
            field:              { default: 'photo_id' },
            width:              { },
            height:             { },
            src:                { default: '' },
            image:              { default: '' },
            name:               {},
            return:             { default: false },
            id:                 { default: '' },
            method:             { default: 'resize' },
            no_thumbs:          { default: false },
            sizes:              { default: '' },
            box_height:         { default: 360 },
            box_meta:           { default: true }
        },
        // component variables
        data(){
            return {
                edit: true,
                preview: '',
                loading: false
            }
        },
        watch: {
            image(value, oldvalue){
                if(typeof value.id !== "undefined") {
                    this.id = value.id
                }
                this.assignSrc();
            }
        },

        // component methods
        methods: {
            initDropZone(){
                if(this.src) return;

                let self = this;

                this.dropzone =  new Dropzone(this.$refs.dropzone, {
                    url: self.url,
                    maxFiles: 1,
                    headers: { 'X-CSRF-TOKEN' : csrf_token },
                    clickable: self.$refs.message,
                    previewsContainer: '.dropzone-message',
                    previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div></div>'
                })
                this.dropzone.on("sending", function(file, xhr, formData){
                    self.loading = true
                    let reader = new FileReader()
                    self.appendFormData(formData);
                    reader.readAsDataURL(file)
                    reader.onload = function(e){
                        self.preview = e.target.e;
                    }
                });
                this.dropzone.on("success", function(file, xhr){
                    this.removeAllFiles()
                    self.image = xhr.image
                    self.edit = false
                })
            },
            appendFormData(data){
                let vm = this;

                ["sizes", "name", "no_thumbs", "method"].forEach(function(item){
                    vm.prepareFormData(data, item)
                });
                vm.prepareFormData('_token', csrf_token)
//                data.append('sizes',    this.sizes);
//                data.append('name',     this.name);
//                data.append('thumbs',   this.thumbs);
//                data.append('method',   this.method);
            },
            prepareFormData(data, param){
                if(this[param]){
                    data.append(param, this[param])
                }
            },
            assignSrc(){
                if(this.return) {
                    return this.src = this.createPathForThumb()
                }
                return this.src = this.image.path;
            },
            createPathForThumb(size = null){
                if(!size) size = this.return
                return this.image.dir + this.image.sizes[this.return].filename
            },
            remove(){
                this.src = ''
                this.id = ''
            }
        },
        // executes when component is created
        created(){
            if(this.image){
                this.image = JSON.parse(this.image)
//                this.image.sizes = JSON.parse(this.image.sizes)
            }
        },
        // executes when component is boot and ready to use
        mounted(){
            this.$nextTick(() => {    
                this.initDropZone();
            });

        }
    }
</script>
<template>
    <div>
        <div class="v-image-container" v-if="src">
            <div class="v-image-wrapper">
                <p class="control has-addons">
                    <button @click.prevent="remove"  class="button"><i class="licon-delete"></i></button>
                </p>
                <img :src="src" alt="" >

            </div>
        </div>
        <div class="editor-media editor-dz" ref="dropzone" v-if="!src && edit">
            <div class="editor-media-frame" :style="{height: box_height+'px'}">
                <div class="editor-media-message dropzone-message" ref="message">
                    <div class="main" v-show="!loading">
                        <div class="dropzone-icon"><i class="ei icon-dropzone"></i></div>
                        <p>Przeciągnij obraz lub kliknij <strong>tutaj</strong> w poszukiwaniu obrazu na dysku</p>
                    </div>
                    <div v-show="box_meta" class="meta">Obraz zostanie automatycznie przeskalowany do szerokości {{ width }}px</div>
                </div>
            </div>
            <div class="dropzone-background-preview" v-show="preview" :style="{ backgroundImage: 'url(' + preview  + ')' }"></div>
        </div>
        <input type="hidden" :name="field" :value="id">
    </div>
</template>
<style>
    .v-image-container{
        text-align: center;
    }
    .v-image-wrapper{
        display: inline-block;
        margin: 20px auto;
        position: relative;
    }
    .v-image-wrapper image{
        display: block;
    }
</style>
