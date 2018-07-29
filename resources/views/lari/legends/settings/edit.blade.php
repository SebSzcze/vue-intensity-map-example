@extends('lari::layout')

@section('content')
    <form action="" class="section is-grey is-paddingless" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <lari-floating-bar v-cloak>
            <template slot="title">
                <h1 class="title">Ustawienia</h1>
                <p>Ustawienia bezpośrednio związane z obiektami na mapie</p>
            </template>
            <template slot="actions">
                <div class="bar-item is-right">
                    <button class="is-fullheight button is-success" type="submit">Zapisz ustawienia</button>
                </div>
            </template>
        </lari-floating-bar>
        <div class="section">
            <div class="columns">
                <div class="column is-5">
                    <h2 class="title">Nagłówki</h2>
                    {{--<lari-floating-label label="Nagłówek listy projektów" name="settings[heading.entities]" value="{{ settings('heading.entities') }}"></lari-floating-label>--}}
                    {{--<lari-floating-label label="Nagłówek listy wydarzeń" name="settings[heading.events]" value="{{ settings('heading.events') }}"></lari-floating-label>--}}
                    <div class="p-t-40">
                        <h2 class="title">Kolory</h2>
                        <p class="subtitle">Lista kolorów na mapie natężeń</p>
                        <color-picker name="settings[intensity.colors.benefit]" label="Kolor przy zasiłkach" value="{{ settings('intensity.colors.benefit') }}"></color-picker>
                        <color-picker name="settings[intensity.colors.unemployment]" label="Kolor przy bezrobociu" value="{{ settings('intensity.colors.unemployment') }}"></color-picker>
                        <color-picker name="settings[intensity.colors.property]" label="Kolor przy typie własności" value="{{ settings('intensity.colors.property') }}"></color-picker>
                        <color-picker name="settings[intensity.colors.companies]" label="Kolor przy PKD firm" value="{{ settings('intensity.colors.companies') }}"></color-picker>
                    </div>

                </div>
            </div>

        </div>
    </form>
@stop