<script type="text/babel">
    export default {
        props: {
            name: {
                default: 'tag'
            },
            field: {
                default: 'name'
            },
            url: {
                default: '/tags'
            }
        },
        data(){
            return {
                search: '',
                index: 0,
                loading: false,
                cached: false,
                items: []
            }
        },
        watch: {
            search(){
                this.index = 0
            }
        },
        methods: {
            loadData(){
                if (!this.cached) {
                    this.loading = true
                    this.$http.get(this.url).then(response => {
                        if (response.ok) {
                            this.items = response.data
                            this.loading = false
                            this.cached = true
                        }
                    })
                }
            },
            down(){
                if (this.index < this.count) {
                    this.index++
                }
            },
            up(){
                if (this.index > 0) {
                    this.index--
                }
            },
            enter(){
                console.log(this.list[this.index]);
            }
        },
        computed: {
            list(){

                return this.items.filter((item) => {
                    let filter = this.search.toUpperCase()
                    return item.name.toUpperCase().indexOf(filter) > -1
                }).slice(0, 10)

            },
            count(){
                return this.list.length
            }
        },
        mounted(){
            this.$nextTick(() => {    
                this.$refs.search.autofocus
            });
        }
    }
</script>

<template>
    <div class="l-dropdown">
        <p class="l-control">
            <i class="licon-search_left addon"></i>
            <input type="text"
                v-model="search"
                @keydown="loadData"
                @keydown.down.prevent="down"
                @keydown.up.prevent="up"
                @keydown.enter.prevent="enter"
                placeholder="Wyszukaj" 
                ref="search">
            <span class="addon l-loading" v-show="loading"></span>
        </p>
        <ul>
            <li v-for="(item, i) in list" :class="{ 'is-active' : index == i }">
                <div>{{ item[field] }}</div>
            </li>
            <li v-if="!list">
                <div class="no-results">
                    Brak wyników
                </div>
            </li>

            <li class="create" v-show="!search">
                <div>Wpisz nazwę elementu</div>
            </li>
            <li class="create" v-show="search" :class="{ 'is-active' : index == count }">
                <div class="">
                    Utwórz nowy {{ name }} <strong>{{ search }}</strong>
                </div>
            </li>
        </ul>
    </div>
</template>
<style lang="sass?indentedSyntax">
    $font-size: 14px
    $grey-darker: #222324
    $grey-dark: #69707a
    $grey: #aeb1b5
    $grey-light: #d3d6db
    $grey-lighter: #f5f7fa
    $min-width: 50px
    $max-width: 300px

    $base-line-height: 16px;
    $line-width: 4px
    $white: rgb(0,0,0);
    $off-white: rgba($white, 0.5);
    $spin-duration: 1s;
    $pulse-duration: 750ms;

    .l-control
        border: 1px solid $grey-light
        display: flex
        align-items: center
        position: relative
        margin: 4px
        .addon
            margin: 0 5px
            color: $grey
        input
            border: 0
            color: $grey-dark
            font-size: $font-size
            flex: 1
            padding: 5px 10px 5px 5px
            &:focus
                outline: none

    .l-dropdown
        display: inline-block
        min-width: $min-width
        max-width: $max-width
        border: 1px solid $grey-light
        border-radius: 2px
        box-shadow: 0 0 4px $grey-light


        ul
            font-size: $font-size

            li
                padding: 5px 10px

                &.no-results
                    color: $grey-light
                &.create
                    border-top: 1px solid $grey-lighter
                &.is-active
                    background: $grey-lighter
                    div
                        font-weight: 500



    .l-loading
        position: absolute
        right: $base-line-height / 2
        width: ($base-line-height / 4)
        height: $base-line-height
        background: $grey-light
        animation: pulse $pulse-duration infinite
        animation-delay: ($pulse-duration / 3)
        &:before, &:after
            content: ''
            position: absolute
            display: block
            height: ($base-line-height / 1.5)
            width: ($base-line-height / 4)
            background: $grey-light
            top: 50%
            transform: translateY(-50%)
            animation: pulse $pulse-duration infinite

        &:before
            left: -($base-line-height / 2)

        &:after
            left: ($base-line-height / 2)
            animation-delay: ($pulse-duration / 1.5)

    @keyframes pulse
        50%
            background: $grey-lighter



</style>
