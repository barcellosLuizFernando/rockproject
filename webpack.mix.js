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
    .autoload({jquery: ['$', 'jQuery', 'window.jQuery']})
    .js('resources/js/app.js', 'public/js')
    .js('node_modules/jquery/dist/jquery.js', 'public/js/jQuery.js')
    .js('node_modules/inputmask/dist/jquery.inputmask.js', 'public/js/inputmask.js')
    .js('node_modules/inputmask/dist/bindings/inputmask.binding.js', 'public/js/inputmask.binding.js')
    .js('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js').sourceMaps()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

mix.sass('resources/scss/styles.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
