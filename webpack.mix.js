const { mix } = require('laravel-mix');

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

mix.sourceMaps();
mix.js(['resources/assets/js/app.js'], 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css');
// mix.version()
mix.copyDirectory('resources/assets/vrplay', 'public/vrplay');
mix.copyDirectory(['resources/assets/vendor'], 'public/vendor');


mix.browserSync('0.0.0.0:8000');