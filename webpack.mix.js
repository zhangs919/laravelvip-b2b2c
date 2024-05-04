const {env} = require('minimist')(process.argv.slice(2));

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
if (env && env.combine) {
    require(`${__dirname}/webpack.combine.js`);
    return;
}

/*如果不带任何参数 则执行全部*/
if (!env) {
    require(`${__dirname}/webpack.combine.js`);
    return;
}
