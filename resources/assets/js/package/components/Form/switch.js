export default {
    props: {
        name: {
            required: true
        },
        error: {
            default: false
        },
        label: {
            default: ''
        },
        id: {
            required: true
        },
        val: {
            default: false
        }

    },
    data: function() {
        return {
            value: this.val
        }
    },
    watch: {
        value($new){
            this.$emit('changed', $new);
        }
    },
    computed: {
        fieldId(){
            return `${this.name}-${this.id}`;
        }
    },
}