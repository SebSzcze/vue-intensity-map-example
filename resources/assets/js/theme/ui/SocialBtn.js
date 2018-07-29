const SHARE_BASE = {
    GOOGLE: "https://plus.google.com/share?url={0}",
    FACEBOOK: "https://www.facebook.com/sharer/sharer.php?u={0}",
    LINKEDIN: "https://www.linkedin.com/shareArticle?mini=true&url={0}&title={1}&summary={2}&source={0}",
    TWITTER: "https://twitter.com/intent/tweet?url={0}&text={1}"
};

export default {
    props: ['url'],
    
    computed: {
        shareUrl(){
            return this.url || window.location.href;
        },
        
        provider(){
            return this.$options.name.replace("Btn", "").toUpperCase()
        },

        href(){
            return this.stringFormat(SHARE_BASE[this.provider], [
                this.shareUrl
            ]);
        }
    },

    methods: {
        share(){
            this.openPopup()
        },

        stringFormat(str, args){
            return str.replace(/\{(\d+)\}/g, function (m, n) {
                return args[n] || m;
            });
        },

        openPopup(){
            var _w = 600,
                _h = 400,
                dualScreenLeft = typeof window.screenLeft !== 'undefined' ? window.screenLeft : screen.left,
                dualScreenTop = typeof window.screenTop !== 'undefined' ? window.screenTop : screen.top,
                width = window.innerWidth || d.documentElement.clientWidth || screen.width,
                height = window.innerHeight || d.documentElement.clientHeight || screen.height,
                left = ((width / 2) - (_w / 2)) + dualScreenLeft,
                top = ((height / 3) - (_h / 3)) + dualScreenTop,
                windowFormat = 'resizable,toolbar=yes,location=yes,scrollbars=yes,menubar=yes,width={0},height={1},top={2},left={3}',
                newWindow = window.open(this.href, '', this.stringFormat(windowFormat, [_w, _h, top, left]));

            if (newWindow !== null && newWindow.focus) {
                newWindow.focus();
            }
        }
    },
    
    mounted(){
        console.log(this.provider);
        console.log(this.shareUrl);
    },
}
