@component('lari::components.form-box-2col', ['class' => 'container-full' ])
    @slot('left')
        @component('lari::components.input', [
            'size' => 'xl',
            'label' => 'Nazwa',
            'field' => 'name',
            'class' => 'font-bold text-grey-darker',
            'description' => 'Tytuł wyświetlany na listach',
            'model' => $resource
        ])
        @endcomponent
        @component('lari::components.input', [
            'size' => 'sm',
            'label' => 'Klucz',
            'field' => 'key',
            'description' => 'Identyfikator służący do wyciągania odpowiednich danych. Jeżeli nie jesteś pewnien/a do czego wykorzystywane jest to pole, nie zmieniaj jego wartości',
            'model' => $resource
        ])
        @endcomponent
    @endslot
    @slot('right')
        <lari-textarea
                label="Opis"
                name="info"
                data-class="leading-normal text-sm"
                data-value='{{ $resource->info }}'
                description="Tekst wyświetlany pod nagłówkiem w sidebarze"
        ></lari-textarea>
    @endslot
@endcomponent

<div class="flex mb-4 mx-auto container">
    <div class="p-8 w-2/3">

        <h3 class="mb-8 text-base">Opcje</h3>
        <v-options name="options"
                   :node="{name:''}"
                   :data-values="{{ old('options', $resource->options) ?: collect([]) }}">
            <template slot-scope="{name, value}">
                <div class="p-4 pb-0 bg-grey-lighter mb-4 rounded">
                    <lari-input
                            :data-value="value.name"
                            v-model="value.name"
                            label="Nazwa"
                            data-class="text-grey"
                    >
                    </lari-input>
                    <lari-textarea
                            label="Opis"
                            size="sm"
                            data-class="leading-normal text-xm"
                            :data-value="value.description"
                            v-model="value.description"
                            description="Tekst wyświetlany pod nagłówkiem w sidebarze"
                    ></lari-textarea>
                </div>
            </template>
        </v-options>
    </div>
    <div class="p-8 w-1/3">

    </div>
</div>

