@extends('lari::layout')

@section('content')
    <form action="{{ route($controller::ROUTE_KEY.'.update', ${$controller::BLADE_VARIABLE_NAME}->id) }}" method="post">
        {!! csrf_field() !!}
        {{ method_field('PATCH') }}

        @component('lari::components.floating-bar')
            @slot('title')
                <strong>{{ trans('backend.'.$controller::ROUTE_KEY.'.edit.heading') }}
                    : {{ ${$controller::BLADE_VARIABLE_NAME}->name }}</strong>
                <span class="text-grey-dark">{{ trans('backend.'.$controller::ROUTE_KEY.'.edit.subtitle') }}</span>
            @endslot

            @slot('actions')
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

        <div class="section p-8">
            <div class="w-1/3">

            </div>
        </div>

        <section class="section bg-grey-lightest">
            @include($controller::BLADE_BASE_DIR.'_form', ['resource' => ${$controller::BLADE_VARIABLE_NAME} ])
        </section>
    </form>
@stop