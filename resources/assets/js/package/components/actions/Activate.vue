<script>
    import {string} from './../../config'
    export default {
        props: {
            name : { required: true },
            error : { default: false },
            label: { default: false },
            id: { required: true },
            value: { default: 0 },
            url: { required: true },
            update: { default: true },
            onSuccessMessage: {
                default: string.flash.onUpdate.success
            }
        },
        data(){
            return {
                fieldValue: this.value
            }
        },
        computed: {
            fieldId(){
                return `${this.name}-${this.id}`
            },
        },
        watch: {
            fieldValue($value, $old_value){
                this.save()
            }    
        },
        methods: {
            save(){
//                let formData = new FormData();

                let data = {}
                data[this.name] = !!this.fieldValue;
//                formData.append(this.name, !!this.fieldValue);
                if(this.update){
                    data['_method'] = 'PATCH';
                }
                this.$http.post(this.url, data).then(response => {
                    flash(this.onSuccessMessage)
                }).catch(() => {
                    flash().error(string.flash.onUpdate.error)
                });
            }
        }
    }
</script>
<template>
    <div>
        <p class="switch">
            <input type="checkbox" :name="name" value="1" v-model="fieldValue" :id="fieldId">
            <label :for="fieldId"> </label>
            <label class="text" :for="fieldId" v-if="label"> {{ label }}</label>
            <small class="text-danger" v-if="error">{{ error }}</small>
        </p>
    </div>
</template>