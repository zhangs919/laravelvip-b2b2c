<?php

namespace App\Repositories;


use App\Models\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ToolsRepository
{
    use BaseRepository;

    protected $model;

    public function uploadOnePic($request, $filename, $storePath = '', $isReplace = false, $base64Field = '', $defaultDriver = '')
    {

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $filename, $result) || $base64Field == 'img_base64') {//base64上传
            // 单图上传
            $data = $this->upfile($filename, $request, $storePath, $isReplace, $base64Field, $defaultDriver);
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
                    $resItem = $this->upfile($item, $request, $storePath, $isReplace, '', $defaultDriver);
                    if (isset($resItem['error']) && !empty($resItem['error'])) {
                        $error = $resItem['error'];
                    }
                    $data[] = $resItem;
                }
                $count = count($data);
            } else {
                // 单图上传
                $data = $this->upfile($file, $request, $storePath, $isReplace, '', $defaultDriver);
                if (isset($data['error']) && !empty($data['error'])) {
                    $error = $data['error'];
                }
                $count = 1;
            }
        }

        $result = [
            'count' => $count,
            'data' => $data
        ];
        if (!empty($error)) {
            $result['error'] = $error;
        }

        return $result;
    }

    public function upfile($file, Request $request, $storePath = 'temp', $isReplace = false, $base64Field = '', $defaultDriver = '')
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
                return ['error' => '上传图片不合法'];
            }

            $filesize = $file->getSize();
            // 4.先得到文件后缀,然后将后缀转换成小写,然后看是否在否和图片的数组内
            $ext = strtolower($file->extension()) == 'jpeg' ? 'jpg' : strtolower($file->extension());
            $originalName = $file->getClientOriginalName();

            if ($ext == 'txt') {
                $ext = str_replace('.', '', strrchr($originalName, '.'));
            }
            $name = str_replace(strrchr($originalName, '.'), '', $originalName);
        }

        if(! in_array( $ext, ['jpeg','jpg','gif','gpeg','png','txt', 'pem'])){
            return ['error' => '上传图片后缀不合法'];
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



        // 默认文件系统驱动
        if (!$defaultDriver) {
//            $defaultDriver = config('filesystems.default');
            $defaultDriver = sysconf('alioss_enable') ? 'oss' : 'local';
        }

        // 是否添加水印
        $is_watermark = $request->post('is_watermark', 0);
        if ($is_watermark) {
            // 添加水印

        }

        if ($defaultDriver == 'oss') {
            // oss上传
            $dirname = '/'.$storePath.'/'.date('Y/m/d').'/'; // /backend/gallery/2018/04/05/
            $path = $dirname.$newName.'.'.$ext;
            $host = 'https://'.sysconf('oss_domain').$fullpath;
            $url = $host.ltrim($path, '/');
            try {
                $contents = file_get_contents($file); // 文件内容
                $result = Storage::put($fullpath.ltrim($path, '/'), $contents);
            } catch(\Exception $e) {
                return ['error' => $e->getMessage()];
            }
        }elseif($defaultDriver == 'local') {
            // 本地上传
            $dirname = '/upload/'.$storePath.'/'.date('Y/m/d').'/'; // /backend/gallery/2018/04/05/
            $path = $dirname.$newName.'.'.$ext;
            $host = request()->getSchemeAndHttpHost().'/';
            $url = $host.ltrim($path, '/');
            $result = $file->move(storage_path(ltrim($dirname, '/')), $newName.'.'.$ext);
        }

        if(!$result){
            return ['error' => '图片上传失败'];
        }

        $imageSize = getimagesize($url);
        $width = 0;
        $height = 0;
        if (!empty($imageSize)) {
            $width = $imageSize[0];
            $height = $imageSize[1];
        }

        $imageRep = new ImageRepository();
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
            $ret = $imageRep->update($id, $updateArray);
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
        $ret = $imageRep->store($insertArray);

        if ($ret === false) {
            return ['error' => '图片信息保存失败'];
        }

        $data = [
            'add_time' => time(),
            'dir_id' => $dir_id, // "45", // 图片相册id
            'dirname' => $dirname, // /backend/gallery/2018/04/05/
            'extension' => $ext, // "png"
            'file_name' => $newName, // 15229209224694
            'height' => $height,
            'host' => $host, //'http://xx.oss-cn-beijing.aliyuncs.com/images/11880/',
            'img_id' => $ret->img_id, // 图片id
            'name' => $name,
            'path' => $path, // /backend/gallery/2018/04/05/15229209224694.png
            'size' => $filesize, // 42768
            'sort' => 255,
            'url' =>  $url, // http://xxx.oss-cn-beijing.aliyuncs.com/images/11880/backend/gallery/2018/04/05/xxxx.png
            'width' => $width
        ];
        return $data;
    }

    //    上传图片
    public function uploadPic(Request $request, $filename, $storePath = '', $isReplace = false, $base64Field = '', $defaultDriver = '')
    {
        $result = $this->uploadOnePic($request, $filename, $storePath, $isReplace, $base64Field, $defaultDriver);
        return $result;

    }

    /**
     * 上传 Ueditor 远程图片
     *
     * @param $url
     * @param string $storePath 'backend/1'
     * @return array|Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function uploadUeditorRemoteImage($url, $storePath = 'site/1/ueditor')
    {
        $ext = 'jpg';
        $newName = time().rand(1000, 9999);
        $dirname = '/'.$storePath.'/'.date('Y/m/d').'/';
        $path = $dirname.$newName.'.'.$ext;
        $fullpath = '/' . sysconf('alioss_root_path') . '/';
        $host = 'http://' . sysconf('oss_domain') . $fullpath;
        $result = Storage::put($fullpath . ltrim($path, '/'), file_get_contents($url));
        if (!$result) {
            return arr_result(-1, null, '上传失败');
        }
        $resultUrl = $host . ltrim($path, '/');

        return arr_result(0, $resultUrl, '上传成功');
    }

    /**
     * 上传 远程图片
     *
     * @param $url
     * @param string $storePath 'backend/1'
     * @return array|Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function uploadRemoteImage($url, $storePath = 'backend/collect')
    {
        if (empty($url)) {
            return arr_result(-1, null, '上传失败');
        }
        $ext = 'jpg';
        $newName = time().rand(1000, 9999);
        $dirname = '/'.$storePath.'/'.date('Y/m/d').'/';
        $path = $dirname.$newName.'.'.$ext;
        $fullpath = '/' . sysconf('alioss_root_path') . '/';
        $host = 'http://' . sysconf('oss_domain') . $fullpath;
        $result = Storage::put($fullpath . ltrim($path, '/'), file_get_contents($url));

        if (!$result) {
            return arr_result(-1, null, '上传失败');
        }
        $resultUrl = $host . ltrim($path, '/');
        $res = [
            'path' => $path,
            'url' => $resultUrl
        ];

        return arr_result(0, $res, '上传成功');
    }

    /**
     * 上传 远程视频
     *
     * @param $url
     * @param string $storePath 'backend/1'
     * @return array|Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function uploadRemoteVideo($url, $storePath = 'backend/collect')
    {
        $ext = 'mp4';
        $newName = time().rand(1000, 9999);
        $dirname = '/'.$storePath.'/'.date('Y/m/d').'/';
        $path = $dirname.$newName.'.'.$ext;
        $fullpath = '/' . sysconf('alioss_root_path') . '/';
        $host = 'http://' . sysconf('oss_domain') . $fullpath;
        $result = Storage::put($fullpath . ltrim($path, '/'), file_get_contents($url));

        if (!$result) {
            return arr_result(-1, null, '上传失败');
        }
        $resultUrl = $host . ltrim($path, '/');
        $res = [
            'path' => $path,
            'url' => $resultUrl
        ];

        return arr_result(0, $res, '上传成功');
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
