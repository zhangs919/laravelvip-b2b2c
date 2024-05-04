<?php

namespace App\Modules\Backend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * UEditor 集成秀米排版功能
 * 
 * Class UEditorController.
 */
class UEditorController extends Backend
{

    protected $tools;

    public function __construct(ToolsRepository $tools)
    {
        parent::__construct();

        $this->tools = $tools;
    }

    public function serve(Request $request)
    {
        $upload = config('ueditor.upload');
        $storage = app('ueditor.storage');

        switch ($request->get('action')) {
            case 'config':
                return config('ueditor.upload');

            case $upload['imageActionName']: // 重写图片上传方法
                $filename = $request->post('filename', 'name');
                $storePath = 'site/1/ueditor';

                $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);
                if (isset($uploadRes['error'])) {
                    // 上传出错
                    return [
                        'state' => '上传失败',
                    ];
                }

                return [
                    'state' => 'SUCCESS',
                    'url' => $uploadRes['data']['url'],
                    'title'=> '',
                    'original'=>'',
                ];

            // lists
            case $upload['imageManagerActionName']: // todo 后期再做
                return $storage->listFiles(
                    $upload['imageManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['imageManagerAllowFiles']);

            case $upload['fileManagerActionName']: // todo 后期再做
                return $storage->listFiles(
                    $upload['fileManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['fileManagerAllowFiles']);

            case $upload['catcherActionName']: // 重写抓取远程图片方法
                $source = $request->post('source');
                if (!empty($source)) {
                    foreach ($source as $item) {
                        // 上传图片
                        $ossImageRes = $this->tools->uploadUeditorRemoteImage($item);
                        if ($ossImageRes['code'] == -1) {
                            return ['state' => '抓取远程图片失败'];
                        }
                        $list[] = [
                            'state' => 'SUCCESS',
                            'url' => $ossImageRes['data'],
                            'size' => null,
                            'title'=> '',
                            'original'=>'',
                            'source'=> $item
                        ];
                    }
                }

                $result = [
                    'state' => 'SUCCESS',
                    'list' => $list
                ];
                return $result;
            default:
                // 默认 上传操作 todo 后期再完善
//                return $storage->upload($request);
        }
    }

//    /**
//     * 上传远程图片
//     *
//     * @param $url
//     * @return array
//     */
//    private function uploadRemoteImage($url)
//    {
//        $fullpath = '/' . sysconf('alioss_root_path') . '/';
//        $host = 'http://' . sysconf('oss_domain') . $fullpath;
//        $savepath = '/site/1/ueditor/'.date('Ymd').'/' . make_uuid() . '.jpg';
//        $result = Storage::put($fullpath . ltrim($savepath, '/'), file_get_contents($url));
//        if (!$result) {
//            return arr_result(-1, null, '上传失败');
//        }
//        $resultUrl = $host . ltrim($savepath, '/');
//
//        return arr_result(0, $resultUrl, '上传成功');
//    }
}
