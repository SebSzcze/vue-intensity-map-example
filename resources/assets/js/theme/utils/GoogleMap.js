import GoogleMapsApiLoader from 'google-maps-api-loader';

export default {
    install(Vue) {
        GoogleMapsApiLoader({
            libraries: ['geometry'],
            apiKey: 'AIzaSyBST0dUuRL1O4PvT429v8vMKxhs_0t5HWw',
        }).then((google) => {
            Vue.prototype.$google = google;
            Vue.prototype.$bus.fire('google:maps.loaded')
        });
    }
}
