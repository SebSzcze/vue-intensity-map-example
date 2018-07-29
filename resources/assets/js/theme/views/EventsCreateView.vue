<template>
    <single-view
            cover="/images/events-form-head.jpg"
            title="item.name"
    >
        <template slot="title">
            <div class="flex-1">
                <h1 class="font-normal mb-1">Zgłoś wydarzenie</h1>
                <p class="text-grey-dark">Planujesz wydarzenie związane z rewitalizacją?</p>
            </div>
            <div>
            </div>
        </template>
        <template slot="content">
            <form @submit.prevent="submit" class="flex-1 flex" method="post" v-if="!success">
                <div class="md:w-2/3 md:pr-16 content">

                    <p class="">Wypełnij poniższy formularz, żeby umieścić wydarzenie na naszej mapie.</p>
                    <p class="mb-8">Uzupełnij wszystkie poniższe pola.</p>

                    <div class="field">
                        <label for="event-title" class="label">Nazwa wydarzenia</label>
                        <input type="text" id="event-title" class="input" v-model="form.title">
                        <span class="text-sm text-red font-medium" v-if="errors.title" v-text="errors.title[0]"></span>
                    </div>

                    <div class="field">
                        <label for="event-organizer" class="label">Organizator</label>
                        <input type="text" id="event-organizer" class="input" v-model="form.organizer">
                        <span class="text-sm text-red font-medium" v-if="errors.organizer" v-text="errors.organizer[0]"></span>
                    </div>

                    <div class="field">
                        <label for="event-localization" class="label">Miejsce</label>
                        <input type="text" id="event-localization" class="input" v-model="form.localization">
                        <span class="text-sm text-red font-medium" v-if="errors.localization" v-text="errors.localization[0]"></span>
                    </div>

                    <div class="field">
                        <label for="event-url" class="label">Strona www</label>
                        <input type="text" id="event-url" class="input" v-model="form.url">
                        <span class="text-sm text-red font-medium" v-if="errors.url" v-text="errors.url[0]"></span>
                    </div>
                    <div class="field">
                        <label for="event-info" class="label">Opis wydarzenia</label>
                        <textarea id="event-info" class="textarea h-24"  v-model="form.body"></textarea>
                        <span class="text-sm text-red font-medium" v-if="errors.body" v-text="errors.body[0]"></span>
                    </div>


                </div>
                <div class="md:w-1/3 content">
                    <div class="field">
                        <label for="event-date" class="label">Data wydarzenia</label>
                        <input type="date" id="event-date" class="input text-2xl" v-model="form.date">
                        <span class="text-sm text-red font-medium" v-if="errors.date" v-text="errors.date[0]"></span>
                    </div>

                    <h3 class="pt-8">Dane kontaktowe</h3>
                    <p>Wypełnij wszystkie poniższe pola. W razie pytań skontaktujemy się z Tobą celem doprecyzowania
                        informacji.</p>

                    <div class="field">
                        <label for="event-name" class="label">Imię i nazwisko</label>
                        <input type="text" id="event-name" class="input"  v-model="form.name">
                        <span class="text-sm text-red font-medium" v-if="errors.name" v-text="errors.name[0]"></span>
                    </div>
                    <div class="field">
                        <label for="event-phone" class="label">Numer telefonu</label>
                        <input type="text" id="event-phone" class="input" v-model="form.phone">
                        <span class="text-sm text-red font-medium" v-if="errors.phone" v-text="errors.phone[0]"></span>
                    </div>
                    <div class="field">
                        <label for="event-email" class="label">Adres email</label>
                        <input type="text" id="event-email" class="input" v-model="form.email">
                        <span class="text-sm text-red font-medium" v-if="errors.email" v-text="errors.email[0]"></span>
                    </div>
                    <div class="field">
                        <label for="event-file" class="label">Zdjęcie</label>
                        <input type="file" id="event-file" class="text-sm">
                        <span class="text-sm text-red font-medium" v-if="errors.file" v-text="errors.file[0]"></span>
                        <p>
                            <small>Zdjęcie powinno być w możlwie największej rozdzielczości</small>
                        </p>
                    </div>

                    <button class="font-semibold bg-teal text-white px-8 py-2 text-lg mb-8" type="submit" @click="submit">
                        Zgłoś wydarzenie
                    </button>
                </div>
            </form>

            <div class="md:w-1/2 text-teal" v-else>
                <h3 class="text-teal">Dziękujemy</h3>
                <p class="text-xl" v-text="success"></p>
            </div>

        </template>
    </single-view>
</template>

<script>
    import axios from 'axios';
    import SingleView from './SingleView';

    export default {
        name: "EventsCreateView",
        components: {SingleView},

        data() {
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
                errors: {},
                success: false
            }
        },
        watch: {
            form($name){
                this.errors = {}
            }
        },
        methods: {
            submit() {
                axios.post('/api/events', this.form).then(({data}) => {
                    this.errors = {}
                    this.success = data.message
                }).catch(({response}) => {
                    this.errors = response.data.errors
                })
            },
        },

    }
</script>

