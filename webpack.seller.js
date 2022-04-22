const mix = require('laravel-mix');

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

// mix.setPublicPath('public/seller/web');

// 商家后台资源
mix.copyDirectory('resources/static/seller/web', 'public/seller/web')
    // .version();
mix.copyDirectory('resources/static/assets', 'public/seller/web/assets/d2eace91')
    // .version();

// mix.setPublicPath('public/seller/web_mobile');
mix.copyDirectory('resources/static/seller/web_mobile', 'public/seller/web_mobile')
    // .version();

/*其他资源*/
mix.copyDirectory('resources/static/68yun', 'public/seller/web/68yun')
    // .version();