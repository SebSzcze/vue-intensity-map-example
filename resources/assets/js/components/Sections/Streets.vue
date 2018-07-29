<script type="text/babel">
    export default {
        name: 'Streets',
        // component variables
        data(){
            return {}
        },
        computed: {
            streets(){
                return storage.streets
            },
        },
        // executes when component is boot and ready to use
        beforeMount(){
            storage.fetchStreetsWithEntities();
        }
    }
</script>
<template>
    <section class="section types is-city">
        <div class="container">
            <h2 class="title is-2 is-light has-text-centered p-b-40">Realizacje wg ulic</h2>
            <div class="columns is-multiline">
                <div class="column is-3 street" v-for="street in streets">
                    <h3 class="street-name"><a is="router-link" href="#" :to="{ name: 'filter', query: { street: street.id } }">{{ street.name }} <span class="is-pulled-right">({{ street.entities_count }})</span></a></h3>
                    <a v-for="type in street.types" is="router-link" href="#" :to="{ name: 'filter', query: { street: street.id, type: type.id } }" class="street-row"> <span>{{ type.name }}</span> <strong>{{ type.entities_count }}</strong> </a>
                </div>

            </div>
        </div>
    </section>
</template>
