import cookie from 'js-cookie';

class Cache {

    constructor() {
        this.keys = __KEYS__ || {}
    }

    /**
     *
     * @param key
     * @param value
     * @returns {*}
     */
    remember(key, value, hash = null){
        const cookieKeyValue = this.getCookie(key);
        hash = hash || cookieKeyValue || this.keys[key] || key;

        let toSave = JSON.stringify(value);
        this.setCookie(key, hash);
        localStorage.setItem(hash, toSave);

        return value;
    }

    /**
     *
     * @param key
     * @param value
     * @returns {*}
     */
    get(key, value = null){
        let hash = this.keys[key] || key;
        const cookieHashValue  = this.getCookie(key); // hash

        if(cookieHashValue && cookieHashValue !== hash) {
            this.forget(key);
        }

        const data = localStorage.getItem(hash);

        if(!data && value) {
            return this.remember(key, value);
        }

        return JSON.parse(data);
    }

    forget(key){
        const cookieHashValue  = this.getCookie(key); // hash
        cookie.remove(key);
        localStorage.removeItem(cookieHashValue);
    }
    /**
     *
     * @param key
     * @returns {*}
     */
    getCookie(key){
        return cookie.get(key);
    }

    /**
     *
     * @param key
     * @param value
     */
    setCookie(key, value){
        cookie.set(key, value, {expires: 120});
    }
}

export default new Cache;
