@component('lari::components.form-box-2col', ['class' => 'container-full' ])
    @slot('left')
        @component('lari::components.input', [
            'size' => 'xl',
            'label' => 'Nazwa',
            'field' => 'name',
            'class' => 'font-bold text-grey-darker',
            'description' => 'Tytuł legendy wyświetlany na listach',
            'model' => $resource
        ])
        @endcomponent
        @component('lari::components.input', [
            'size' => 'sm',
            'label' => 'Klucz',
            'field' => 'key',
            'description' => 'Identyfikator legendy służący do wyciągania odpowiednich danych. Jeżeli nie jesteś pewnien/a do czego wykorzystywane jest to pole, nie zmieniaj jego wartości',
            'model' => $resource
        ])
        @endcomponent
    @endslot
    @slot('right')

        <color-picker
                name="color"
                value="{{ $resource->color ?: '#fff' }}"
                description="Kolor bazowy"
                label="Kolor"
        ></color-picker>

        <lari-textarea
                label="Opis"
                name="description"
                data-class="leading-normal text-sm"
                data-value='{{ $resource->description }}'
                description="Tekst wyświetlany pod nagłówkiem w sidebarze"
        ></lari-textarea>


    @endslot
@endcomponent

<div class="flex mb-4 mx-auto container">
    <div class="p-8 w-2/3">
        <h3 class="mb-8 text-base">Opcje</h3>
        <v-options name="groups"
                   :node="{name: ''}"
                   :data-values="{{ old('attributes', $resource->groups) ?: collect([]) }}">
            <template slot-scope="{name, value, replace}">
                <div class="p-4 bg-grey-lighter mb-4 rounded">
                    <v-select
                            data-url="{{ route('attribute.groups.index') }}"
                            :data-selected="value"
                            @replace="replace"
                    >
                        <template slot="item" slot-scope="{item}">
                            <div class="pr-6 whitespace-no-wrap">
                                @{{ item.name }}
                            </div>

                        </template>

                        <template slot="selected" slot-scope="{item,show}">

                            <div
                                    class="cursor-pointer flex items-center text-sm px-4 py-2 relative"
                            >
                                <span class="flex-1" v-if="!item.name">Wybierz atrybut</span>
                                <div class="flex items-center flex-1" v-else>
                                    <div class="leading-tight py-1">
                                        <strong class="text-grey-darkest">@{{ item.name }}</strong>
                                    </div>
                                </div>
                                <icon name="arrow-down" class="text-xs text-grey-darker mr-1 ml-4"></icon>
                            </div>
                        </template>

                    </v-select>
                </div>
            </template>
        </v-options>
    </div>
    <div class="p-8 w-1/3">
        <h3 class="text-base my-8">Przedziały</h3>
        <v-options name="range"
                   :node="{name:''}"
                   :max="4"
                   :data-values="{{ old('options', $resource->range ?: collect([])) }}">
            <template slot-scope="{name, value}">
                <div class="p-4 bg-grey-lighter mb-4 rounded">
                    <lari-input
                            :data-value="value.name"
                            v-model="value.name"
                            label="Etykieta"
                            data-class="text-grey"
                    >
                    </lari-input>
                    <lari-input
                            class="-mt-2"
                            :data-value="value.color"
                            size="xs"
                            v-model="value.color"
                            label="Kolor"
                            data-class="text-grey"
                    >
                    </lari-input>
                </div>
            </template>
        </v-options>
    </div>
</div>

