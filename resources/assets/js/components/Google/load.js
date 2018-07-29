import GoogleMapsApiLoader from 'google-maps-api-loader';
import components from 'lari-google-maps'

GoogleMapsApiLoader({
    libraries: ['geometry'],
    apiKey: 'AIzaSyBST0dUuRL1O4PvT429v8vMKxhs_0t5HWw',
}).then((google) => {
    Vue.prototype.$google = google;
    Event.fire('GoogleMapsApiLoaded');
    Event.fire('googlemaps.loaded');
});
Vue.component('googlemap', require('./Map'));
Vue.component('polygon-map', require('./PolyMap'));

//
// Vue.component('google-map', components.GoogleMap);
// Vue.component('google-map-marker', components.GoogleMapMarker);
