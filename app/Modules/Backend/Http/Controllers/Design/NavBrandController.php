<?php


namespace app\Modules\Backend\Http\Controllers\Design;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\BrandRepository;
use App\Repositories\NavBrandRepository;
use App\Repositories\NavCategoryRepository;
use Illuminate\Http\Request;

class NavBrandController extends Backend
{

    private $editLinks = [
        ['url' => 'design/nav-category/edit', 'text' => '分类导航'],
        ['url' => 'design/nav-words/nav-words_list', 'text' => '分类推荐词'],
        ['url' => 'design/nav-brand/nav-brand_list', 'text' => '分类推荐品牌'],
        ['url' => 'design/nav-ad/nav-ad_list', 'text' => '分类推荐广告'],
    ];

    protected $navBrand;
    protected $navCategory;
    protected $brand;

    public function __construct(
        NavCategoryRepository $navCategoryRepository,
        NavBrandRepository $navBrandRepository,
        BrandRepository $brandRepository)
    {

        parent::__construct();

//        setcookie('theme_style', "true"); // todo 设置theme_style 改变整体样式

        $this->navCategory = $navCategoryRepository;
        $this->navBrand = $navBrandRepository;
        $this->brand = $brandRepository;
    }

    public function lists(Request $request)
    {
        $title = '分类推荐品牌';
        $fixed_title = $title;

        $cid = $request->get('cid');
        $nav_cat_info = $this->navCategory->getById($cid);
        $nav_page = $nav_cat_info->nav_page;

        $this->sublink($this->editLinks, 'nav-brand_list', '', '?cid='.$cid);

        $action_span = [
            [
                'url' => '/design/nav-category/list?nav_page='.$nav_page,
                'icon' => 'fa-reply',
                'text' => '返回分类导航列表'
            ],
            [
                'url' => 'add?cid='.$cid,
                'icon' => 'fa-plus',
                'text' => '添加推荐品牌'
            ],
        ];

        $explain_panel = [
            '建议最多设置6个推荐品牌，保证页面布局完美',
            '所有相关设置完成，请清除缓存，前台展示页面才会变化'
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
        $search_arr = ['brand_name']; // todo 搜索品牌名称bug
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'brand_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 排序
        $sortname = $request->get('sortname', 'brand_sort');
        $sortorder = $request->get('sortorder', 'asc');

        // 根据分类导航id查询
        $where[] = ['category_id', $cid];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($list, $total) = $this->navBrand->getList($condition);
        $pageHtml = pagination($total);

        // 获取品牌信息
        if (!empty($list)) {
            foreach ($list as &$value) {
                $brand = $this->brand->getById($value->brand_id);
                $value->brand_name = $brand->brand_name;
                $value->brand_logo = $brand->brand_logo;
            }
        }
//        dd($total);
        $compact = compact('title', 'list', 'total', 'pageHtml', 'nav_page', 'cid');
        if ($request->ajax()) {
            $render = view('design.nav-brand.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('design.nav-brand.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '推荐品牌添加';
//        $this->sublink($this->links, 'add');

        $id = $request->get('id', 0);
        $cid = $request->get('cid', 0);
        $form_action = '/design/nav-brand/add?cid='.$cid; // 添加action

        if ($id) {
            // 更新操作
            $form_action = '/design/nav-brand/edit?id='.$id; // 编辑action
//            $extra = '?id='.$id;
            $info = $this->navBrand->getById($id);
            // 获取品牌信息
            $brand = $this->brand->getById($info->brand_id);
            $info->brand_name = $brand->brand_name;
            $info->brand_logo = $brand->brand_logo;
            view()->share('info', $info);
            $title = '推荐品牌编辑';
//            $this->sublink($this->edit_links, 'edit', '', $extra);
            $cid = $info->category_id;
        }

        $fixed_title = '推荐品牌管理 - '.$title;
        $action_span = [
            [
                'url' => 'list?cid='.$cid,
                'icon' => 'fa-reply',
                'text' => '返回推荐品牌列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('design.nav-brand.add', compact('title', 'cid', 'form_action'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('NavBrandModel');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->navBrand->update($post['id'], $post);
            $cid = $ret->category_id;
            $msg = '推荐品牌编辑';
        }else {
            // 添加
            $cid = $request->get('cid');
            $post['category_id'] = $cid;
            $ret = $this->navBrand->store($post);
            $msg = '推荐品牌添加';
        }
        $extra = '?cid='.$cid;
        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/design/nav-brand/list'.$extra);
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/design/nav-brand/list'.$extra);
    }

    /**
     * 设置是否显示
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->navBrand->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function brandSearch(Request $request)
    {
        $brand_name = $request->get('brand_name', '');
        $where[] = ['brand_name', 'like', "%{$brand_name}%"];
        $condition = [
            'where' => $where,
            'sortname' => 'brand_sort',
            'sortorder' => 'asc'
        ];

        list($brand_list, $total) = $this->brand->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('brand_list', 'pageHtml');

        $render = view('design.nav-brand.brand_search', $compact)->render();
        return result(0, $render);
    }

    public function brandTableList(Request $request)
    {
        $brand_name = $request->get('brand_name', '');
        $where[] = ['brand_name', 'like', "%{$brand_name}%"];
        $condition = [
            'where' => $where,
            'sortname' => 'brand_sort',
            'sortorder' => 'asc'
        ];

        list($brand_list, $total) = $this->brand->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('brand_list', 'pageHtml');
        $render = view('design.nav-brand.partials._brand_table_list', $compact)->render();
        return result(0, $render);
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->navBrand->del($id);
        if ($ret === false) {
            // Log
            admin_log('分类推荐品牌删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('分类推荐品牌删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    /**
     * 批量删除
     *
     * @param Request $request
     * @return mixed
     */
    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->navBrand->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('分类推荐品牌批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('分类推荐品牌批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}