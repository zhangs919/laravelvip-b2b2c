<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2024-04-15
// | Description:系统安装控制器
// +----------------------------------------------------------------------


/**
 * 系统安装
 * Class MainController
 */
class MainController extends BaseController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $agree = request('agree', 0);

        if ($agree == 1) {
            $_SESSION['agree'] = 1;
            $this->redirect('?a=check');
        }
    }

    /**
     * 环境检测
     */
    public function actionCheck()
    {
        if ($_SESSION['agree'] != 1) {
            $this->redirect('?a=index');
        }

        $_SESSION['ins_error'] = false;
        //环境检测
        $this->env = check_env();
        //函数检测
        $this->func = check_func();
        //目录文件读写检测
        $this->dirfile = check_dirfile();
    }

    /**
     * 配置信息
     */
    public function actionSetting()
    {
        if ($_SESSION['ins_error'] || $_SESSION['agree'] != 1) {
            $this->redirect('?a=index');
        }
        $this->timezones = $this->geTimezones();

        $host = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);
        $host_arr = explode('.', $host);
        $current_sub = $host_arr[0]; // 当前访问域名的子域

        $appUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $host;
        preg_match("#\.(.*)#i", $appUrl, $match);
//        $session_domain = $match[0];
        $root_domain = $match[1];

        $this->frontend_sub = $current_sub;
        $this->mobile_sub = 'm';
        $this->backend_sub = 'backend';
        $this->seller_sub = 'seller';
        $this->store_sub = 'store';
        $this->api_sub = 'api';
        $this->push_sub = 'push';
        $this->kf_sub = 'kf';
        $this->goods_detail_sub = 'item.m';
        $this->mobile_goods_detail_sub = 'item';

        $this->frontend_domain = $current_sub.'.' . $root_domain;
        $this->mobile_domain = 'm.' . $root_domain;
        $this->backend_domain = 'backend.' . $root_domain;
        $this->seller_domain = 'seller.' . $root_domain;
        $this->store_domain = 'store.' . $root_domain;
        $this->api_domain = 'api.' . $root_domain;
        $this->push_domain = 'push.' . $root_domain;
        $this->kf_domain = 'kf.' . $root_domain;
        $this->goods_detail_domain = 'item.' . $root_domain;
        $this->mobile_goods_detail_domain = 'item.m.' . $root_domain;
    }

    public function actionDatabases()
    {
        $db_host = request('db_host', '');
        $db_port = request('db_port', '');
        $db_user = request('db_user', '');
        $db_pass = request('db_pass', '');
        $filter_dbs = ['information_schema', 'mysql', 'performance_schema', 'sys'];

        $pdo = $this->getDb($db_host, $db_port, $db_user, $db_pass);
        if ($pdo === false) {
            die(json_encode(['status' => 'error', 'message' => '数据库连接失败']));
        }

        $result = $pdo->query('show databases;');

        if ($result === false) {
            die(json_encode(['status' => 'error', 'message' => 'query failed']));
        }

        $list = $result->fetchAll();

        $databases = [];
        if ($list) {
            foreach ($list as $key => $row) {
                if (in_array($row['Database'], $filter_dbs)) {
                    continue;
                }
                $databases[] = $row['Database'];
            }
        }

        die(json_encode(['status' => 'success', 'data' => $databases]));
    }

    /**
     * 保存配置
     */
    public function actionSave()
    {
        if (PHP_OS == 'WINNT') {
            die(json_encode(['status' => 'n', 'info' => '该系统暂不支持Windows操作系统']));
        }
        $db_host = request('db_host', '');
        $db_port = request('db_port', '');
        $db_user = request('db_user', '');
        $db_pass = request('db_pass', '');
        $db_name = request('db_name', '');
        $db_prefix = request('db_prefix', '');
        // 阿里云配置
        $ali_access_key_id = request('ali_access_key_id', '');
        $ali_access_key_secret = request('ali_access_key_secret', '');
        $es_hosts = request('es_hosts', '');
        // 授权码
        $app_key = trim(request('app_key'));

        // 注册超级管理员
        $admin = [
            'username' => trim(request('admin_name')),
            'password' => trim(request('admin_password')),
            'email' => trim(request('admin_email')),
        ];

        // 验证参数
        if (empty($admin['username'])) {
            die(json_encode(['status' => 'n', 'info' => '请填写管理员用户名']));
        }

        if (empty($admin['password'])) {
            die(json_encode(['status' => 'n', 'info' => '请填写管理员登录密码']));
        }

        if (empty($admin['email'])) {
            die(json_encode(['status' => 'n', 'info' => '请填写管理员电子邮箱']));
        }

//        if (empty($app_key)) {
//            die(json_encode(['status' => 'n', 'info' => '请填写授权码']));
//        }


        $host = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);
        $host_arr = explode('.', $host);
        $current_sub = $host_arr[0]; // 当前访问域名的子域

        $appUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $host;
        preg_match("#\.(.*)#i", $appUrl, $match);
        $session_domain = $match[0];
        $root_domain = $match[1];

        // 域名验证
        $frontend_sub = $current_sub;
        $mobile_sub = request('mobile_sub', '');
        $backend_sub = request('backend_sub', '');
        $seller_sub = request('seller_sub', '');
        $store_sub = request('store_sub', '');
        $api_sub = request('api_sub', '');
        $push_sub = request('push_sub', '');
        if (!$frontend_sub || !$mobile_sub || !$backend_sub || !$seller_sub
            || !$store_sub || !$api_sub || !$push_sub) {
            die(json_encode(['status' => 'n', 'info' => '请检查域名配置信息是否正确']));
        }

        $frontend_domain = $frontend_sub.'.' . $root_domain; // PC端域名 固定取当前访问域名
        $mobile_domain = $mobile_sub.'.' . $root_domain;
        $backend_domain = $backend_sub.'.' . $root_domain;
        $seller_domain = $seller_sub.'.' . $root_domain;
        $store_domain = $store_sub.'.' . $root_domain;
        $api_domain = $api_sub.'.' . $root_domain;
        $push_domain = $push_sub.'.' . $root_domain;
        $kf_domain = 'kf.' . $root_domain;
        $goods_detail_domain = 'item.' . $root_domain;
        $mobile_goods_detail_domain = 'item.m.' . $root_domain;

        // 连接数据库服务器
        $db = $this->getDb($db_host, $db_port, $db_user, $db_pass);
        if ($db === false) {
            die(json_encode(['status' => 'n', 'info' => '数据库连接失败']));
        }

        // 创建数据库
        $sql = "CREATE DATABASE IF NOT EXISTS `{$db_name}` DEFAULT CHARACTER SET utf8mb4";
        $db->exec($sql) or die(json_encode(['status' => 'n', 'info' => '数据库[' . $db_name . ']创建失败']));

        // 判断数据库是否为空
        $sql = "SELECT COUNT(*) AS table_count FROM information_schema.tables WHERE table_schema = '{$db_name}';";
        $ret = $db->query($sql)->fetchColumn();
        if ($ret > 0) {
            die(json_encode(['status' => 'n', 'info' => '请先清空数据库所有表']));
        }

        // 导入数据
        $db = $this->getDb($db_host, $db_port, $db_user, $db_pass, $db_name);
        $sqls = ['structure.sql'];
        try {
            foreach ($sqls as $sql) {
                $this->importSql($db, $sql, $db_prefix);
            }
        } catch (Exception $e) {
            die(json_encode(['status' => 'n', 'info' => '数据导入失败['.$e->getMessage().']']));
        }


        // 执行安装shell脚本
        $output = shell_exec('sh ../../../../scripts/install_panel.sh');
//        $output = shell_exec('sudo -u www sh ../../../../scripts/install_panel.sh');
        if ($output === NULL) {
            die(json_encode(['status' => 'n', 'info' => 'shell脚本执行失败']));
        }
        if ($output && !str_contains($output, 'INFO')) {
            die(json_encode(['status' => 'n', 'info' => 'shell脚本执行失败[' . $output . ']']));
        }
        // 写入配置
        $config = [
            'APP_URL' => $appUrl,
            'DB_HOST' => $db_host,
            'DB_PORT' => $db_port,
            'DB_DATABASE' => $db_name,
            'DB_USERNAME' => $db_user,
            'DB_PASSWORD' => $db_pass,
            'DB_PREFIX' => $db_prefix == '_' ? '' : $db_prefix,
            'ROOT_DOMAIN' => $root_domain,
            'SESSION_DOMAIN' => $session_domain,
            'BACKEND_DOMAIN' => $backend_domain,
            'SELLER_DOMAIN' => $seller_domain,
            'STORE_DOMAIN' => $store_domain,
            'FRONTEND_DOMAIN' => $frontend_domain,
            'MOBILE_DOMAIN' => $mobile_domain,
            'API_DOMAIN' => $api_domain,
            'KF_DOMAIN' => $kf_domain,
            'GOODS_DETAIL_DOMAIN' => $goods_detail_domain,
            'MOBILE_GOODS_DETAIL_DOMAIN' => $mobile_goods_detail_domain,
            'PUSH_DOMAIN' => $push_domain,

            // 阿里云配置
            'ALI_ACCESS_KEY_ID' => $ali_access_key_id,
            'ALI_ACCESS_KEY_SECRET' => $ali_access_key_secret,

            'ES_HOSTS' => $es_hosts,

            // 微信公众号配置
//            'WECHAT_OFFICIAL_ACCOUNT_APPID' => '',
//            'WECHAT_OFFICIAL_ACCOUNT_SECRET' => '',
        ];
        if (!$this->writeConf($config)) {
            die(json_encode(['status' => 'n', 'info' => '创建配置文件失败']));
        }

        try {
            // 执行seeder数据填充 写入授权码
            $seeder_url = "$appUrl/install/seeder?username={$admin['username']}&password={$admin['password']}&app_key={$app_key}";
            list($seeder_res, $http_status_code) = Http::get($seeder_url);
            if ($http_status_code != 200) {
                throw new Exception('执行seeder数据填充失败，状态码：'.$http_status_code);
            }
            $seeder_res = json_decode($seeder_res, true);
            if ($seeder_res['code'] == -1) {
                throw new Exception($seeder_res['message']);
            }
        } catch (\Exception $e) {
            die(json_encode(['status' => 'n', 'info' => '安装失败：' . $e->getMessage()]));
        }

        // 安装完成
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_password'] = $admin['password'];
        $_SESSION['app_url'] = $appUrl;
        $_SESSION['complete'] = true;

        // 生成 install.lock 文件
        $base_path = BASE_PATH . DS . '..' . DS . '..';
        $data = "乐融沃 https://www.laravelvip.com/ \r\n 安装时间：" . date('Y-m-d H:i:s');
        file_put_contents($base_path . $this->lockFile, $data);

        die(json_encode(['status' => 'y', 'info' => '数据已成功提交']));
    }

    /**
     * 完成
     */
    public function actionDone()
    {
        $host = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);
        $appUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $host;
        preg_match("#\.(.*)#i", $appUrl, $match);
        $session_domain = $match[0];
        $root_domain = $match[1];

        $this->frontend_url = $_SERVER['REQUEST_SCHEME'] . '://' . 'www.' . $root_domain;
        $this->backend_url = $_SERVER['REQUEST_SCHEME'] . '://' . 'backend.' . $root_domain;

        if (!isset($_SESSION['complete'])) {
            $this->redirect($_SERVER['REQUEST_SCHEME'] . '://' . 'www.' . $root_domain);
        }
    }

    /**
     * 时区
     */
    private function geTimezones()
    {
        return array(
            'UTC' => 'UTC',
            'PRC' => '中华人民共和国',
            'Asia/Shanghai' => '亚洲，中国，上海',
            'Asia/Taipei' => '亚洲，中国，台北',
            'Asia/Chongqing' => '亚洲，中国，重庆',
            'Asia/Chungking' => '亚洲，中国，重庆',
            'Asia/Harbin' => '亚洲，中国，哈尔滨',
            'Asia/Urumqi' => '亚洲，中国，乌鲁木齐',
            'Asia/Hong_Kong' => '亚洲，中国，香港',
            'Hongkong' => '亚洲，中国，香港',
            'Asia/Macau' => '亚洲，中国，澳门',
            'Asia/Macao' => '亚洲，中国，澳门',
            'Asia/Singapore' => '亚洲，新加坡',
            'Singapore' => '亚洲，新加坡',
            'Asia/Seoul' => '亚洲，韩国，首尔',
            'Asia/Tokyo' => '亚洲，日本，东京',
            'Europe/Berlin' => '欧洲，德国，柏林',
            'Europe/Dublin' => '欧洲，德国，都柏林',
            'Europe/Paris' => '欧洲，法国，巴黎'
        );
    }

    /**
     * DB实例
     * @param $db_host
     * @param $db_port
     * @param $db_user
     * @param $db_pass
     * @param $db_name
     * @return PDO
     */
    private function getDb($db_host, $db_port, $db_user, $db_pass, $db_name = '')
    {
        $config = [
            'MYSQL_HOST' => trim($db_host),
            'MYSQL_PORT' => trim($db_port),
            'MYSQL_USER' => trim($db_user),
            'MYSQL_PASS' => trim($db_pass),
            'MYSQL_CHARSET' => 'utf8',
        ];

        try {
            $dsn = 'mysql:host=' . $config['MYSQL_HOST'] . ';port=' . $config['MYSQL_PORT'];
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'' . $config['MYSQL_CHARSET'] . '\'');
            // 有具体数据库时采用长连接
            if (!empty($db_name)) {
                $dsn .= ';dbname=' . trim($db_name);
                $options[PDO::ATTR_PERSISTENT] = true;
            }
            $pdo = new PDO($dsn, $config['MYSQL_USER'], $config['MYSQL_PASS'], $options);
        } catch (PDOException $e) {
            return false;
        }

        return $pdo;
    }

    /**
     * 导入sql文件
     * @param $db
     * @param string $file
     * @param string $prefix
     */
    private function importSql($db, string $file, string $prefix = '')
    {
        //读取SQL文件
        $sql = file_get_contents(APP_DIR . '/data/' . $file);
        $sql = str_replace(["\r\n", "\n\r", "\r"], "\n", $sql);
        $sql = explode(";\n", $sql);

        //替换表前缀
        $prefix = trim($prefix);
        $sql = str_replace(" `lrw_", " `{$prefix}", $sql);

        // 开始安装数据库
        foreach ($sql as $value) {
            $value = trim($value);
            if (empty($value)) {
                continue;
            }

            if (substr($value, 0, 12) == 'CREATE TABLE') {
                $name = preg_replace("/^CREATE TABLE .*`(\w+)` .*/s", "\\1", $value);
                if (false === $db->exec($value)) {
                    die(json_encode(['status' => 'n', 'info' => '创建数据表[' . $name . ']失败']));
                }
            } else {
                $db->exec($value);
            }
        }
    }

    /**
     * 生成配置文件
     * @param $config
     * @return bool
     */
    private function writeConf($config)
    {
        $base_path = BASE_PATH . DS . '..' . DS . '..';
        if (is_array($config)) {
            //读取配置内容
            $conf = file_get_contents($base_path . '/.env');
            //替换配置项
            foreach ($config as $k => $v) {
                $conf = str_replace('[' . $k . ']', $v, $conf);
            }
            //写入应用配置文件
            if (file_put_contents($base_path . '/.env', $conf)) {
                return true;
            }
        }
        return false;
    }
}
