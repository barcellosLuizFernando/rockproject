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
    .js('node_modules/echarts/dist/echarts.js', 'public/js/echarts.js') 
    .js('node_modules/@chartisan/echarts/dist/chartisan_echarts.js', 'public/js/chartisan_echarts.js')    
    .js('node_modules/inputmask/dist/jquery.inputmask.js', 'public/js/inputmask/inputmask.js')
    .js('node_modules/inputmask/dist/bindings/inputmask.binding.js', 'public/js/inputmask/inputmask.binding.js')

    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .sass('resources/scss/styles.scss', 'public/css/styles.css');

if (mix.inProduction()) {
    mix.version();
}
