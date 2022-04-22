<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Exports\BrandsExport;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\BrandRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Backend
{

    private $links = [
        ['url' => 'goods/brand/list', 'text' => '管理'],
        ['url' => 'goods/brand/add', 'text' => '添加'], // 列表时不显示
        ['url' => 'goods/brand/edit', 'text' => '编辑'] // 列表时不显示
    ];

    protected $brand;

    protected $tools;



    public function __construct(BrandRepository $brandRepository, ToolsRepository $toolsRepository, Excel $excel)
    {
        parent::__construct();

        $this->brand = $brandRepository;
        $this->tools = $toolsRepository;
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '品牌管理 - 列表';
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加品牌'
            ],
            [
                'url' => 'brand-batch-upload',
                'icon' => 'fa-cloud-upload',
                'text' => '上传ecshop数据源'
            ],
            [
                'url' => '/goods/cloud/brand-import',
                'icon' => 'fa-cloud-upload',
                'text' => '批量导入品牌库'
            ],
        ];

        $explain_panel = [
            '添加品牌后请到“<a href="/goods/category/list">分类管理</a>”中的分类列表页面中“关联品牌”，只有关联了分类的品牌才能够在发布、编辑此分类下的商品时选择绑定的品牌'
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
        $search_arr = ['brand_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'brand_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'brand_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->brand->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.brand.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.brand.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        if ($id) {
            // 更新操作
            $title = '编辑';
            $info = $this->brand->getById($id);
            view()->share('info', $info);

            $this->sublink($this->links, 'edit', '', '', 'add');

        }

        $fixed_title = '品牌管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回品牌列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.brand.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('BrandModel');

        if (!empty($post['brand_id'])) {
            // 编辑
            $ret = $this->brand->update($post['brand_id'], $post);
            $msg = '商品品牌编辑';
        }else {
            // 添加
            $ret = $this->brand->store($post);
            $msg = '商品品牌添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/goods/brand/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/goods/brand/list');
    }

    public function clientValidate(Request $request)
    {
        $result = $this->brand->clientValidate($request, 'BrandModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function setIsRecommend(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->brand->changeState($id, 'is_recommend');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editSort(Request $request)
    {
        $ret = $this->brand->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function uploadBrandLogo(Request $request)
    {
        $id = $request->post('id');

        $filename = $request->post('filename', 'name');
        $storePath = 'goods/brand';
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->brand->update($id, ['brand_logo' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置失败！');
        }

        return result(0, $uploadRes['data'], '设置成功', ['count' => $uploadRes['count']]);
    }

    public function uploadPromotionImage(Request $request)
    {
        $id = $request->post('id');

        $filename = $request->post('filename', 'name');
        $storePath = 'promotionimages'; // todo
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->brand->update($id, ['promotion_image' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置失败！');
        }

        return result(0, $uploadRes['data'], '设置成功', ['count' => $uploadRes['count']]);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->brand->del($id);
        if ($ret === false) {
            // Log
            admin_log('商品品牌删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('商品品牌删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->brand->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('商品品牌批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('商品品牌批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function export(Request $request, BrandsExport $brandsExport)
    {
        $brand_name = $request->get('brand_name', '');
        $filename = '乐融沃B2B2C商城演示站_品牌列表-'.date('Ymdhis').'.xls';

        return Excel::download($brandsExport, $filename);
    }

    /**
     * 品牌选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->get('page')['page_id'];
        $output = $request->get('output');
        $selected_ids = $request->get('selected_ids', '');
        $selected_ids = explode(',', $selected_ids);

        // 查询条件
        $where[] = ['is_show', 1];
        $where[] = ['brand_logo', '<>', null];
        $whereIn = [];

        $tpl = 'picker';
        if (!$output) {
            // ajax 输出列表
            $tpl = 'partials._picker_brand_list';
        }

        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'brand_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->brand->getList($condition);
        $pageHtml = short_pagination($total);

        $render = view('goods.brand.'.$tpl, compact('page_id', 'pagination_id', 'list', 'pageHtml', 'selected_ids'))->render();
        return result(0, $render);
    }
}