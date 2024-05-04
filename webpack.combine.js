const mix = require('laravel-mix');

const assets_path = 'resources/static/assets/';
const frontend_web_path = 'resources/static/frontend/web/';
const frontend_web_mobile_path = 'resources/static/frontend/web_mobile/';

const public_assets_path = 'assets/';
const public_frontend_path = 'frontend/web/';
const public_mobile_path = 'frontend/web_mobile/';

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
mix.setPublicPath('resources/static');

mix.combine([
    assets_path + 'js/scrollBar/jquery.mousewheel.min.js',
    assets_path + 'js/scrollBar/jquery.mCustomScrollbar.js',
], assets_path + 'min/js/scrollBar.min.js');

mix.js([
    assets_path + 'js/jquery.lazyload.js',
    assets_path + 'js/layer/layer.js',
    assets_path + 'js/jquery.cookie.js',
    assets_path + 'js/jquery.history.js',
    assets_path + 'js/jquery.method.js',
    assets_path + 'js/jquery.widget.js',
    assets_path + 'js/jquery.modal.js',
    assets_path + 'js/table/jquery.tablelist.js',
    assets_path + 'js/szy.page.more.js',
], public_assets_path + 'min/js/core.min.js');
mix.js([
    assets_path + 'bootstrap/js/bootstrap.min.js',
    assets_path + 'js/common.js',
    // assets_path + 'js/scrollBar/jquery.mousewheel.min.js',
    // assets_path + 'js/scrollBar/jquery.mCustomScrollbar.js',
], public_assets_path + 'min/js/app.common.min.js');

mix.combine([
    assets_path + 'js/validate/jquery.metadata.js',
    assets_path + 'js/validate/jquery.validate.js',
    assets_path + 'js/validate/jquery.validate.custom.js',
    assets_path + 'js/validate/messages_zh.js',
], assets_path + 'min/js/validate.min.js');

mix.js([
    assets_path + 'js/upload/jquery.ajaxfileupload.js',
    assets_path + 'js/pic/imgPreview.js',
], public_assets_path + 'min/js/upload.min.js');

mix.combine([
    assets_path + 'js/message/message.js',
    assets_path + 'js/message/messageWS.js',
], assets_path + 'min/js/message.min.js');

mix.js([
    frontend_web_path + 'js/index.js',
    frontend_web_path + 'js/tabs.js',
    frontend_web_path + 'js/bubbleup.js',
    frontend_web_path + 'js/jquery.hiSlider.js',
    frontend_web_path + 'js/index_tab.js',
    // frontend_web_path + 'js/jump.js', // 由于放到里面压缩后会报错，暂时独立放出来不压缩
    frontend_web_path + 'js/nav.js',
], public_frontend_path + 'js/app.frontend.index.min.js');

mix.js([
    frontend_web_mobile_path + 'js/jquery.fly.min.js',
    frontend_web_mobile_path + 'js/common.js',
    frontend_web_mobile_path + 'js/placeholder.js',
], public_mobile_path + 'js/app.frontend.mobile.min.js');

// 合并css
mix.styles([
    assets_path + 'css/animate.css',
    assets_path + 'css/loading/loaders.css',
    assets_path + 'css/common.css',
    assets_path + 'css/styles.css',
], assets_path + 'css/app.common.min.css');


