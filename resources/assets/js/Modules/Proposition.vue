<template>
    <div class="modal is-page" ref="modal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="container">
                    <div class="is-flex">
                        <div class="modal-header-left">
                            <h1 class="title is-1">Zgłoś wydarzenie</h1>
                            <p class="subtile">Planujesz wydarzenie związane z rewitalizacją?</p>
                        </div>
                        <div class="is-right">
                            <router-link to="/" class="button is-rounded is-outlined">Wróć do mapy</router-link>
                        </div>
                    </div>
                    <div class="notification notification--success" v-if="success">
                        <div class="notification-body" v-html="success">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-module">
                <img src="/images/proposition-header.jpg" alt="e">
            </div>
            <div class="modal-body">
                <div class="container">

                    <div class="columns form form--proposition" v-if="!success">
                        <div class="column is-7">
                           <p>Wypełnij poniższy formularz, żeby umieścić wydarzenie na naszej mapie.</p>
                            <p class="title is-4">Uzupełnij wszystkie poniższe pola:</p>
                            <label for="">Nazwa wydarzenia</label>
                            <input type="text" class="input input--large" v-model="form.title">
                            <span class="error" v-if="errors.title" v-for="error in errors.title">{{ error }}</span>
                            <label for="">Organizator</label>
                            <input type="text" class="input" v-model="form.organizer">
                            <span class="error" v-if="errors.organizer" v-for="error in errors.organizer">{{ error }}</span>
                            <label for="">Miejsce</label>
                            <input type="text" class="input" v-model="form.localization">
                            <span class="error" v-if="errors.localization" v-for="error in errors.localization">{{ error }}</span>
                            <label for="">Strona www wydarzenia</label>
                            <input type="text" class="input" v-model="form.url">
                            <span class="error" v-if="errors.url" v-for="error in errors.url">{{ error }}</span>
                            <label for="">Informacje</label>
                            <textarea name="" id="" v-model="form.body" rows="15" class="textarea"></textarea>
                            <span class="error" v-if="errors.body" v-for="error in errors.body">{{ error }}</span>

                        </div>
                        <div class="column is-offset-1">

                                <label for="p-date">Data wydarzenia</label>
                                <input type="date" class="input" id="p-date" v-model="form.date">
                                <span class="error" v-if="errors.date" v-for="error in errors.date">{{ error }}</span>
                                <h4 class="title is-6">Dane kontaktowe</h4>
                                <p>Wypełnij wszystkie poniższe pola. W razie pytań skontaktujemy się z Tobą celem doprecyzowania informacji.</p>
                                <label for="">Imię i nazwisko</label>
                                <input type="text" class="input" v-model="form.name">
                            <span class="error" v-if="errors.name" v-for="error in errors.name">{{ error }}</span>
                            <label for="">Numer telefonu</label>
                            <input type="text" class="input" v-model="form.phone">
                            <span class="error" v-if="errors.phone" v-for="error in errors.phone">{{ error }}</span>
                            <label for="">Adres email</label>
                            <input type="text" class="input" v-model="form.email">
                            <span class="error" v-if="errors.email" v-for="error in errors.email">{{ error }}</span>

                            <div class="p-t-20">
                                <label for="file">Dodaj zdjęcie</label>
                                <input type="file" name="file" id="file">
                                <small>Zdjęcie powinno być w możlwie największej rozdzielczości</small>
                            </div>

                            <p class="p-t-40">
                                <button @click.prevent="submit" class="button is-primary is-large">Zgłoś wydarzenie</button>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>
<script type="text/babel">
    export default {
        name: 'EventProposition',
        // properties defined with component
        props: {},
        // component variables
        data(){
            return {
                form: {
                    title: '',
                    body: '',
                    name: '',
                    phone: '',
                    email: '',
                    organizer: '',
                    url: '',
                    date: ''
                },
                errors: {
                    
                },
                success: ''
            }
        },
        computed: {

        },
        watch: {
            form($name){
                this.errors = {}
            }
        },
        // component methods
        methods: {
            submit(){
                axios.post('/api/events', this.form).then(({data}) => {
                    this.success = data.message
                }).catch(({response}) => {
                    this.errors = response.data.errors
                })
            },
        },
        // executes when component is created
        // executes when component is created
        beforeMount(){
//            storage.fetchEntity(this.$route.params.id)
        },
        beforeDestroy(){
            document.body.classList.remove('is-modal-page')
            document.body.style.height = 'auto';
        },
        // executes when component is boot and ready to use
        mounted(){

            document.body.classList.add('is-modal-page')

            this.$nextTick(() => {
                let height = this.$refs.modal.offsetHeight
                document.body.style.height = height + 'px';
            })
        }
    }
</script>

