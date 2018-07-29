<template>
    <div>
        <div class="up-image" ref="image" v-if="src">
                <div class="row-actions-bar up-image__actions" v-if="!upload">
                    <a href="#" class="button" @click.prevent="crop">
                        <lari-icon name="crop_image"></lari-icon>
                    </a>
                    <a href="#" class="button" @click.prevent="unsetImage">
                        <lari-icon name="delete"></lari-icon>
                    </a>
                </div>
            <spinner v-if="upload" size="20px" class="up-image__spinner"></spinner>
            <img :src="src" :alt="image.caption" :style="style">
        </div>

        <lari-upload v-if="!src" @success="uploaded"></lari-upload>
        <crop v-if="size" :show="showCropper" :image="image"
              @closed="showCropper = false"
              @cropped="cropped"
              :size="size"
        ></crop>
    </div>
</template>
<script type="text/babel">
    import helpers from '../../utils/helpers';
    import Crop from './Crop.vue'
    import Spinner from '../../components/UI/CircleLoader'
    export default {
        name: 'Image',
        components: {Spinner, Crop},
        props: {
            value: {
                default: () => {
                    return {
                        path: ''
                    }
                }
            },
            size: {
                default: false
            },
        },
        // component variables
        data(){
            return {
                image: this.value,
                upload: false,
                showCropper: false,
                time: (new Date()).getTime()
            }
        },

        computed: {
            src() {
                if(!this.image.path) {
                    return false
                }

                if(!this.size || !this.image.meta || this.upload) {
                    return helpers.media(this.image.path);
                }

                return this.url(this.image.meta.sizes[this.size].path);
            },
            
            style(){
                let styles = {};

                if(this.size) {
                   styles.width = this.image.meta.sizes[this.size].width + 'px'
                   styles.height = this.image.meta.sizes[this.size].height + 'px'
                }

                return styles;
            },
        },

        methods: {
            url(path){
                return helpers.media(`${path}?time=${this.time}`);
            },

            uploaded(image){
                this.image = image;
                this.upload = true;
                setTimeout(() => {
                    this.updateStatusIfFileExists()
                }, 2000)
            },

            cropped(){
                this.time = (new Date()).getTime()
                this.showCropper = false
            },

            updateStatusIfFileExists(){
                let path = this.image.meta.sizes[this.size].path;
                axios.get(path)
                    .then(() => {
                        this.upload = false
                    })
                    .catch(() => {
                        setTimeout(() => {
                            this.updateStatusIfFileExists();
                        }, 3000)
                    });
            },

            crop(){
                this.showCropper = true;
            },

            unsetImage(){
                this.image = { path: ''}
            }
        }
    }
</script>
<style>
    .up-image{
        display: inline-flex;
        position: relative;

    }
    .up-image__spinner{
        position: absolute;
        right: 10px;
        top: 5px;
    }
    .up-image__actions{
        right: 0;
        display: none;
    }
    .up-image:hover .up-image__actions{
        animation: slideInRight .3s ease;
        animation-fill-mode: both;
        display: block;
    }

</style>

