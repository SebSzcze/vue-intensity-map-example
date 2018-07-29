<script>
    import EventListener from './../EventListener'
    export default {

        props: ['name', 'email'],

        data: function(){
            return{
                visible: false
            }
        },
        watch: {
            visible: function(value, old_value){
                let vm = this
                if(value){
                    this._closeEvent = EventListener.listen(window, 'click', (e) => {
                        if (!this.$el.contains(e.target) || e.target.nodeName.toLowerCase() == 'a') vm.toggle()
                    })
                }
            }
        },

        methods: {
            toggle: function(){
                jQuery(this.$refs.dropdown).toggleClass('is-active')
                this.visible = !this.visible

            },
        },
    }
</script>

<template>
    <div class="logged-user">
        <div class="name" @click="toggle">
            <strong>{{ name }}</strong>
            <span>{{ email }}</span>
        </div>
        <div class="avatar" @click="toggle">

        </div>
        <ul class="dropdown-menu" ref="dropdown">
            <slot name="after"></slot>
            <li><a href="/profile"><i class="icon-user icon"></i> Profil</a></li>
            <slot name="after"></slot>
            <li class="bg-lighter">
                <a href="/logout">Wyloguj <i class="icon icon-logout is-pulled-right"></i></a>
            </li>
        </ul>
    </div>
</template>