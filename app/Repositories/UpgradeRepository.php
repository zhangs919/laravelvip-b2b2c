<?php


namespace App\Repositories;

use App\Http\Controllers\Controller;


/**
 * 客户端程序升级逻辑代码
 *
 * Class Upgrade
 * @package App\Repository
 */
class UpgradeRepository
{
    public $app_path;
    public $version_txt_path;
    public $current_version;
    public $service_url;

    /**
     * 析构函数
     */
    function  __construct() {

        $this->app_path = base_path(); // 当前项目路径为 根目录 //dirname($_SERVER['SCRIPT_FILENAME']).'/'; // 当前项目路径
        $this->version_txt_path = config_path('version.php'); // 版本文件路径
        $this->current_version = file_get_contents($this->version_txt_path); // 记录版本的常量文件
//        $this->service_url = "http://service.tp-shop.cn/index.php?m=Home&c=Index&a=checkVersionTp5";
        $this->service_url = env('UPGRADE_SERVER');

    }
    /**
     * 检查是否有更新包
     * @return type 提示语
     */
    public function checkVersion() {

        //echo "if(strtolower(".CONTROLLER_NAME.") == 'index' && strtolower(".ACTION_NAME.") == 'index')";
//        if(strtolower(CONTROLLER_NAME) == 'index' && strtolower(ACTION_NAME) == 'index')
//        {
//            // welcome  index
//           // echo  'welcome  index';
//        }else{
//            return false;
//        }
        error_reporting(0);//关闭所有错误报告
        $url = /*$this->service_url.*/"https://www.apprh.com/check_version?v=".config('version.version');  // http://service.tp-shop.cn/index.php?m=Home&c=Index&a=checkVersionTp5&v=v2.0.0
        $context = stream_context_set_default(array('http' => array('timeout' => 3,'method'=>'GET')));
        $serviceVersion = file_get_contents($url,false,$context);
        $serviceVersion = json_decode(trim($serviceVersion,chr(239).chr(187).chr(191)),true);

        return $serviceVersion;
//        if($serviceVersion['code'] == 0)
//        {
//            return array(
//                0 => $serviceVersion['data']['prompt1'],
//                1 => $serviceVersion['data']['prompt2'], // 升级提示需要覆盖哪些文件
//            );
//        }
//        return null;
    }
    /**
     * 一键更新
     */
    public  function OneKeyUpgrade(){
        error_reporting(0);//关闭所有错误报告                
        $allow_url_fopen = ini_get('allow_url_fopen');
        if(!$allow_url_fopen)
            return "请开启 php.ini allow_url_fopen = 1";

//        $url = $this->service_url."?v=".$this->current_version;
        $url = $this->service_url."check_version?v=".config('version.version');


        $context = stream_context_set_default(array('http' => array('timeout' => 3,'method'=>'GET')));
        $serviceVersion = file_get_contents($url,false,$context);
        $serviceVersion = json_decode(trim($serviceVersion,chr(239).chr(187).chr(191)),true);

        if($serviceVersion['code'] == -1)
            return "没找到升级信息";

//        dd($serviceVersion);
        clearstatcache(); // 清除文件夹权限缓存
        $quanxuan = substr(base_convert(@fileperms($this->app_path),10,8),-4);

        if(!in_array($quanxuan,array('0777','0666','0222')))
            return "网站根目录不可写,无法升级.";

        if(!is_writeable($this->version_txt_path))
            return '文件'.$this->version_txt_path.' 不可写,不能升级!!!';
        // 下载文件        
        $result = $this->downloadFile($serviceVersion['data']['download_url'],$serviceVersion['data']['file_md5']);
//        dd($result);
        if($result != 1) return $result;

        $downFileName = explode('/', $serviceVersion['data']['download_url']);
        $downFileName = end($downFileName);
//        $folderName = str_replace(".zip","",$downFileName);  // 文件夹
        $folderName = 'upgrade';

        // 解压文件
        $zip = new \ZipArchive();//新建一个ZipArchive的对象
        if($zip->open($this->app_path.'/backup/'.$downFileName)!=TRUE)
            return "升级压缩文件读取失败!";
        $zip->extractTo($this->app_path.'/backup/');//假设解压缩到在当前路径下backup文件夹内
        $zip->close();//关闭处理的zip文件

        if(!file_exists($this->app_path.'/backup/'.$folderName.'/www/config/version.php'))
            return "缺少version文件!";

        if(file_exists($this->app_path.'/backup/'.$folderName.'/www/config/database.php'))
            return "不得修改db文件!";

        if(file_exists($this->app_path.'/backup/'.$folderName.'/www/.env'))
            return "不得修改.env配置文件!";

        // 递归复制文件夹
        recurse_copy($this->app_path.'/backup/'.$folderName.'/www/', $this->app_path);
        // 升级的 sql文件
        if(count($serviceVersion['data']['sql_file']) > 0)
        {
            foreach($serviceVersion['data']['sql_file'] as $key => $val)
            {
                $sqlpath = $this->app_path.'backup/'.$folderName.'/sql/'.trim($val);
                $execute_sql = file_get_contents($sqlpath);
                //$execute_sql = iconv("gbk","utf-8//IGNORE",$execute_sql);       
                $execute_sql = explode(';', $execute_sql);
                //print_r($execute_sql);
                foreach($execute_sql as $k => $v)
                    trim($v) && Db::execute($v); // 遍历执行 升级sql语句
            }
        }
        // 修改version.txt 文件
        //file_put_contents($this->version_txt_path,$serviceVersion['to_key_num']);  
        // 删除下载的升级包
//        dd($this->app_path.'/backup/'.$downFileName);
        delFile($this->app_path.'/backup/'.$folderName,true);
        // 推送回服务器  记录升级成功
        $this->UpgradeLog($serviceVersion['data']['version']);
        // 这里写 推送回服务器代码
        return 1;
    }


    /**
     * @param type $fileUrl 下载文件地址
     * @param type $md5File 文件MD5 加密值 用于对比下载是否完整
     * @return string 错误或成功提示
     */
    public function downloadFile($fileUrl,$md5File)
    {
        $downFileName = explode('/', $fileUrl);
        $downFileName = end($downFileName);
//        $saveDir = dirname($_SERVER['SCRIPT_FILENAME']).'/upgrade/'.$downFileName; // 保存目录
        $saveDir = $this->app_path.'/backup/'.$downFileName; // 保存目录


        if(!file_get_contents($fileUrl,0,null,0,1)){
            return "下载升级文件不存在"; // 文件存在直接退出
        }
        $ch = curl_init($fileUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $file = curl_exec ($ch);
        curl_close ($ch);
        $fp = fopen($saveDir,'w');
        fwrite($fp, $file);
        fclose($fp);

//        dd($saveDir);
        if($md5File != md5_file($saveDir))
        {
            return "下载的文件有损害, 请重试!";
        }
        return 1;
    }

    // 升级记录 log 日志
    public  function UpgradeLog($to_key_num){

        $vaules = array(
            'domain'=>$_SERVER['HTTP_HOST'], //用户域名
            'key_num'=>config('version.version'), // 用户版本号
            'to_key_num'=>$to_key_num, // 用户要升级的版本号
            'time'=>time(), // 升级时间
            'cpu'=>'0001', // 用户cpu信息 用于区分唯一标识
            'mac'=>'0002', // 用户网卡信息用于区分用户唯一标识
            'serial_number'=>'20170824085023WhUahf',
        );
//         $url = "http://service.tp-shop.cn/index.php?m=Home&c=Index&a=upgradeLog&".http_build_query($vaules);
        $url = "https://www.apprh.com/upgrade_log?".http_build_query($vaules);
        file_get_contents($url);
    }





}
?>