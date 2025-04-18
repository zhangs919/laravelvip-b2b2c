<?php

/**
 * 系统环境检测
 * @return array 系统环境数据
 */
function check_env()
{
    $base_path = BASE_PATH.DS.'..'.DS.'..';
    $items = array(
        'os' => array('操作系统', '类Unix', '类Unix', PHP_OS, 'success'),
        'php' => array('PHP版本', '8.2', '8.2+', PHP_VERSION, 'success'),
        'upload' => array('附件上传', '不限制', '2M+', '未知', 'success'),
        'gd' => array('GD库', '2.0', '2.0+', '未知', 'success'),
        'disk' => array('磁盘空间', '1024M', '不限制', '未知', 'success'),
    );
    // 操作系统检测
    if (!in_array($items['os'][3], ['Linux', 'Darwin'])) {
        $items['os'][4] = 'error';
        $_SESSION['ins_error'] = true;
    }

    //PHP环境检测
    if ($items['php'][3] < $items['php'][1]) {
        $items['php'][4] = 'error';
        $_SESSION['ins_error'] = true;
    }

    //附件上传检测
    if (@ini_get('file_uploads')) {
        $items['upload'][3] = ini_get('upload_max_filesize');
    }

    //GD库检测
    $tmp = function_exists('gd_info') ? gd_info() : array();
    if (empty($tmp['GD Version'])) {
        $items['gd'][3] = '未安装';
        $items['gd'][4] = 'error';
        $_SESSION['ins_error'] = true;
    } else {
        $items['gd'][3] = $tmp['GD Version'];
    }
    unset($tmp);

    //磁盘空间检测
    if (function_exists('disk_free_space')) {
        $items['disk'][3] = floor(disk_free_space($base_path) / (1024 * 1024)) . 'M';
    }

    return $items;
}

/**
 * 目录，文件读写检测
 * @return array 检测数据
 */
function check_dirfile()
{
    $items = array(
        array('dir', '可写', 'success', '/bootstrap/cache', '框架启动缓存目录'),
        array('dir', '可写', 'success', '/storage/app', '系统缓存目录'),
        array('dir', '可写', 'success', '/storage/app/certs', '第三方证书目录'),
        array('dir', '可写', 'success', '/storage/framework', '框架缓存目录'),
        array('dir', '可写', 'success', '/storage/logs', '运行日志目录'),
        array('dir', '可写', 'success', '/vendor', 'composer依赖'),
        array('file', '可写', 'success', '/composer.lock', 'composer依赖'),
        array('file', '可写', 'success', '/.env', '配置文件'),
    );
    $base_path = BASE_PATH.DS.'..'.DS.'..';
    foreach ($items as &$val) {
        $item = $base_path . $val[3];
        if ('dir' == $val[0]) {
            if (!is_writable($item)) {
                if (is_dir($item)) {
                    $val[1] = '可读';
                    $val[2] = 'error';
                    $_SESSION['ins_error'] = true;
                } else {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    $_SESSION['ins_error'] = true;
                    if ($val[3] == '/vendor') {
                        $val[4] = '请先执行composer install';
                    }
                }
            }
        } else {
            if (file_exists($item)) {
                if ($val[3] == '/.env') {
                    $val[1] = '已存在';
                    $val[2] = 'error';
                    $val[4] = '请先删除 .env';
                    $_SESSION['ins_error'] = true;
                }
                if (!is_writable($item)) {
                    $val[1] = '不可写';
                    $val[2] = 'error';
                    $_SESSION['ins_error'] = true;
                }
            } else {
                if ($val[3] == '/composer.lock') {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    $val[4] = '请先执行composer install';
                    $_SESSION['ins_error'] = true;
                }
                if (!is_writable(dirname($item))) {
                    $val[1] = '不存在';
                    $val[2] = 'error';
                    $_SESSION['ins_error'] = true;
                }
            }
        }
    }
    return $items;
}

/**
 * 函数检测
 * @return array 检测数据
 */
function check_func()
{
    $items = array(
        array('pdo', '支持', 'success', '类'),
        array('pdo_mysql', '支持', 'success', '模块'),
        array('fileinfo', '支持', 'success', '模块'),
        array('openssl', '支持', 'success', '模块'),
        array('swoole', '支持', 'success', '模块'),
        /*以下函数需从禁用函数中删除*/
        array('file_get_contents', '支持', 'success', '函数'),
        array('mb_strlen', '支持', 'success', '函数'),
        array('proc_open', '支持', 'success', '函数'),
        array('symlink', '支持', 'success', '函数'),
        array('putenv', '支持', 'success', '函数'),
        array('proc_get_status', '支持', 'success', '函数'),
        array('exec', '支持', 'success', '函数'),
        array('shell_exec', '支持', 'success', '函数'),
    );

    foreach ($items as &$val) {
        if (('类' == $val[3] && !class_exists($val[0]))
            || ('模块' == $val[3] && !extension_loaded($val[0]))
            || ('函数' == $val[3] && !function_exists($val[0]))
        ) {
            $val[1] = '不支持';
            $val[2] = 'error';
            $_SESSION['ins_error'] = true;
        }
    }

    return $items;
}
