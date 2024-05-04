<?php


namespace App\Repositories;

use App\Extensions\Http;
use GuzzleHttp\Client;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * 客户端程序升级逻辑代码
 *
 * Class Upgrade
 * @package App\Repository
 */
class UpgradeRepository
{
    protected $httpHandler;
    protected $filesystem;

    /**
     * @var string 补丁地址
     */
    protected $patchUrl;

    /**
     * UpgradeRepository constructor.
     * @param Client $client
     * @param Filesystem $filesystem
     */
    function __construct(
        Client $client,
        Filesystem $filesystem
    )
    {

        $this->httpHandler = $client;
        $this->filesystem = $filesystem;
        $this->patchUrl = config('lrw.upgrade_server') . '/metadata.json?v=' . date('Ymd');
    }

    /**
     * 检查是否有更新包
     *
     * @return false|mixed
     */
    public function checkVersion()
    {

        $current_version = sysconf('lrw_version') ?: '';

        // 补丁地址
        $patch = $this->patchList($current_version);

        if (empty($patch)) {
            $last_version = false; // '当前版本为最新版';
        } else {
            $last_version = end($patch);
        }

        return $last_version;
    }

    /**
     * 获取补丁列表
     * @param $current_version
     * @return array
     */
    public function patchList($current_version)
    {
        if (env('APP_ENV') == 'local') {
            return [];
        }
        $metadata = $this->httpHandler->get($this->patchUrl);

        $content = $metadata->getBody()->getContents();

        $metadata = lrw_decode($content, true);

        // 设置版本 hash
        Cache::forever('upgrade_hash', md5($content));

        // 获取可供当前版本升级的压缩包
        $patch = [];
        foreach ($metadata['version'] as $k => $v) {
            if (version_compare($v, $current_version, '>')) {
                $patch[] = $v;
            }
        }

        return $patch;
    }

    /**
     * 更新补丁包
     * @param $version
     * @return string
     */
    public function upgrade($version)
    {
        // 补丁文件
        $patch = 'patch_' . $version;

        // 获取版本 hash
        $hash = Cache::get('upgrade_hash');

        // 远程压缩包地址 http://download.lrwmall.cn/version/v2/patch_v2.1.3.zip?v=7a761415f89cfe32012240d7ded98b19
        $url = dirname($this->patchUrl) . '/version/' . substr($version, 0, 2) . '/' . $patch . '.zip?v=' . $hash;
        // 保存到本地地址
        $path = storage_path('upgrade/' . $patch . '.zip');
        // 补丁包解压路径
        $source_path = storage_path('upgrade/' . $patch);

        // 下载补丁压缩包
        $this->filesystem->put($path, $this->httpHandler->get($url)->getBody());

        // 解压缩补丁包 补丁包中已包含：Migration_v4_0_0.php文件
        if ($this->unzip($path, base_path()) === false) {
            Log::error($patch . ' upgrade unpack the failed');
            return redirect()->route('admin.upgrade');
        }

        // 删除文件
        $this->filesystem->delete($path);

        // 删除文件夹
        $this->filesystem->deleteDirectory($source_path);

        // 更新数据库
        $this->migrate($version);

        // 更新版本到数据库
        sysconf('lrw_version', $version);

        // 推送回服务器  记录升级成功
        $this->upgradeLog($version);
    }

    /**
     * 更新数据库
     * @param $version
     */
    protected function migrate($version)
    {
        $version = 'App\\Patch\\Migration_' . str_replace('.', '_', $version);
        if (class_exists($version)) {
            app($version)->run();
        }
    }

    /**
     * 解压文件到指定目录
     *
     * @param string   zip压缩文件的路径
     * @param string   解压文件的目的路径
     * @param boolean  是否以压缩文件的名字创建目标文件夹
     * @param boolean  是否重写已经存在的文件
     *
     * @return  boolean  返回成功 或失败
     */
    protected function unzip($src_file, $dest_dir = false, $create_zip_name_dir = true, $overwrite = true)
    {
        if ($zip = zip_open($src_file)) {
            if ($zip) {
                $splitter = ($create_zip_name_dir === true) ? "." : "/";
                if ($dest_dir === false) {
                    $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter)) . "/";
                } else {
                    $dest_dir = rtrim($dest_dir, '/') . '/';
                }

                // 如果不存在 创建目标解压目录
                if (!$this->filesystem->isDirectory($dest_dir)) {
                    $this->filesystem->makeDirectory($dest_dir);
                }

                // 对每个文件进行解压
                while ($zip_entry = zip_read($zip)) {
                    // 文件不在根目录
                    $pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");
                    if ($pos_last_slash !== false) {
                        // 创建目录 在末尾带 /
                        $path = $dest_dir . substr(zip_entry_name($zip_entry), 0, $pos_last_slash + 1);
                        if (!$this->filesystem->isDirectory($path)) {
                            $this->filesystem->makeDirectory($path);
                        }
                    }

                    // 打开包
                    if (zip_entry_open($zip, $zip_entry, "r")) {
                        // 文件名保存在磁盘上
                        $file_name = $dest_dir . zip_entry_name($zip_entry);

                        // 检查文件是否需要重写
                        if ($overwrite === true || ($overwrite === false && !is_file($file_name))) {
                            // 读取压缩文件的内容
                            $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                            if (!$this->filesystem->isDirectory($file_name)) {
                                $this->filesystem->put($file_name, $fstream);
                            }
                            // 设置权限
                            chmod($file_name, 0755);
                        }
                        // 关闭入口
                        zip_entry_close($zip_entry);
                    }
                }
                // 关闭压缩包
                zip_close($zip);

                return true;
            }
        }

        return false;
    }

    /**
     * 升级记录 log 日志
     *
     * @param $to_key_num
     */
    public function upgradeLog($to_key_num)
    {
        $param = array(
            'domain' => request()->header('host'), //用户域名
            'key_num' => sysconf('lrw_version'), // 用户版本号
            'to_key_num' => $to_key_num, // 用户要升级的版本号
            'time' => format_time(), // 升级时间
            'cpu' => '0001', // 用户cpu信息 用于区分唯一标识
            'mac' => '0002', // 用户网卡信息用于区分用户唯一标识
            'serial_number' => '20170824085023WhUahf',
        );
        $url = config('lrw.upgrade_server') . "/update/upgrade_log";
         Http::doPost($url, $param);
    }

}

?>