<div class="mb-8">
    @component('lari::components.image-uploader',[
    'class' => \App\Post::class,
    'size' => 'cover',
    'photo' =>  $event->photo
])
    @endcomponent
</div>

@component('lari::components.form-box-2col')
    @slot('left')
        @component('lari::components.input', [
            'size' => 'xl',
            'label' => 'Tytuł',
            'field' => 'title',
            'description' => 'Tytuł wydarzenia wyświetlany na listach',
            'model' => $resource
        ])
        @endcomponent

        <lari-textarea
                label="Zajawka"
                name="excerpt"
                data-value='{{ $resource->excerpt }}'
                description="Tekst wyświetlany na listach"
        ></lari-textarea>


        @component('lari::components.editor', [
    'label' => 'Treść',
    'field' => 'body',
    'model' => $resource
])
        @endcomponent

    @endslot
    @slot('right')
        <div class="my-2 font-medium text-grey">
            Data wydarzenia
        </div>
        <div class="my-4">
            <strong class="text-grey">Rozpoczęcie</strong>
            <lari-datepicker
                    name="start_date"
                    value="{{ $event->start_date }}"
            ></lari-datepicker>
            <strong class="text-grey block mt-2">Zakończenie</strong>
            <lari-datepicker
                    name="end_date"
                    value="{{ $event->end_date }}"
            ></lari-datepicker>
        </div>
        <div class="my-2 font-medium text-grey">
            Miejsce
        </div>
        <googlemap-create-marker
                :geocoder-options="{
                            enabled: true,
                            prefix: 'Leszno, '
                        }"
                field="location"
                @if($resource->location->count())
                :marker='{!! $resource->location !!}'
                @endif
                :height="700"
        ></googlemap-create-marker>


        <div class="py-8">
            <h4 class="text-sm mb-4 text-grey-dark">Załączniki</h4>
            <ul>
                @foreach($event->attachments as $media)
                    <li class="flex">
                        <strong class="truncate">{{ $media->filename }}</strong>
                        <a href="{{ $media->src }}" target="_blank" class="ml-auto mr-2 text-sm font-medium">Pobierz</a>
                        <lari-delete-item url="/media/{{ $media->id }}" ></lari-delete-item>
                    </li>
                @endforeach
            </ul>

            <attachments class="mt-8" model="App\Event" id="{{ $event->id }}"></attachments>
        </div>
    @endslot


@endcomponent


@section('footer.beforeScript')
    {{--<script src="https://unpkg.com/jquery@3.3/dist/jquery.min.js"></script>--}}

    {{--<!-- Editor itself -->--}}
    {{--<script src="https://unpkg.com/trumbowyg@2.9/dist/trumbowyg.min.js"></script>--}}
    {{--<link href="https://unpkg.com/trumbowyg@2.9/dist/ui/trumbowyg.min.css" rel="stylesheet">--}}

    {{--<!-- Vue js -->--}}
    {{--<script src="https://unpkg.com/vue@2.5/dist/vue.min.js"></script>--}}
    {{--<!-- Lastly add this package -->--}}
    {{--<script src="https://unpkg.com/vue-trumbowyg"></script>--}}
@stop

@section('footer.scripts.after')
    {{--<script>--}}
        {{--Vue.component('Trumbowyg', VueTrumbowyg.default);--}}
    {{--</script>--}}
@stop