<?php

namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadVideoRepository
{
    use BaseRepository;

    protected $model;

    public function uploadOne($request, $filename, $storePath = '', $isReplace = false, $base64Field = '')
    {

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $filename, $result) || $base64Field == 'img_base64') {//base64上传
            // 单图上传
            $data = $this->upfile($filename, $request, $storePath, $isReplace, $base64Field);
            $count = 1;
        } else {
            // file上传
            foreach ($request->file() as $k=>$v) {
                $filename = $k;
            }
            // 1.首先检查文件是否存在
            if (! $request->hasFile($filename)) {
                return 1;
            }

            // 2.获取文件
            $file = $request->file($filename);

            if (is_array($file)) {
                // 多图上传
                $data = [];
                foreach ($file as $item) {
                    $data[] = $this->upfile($item, $request, $storePath, $isReplace);
                }
                $count = count($data);
            } else {
                // 单图上传
                $data = $this->upfile($file, $request, $storePath, $isReplace);
                $count = 1;
            }
        }

        $result = [
            'count' => $count,
            'data' => $data
        ];

        return $result;
    }

    public function upfile($file, Request $request, $storePath = 'temp', $isReplace = false, $base64Field = '')
    {

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $result) || $base64Field == 'img_base64') {//base64上传
            if (!preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $result)) { // 没有匹配到 则手动添加 data:image/jpeg;base64
                $file = 'data:image/png;base64,'.$file; // todo image/jpeg 是个bug 后期修复
            }
            preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $result);
            $ext = $result[2]; // 图片扩展名
            $name = ''; // 图片名称
            $filesize = strlen(file_get_contents($file));
        } else { // file上传
            // 3.其次检查图片合法是否
            if (!$file->isValid()){
                return ['error' => '上传文件不合法'];
            }

            $filesize = $file->getSize();
            // 4.先得到文件后缀,然后将后缀转换成小写,然后看是否在否和图片的数组内
            $ext = strtolower($file->extension()) == 'jpeg' ? 'jpg' : strtolower($file->extension());

            $originalName = $file->getClientOriginalName();
            $name = str_replace(strrchr($originalName, '.'), '', $originalName);
        }

        if(! in_array( $ext, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'm4v'])){
            return ['error' => '上传文件后缀不合法'];
        }

        // 4.将文件取一个新的名字
        $newName = time().rand(1000, 9999);

        // 5.移动文件,并修改名字

        $options = json_decode($request->post('options'));
        $maxSize = !empty($options->maxSize) ? $options->maxSize : 0; // 图片允许的最大尺寸
        $dir_id = $request->post('dir_id') ? $request->post('dir_id') : 0; // 相册目录id

        $fullpath = '/'.sysconf('alioss_root_path').'/';
//        if ($siteId) {
//            // 站点id 针对多个站点
//            $fullpath = '/'.sysconf('alioss_root_path').'/'.$siteId.'/';
//        }


        $dirname = '/'.$storePath.'/'.date('Y/m/d').'/'; // /backend/gallery/2018/04/05/
        $path = $dirname.$newName.'.'.$ext;

        // 默认文件系统驱动
        $defaultDriver = config('filesystems.default');

        if ($defaultDriver == 'oss') {
            $region_domains = '[{"name":"西南1(成都)","domain":"oss-cn-chengdu.aliyuncs.com","internal_domain":"oss-cn-chengdu-internal.aliyuncs.com","image_domain":"img-cn-chengdu.aliyuncs.com"},{"name":"华东2(上海)","domain":"oss-cn-shanghai.aliyuncs.com","internal_domain":"oss-cn-shanghai-internal.aliyuncs.com","image_domain":"img-cn-shanghai.aliyuncs.com"},{"name":"华北1(青岛)","domain":"oss-cn-qingdao.aliyuncs.com","internal_domain":"oss-cn-qingdao-internal.aliyuncs.com","image_domain":"img-cn-qingdao.aliyuncs.com"},{"name":"华北2(北京)","domain":"oss-cn-beijing.aliyuncs.com","internal_domain":"oss-cn-beijing-internal.aliyuncs.com","image_domain":"img-cn-beijing.aliyuncs.com"},{"name":"华东1(杭州)","domain":"oss-cn-hangzhou.aliyuncs.com","internal_domain":"oss-cn-hangzhou-internal.aliyuncs.com","image_domain":"img-cn-hangzhou.aliyuncs.com"},{"name":"华南1(深圳)","domain":"oss-cn-shenzhen.aliyuncs.com","internal_domain":"oss-cn-shenzhen-internal.aliyuncs.com","image_domain":"img-cn-shenzhen.aliyuncs.com"},{"name":"香港","domain":"oss-cn-hongkong.aliyuncs.com","internal_domain":"oss-cn-hongkong-internal.aliyuncs.com","image_domain":"img-cn-hongkong.aliyuncs.com"},{"name":"亚洲(新加坡)","domain":"oss-ap-southeast-1.aliyuncs.com","internal_domain":"oss-ap-southeast-1-internal.aliyuncs.com","image_domain":"img-ap-southeast-1.aliyuncs.com"},{"name":"美西1(美国硅谷)","domain":"oss-us-west-1.aliyuncs.com","internal_domain":"oss-us-west-1-internal.aliyuncs.com","image_domain":"img-us-west-1.aliyuncs.com"},{"name":"美东1(美国弗吉尼亚)","domain":"oss-us-east-1.aliyuncs.com","internal_domain":"oss-us-east-1-internal.aliyuncs.com","image_domain":"img-us-east-1.aliyuncs.com"}]';
            $region_domains = json_decode($region_domains, true);
            $alioss_bucket_region = sysconf('alioss_bucket_region');
            $bucket_region_data = $region_domains[$alioss_bucket_region+1] ?? [];
            if (empty($bucket_region_data)) {
                return ['error' => '请检查oss配置'];
            }
            // 动态 OSS 配置
            $ossConfig = [
                'driver'        => 'oss',
                'access_id'     => sysconf('alioss_access_key_id'),
                'access_key'    => sysconf('alioss_access_key_secret'),
                'bucket'        => sysconf('alioss_bucket_name'),
                'endpoint'      => $bucket_region_data['domain'], // 根据实际区域调整
//                'endpoint_internal'      => $bucket_region_data['internal_domain'], // 根据实际区域调整
                'cdnDomain'        => sysconf('alioss_domain'),
                'ssl'       => false, // true to use 'https://' and false to use 'http://'. default is false,
                'isCName'       => !empty(sysconf('alioss_domain')), // 是否使用自定义域名,true: 则Storage.url()会使用自定义的cdn或域名生成文件url， false: 则使用外部节点生成url
                'debug'       => false,
//                'timeout'       => 3600, // 超时设置（可选）
//                'connect_timeout' => 10, // 连接超时（可选）
//                // 其他可能的配置项...
//                'prefix' => '',
                'throw' => true,
            ];

            // 创建临时磁盘实例
            $disk = Storage::build($ossConfig);

            // oss上传
            $host = 'http://'.sysconf('oss_domain').$fullpath;

            $url = $host.ltrim($path, '/');
            $contents = file_get_contents($file); // 文件内容
            $result = $disk->put($fullpath.ltrim($path, '/'), $contents);

//            $result = Storage::put($fullpath.trim($dirname, '/'), $file);
//            $url = 'http://'.sysconf('oss_domain').'/'.$result;
        }elseif($defaultDriver == 'local') {
            // 本地上传
            $host = route('pc_home').'/images';
            $url = $host.$path;
            $result = $file->move(public_path($fullpath.ltrim($dirname, '/')), $newName.'.'.$ext);
        }

        if(! $result){
            return ['error' => '文件上传失败'];
        }

        $imageSize = getimagesize($url);
        $width = 0;
        $height = 0;
        if (!empty($imageSize)) {
            $width = $imageSize[0];
            $height = $imageSize[1];
        }

        $videoRep = new VideoRepository();
        // 替换上传
        $id = $request->post('id', 0);
        if ($isReplace) {
            // 更新该图片id的图片路径
            $updateArray = [
                'dirname' => $dirname,
                'extension' => $ext,
                'file_name' => $newName,
                'path' => $path,
                'name' => $name,
                'size' => $filesize,
                'width' => $width,
                'height' => $height
            ];
            $ret = $videoRep->update($id, $updateArray);
            if ($ret === false) {
                return ['error' => '图片信息保存失败'];
            }
            return $ret;
        }

        // 新增上传
        // 图片上传成功 存入相册图片表
        $insertArray = [
            'dir_id' => $dir_id,
            'dirname' => $dirname,
            'extension' => $ext,
            'file_name' => $newName,
            'path' => $path,
            'name' => $name,
            'size' => $filesize,
            'width' => $width,
            'height' => $height
        ];
        $ret = $videoRep->store($insertArray);

        if ($ret === false) {
            return ['error' => '文件信息保存失败'];
        }

        $data = [
            'add_time' => time(),
            'audio_bit_rate' => '45222', // 音频码率
            'audio_channels' => 2, // 声道数
            'audio_codec' => 'AAC (Advanced Audio Coding)', // 编解码格式
            'audio_desc' => 'AAC (Advanced Audio Coding) 48000Hz 立体声 44.162109375Kbps',
            'audio_duration' => '41.770000',
            'bit_rate' => '482591',
            'dir_id' => $dir_id, // "45", // 图片相册id
            'dirname' => $dirname, // /backend/gallery/2018/04/05/
            'display_ratio' => '0:1',
            'duration' => '41.792000',
            'extension' => $ext, // "png"
            'file_name' => $newName, // 15229209224694
            'frame_rate' => 24,
            'height' => $height,
            'host' => $host, //'http://xxx.oss-cn-beijing.aliyuncs.com/images/',
            'name' => $name,
            'path' => $path, // /videos/shop/1/gallery/2019/03/17/xxx.mp4
            'poster' => $url.'!poster.png', //'http://xxx.oss-cn-beijing.aliyuncs.com/images/videos/shop/1/gallery/2019/03/17/xxx.mp4!poster.png',
            'sample_rate' => '48000', // 采样率
            'shop_id' => 0, //$shop_id,
            'site_id' => 0, //$site_id,
            'size' => $filesize, // 42768
            'sort' => 255,
            'url' =>  $url, // http://xxx.oss-cn-beijing.aliyuncs.com/images/videos/shop/1/gallery/2019/03/17/xxx.mp4
            'video_bit_rate' => '435573',
            'video_codec' => 'H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10',
            'video_desc' => 'H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10 640x368 24fps 425.3642578125Kbps',
            'video_id' => $ret->video_id, // 视频id
            'width' => $width
        ];
        return $data;
    }

    //    上传图片
    public function uploadVideo(Request $request, $filename, $storePath = '', $isReplace = false, $base64Field = '')
    {
        $result = $this->uploadOne($request, $filename, $storePath, $isReplace, $base64Field);
        return $result;

    }

    /**
     * 根据地名查询经纬度
     *
     * @response location->lng location->lat precise confidence level
     * @param $search
     * @return bool|string
     */
//    public static function searchAddressToLngLat($search)
//    {
//        $mapApiType = sysconf('map_api_type'); // 调用的地图API类型 1高德地图 2百度地图
//        if ($mapApiType == 1) {
//            // 高德地图 todo 如何通过高德地图搜索地区名查询经纬度
//
//            return false;
//        } elseif($mapApiType == 2) {
//            // 百度地图
//            $ak = sysconf('bmap_js_key');
//            $result = file_get_contents('http://api.map.baidu.com/geocoder/v2/?address='.$search.'&output=json&ak='.$ak);
//            $result = json_decode($result);
//            if ($result->status == 1) {
//                // 未搜索到地区
//                return false;
//            }
//
//            $location = $result->result->location;
//            $data = round($location->lng,5).','.round($location->lat,5);
//            return $data;
//        } else {
//            return false;
//        }
//
//    }

}
