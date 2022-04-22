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

// mix.setPublicPath('public/backend/web');

// 平台后台资源
mix.copyDirectory('resources/static/backend/web', 'public/backend/web')
    // .version();
mix.copyDirectory('resources/static/assets', 'public/backend/web/assets/d2eace91')
    // .version();

// mix.setPublicPath('public/backend/web_mobile');
mix.copyDirectory('resources/static/backend/web_mobile', 'public/backend/web_mobile')
    // .version();

/*其他资源*/
mix.copyDirectory('resources/static/68yun', 'public/backend/web/68yun')
    // .version();

mix.copyDirectory('resources/static/oss', 'public/backend/web/oss')
    // .version();