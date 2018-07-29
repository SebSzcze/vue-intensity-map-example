

@component('lari::components.form-box')
    @component('lari::components.input', [
        'size' => 'xl',
        'label' => 'Nazwa ulicy',
        'field' => 'name',
        'description' => 'Nazwa ulicy wyśiwtlana na listach',
        'model' => $resource
    ])
    @endcomponent

    @component('lari::components.editor', [
        'label' => 'Opis',
        'field' => 'info',
        'descritpion' => 'Krótka informacja dotycząca ulicy',
        'model' => $resource
    ])
    @endcomponent

@endcomponent