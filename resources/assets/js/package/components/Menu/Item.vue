<script type="text/babel">
    export default {
        name: 'MenuItem',
        // properties defined with component
        props: {
            data: {
                required: true
            },
            additionalAttributes: {
                type: Object,
                default: () => {
                    return {}
                }
            }
        },
        // component variables
        data(){
            return {
                opened: false,
                id: this.data.id
            }
        },
        // component methods
        methods: {
            toggle(){
                this.opened = !this.opened;
            },
            remove(){
                this.$emit('remove', this.data);
            },
            addChild(){
                let count = this.data.children.length + 1
                let id = `${this.id}-${count}`;

                let schema = {
                    id,
                    anchor: "",
                    url: "",
                    class: "",
                    children: []
                };
                schema = Object.assign(schema, this.additionalAttributes);
                this.data.children.push(schema);
            },
            removeChild(item){
                const index = this.data.children.indexOf(item);
                this.data.children.splice(index, 1);
            }
        },
        // executes when component is created
        created(){

        },
        // executes when component is boot and ready to use
        mounted(){

        }
    }
</script>
<template>
    <div class="menu-creator-item">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-heading-icon is-draggable">
                    <i class="licon-move"></i>
                </div>
                <div class="panel-title is-clickable" @click="toggle">
                    <span class="is-grey" v-if="!data.anchor">Wstaw tekst</span>
                    {{ data.anchor }}
                </div>
                <div class="panel-heading-icon" v-show="opened">
                    <button @click.prevent="addChild" class="button is-transparent">
                        <i class="icon licon-sites"></i> <span>Dodaj podmenu</span>
                    </button>
                    <button @click="remove" class="button is-transparent">
                        <i class="icon licon-delete is-red"></i> <span>usuń</span>
                    </button>
                </div>
            </div>
            <div class="panel-body" v-show="opened">
                <lari-floating-label label="Tekst odnośnika"
                                     :value="data.anchor"
                                     v-model="data.anchor">
                </lari-floating-label>

                <div class="columns">
                    <div class="column">
                        <lari-floating-label label="Adres url"
                                             :value="data.url"
                                             v-model="data.url">
                        </lari-floating-label>
                    </div>
                    <div class="column">
                        <lari-floating-label label="Klasa css"
                                             :value="data.class"
                                             v-model="data.class">
                        </lari-floating-label>
                    </div>
                </div>
                <div class="meta-creator-item-separator" v-if="additionalAttributes.length">
                    <span>Meta</span>
                </div>
                <div class="columns is-multiline" v-if="additionalAttributes.length">
                    <div class="column is-half" v-for="(value, key) in additionalAttributes">
                        <lari-floating-label :label="value" :name="key"></lari-floating-label>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-creator-item-children" v-dragula="data.children" drake="first">
            <menu-item v-for="item in data.children" :key="item.id" :data="item" @remove="removeChild"></menu-item>
        </div>
    </div>
</template>

<style>
    .menu-creator-item {
        position: relative;
        margin: 10px 0;
    }

    .menu-creator-item-children {
        padding-left: 40px
    }
    .meta-creator-item-separator{
        color: #aeb1b5;
        display: flex;
        align-items: center;
        font-family: "Proxima Nova", sans-serif;
        font-weight: 600;
        padding: 10px 0;
        margin: 20px 0;
        position: relative;
    }
    .meta-creator-item-separator:after{
        background: rgba(0,0,0,.1);
        height: 2px;
        width: 100%;
        content: "";
        display: block;
        position: absolute;
    }
    .meta-creator-item-separator span{
        display: inline-block;
        background: #fff;
        padding: 5px 20px 5px 20px;
        z-index: 1
    }
    .menu-creator-item.gu-mirror {
        /*position: fixed;*/
    }

    .is-draggable {
        cursor: grab;
    }

    .panel-heading {
        display: flex;
        padding: 0px
    }

    .panel-title {
        padding: 20px;
        flex: 1
    }

    .panel-heading-icon {
        padding: 20px;
    }

    .panel-heading-meta {

    }



    .is-grey {
        color: #aeb1b5
    }

</style>