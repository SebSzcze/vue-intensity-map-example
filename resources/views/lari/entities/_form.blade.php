<div class="mb-8">
    @component('lari::components.image-uploader',[
    'class' => \App\Entity::class,
    'size' => 'cover',
    'photo' =>  $entity->photo
])
    @endcomponent
</div>

@component('lari::components.form-box-2col', ['class' => 'container-full' ])
    @slot('left')
        @component('lari::components.input', [
            'size' => 'xl',
            'label' => 'Nazwa',
            'field' => 'name',
            'class' => 'font-bold text-grey-darker',
            'description' => 'Nazwa obiektu wyświetlana na listach',
            'model' => $resource
        ])
        @endcomponent

        <lari-textarea
                label="Zajawka"
                name="excerpt"
                data-class="leading-normal"
                data-value='{{ $resource->excerpt }}'
                description="Tekst wyświetlany na listach"
        ></lari-textarea>

        @component('lari::components.editor', [
            'label' => 'Treść',
            'field' => 'body',
            'model' => $resource
        ])
        @endcomponent

        @component('lari::components.editor', [
            'label' => 'Informacje dodatkowe',
            'field' => 'meta',
            'model' => $resource
        ])
        @endcomponent

    @endslot
    @slot('right')
        {{--@component('lari::components.image-uploader',[--}}
            {{--'class' => \App\Entity::class,--}}
            {{--'photo' =>  $resource->photo--}}
        {{--])--}}
        {{--@endcomponent--}}

        <googlemap-create-marker
                :geocoder-options="{
                            enabled: true,
                            prefix: 'Leszno, '
                        }"
                field="location"
                class="mb-8"
                :multiple="true"
                @if(optional($resource->location)->count())

                :center='{!! $entity->location !!}'
                :marker='{!! $entity->location !!}'
                @endif

                @if($resource->locations)
                :locations='{!! $entity->locations !!}'
                @endif
                :height="500"
        ></googlemap-create-marker>


        @component('lari::components.input', [
            'label' => 'Adres',
            'field' => 'address',
            'description' => 'Pole widoczne tylko dla administratora serwisu',
            'model' => $resource
        ])
        @endcomponent
    @endslot
@endcomponent