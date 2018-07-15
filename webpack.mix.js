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
    .js('resources/assets/admin/scripts/layout.js', 'public/layout/scripts')
    .js('resources/assets/global/scripts/metronic.js', 'public/global/scripts')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/global/components-md.scss', 'public/components')
    .sass('resources/assets/global/plugins-md.scss', 'public/plugins')
    .sass('resources/assets/global/plugins/_uniform.scss', 'public/global')
    .sass('resources/assets/admin/layout/layout.scss', 'public/layout');



mix.options({
    processCssUrls: false
});