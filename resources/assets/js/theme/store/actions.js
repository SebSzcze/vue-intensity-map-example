import axios from 'axios';
import Cache from './../utils/Cache';

export default {
    // action(context, payload)
    get({commit}, {key, url, cacheable}) {
        let data = Cache.get(key);

        return new Promise((resolve, reject) => {
            if (data && cacheable) {
                return resolve({key, data});
            }

            axios.get(url).then(({data}) => {
                if (cacheable !== false) {
                    Cache.remember(key, data)
                }

                return resolve({key, data});
            }).catch(() => {
                return reject(key);
            })
        })
    },

    searchEntities({dispatch}, {query, type, street}) {
        return dispatch('fetchList', {
            url: `/api/search/${query || ''}?type=${type || ''}&street=${street || ''}`,
            key: 'entities',
            cacheable: false
        });
    },

    fetchIntesityLegend({commit, dispatch}) {
        return dispatch('fetchList', {url: '/api/legend', key: 'legends'});
    },

    fetchEntities({state, commit, dispatch}) {
        return dispatch('fetchList', {url: '/api/entities', key: 'entities'});
    },

    fetchPosts({dispatch}, {take, cacheable, page = 1}) {
        return dispatch('fetchList', {
            url: `/api/posts?take=${take}&page=${page}`,
            key: 'posts',
            cacheable
        });
    },

    fetchEvents({dispatch}, take, page = 1) {
        return dispatch('fetchList', {
            url: `/api/events?take=${take}&page=${page}`,
            key: 'events',
            cacheable: take <= 3
        });
    },

    /**
     * single entity
     * @param dispatch
     * @param id
     */
    fetchEntity({dispatch}, id) {
        return dispatch('fetchItem', {url: `/api/entities/${id}`, type: 'entity'});
    },

    /**
     * single post
     * @param dispatch
     * @param id
     */
    fetchPost({dispatch}, id) {
        return dispatch('fetchItem', {url: `/api/posts/${id}`, type: 'post'});
    },

    fetchEvent({dispatch}, id) {
        return dispatch('fetchItem', {url: `/api/events/${id}`, type: 'event'});
    },

    /**
     * single post
     * @param dispatch
     * @param id
     */
    fetchPage({dispatch}, slug) {
        return dispatch('fetchItem', {url: `/api/pages/${slug}`, type: 'page'});
    },

    fetchSettings({commit, dispatch}) {
        dispatch('fetchMenus');
        return dispatch('fetchList', {url: '/api/settings', key: 'settings'});
    },

    fetchMenus({commit, dispatch}) {
        return dispatch('fetchList', {url: '/api/settings/menus', key: 'menus'});
    },

    fetchGeoData({dispatch}) {
        return dispatch('fetchList', {url: '/js/map.json', key: 'geojson'});
    },

    fetchMapBoundaries({dispatch}) {
        return dispatch('fetchList', {url: '/api/boundaries.json', key: 'boundaries'});
    },

    /**
     * Fetch intesity part
     * @param dispatch
     * @param commit
     * @param key
     * @returns {Promise<T | never>}
     */
    fetchIntesity({dispatch, commit}, key) {

        return dispatch('get', {key, url: `/api/polygons/${key}`, cacheable: false}).then(({key, data}) => {
            commit('SET_INTENSITY', {key, value: data});

            this._vm.$nextTick(() => {
                setTimeout(() => {
                    commit('LOADING', false);
                }, 1000);
            })
        }).catch(() => {
            commit('SET_INTENSITY', {key, value: []});
            this._vm.$nextTick(() => {
                setTimeout(() => {
                    commit('LOADING', false);
                }, 1000);
            });
            throw `There was an error loading resource with given key (${resource})`;
        })
    },

    /**
     * Fetch single item object
     * @param state
     * @param commit
     * @param url
     * @param type
     * @returns {Promise<AxiosResponse<any> | never | never>}
     */
    fetchItem({state, commit}, {url, type}) {

        commit('LOADING', true);

        return axios.get(url).then(({data}) => {
            commit('SET_CURRENT', {type, item: data});
            this._vm.$nextTick(() => {
                commit('LOADING', false);
            });
        }).catch(() => {
            commit('SET_CURRENT', {type, item: {}});
            this._vm.$nextTick(() => {
                commit('LOADING', false);
            });
            throw `There was an error loading resource with given key (${type})`;
        })
    },

    /**
     * Fetch resource items list
     * @param commit
     * @param dispatch
     * @param url
     * @param key
     * @param cacheable
     * @returns {Promise<T | never>}
     */
    fetchList({commit, dispatch}, {url, key, cacheable}) {
        commit('LOADING', true);

        return dispatch('get', {key, url, cacheable: cacheable !== false}).then(({key, data}) => {
            commit('RESOURCE', {key, data});

            this._vm.$nextTick(() => {
                setTimeout(() => {
                    commit('LOADING', false);
                }, 1000);
            })
        }).catch(() => {
            commit('RESOURCE', {key, data: []});
            this._vm.$nextTick(() => {
                setTimeout(() => {
                    commit('LOADING', false);
                }, 1000);
            });
            throw `There was an error loading resource with given key (${resource})`;
        })
    }
}
