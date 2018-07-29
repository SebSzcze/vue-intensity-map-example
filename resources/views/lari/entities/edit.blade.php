@extends('lari::layout')

@section('content')
    <form action="{{ route($controller::ROUTE_KEY.'.update', ${$controller::BLADE_VARIABLE_NAME}->id) }}" method="post">
        {!! csrf_field() !!}
        {{ method_field('PATCH') }}

        @component('lari::components.floating-bar')
            @slot('title')
                <strong>{{ trans('backend.'.$controller::ROUTE_KEY.'.edit.heading') }}
                    : {{ str_limit(${$controller::BLADE_VARIABLE_NAME}->name, 35) }}</strong>
                <span class="text-grey-dark">{{ trans('backend.'.$controller::ROUTE_KEY.'.edit.subtitle') }}</span>
            @endslot

            @slot('actions')
                    <div class="bar-item no-margin-right" v-tooltip:bottom="'Wybierz typ obiektu'">
                        <v-select
                                name="type_id"
                                data-url="/entitytypes"
                                @if($entity->type)
                                :data-selected='{{ $entity->type }}'
                                @endif
                                :data-config="{{ collect(['once' => true ]) }}"

                        >
                            <template slot="selected" slot-scope="{item,show}">

                                <div
                                        class="cursor-pointer flex items-center text-sm px-4 py-2 relative"
                                >
                                    <span class="flex-1" v-if="!item.name">Wybierz typ</span>
                                    <div class="flex items-center flex-1" v-else>
                                        <img :src="item.icon_image" alt="" class="mr-4 w-6">
                                        <div class="leading-tight py-1">
                                            <strong class="text-white">@{{ item.name }}</strong>
                                            <span class="block text-xs text-grey">Ilość obiektów: @{{ item.entities_count }}</span>
                                        </div>
                                    </div>
                                    <icon name="arrow_down" class="text-xs text-grey-darker mr-1 ml-4"></icon>
                                </div>
                            </template>
                            <template slot="item" slot-scope="{item}">
                                <div class="flex items-center py-2 pr-6">
                                    <img :src="item.icon_image" alt="" class="mr-4 w-6">
                                    <div class="leading-tight py-1 whitespace-no-wrap">
                                        @{{ item.name }}
                                        <span class="block text-xs text-grey">Ilość obiektów: @{{ item.entities_count }}</span>
                                    </div>
                                </div>

                            </template>
                        </v-select>
                    </div>
                    <div class="bar-item">
                        <v-select
                                name="street_id"
                                @if($entity->street)
                                :data-selected='{{ $entity->street }}'
                                @endif
                                data-url="/streets"
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
                                    <span class="flex-1" v-if="!item.name">Wybierz ulicę</span>
                                    <div class="flex items-center flex-1" v-else>
                                        <div class="leading-tight py-1">
                                            <strong class="text-white">@{{ item.name }}</strong>
                                            <span class="block text-xs text-grey">Ilość obiektów: @{{ item.entities_count }}</span>
                                        </div>
                                    </div>
                                    <icon name="arrow_down" class="text-xs text-grey-darker mr-1 ml-4"></icon>
                                </div>
                            </template>

                        </v-select>
                        {{--<lari-select--}}
                                {{--name='street_id'--}}
                                {{--@if($entity->street)--}}
                                {{--:selected='{{ $entity->street }}'--}}
                                {{--@endif--}}
                                {{--:labels="{placeholder: 'Wybierz nazwę ulicy', create: 'Dodaj ulicę', search: 'Szukaj'}"--}}
                                {{--url="/streets"></lari-select>--}}
                    </div>
                    <div class="bar-item">
                    <lari-icon-switch name="is_project"
                                      :show-icon="true"
                                      icon-checked="list-square"
                                      icon-unchecked="list-square"
                                      id="is_project"
                                      :val="{{  old('is_project', ${$controller::BLADE_VARIABLE_NAME}->is_project) }}"
                    ></lari-icon-switch>
                </div>
                <div class="bar-item">
                    <lari-icon-switch name="is_published"
                                      :show-icon="true"
                                      id="is_active"
                                      :val="{{  old('is_published', ${$controller::BLADE_VARIABLE_NAME}->is_published) }}"
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


        <div class="section p-8">
            <div class="w-1/3">

            </div>
        </div>

        <section class="section bg-grey-lightest">
            @include($controller::BLADE_BASE_DIR.'_form', ['resource' => ${$controller::BLADE_VARIABLE_NAME} ])
        </section>
    </form>
@stop


{{--@extends('lari::layout')--}}

{{--@section('content')--}}

{{--<form action="{{ route('entities.update', $entity->id) }}" method="post" class="section is-grey has-sidebar is-paddingless">--}}
{{--{!! csrf_field() !!}--}}
{{--{!! method_field('PATCH') !!}--}}
{{--<lari-floating-bar v-cloak>--}}
{{--<template slot="title">--}}
{{--<h1 class="title"><lari-icon name="pin_plus"></lari-icon> Aktualizacja obiektu</h1>--}}
{{--</template>--}}
{{--<template slot="actions">--}}
{{--<div class="bar-item no-margin-right">--}}
{{--<lari-select--}}
{{--name='type_id'--}}
{{--@if($entity->type)--}}
{{--:selected='{{ $entity->type }}'--}}
{{--@endif--}}
{{--:labels="{placeholder: 'Wybierz typ realizacji', create: 'Dodaj ulicę', search: 'Szukaj'}"--}}
{{--url="/entitytypes"></lari-select>--}}
{{--</div>--}}
{{--<div class="bar-item">--}}
{{--<lari-select--}}
{{--name='street_id'--}}
{{--@if($entity->street)--}}
{{--:selected='{{ $entity->street }}'--}}
{{--@endif--}}
{{--:labels="{placeholder: 'Wybierz nazwę ulicy', create: 'Dodaj ulicę', search: 'Szukaj'}"--}}
{{--url="/streets"></lari-select>--}}
{{--</div>--}}
{{--<div class="bar-item">--}}
{{--<lari-icon-switch label="Projekt wyświetlany na liście" name="is_project" :show-icon="true" icon-checked="star_favorite_fill" icon-unchecked="star_favorite"  id="is_project" :val="{{ $entity->is_project }}"></lari-icon-switch>--}}
{{--</div>--}}
{{--<div class="bar-item">--}}
{{--<lari-icon-switch name="is_published" :show-icon="true"  id="is_published" :val="{{ $entity->is_published }}"></lari-icon-switch>--}}
{{--</div>--}}
{{--<a href="{{ route('entities.index') }}" class="bar-item is-icon">--}}
{{--<lari-icon name="back_to_list"></lari-icon>--}}
{{--</a>--}}
{{--<div class="bar-item is-right">--}}
{{--<button type="submit" class="is-fullheight button is-success">Zapisz obiekt</button>--}}
{{--</div>--}}
{{--</template>--}}
{{--</lari-floating-bar>--}}
{{--<section class="p-r-450 is-flex-1 is-relative">--}}
{{--<div class="li-absolute-sidebar w-450 li-bg-af-white is-right">--}}
{{--<p class="p-b-10"><strong>Lokalizacja</strong></p>--}}
{{--<googlemap-create-marker--}}
{{--:geocoder-options="{--}}
{{--enabled: true,--}}
{{--prefix: 'Leszno, '--}}
{{--}"--}}
{{--:multiple="true"--}}
{{--@if($entity->location)--}}
{{--:marker='{!! $entity->location !!}'--}}
{{--:center='{!! $entity->location !!}'--}}
{{--@endif--}}
{{--@if($entity->locations)--}}
{{--:locations='{!! $entity->locations !!}'--}}
{{--@endif--}}

{{--field="location"--}}
{{--:height="500"--}}
{{--></googlemap-create-marker>--}}

{{--<p class="p-t-20"></p>--}}

{{--@can('edit_code')--}}
{{--<lari-floating-label label="Adres" value="{{ $entity->address }}"></lari-floating-label>--}}
{{--@endcan--}}

{{--</div>--}}

{{--<div class="container is-fluid section">--}}

{{--<lari-image-upload url="/photos" name="12"></lari-image-upload>--}}

{{--<p class="control is-default is-large {{ $errors->has('name') ? 'is-danger' : '' }}">--}}
{{--<label for="input-name">Nazwa obiektu</label>--}}
{{--<input type="text" name="name" id="input-name" class="" value="{{ old('name') ?: $entity->name }}"--}}
{{--placeholder="Wprowadź nazwę obiektu wyświetlaną na listach">--}}
{{--@if($errors->has('name'))--}}
{{--<span class="help is-danger">{{ $errors->first('name') }}</span>--}}
{{--@endif--}}
{{--</p>--}}
{{--<p class="control is-default {{ $errors->has('excerpt') ? 'is-danger' : '' }}">--}}
{{--<label for="txt-excerpt">Zajawka</label>--}}
{{--<textarea name="excerpt" id="txt-excerpt" class=""--}}
{{--placeholder="Krótkie wprowadzenie wyświetlane na listach">{{ old('excerpt') ?: $entity->excerpt }}</textarea>--}}
{{--@if($errors->has('excerpt'))--}}
{{--<span class="help is-danger">{{ $errors->first('excerpt') }}</span>--}}
{{--@endif--}}
{{--</p>--}}
{{--<div class="p-20"></div>--}}
{{--<div class="content">--}}
{{--<lari-medium-editor name="body">{!! old('body') ?: $entity->body !!}</lari-medium-editor>--}}
{{--</div>--}}

{{--@if($errors->has('body'))--}}
{{--<span class="help is-danger">{{ $errors->first('body') }}</span>--}}
{{--@endif--}}

{{--<h5 class="title has-line m-t-50"><span>Informacje na pasku bocznym</span></h5>--}}
{{--<div class="content">--}}
{{--<lari-medium-editor name="meta">{!! old('meta') ?: $entity->meta !!}</lari-medium-editor>--}}
{{--</div>--}}

{{--<p class="p-b-40"></p>--}}
{{--<h5 class="title has-line"><span>Własność</span></h5>--}}
{{--<h5 class="title has-line"><span>Bezrobocie</span></h5>--}}
{{--<h5 class="title has-line"><span>Zasiłki</span></h5>--}}
{{--<h5 class="title has-line"><span>Firmy</span></h5>--}}

{{--</div>--}}

{{--</section>--}}
{{--</form>--}}

{{--@stop--}}


