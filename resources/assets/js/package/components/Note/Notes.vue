<script>
    export default {
        props: {
            notes: { default: function() { return [] } },
            count: { default: 0 },
            model: {
                required: true
            }
        },
        data(){
            return {
                error: false,
                note: '',
                toggle: true,
                send: ''
            }
        },

        watch: {
            note(value, old_value){
                this.adjustHeight();
            }
        },
        computed: {
            orderedNotes(){
                //notes | orderBy created_at order    
                // TODO: order by created at             
                return this.notes.sort((a, b) => {
                    return a.order - b.order
                })
            },


        },
        methods: {
            // totod extract helper
            nl2br (str, is_xhtml){
                let breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
                return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
            },

            validate(){
                if(!this.note.length){
                    this.error = true
                    return false
                }
                this.error = false
                return true
            },

            adjustHeight(){
                let height = this.$refs.textarea.scrollHeight

                if(height > 36){
                    this.$refs.textarea.style.height = height + "px"
                }
            },
            add(){
                if(!this.validate()) return false;  // if validation fails do not proceed
                const data = {
                    model: this.model,
                    note: this.note
                }
                this.$http.post('/notes', data).then(response => {
                    if (response.ok) {
                        this.orderedNotes.push(response.data);
                        this.note = '';
                    }
                });
            },
            noteHtmlContent($content){
                return this.nl2br($content);
            },
            remove(note){
                if(confirm("Usunąć ten wpis?") == true){
                    this.$http.delete(this.url + "/" + note.id).then( response => {
                        if(response.status == 200 & response.data.success){
                            const index = this.notes.indexOf(element)
                            this.notes.splice(index, 1)
                        }
                    });
                }
            }

        },
    }
</script>
<template>
    <div>
        <div class="note note--user" v-for="note in orderedNotes">
            <div class="note-content">
                <button class="delete" @click.prevent="remove(note)"></button>
                <div v-html="noteHtmlContent(note.content)"></div>
            </div>
            <div class="note-meta">
                Dodane przez: <strong>{{ note.username }}</strong> {{ note.created_at }}
            </div>
        </div>
        <p class="control is-default"  :class="[ error ? 'is-danger' : '' ]">
            <label for="txt-note">Treść notatki</label>
            <textarea name="note" id="txt-note" v-model="note" ref="textarea"></textarea>
            <span class="help is-danger" v-if="error">To pole nie może być puste</span>
        </p>
        <p>
            <button class="button is-small is-purple" @click.prevent="add"><i class="icon licon-notebook"></i> <span>Dodaj notatkę</span></button>
        </p>
    </div>
</template>