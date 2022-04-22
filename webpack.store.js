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

// mix.setPublicPath('public/store/web');

// 网点后台资源
mix.copyDirectory('resources/static/store/web', 'public/store/web')
    // .version();
mix.copyDirectory('resources/static/assets', 'public/store/web/assets/d2eace91')
    // .version();

// mix.setPublicPath('public/store/web_mobile');
mix.copyDirectory('resources/static/store/web_mobile', 'public/store/web_mobile')
    // .version();

/*其他资源*/
mix.copyDirectory('resources/static/68yun', 'public/store/web/68yun')
    // .version();