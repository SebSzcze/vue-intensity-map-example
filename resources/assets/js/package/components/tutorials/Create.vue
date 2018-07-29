<script>
    export default {
        props: {
            videoid: { default: '' },
            url : { default: '/tuts' },
        },
        data(){
            return {
                thumbnail: '',
                id: this.videoid
            }
        },
        watch: {
            id(value, old_value){
                this.parseUrl(value);
                this.getThumbnail();
            }
        },
        methods: {
            getThumbnail(){
                this.thumbnail = `https://i.ytimg.com/vi/${this.id}/mqdefault.jpg`;
            },
            parseUrl(url){
                if(this.isUrl(url)){
                    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                    var match = url.match(regExp);
                    return  this.id = (match&&match[7].length==11)? match[7] : url;
                }
            },
            isUrl(str){
                var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
                        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
                return pattern.test(str);
            }
        },
        mounted(){
            if(this.videoid){
                this.getThumbnail();
            }
        }
    }
</script>
<template>
    <div>
        <div class="p-v-40">
            <div class="video-thumbnail">
                <i class="icon icon-control-play"></i>
                <img v-if="thumbnail" :src="thumbnail" alt="">
            </div>
            <p class="control is-default">
                <label for="input-videoid">Film</label>
                <input type="text" name="videoid" v-model="id" id="input-videoid" placeholder="ID lub adres filmu">
            </p>
        </div>
    </div>
</template>
<style>
    .video-thumbnail{
        position: relative;
        text-align: center;
    }
    .video-thumbnail .icon-control-play{
        position: absolute;
        z-index: 10;
        color: #fff;
        font-size: 50px;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
    }
</style>