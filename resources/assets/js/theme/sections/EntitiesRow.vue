<template>
    <section class="pt-16">
        <div class="container">
            <h2 class="text-center">Ostatnio aktualizowane</h2>
            <div class="flex flex-wrap pt-16 -mx-4">
                <entity v-for="entity in entities" :entity="entity" :key="entity.id"></entity>
            </div>
        </div>
    </section>
</template>

<script>
    const Entity = require('./../content/Entity');

    export default {
        name: "EntitiesRow",

        components: {
            Entity
        },
        computed: {
            entities(){
                let entities = [... this.$store.state.entities]
                return entities.sort(function(a,b){
                    // Turn your strings into dates, and then subtract them
                    // to get a value that is either negative, positive, or zero.
                    return new Date(b.updated_at) - new Date(a.updated_at);
                }).slice(0, 3);

            }
        }
    }
</script>
