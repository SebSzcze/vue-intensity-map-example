@component('lari::components.floating-bar')
    @slot('title')
        <strong>{{ trans('backend.'.$controller::ROUTE_KEY.'.edit.heading') }}
            : {{ ${$controller::BLADE_VARIABLE_NAME}->name }}</strong>
        <span class="text-grey-dark">{{ trans('backend.'.$controller::ROUTE_KEY.'.edit.subtitle') }}</span>
    @endslot

    @slot('actions')
        <div class="bar-item">
            <lari-icon-switch
                    name="is_visible" id="is_visible"
                    :val="{{  json_encode(old('is_visible', ${$controller::BLADE_VARIABLE_NAME}->is_visible) ?: false) }}"
            ></lari-icon-switch>
        </div>

        <a href="{{ route($controller::ROUTE_KEY.'.index') }}" class="bar-item is-icon">
            <icon name="back_to_list"></icon>
        </a>

        <div class="bar-item is-right">
            <button type="submit" class="self-stretch px-6 bg-green inline-flex text-white font-medium text-sm items-center">
                {{ trans('backend.'.$controller::ROUTE_KEY.'.edit.saveBtn') }}
            </button>
        </div>
    @endslot
@endcomponent