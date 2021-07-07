const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])

    .sass('resources/scss/styles.scss', 'public/css/styles.css')

    
    .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jQuery.js')
    .scripts('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
    .scripts('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/js/bootstrap.bundle.js.map');

if (mix.inProduction()) {
    mix.version();
}
