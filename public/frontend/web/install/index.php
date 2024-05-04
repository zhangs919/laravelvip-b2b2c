<?php
session_start();
header("Content-type: text/html; charset=utf-8");
define('APP_DIR', realpath(__DIR__));
define('BASE_PATH', dirname(APP_DIR, 2));
require APP_DIR . '/protected/helpers.php';
require APP_DIR . '/protected/lib/http.php';
require APP_DIR . '/protected/lib/core.php';
