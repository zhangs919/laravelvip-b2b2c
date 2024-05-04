<?php

namespace App\Modules\Backend\Http\Controllers;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\UpgradeRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class UpgradeController extends Backend
{

    protected $filesystem;
    protected $upgrade;

    public function __construct(
        UpgradeRepository $upgrade,
        Filesystem $filesystem
    ) {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->upgrade = $upgrade;

        @ini_set('memory_limit', '1024M'); // 设置内存大小
        @ini_set("max_execution_time", "0"); // 请求超时时间 0 为不限时
        @ini_set('default_socket_timeout', 3600); // 设置 file_get_contents 请求超时时间 官方的说明，似乎没有不限时间的选项，也就是不能填0，你如果填0，那么socket就会立即返回失败，

    }

    public function index(Request $request)
    {
        $title = $fixed_title = '在线更新';
        $lrw_version = sysconf('lrw_version') ?: '';
        $act = $request->get('act', 'index');

        $explain_panel = [
            '重要：升级前，请 <a class="btn btn-sm btn-danger" href="/system/backup/list">备份您的数据库</a>，程序有可能覆盖模版文件，请注意备份！',
            'linux服务器需检查文件所有者权限和组权限，确保WEB SERVER用户有文件写入权限！'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 当前版本
        $current_version = $lrw_version;

        // 补丁地址
        $patch = $this->upgrade->patchList($current_version);

        /**
         * 在线升级列表
         */
        if ($act == 'index') {
            // 检查权限
            $check_auth = backend_auth('upgrade_manage');
            if ($check_auth !== true) {
//                abort(403, NO_OPERATE_AUTH);
            }

            if (empty($patch)) {
                $last_version = '当前版本为最新版';
            } else {
                $last_version = end($patch);
            }

            $lrw_release = get_release();
            $is_writable = $this->filesystem->isWritable(base_path());

            return view('upgrade.index',
                compact('title', 'current_version','lrw_release',
                    'last_version', 'is_writable', 'patch'));
        }

        /**
         * 在线升级功能
         */
        if ($_REQUEST['act'] == 'init') {
            // 检查权限
            $check_auth = backend_auth('upgrade_manage');
            if ($check_auth !== true) {
//                return result(-1, null, NO_OPERATE_AUTH);
            }

            // 确认是否升级
            $upgradeModel = $request->get('UpgradeModel', 0);
            if (empty($upgradeModel['cover'])) {
                return result(-1, null, '升级版本会覆盖老版本代码，请确认是否升级？');
            }

            // 获取补丁列表
            if (empty($patch)) {
                return result(-1, null, '当前版本为最新版');
            }

            // 创建缓存文件夹
            $upgrade_path = storage_path('upgrade');
            if (!$this->filesystem->isDirectory($upgrade_path)) {
                $this->filesystem->makeDirectory($upgrade_path);
            }

            // 更新补丁包
            $this->upgrade->upgrade($patch[0]);

            // 生成队列url
            if (isset($patch[1])) {
                $url = 'upgrade?act=init&cover=' . $upgradeModel['cover'] . '&t=' . time();
            } else {
                $url = 'upgrade?act=index';
                // 清除缓存 todo
//                clear_all_files();
            }

            // 升级成功
            $links = [
                [
                    'text' => $patch[0] . '升级成功！',
                    'href' => $url,
                ]
            ];
            return result(0, $links, '正在升级');
        }
    }
}
