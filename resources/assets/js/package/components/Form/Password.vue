<template>
    <div>
        <input :type="type" class="input" id="password" name="password" :placeholder="placeholder">
        <i class="showPassword licon-eye" :class="{ 'is-active' : show }"  @click="toggle"></i>
    </div>
</template>

<script type="text/babel">
    export default {
        // properties defined with component
        props: {
            placeholder: {
                default: 'Hasło'
            }
        },
        // component variables
        data: () => ({
            type: 'password',
            show: false
        }),
        watch: {
            show($new, $old){
                if($new == true){
                    return this.setType('text');
                }
                return this.setType('password');
            }
        },
        // component methods
        methods: {
            toggle(){
                this.show = !this.show;
            },
            setType($value){
                this.type = $value;
            }
        },
    }
</script>

