<template>
    <sidebar>
        <h1 class="text-white text-xl font-bold mt-0 mb-2" v-text="legend.name"></h1>
        <scrollbar class="flex-1 relative mb-6 -mr-2" style="height: 400px">
            <p class="text-white text-sm" v-text="legend.description"></p>
            <div class="mt-4" v-for="group in legend.groups">
                <h2 class="text-white font-semibold text-lg" v-text="group.name" v-if="legend.groups.length > 1"></h2>
                <div v-for="attribute in group.attributes">
                    <div class="mb-2 radio">
                        <input type="radio" :id="attribute.id" v-model="activeAttribute" :value="attribute.id">
                        <label class="font-medium" v-text="attribute.name" :for="attribute.id"></label>
                    </div>
                    <div class="text-sm text-teal-light mb-4" v-if="attribute.info" v-text="attribute.info"></div>
                </div>
            </div>
        </scrollbar>
        <div class="flex items-center">
            <h5 class="text-white font-bold text-sm">Legenda</h5>
            <label class="toggler ml-auto inline-flex items-center cursor-pointer">
                <input type="checkbox" class="hidden" v-model="numerical">
                <span class="text-white text-sm mr-2">Dane Liczbowe</span>
                <i class="track"></i>
            </label>
        </div>
        <footer class="flex mb-4 bg-white text-xs font-bold text-center">
            <div class="flex-inline flex-1 items-center justify-center py-1"
                 v-if="ranges.ranges"
                 v-for="range in ranges.ranges"
                 v-text="range.label"
                 :style="{  background: range.color, color: range.text }"
            ></div>
        </footer>
    </sidebar>
</template>

<script>
    import Range from './../../utils/LegendRange';

    export default {
        name: "Intesity",
        props: ['max-count'],
        data() {
            return {
                activeAttribute: false,
                numerical: false
            }
        },
        computed: {
            legend() {
                return Object.assign({name: false}, this.$store.state.legends.filter(item => {
                    return item.key === this.$route.params.key
                }).pop())
            },
            ranges() {
                return new Range(this.maxCount, this.legend.color)
            },

        },
        watch: {
            activeAttribute(active){
                this.$emit('input', active)
            },

            numerical(numerical){
                this.$emit('updateNumerical', numerical);
            },
            
            legend: {
                immediate: true,
                handler(legend){
                    if(!legend.groups) {
                        return;
                    }
                    this.activeAttribute = legend.groups[0].attributes[0].id;
                }

            }
        },

        beforeCreate() {
            this.$store.dispatch('fetchIntesity', this.$route.params.key)
        },
        
        mounted(){
        }
    }
</script>
