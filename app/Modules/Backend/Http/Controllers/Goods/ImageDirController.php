<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ImageDirRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ImageDirController extends Backend
{

    private $links = [

    ];

    protected $imageDir;

    protected $image;

    public function __construct(ImageDirRepository $imageDirRepository, ImageRepository $imageRepository)
    {
        parent::__construct();

        $this->imageDir = $imageDirRepository;
        $this->image = $imageRepository;
    }


    public function lists(Request $request)
    {
        $title = '相册列表';
        $fixed_title = '图片空间 - 相册列表';

        $action_span = [
            [
                'url' => '/goods/image/trash',
                'icon' => 'fa-trash',
                'text' => '平台方图片回收站'
            ],
            [
                'id' => 'btn_add_dir',
                'url' => '',
                'icon' => 'fa-folder-open',
                'text' => '新建平台方相册'
            ],
        ];

        $explain_panel = [
            '商城后台上传的图片自动上传到图片空间中，可以直接由图片空间调用'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['dir_name', 'dir_group'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'dir_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'relation' => 'image',
            'sortname' => 'dir_id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->imageDir->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.image-dir.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.image-dir.list', $compact);
    }

    public function add(Request $request)
    {
        $uuid = make_uuid();

        $render = view('goods.image-dir.add', compact('uuid'))->render();

        return result(0, $render);
    }

    public function edit(Request $request)
    {
        $id = $request->get('dir_id');
        // 获取信息
        $info = $this->imageDir->getById($id);
        $uuid = make_uuid();

        $render = view('goods.image-dir.add', compact('uuid', 'info'))->render();

        return result(0, $render);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('ImageDir');

        if (!empty($post['dir_id'])) {
            // 编辑
            $ret = $this->imageDir->update((int)$post['dir_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            // 平台方相册标识 dir_group = backend
            $post['dir_group'] = 'backend';
            $ret = $this->imageDir->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // Log
            admin_log($msg.'相册信息失败。ID：'.$ret->dir_id);
            // fail
            return result(-1, '', $msg.'失败');
        }
        // Log
        admin_log($msg.'相册信息成功。ID：'.$ret->dir_id);
        // success
        return result(0, '', $msg.'成功');
    }

}