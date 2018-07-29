import Vue from 'vue';

export default {
    RESOURCE(state, {key, data}) {

        state[key] = data
    },

    LOADING(state, loading) {
        let progress = this._vm.$Progress;

        if(loading) {
            progress.start();
        }else{
            progress.finish();
        }

        state.loading = loading
    },

    SET_CURRENT(state, {type, item}) {
        state.current = {type, item}
    },

    SET_MAP(state, map) {
        state.map = map
    },

    TOGGLE_SIDEBAR(state) {
        state.sidebar = !state.sidebar
    },

    SHOW(state, key) {
        this._vm.$set(state.show, key, true)
    },

    HIDE(state, key) {
        this._vm.$set(state.show, key, true)
    },

    SET_INTENSITY(state, {key, value}) {
        this._vm.$set(state.intensity, key, value);
    }
}
