import Vue from 'vue';
/**
 * Event Bus
 * @author Sebastian Szczepanski <sebastian@ably.pl>
 */
class EventBus {
    constructor(){
        this.vue = new Vue()
    }

    /**
     * Fire given event
     * @param {String} event
     * @param {Object} payload
     */
    fire(event, payload = null){
        this.vue.$emit(event, payload);
    }

    /**
     * Listen for given event
     * @param {String} event
     * @param {Function} callback
     */
    listen(event, callback){
        this.vue.$on(event, callback);
    }

    /**
     * Listen for given event once
     * @param {String} event
     * @param {Function} callback
     */
    listenOnce(event, callback){
        this.vue.$once(event, callback);
    }

    /**
     * Removes listeners for given event with callback
     * @param {String} event
     * @param {Funciton} callback
     */
    remove(event, callback){
        this.vue.$off(event, callback)
    }

    /**
     * Removes all listeners for given event
     * @param {String} event
     */
    removeListnersFrom(event){
        this.vue.$off(event);
    }

    /**
     * Removes all listners
     */
    removeAll(){
        this.vue.$off();
    }
}

export default {
    install(Vue){
        Vue.prototype.$bus = new EventBus();
    }
}
