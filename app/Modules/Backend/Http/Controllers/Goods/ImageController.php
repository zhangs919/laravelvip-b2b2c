<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ImageDirRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Backend
{

    private $links = [
        ['url' => 'goods/image/list', 'text' => '平台方相册：'],
    ];

    protected $imageDir;

    protected $image;

    public function __construct(ImageDirRepository $imageDirRepository, ImageRepository $imageRepository)
    {
        parent::__construct();

        $this->imageDir = $imageDirRepository;
        $this->image = $imageRepository;
    }

    /**
     * 图片列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '图片列表';
        $fixed_title = '图片空间 - 图片列表';

        $type = $request->get('type', 0); // 图片展示模式 0大图模式 1列表模式
        $dir_id = $request->get('dir_id', 0);

        // 获取相册信息
        $image_dir_info = $this->imageDir->getById($dir_id); // todo
        $this->links[0]['text'] = '平台方相册：'.$image_dir_info->dir_name;
        $this->sublink($this->links, 'list', '', '?dir_id='.$dir_id);

        $action_span = [
            [
                'url' => '/goods/image-dir/list',
                'icon' => 'fa-reply',
                'text' => '返回相册列表'
            ],
            [
                'id' => 'btn_upload_image',
                'url' => '',
                'icon' => 'fa-cloud-upload',
                'text' => '上传图片'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
//        $search_arr = ['dir_name', 'dir_group'];
//        foreach ($search_arr as $v) {
//            if (isset($params[$v]) && !empty($params[$v])) {
//
//                if ($v == 'dir_name') {
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
//            }
//        }

        // 排序
        $sortname = $request->get('sortname', 'created_at');
        $sortorder = $request->get('sortorder', 'desc');

        // 列表
        $where[] = ['dir_id', '=', $dir_id];
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->image->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'dir_id');
        if ($request->ajax()) {
            $render = view('goods.image.partials._list_'.$type, $compact)->render();
            return result(0, $render);
        }
        return view('goods.image.list', $compact);
    }

    /**
     * 编辑图片名称
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function editName(Request $request)
    {
        $title = '修改图片名称';
        $id = $request->get('id');
        $uuid = make_uuid();
        $info = $this->image->getById($id);

        $render = view('goods.image.edit_name', compact('title', 'uuid', 'info'))->render();

        return result(0, $render);
    }

    /**
     * 编辑图片名称 保存数据
     *
     * @param Request $request
     * @return mixed
     */
    public function saveEditName(Request $request)
    {
        $post = $request->post('ImageModel');
        $ret = $this->image->update((int)$post['img_id'], $post);
        if ($ret === false) {
            // Log
            admin_log('更新图片名称失败。ID：'.$ret->img_id);
            // fail
            return result(-1, '', '更新图片名称失败');
        }
        // Log
        admin_log('更新图片名称成功。ID：'.$ret->img_id);
        // success
        return result(0, '', '更新图片名称成功');
    }

    /**
     * 设为封面
     *
     * @param Request $request
     * @return mixed
     */
    public function cover(Request $request)
    {
        $id = $request->post('id');
        $imageInfo = $this->image->getById($id);
        if (empty($imageInfo)) {
            return result(-1, '', '操作失败');
        }
        $input['dir_cover'] = $imageInfo->path;
        $ret = $this->imageDir->update($imageInfo['dir_id'], $input);

        if ($ret === false) {
            return result(-1, '', '操作失败');
        }

        return result(0, '', '操作成功');
    }

    /**
     * 替换上传
     *
     * @param Request $request
     * @return mixed
     */
    public function replace(Request $request)
    {
        $filename = $request->post('filename', 'name');
        $storePath = 'backend/gallery'; // todo
        $tools = new ToolsRepository();
        $uploadRes = $tools->uploadPic($request, $filename, $storePath, true);
        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        // 记录日志

        return result(0, '', '替换成功');

    }

    /**
     * 转移相册
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function move(Request $request)
    {
        $uuid = make_uuid();

        $condition = [
            'where' => [['dir_group', '=', 'backend']],
            'limit'=> 0,
            'sortname' => 'dir_sort',
            'sortorder' => 'asc'
        ];
        list($image_dir_list, $total) = $this->imageDir->getList($condition);

        $render = view('goods.image.move', compact('uuid', 'image_dir_list'))->render();

        return result(0, $render);
    }

    /**
     * 转移相册 保存数据
     *
     * @param Request $request
     * @return mixed
     */
    public function saveMoveData(Request $request)
    {
        $dir_id = $request->post('dir_id');
        $img_ids = $request->post('img_ids');
//        dd($img_ids);
        $condition = [
            ['img_id', 'in', $img_ids]
        ];
        $update = [
            'dir_id' => $dir_id
        ];
        $ret = $this->image->batchUpdate('img_id', $img_ids, $update);
        if ($ret === false) {
            return result(-1, '', '操作失败');
        }
        return result(0, '', '操作成功');
    }

    /**
     * 删除图片
     *
     * 目前只支持从数据库删除数据 后期考虑同步删除oss数据
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->image->batchDel($ids);
        if ($ret === false) {
            return result(-1, '', '图片批量删除失败');
        }

        return result(0, '', '图片批量删除成功');

//        $ret = Storage::delete($images);
    }

}