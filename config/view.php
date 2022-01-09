<?php

$cur_domain = $_SERVER['HTTP_HOST'];

/**
 * 设置模板路径
 */
$module = '';
if ($cur_domain == env('FRONTEND_DOMAIN')) {
    $module = 'Frontend';
} elseif ($cur_domain == env('BACKEND_DOMAIN')) {
    $module = 'Backend';
} elseif ($cur_domain == env('SELLER_DOMAIN')) {
    $module = 'Seller';
} elseif ($cur_domain == env('STORE_DOMAIN')) {
    $module = 'Store';
} elseif ($cur_domain == env('MOBILE_DOMAIN')) {
    $module = 'Mobile';
}

$view_path = '';
if ($module != '') {
    $view_path = resource_path('views/'.strtolower($module).'/web/tpl_2018');
    if ($module == 'Mobile') {
        $view_path = resource_path('views/frontend/web_mobile/tpl_2018');
    }
//    $view_path = app_path('Modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views');
}

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'), // 默认模板路径
        $view_path, // 模板路径
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),

];
