const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('lari.sass', 'public/lari/css/style.css')
        .sass('login.sass', 'public/lari/css/login.css')
        .webpack('lari.js', 'public/lari/js/app.js')
        .webpack('login.js', 'public/lari/js/login.js');
});
