<?php

namespace app\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ImageDirRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ImageDirController extends Seller
{

    private $links = [
        ['url' => 'goods/image-dir/list', 'text' => '我的相册'],
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

        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => '/goods/image/trash',
                'icon' => 'fa-trash',
                'text' => '图片回收站'
            ],
            [
                'id' => 'btn_batch_add_dir',
                'url' => '',
                'icon' => 'fa-plus',
                'text' => '批量创建相册'
            ],
            [
                'id' => 'btn_add_dir',
                'url' => '',
                'icon' => 'fa-folder-open',
                'text' => '新建相册'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];

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
        $id = $request->get('id');
        if ($id) {
            $info = $this->imageDir->getById($id);
            view()->share('info', $info);
        }
        $uuid = make_uuid();
        $is_batch = $request->get('is_batch',0); // 是否批量创建相册
        $tpl = 'add';
        if ($is_batch) {
            $tpl = 'batch_add';
        }

        $render = view('goods.image-dir.'.$tpl, compact('uuid'))->render();

        return result(0, $render);
    }

    public function edit(Request $request)
    {
        return $this->add($request);
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
            $msg = '添加';
            // 店铺相册标识 dir_group = shop
            // 判断是否是批量添加
            $dir_name = $post['dir_name'];
            $dir_name = str_replace('，', ',', $dir_name);
            $dir_name = str_replace("\r\n", ',', $dir_name);
            $dir_name = str_replace(' ', ',', $dir_name);
            $dir_name = array_unique(explode(',', $dir_name));
            $insertAll = [];
            foreach ($dir_name as $item) {
                $insertAll[] = [
                    'dir_name' => $item,
                    'dir_sort' => $post['dir_sort'],
                    'dir_desc' => !empty($post['dir_desc']) ? $post['dir_desc'] : '',
                    'dir_group' => 'shop',
                    'shop_id' => seller_shop_info()->shop_id
                ];
            }
            $ret = $this->imageDir->addAll($insertAll);
        }

        if ($ret === false) {
            // fail
            return result(-1, '', $msg.'失败');
        }

        // Log
        // success
        return result(0, '', $msg.'成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->imageDir->del($id);
        if ($ret === false) {
            return result(-1, '', '删除失败');
        }
        return result(0, '', '删除成功');
    }

}