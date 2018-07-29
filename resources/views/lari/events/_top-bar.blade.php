@component('lari::components.floating-bar')
    @slot('title')
        <strong>{{ __b($controller::ROUTE_KEY, 'edit.heading') }}
            : {{ ${$controller::BLADE_VARIABLE_NAME}->title }}</strong>
        <span class="text-grey-dark">{{ __b($controller::ROUTE_KEY, 'edit.subtitle') }}</span>
    @endslot

    @slot('actions')
        <div class="bar-item">
            <lari-datepicker
                    name="published_at"
                    value="{{ $event->published_at ?: now() }}"
            ></lari-datepicker>
        </div>
        <div class="bar-item">
            <lari-icon-switch name="is_published" :show-icon="true" id="is_published"
                              :val="{{  json_encode(old('is_published', $event->is_published) ?: false) }}"></lari-icon-switch>
        </div>
        <a href="{{ $event->url }}" class="bar-item is-icon" target="_blank">
            <icon name="link"></icon>
        </a>

        <a href="{{ route($controller::ROUTE_KEY.'.index') }}" class="bar-item is-icon">
            <icon name="back_to_list"></icon>
        </a>

        <div class="bar-item is-right">
            <button type="submit" class="self-stretch px-6 bg-green inline-flex text-white font-medium text-sm items-center">
                {{ __b($controller::ROUTE_KEY, 'edit.saveBtn') }}
            </button>
        </div>
    @endslot
@endcomponent