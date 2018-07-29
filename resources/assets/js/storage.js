let storage = new Vue({
    data: () => ({
        entities: [],
        events: [],
        groups: [],
        streets: [],
        settings: [],
        activeModel: '',
        activeEntity: '',
        page: {},
        posts: {},
        busy: false,
        sidebar: true,
        legend: {}
    }),

    watch: {
        busy($new) {
            if ($new) {
                this.$Progress.start();
            } else {
                this.$Progress.finish();
            }
        }
    },

    methods: {
        fetchLegends() {
            this.busy = true
            return axios.get('api/legend').then(({data}) => {
                this.legends = data
                this.busy = false
                Event.fire('legendsLoaded')
            })
        },
        fetchEntities(params = '') {
            this.busy = true;
            axios.get('/api/entities' + params).then(({data}) => {
                this.entities = data;
                this.busy = false;
                Event.fire('GoogleMapApiMarkersUpdated');
            })
        },
        fetchEvents(take = 3) {
            this.busy = true;
            axios.get('/api/events?take=' + take).then(({data}) => {
                this.events = data;
                Event.fire('GoogleMapApiMarkersUpdated');
                this.busy = false;
            });
        },
        fetchEventsAsEntities() {
            this.busy = true;
            axios.get('/api/events').then(({data}) => {
                this.entities = data;
                Event.fire('GoogleMapApiMarkersUpdated');
                this.busy = false;
            });
        },
        fetchSettings() {
            this.busy = true
            axios.get('/api/settings').then(({data}) => {
                this.settings = data;
                this.busy = false;
            });
        },
        getLatestEntities(take = 3) {
            let entities;
            this.busy = true;
            axios.get('/api/entities/latest').then(({data}) => {
                entities = data;
                this.busy = false;
                this.$emit('LatestEntitiesLoaded', entities)
            });
            return entities
        },
        fetchStreetsWithEntities() {
            this.busy = true
            axios.get('/api/streets').then(({data}) => {
                this.streets = data;
                this.busy = false;
            })

            return this.streets;
        },
        fetchEntity(id) {
            this.busy = true;
            axios.get('/api/entities/' + id).then(({data}) => {
                this.activeEntity = data;
                this.busy = false;
                Event.fire('ActiveEntityUpdated');
            })
        },
        fetchEvent(id) {
            this.busy = true;
            axios.get('/api/events/' + id).then(({data}) => {
                this.activeModel = data;
                this.busy = false;
                Event.fire('ActiveEventUpdated', data);
            })
        },
        getHeading(key) {
            if (typeof this.settings.headings != 'undefined') {
                return this.settings.headings[key]
            }
        },
        fetchProjects() {
            this.busy = true;
            axios.get('/api/projects/').then(({data}) => {
                this.entities = data;
                this.busy = false;
                Event.fire('GoogleMapApiMarkersUpdated', data);
            })
        },

        fetchPage(slug) {
            this.busy = true;
            axios.get('/api/pages/' + slug).then(({data}) => {
                this.busy = false;
                this.page = data;
            });
        },

        fetchPost(id) {
            this.busy = true;
            axios.get('/api/posts/' + id).then(({data}) => {
                this.busy = false;
                this.page = data;
            });
        },
        fetchPosts(take = 10) {
            this.busy = true;
            return axios.get('/api/posts?take=' + take).then(({data}) => {
                this.busy = false;
                this.posts = data;

                this.$emit('LatestPostsLoaded', this.posts)
            });
        },
    }
});
window.storage = storage;
