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
   .js('resources/assets/js/vue.js', 'public/js')
   .js('resources/assets/js/code.js', 'public/js')
   .js('resources/assets/js/scrollLoader.js', 'public/js')
   .js('resources/assets/js/scrollProgress.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/light.scss', 'public/css')
   .sass('resources/assets/sass/admin/adminStyle.scss', 'public/css')
   .sass('resources/assets/sass/dark.scss', 'public/css')
   .sass('resources/assets/sass/vue.scss', 'public/css').version();
