@component('lari::components.form-box')
    @component('lari::components.input', [
        'size' => 'xl',
        'label' => 'Nazwa typu',
        'field' => 'name',
        'description' => 'Typ obiektu określający przynależność do konkretnej grupy',
        'model' => $resource
    ])
    @endcomponent

    <div class="mb-4">
        <div class="flex">
            @foreach(\App\EntityType::ICONS as $icon => $color)
                <label class="flex p-4 items-center cursor-pointer">
                    <input type="radio" name="icon" value="{{ $icon }}" class="m-r-10" {!! is_checked( $icon == $entitytype->icon) !!}>
                    <img src="{{ asset('images/icon-'.$icon.'.svg') }}" alt="">
                </label>
            @endforeach
        </div>
    </div>



@endcomponent