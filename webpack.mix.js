const {mix} = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');

require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
mix.webpackConfig({
    output: {
        chunkFilename: 'js/build/[name].[chunkhash].js',
    },
});

mix.sass('resources/assets/sass/style.sass', 'css')
    .options({
        autoprefixer: {
            options: {
                browsers: [
                    'last 6 versions',
                ]
            }
        },
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.js')],
    }).version();
    // .purgeCss({
    //     enabled: true,
    //     globs: [
    //         // path.join(__dirname, 'theme/**/*.php'),
    //     ],
    //     extensions: ['html', 'js', 'php', 'vue'],
    //     whitelistPatterns: [
    //         /-enter-active$/,
    //         /-leave-active$/,
    //         /-enter$/,
    //         /-leave-to$/,
    //     ]
    // });

mix.js('resources/assets/js/app.js', 'js');


mix.sass('resources/assets/sass/lari.sass', 'public/lari/css/style.css').options({
    postCss: [
        tailwindcss('./node_modules/lari/lari.tailwind.js')
    ]
}).version();
//
// mix.js('resources/assets/js/app.js', 'public/js/app.js')
    mix.js('resources/assets/js/lari.js', 'public/lari/js/app.js')
    .version();
//
// mix.sass('resources/assets/sass/login.sass', 'public/lari/css/login.css')
//     .js('resources/assets/js/login.js', 'public/lari/js/login.js');
// mix.sass('resources/assets/sass/lari.sass', 'public/lari/css/style.css').options({
//     postCss: [
//         tailwindcss('./node_modules/lari/lari.tailwind.js')
//     ]
// });
// .sass('resources/assets/sass/login.sass', 'public/lari/css/login.css')
// mix.sass('resources/assets/sass/app/style.sass', 'public/css/style.css')
// .options({
//     processCssUrls: false
// }).version()
// .js('resources/assets/js/app.js', 'public/js/app.js')
//  .js('resources/assets/js/lari.js', 'public/lari/js/app.js');
// .js('resources/assets/js/login.js', 'public/lari/js/login.js');
