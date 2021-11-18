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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/saas/bootstrap.scss', 'public/css/bootstrap.css')
    .postCss('resources/css/mystyle.css', '/public/build/css/mystyle.css')
    .options({
    processCssUrls: false
    });
