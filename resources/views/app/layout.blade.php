<!doctype html>
<html lang="pl">
<head>
    @include('app.partials._dns-prefetch')
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700&amp;subset=latin-ext" rel="stylesheet">
    @include('app.partials._favicon')
    @include('app.partials._seo-tools')
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    <script>
        @cache('cache_keys')
        var __KEYS__ = {!!  new \App\CacheKeys() !!};
        @endcache
    </script>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
<div id="app">
    <header class="h-16 flex items-center px-4 shadow fixed z-30 bg-white pin-x">
        <div class="inline-flex items-center">
            <router-link to="/" class="header-brand-logo">
                <img src="{{ asset('images/paski.svg') }}" class="mr-4" alt="Rewitalizacja">
                <img src="{{ asset('images/rewitalizacja.svg') }}" alt="Rewitalizacja">
            </router-link>
        </div>
        <div class="ml-auto">
            <navigation></navigation>
        </div>
    </header>
    <vue-progress-bar></vue-progress-bar>

    <router-view></router-view>

    <footer class="mt-8">
        <div class="text-center">
            <img src="{{ asset('images/logo-ue.jpg') }}" alt="Logo UE">
        </div>
        <div class="container flex border-t border-grey-lighter py-8 mt-8">
            <p class="text-base text-grey text-semibold">&copy; 2018 Miasto Leszno. Wszelkie prawa zastrzeżone</p>
            <div class="ml-auto">
                <span class="text-sm text-grey">Realizacja: </span>
                <a href="http://itleszno.pl/"><img src="{{ asset('images/klaster.png') }}" alt="Klaster IT"></a>
            </div>
        </div>
    </footer>
    <policy-bar></policy-bar>


    {{--<header class="header">--}}
    {{--<div class="header-brand">--}}
    {{--<router-link to="/" class="header-brand-logo">--}}
    {{--<img src="{{ asset('images/paski.svg') }}" class="header-brand-signature" alt="Rewitalizacja">--}}
    {{--<img src="{{ asset('images/rewitalizacja.svg') }}" alt="Rewitalizacja">--}}
    {{--</router-link>--}}
    {{--</div>--}}
    {{--<partial-navigation></partial-navigation>--}}

    {{--</header>--}}
    {{--<router-view></router-view>--}}
    {{--<vue-progress-bar></vue-progress-bar>--}}


    {{--<intro-modal style="display: none" v-cloak>--}}
    {{--<h2 class="title is-3">Witamy na stronie poświęconej rewitalizacji miasta Leszna.</h2>--}}
    {{--<p>Znajdziecie tutaj interaktywną mapę obszaru rewitalizacji, na kt&oacute;rej zaznaczone są r&oacute;żne--}}
    {{--przedsięwzięcia i ich lokalizacje, wydarzenia, plany i aktywności. Znajdziecie też informacje o--}}
    {{--realizowanym przez Miasto Leszno projekcie pt. &bdquo;Nowe tory &ndash; centrum Leszna po kolei&rdquo;,--}}
    {{--wsp&oacute;łfinansowanym ze środk&oacute;w Unii Europejskiej w ramach Programu Operacyjnego--}}
    {{--Pomoc Techniczna 2014-2020.</p>--}}
    {{--<p>Zachęcamy do wsp&oacute;łtworzenia mapy razem z nami!</p>--}}
    {{--<p>Zapraszamy do podr&oacute;ży po obszarze rewitalizacji!</p>--}}
    {{--</intro-modal>--}}

</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
