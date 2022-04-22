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

// mix.setPublicPath('public/frontend/web');

// 前端资源
mix.copyDirectory('resources/static/frontend/web', 'public/frontend/web')
    // .version();
mix.copyDirectory('resources/static/assets', 'public/frontend/web/assets/d2eace91')
    // .version();

// mix.setPublicPath('public/frontend/web_mobile');
mix.copyDirectory('resources/static/frontend/web_mobile', 'public/frontend/web_mobile')
    // .version();
mix.copyDirectory('resources/static/assets', 'public/frontend/web_mobile/assets/d2eace91')
    // .version();

/*其他资源*/
mix.copyDirectory('resources/static/68yun', 'public/frontend/web/68yun')
    // .version();