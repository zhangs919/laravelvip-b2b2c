// const { mix } = require('laravel-mix');
const { env } = require('minimist')(process.argv.slice(2));

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

// mix.js('resources/js/app.js', 'public/js')
// .version();

/*平台后台资源*/
if (env && env.backend) {
    require(`${__dirname}/webpack.backend.js`);
    return;
}

/*前端资源*/
if (env && env.frontend) {
    require(`${__dirname}/webpack.frontend.js`);
    return;
}

/*商家后台资源*/
if (env && env.seller) {
    require(`${__dirname}/webpack.seller.js`);
    return;
}

/*网点后台资源*/
if (env && env.store) {
    require(`${__dirname}/webpack.store.js`);
    return;
}