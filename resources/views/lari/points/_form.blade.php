@component('lari::components.form-box-2col', ['class' => 'container-full' ])
    @slot('left')
        @component('lari::components.input', [
            'size' => 'xl',
            'label' => 'Adres',
            'field' => 'address',
            'class' => 'font-bold text-grey-darker',
            'description' => 'Adres do identyfikacji. Niewidoczny na listach',
            'model' => $resource
        ])
        @endcomponent
        <h3 class="text-base mt-4">Atrybuty</h3>
        <p class="text-grey text-sm mb-8">W tym miejscu możesz przypisać odpowiednie wskaźniki dla danego punktu</p>
        <v-options name="attributes"
                   :node="{attribute_id:'', 'value': '', meta: '', created_at: '', updated_at: ''}"
                   :data-values="{{ old('attributes', $point->attributes()->with('attribute')->get()) ?: collect([]) }}">
            <template slot-scope="{name, value}">
                <div class="p-1 bg-grey-lightest mb-4 rounded">
                    <div class="flex items-center">
                        <div class="w-2/3 pr-8">
                            <v-select
                                    data-url="/attributes"
                                    :data-selected="value.attribute"
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
                                        <span class="flex-1 font-medium text-grey" v-if="!item.name">Wybierz atrybut</span>
                                        <div class="flex items-center flex-1" v-else>
                                            <div class="leading-tight py-1">
                                                <strong class="text-grey-dark">@{{ item.name }}</strong>
                                            </div>
                                        </div>
                                        <icon name="arrow-down" class="text-xs text-grey-darker mr-1 ml-4"></icon>
                                    </div>
                                </template>

                            </v-select>
                        </div>
                        <div class="w-1/3 pr-4">

                            <lari-input
                                    class="mt-4"
                                    :data-value="value.value"
                                    v-model="value.value"
                                    label="Wartość"
                                    size="sm"
                                    data-class="text-grey"
                            >
                            </lari-input>
                        </div>
                    </div>



                </div>
            </template>
        </v-options>


    @endslot
    @slot('right')
        <googlemap-create-marker
                :geocoder-options="{
                            enabled: true,
                            prefix: 'Leszno, '
                        }"
                field="location"
                :multiple="false"
                class="mb-8"
                @if($resource->hasCoordinates())

                :center="{{ $resource->location }}"
                :marker="{{ $resource->location }}"
                @endif

                :height="500"
        ></googlemap-create-marker>


    @endslot
@endcomponent

