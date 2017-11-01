let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/dropzone/dist/dropzone.js', 'public/js/dropzone.js')
    .copy('node_modules/dropzone/dist/dropzone.css', 'public/css/dropzone.css')
    .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
    .copy('node_modules/trix/dist/trix.js', 'public/js/trix.js')
    .copy('node_modules/trix/dist/trix.css', 'public/css/trix.css')
;
