<?php

namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolsRepositorya
{

    public function uploadOnePic($request, $filename, $filepath)
    {

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
                $data[] = $this->upfile($item, $filepath, $request);
            }
            $count = count($data);
        } else {
            // 单图上传
            $data = $this->upfile($file, $filepath, $request);
            $count = 1;
        }

        $result = [
            'count' => $count,
            'data' => $data
        ];

        return $result;
    }

    private function upfile($file, $filepath, Request $request)
    {

        // 3.其次检查图片合法是否
        if (!$file->isValid()){
            return ['error' => '上传图片不合法'];
        }

//        dd($request->file()->);getFileInfo
//        dd($file->getFileInfo());
        $filesize = $file->getSize();
        // 4.先得到文件后缀,然后将后缀转换成小写,然后看是否在否和图片的数组内
        $ext = strtolower($file->extension()) == 'jpeg' ? 'jpg' : strtolower($file->extension());
        if(! in_array( $ext, ['jpeg','jpg','gif','gpeg','png'])){
            return ['error' => '上传图片后缀不合法'];
        }

        // 4.将文件取一个新的名字
        $newName = time().rand(1000, 9999);

        // 5.移动文件,并修改名字

        $options = json_decode($request->post('options'));
        $maxSize = $options->maxSize; // 图片允许的最大尺寸
        $dir_id = $request->post('dir_id');
        $originalName = $file->getClientOriginalName();
        $dirname = '/backend/gallery/'.date('Y/m/d').'/'; // /backend/gallery/2018/04/05/
        $path = $dirname.$newName.'.'.$ext;
        $fullpath = '/'.sysconf('alioss_root_path').'/'.$dir_id.'/';
        $host = 'http://'.sysconf('oss_domain').$fullpath;
        $url = $host.ltrim($path, '/');
//        dd($file->getFilename());
        // 默认文件系统驱动
        $defaultDriver = config('filesystems.default');
//        $result = false;
        if ($defaultDriver == 'oss') {
            // oss上传
            $result = Storage::put($fullpath.ltrim($path, '/'), $file->getFilename());
        }elseif($defaultDriver == 'local') {
            // 本地上传
            $result = $file->move(public_path($fullpath.ltrim($dirname, '/')), $newName.'.'.$ext);
        }

        if(! $result){
            return ['error' => '图片上传失败'];
        }
//        Storage::size('path/to/file/file.jpg');
//        dd(getimagesize($url));

        $data = [
            'add_time' => time(),
            'dir_id' => $dir_id, // "45", // 图片相册id
            'dirname' => $dirname, // /backend/gallery/2018/04/05/
            'extension' => $ext, // "png"
            'file_name' => $newName, // 15229209224694
            'height' => 55,
            'host' => $host, //'http://68yun.oss-cn-beijing.aliyuncs.com/images/11880/',
            'img_id' => 200, // 图片id
            'name' => $originalName,
            'path' => $path, // /backend/gallery/2018/04/05/15229209224694.png
            'size' => $filesize, // 42768
            'sort' => 255,
            'url' =>  $url, // http://68yun.oss-cn-beijing.aliyuncs.com/images/11880/backend/gallery/2018/04/05/15229209224694.png
            'width' => 34
        ];
        return $data;
    }

    //    上传图片
    public function uploadPic(Request $request, $filename, $filepath)
    {
        $result = $this->uploadOnePic($request, $filename, $filepath);
        return $result;

    }

    /**
     * 根据地名查询经纬度
     *
     * @response location->lng location->lat precise confidence level
     * @param $search
     * @return bool|string
     */
    public static function searchAddressToLngLat($search)
    {
        $ak = 'ThZPomUj8vmkMa9LAxzGYSa1BlLfWGbU';
        $result = file_get_contents('http://api.map.baidu.com/geocoder/v2/?address='.$search.'&output=json&ak='.$ak);
        $result = json_decode($result);
        if ($result->status == 1) {
            // 未搜索到地区
            return false;
        }

        $location = $result->result->location;
        $data = round($location->lng,5).','.round($location->lat,5);
        return $data;
    }

}