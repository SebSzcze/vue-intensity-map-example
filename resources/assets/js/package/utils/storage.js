/**
 * Storage
 * @author Sebastian Szczepański <sebastian@ably.pl>
 */
class Store {
    constructor(){
        this.vue = new Vue({
            data: {
                items: [],
                iteratble: [],
                settings: {}
            }
        });
    }

    /**
     * Get dataset or single key from store
     * @param {String|null} key
     * @returns {*}
     */
    get(key = null){
        let data = this.vue.$data;

        if(key){
            return data[key];
        }

        return data;
    }

    /**
     * Set new value for given key
     * @param {String} key
     * @param {String|Object} value
     * @returns {*}
     */
    set(key, value){
        this.vue.$data[key] = value;

        return value;
    }

    /**
     * Push new value to array
     * @param {String} key
     * @param {String|Object|Array} value
     * @returns {*}
     */
    push(key, value){
        this.vue.$data[key].push(value);

        return this.vue.$data[key];
    }

    /**
     * Remove item from array
     * @param {String} key
     * @param value
     */
    removeFrom(key, value){
        let index = this.vue.$data[key].indexOf(value);
        this.vue.$data[key].splice(index, 1)
    }
}

let s = new Store;
Vue.prototype.$store = s;
Vue.prototype.$storage = s.get();
window.Store = s;

export default s;