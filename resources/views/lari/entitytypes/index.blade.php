@extends('lari::layout')

@section('content')
    {{-- Floating bar --}}
    <lari-floating-bar v-cloak>
        <template slot="title">
            <strong>{{ trans('backend.'.$controller::ROUTE_KEY.'.index.heading') }}</strong>
            <span class="text-grey-dark">{{ trans('backend.'.$controller::ROUTE_KEY.'.index.subtitle') }}</span>
        </template>
        <template slot="actions">
            <div class="bar-item is-right">
                <a href="{{ route($controller::ROUTE_KEY.'.create') }}" class="self-stretch px-6 bg-green inline-flex text-white font-medium text-sm items-center">
                    {{ trans('backend.'.$controller::ROUTE_KEY.'.index.addBtn') }}
                </a>
            </div>
        </template>
    </lari-floating-bar>
    {{-- /// Floating bar --}}

    <section class="bg-grey-lighter p-8">
        {{-- section content --}}
        @component('lari::components.data-table',[
            'controller' =>  $controller,
        ])
            @slot('row')
                @include($controller::BLADE_BASE_DIR.'_table-row')
            @endslot
        @endcomponent
        {{-- /// section content --}}
    </section>
@stop

