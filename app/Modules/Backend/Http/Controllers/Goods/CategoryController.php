<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\CatAttribute;
use App\Models\Category;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AttributeRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsTypeRepository;
use App\Repositories\LinkTypeRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Backend
{


    private $links = [
        ['url' => 'goods/category/list', 'text' => '管理'],
        ['url' => 'goods/category/add', 'text' => '添加'] // 列表时不显示
    ];

    private $edit_links = [
        ['url' => 'goods/category/edit', 'text' => '基本信息'],
        ['url' => 'goods/category/edit-brand', 'text' => '关联品牌'],
        ['url' => 'goods/category/edit-filter', 'text' => '设置筛选属性'],
        ['url' => 'goods/category/edit-other', 'text' => '关联属性、规格'],
    ];

    protected $category;

    protected $brand;

    protected $tools;

    protected $goodsType;

    protected $attribute;

    protected $linkType;

    public function __construct(CategoryRepository $categoryRepository,
                                BrandRepository $brandRepository,
                                ToolsRepository $toolsRepository,
                                GoodsTypeRepository $goodsTypeRepository,
                                AttributeRepository $attributeRepository,
                                LinkTypeRepository $linkTypeRepository)
    {
        parent::__construct();

        $this->category = $categoryRepository;
        $this->brand = $brandRepository;
        $this->tools = $toolsRepository;
        $this->goodsType = $goodsTypeRepository;
        $this->attribute = $attributeRepository;
        $this->linkType = $linkTypeRepository;

        // 获取所有商品类型
        $goodsTypeAll = $this->goodsType->all();
        view()->share('goods_type_all', $goodsTypeAll);
    }

    /**
     * 分类列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '管理';
        $fixed_title = '分类管理 - 管理';
        $this->sublink($this->links, 'list', '', '', 'add');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加商品分类'
            ],
            [
                'url' => 'cate-batch-upload',
                'icon' => 'fa-cloud-upload',
                'text' => '上传ecshop数据源'
            ],
            [
                'url' => '/goods/cloud/category-import',
                'icon' => 'fa-cloud-upload',
                'text' => '批量导入分类库'
            ]
        ];

        $explain_panel = [
            '当店主发布商品时可以选择商品分类，用户在前台可以通过商品分类查询商品',
            '最多添加13个一级分类前台显示效果是最佳',
            '展示方式：默认主图：前台商品分类列表页，仅展示商品主图；规格相册：前台商品分类列表会页，商品以规格小图形式展示，切换规格小图，规格主图自动变化'
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
        $search_arr = ['cat_id', 'cat_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'cat_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif($v == 'cat_id') {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->category->getList($condition, '', true);

        $pageHtml = pagination($total, false);

//        dd($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.category.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.category.list', $compact);
    }

    public function isChange(Request $request)
    {

        return result(0);
    }

    /**
     * 添加分类
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add');

        $id = $request->get('id', 0);
        $parent_id = $request->get('parent_id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->category->getById($id);
            view()->share('info', $info);
            $title = '编辑【'.$info->cat_name.'】';
//            dd($info);
            if ($info->is_parent) {
                $this->sublink($this->edit_links, 'edit', '', $extra, 'edit-other');
            } else {

                $this->sublink($this->edit_links, 'edit', '', $extra, 'edit-filter');
            }
        }

        // 判断cat_level 如果是顶级分类 则cat_level=1 否则 cat_level=上级分类的cat_level+1 cat_level 最大是3级 超过3级不允许添加分类
        if ($parent_id == 0) {
            $cat_level = 1;
        } else {
            // 非顶级分类 cat_level=上级分类的cat_level+1
            $p_cat_level = Category::where('cat_id', $parent_id)->value('cat_level');
            $cat_level = $p_cat_level + 1;
        }

        $fixed_title = '分类管理 - '.$title;
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品分类列表'
            ]
        ];
        $explain_panel = [
            '只能为末级商品分类设置属性与规格',
            '当分类为禁止新增下级分类时，意味着这个分类为子分类，您可以设置此分类关联的规格、属性，设置成功后，在此分类下发布新商品时将会看 到分类所关联的规格、属性，如果此分类下已经存在了商品，并且分类关联的规格、属性发生变化后，那么这些存在的商品在重新编辑商品时，商品规格、属性会变化，如果未编辑商品，则商品的原有属性和规格不会有影响。所以为了不影响商家的正常销售，请您谨慎编辑分类下的属性、规格，编辑属性、规格后请在系统里发布公告告知商家，以免对商家造成不必要的损失',
            '显示：勾选后此属性会在商家添加商品属性时展示<br>
	必填：勾选后此属性，店铺在发布商品选择商品属性时，此项是必填项<br>
	允许输入：勾选此项后，商家发布商品时可以输入平台方未提供的规格<br>
	备注：勾选此项后，店铺在编辑此规格时即可以为规格添加备注，前台鼠标经过规格时展示该备注<br>
	筛选：勾选后此属性、规格会作为筛选条件展示在前台的商品列表页的筛选区域<br>
	别名：勾选此项后，此规格的名称就可以被店铺修改，例如：平台方此规格是颜色，店铺在自己编辑时把颜色改为版本，其他店铺依旧是颜色'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.category.add', compact('title', 'parent_id', 'cat_level'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('CategoryModel');

        $post['cat_letter'] = pinyin_permalink($post['cat_name'], ''); // 拼音全拼
//        dd($post);
        $data = [];
        if (!empty($post['cat_id'])) {
            // 编辑
            $ret = $this->category->update($post['cat_id'], $post);

            // 同步更新到子分类
            if ($post['sync_take_rate'] == 1) {
                // todo
            }
            $data['cat_id'] = $post['cat_id'];
        }else {
            // 添加
            // 判断cat_level 如果是顶级分类 则cat_level=1 否则 cat_level=上级分类的cat_level+1 cat_level 最大是3级 超过3级不允许添加分类
            if ($post['parent_id'] == 0) {
                $post['cat_level'] = 1;
            } else {
                // 非顶级分类 cat_level=上级分类的cat_level+1
                $p_cat_level = Category::where('cat_id', $post['parent_id'])->value('cat_level');
                $post['cat_level'] = $p_cat_level + 1;
            }

            $ret = $this->category->store($post);
            $data['cat_id'] = $ret->cat_id;
            $data['parent_id'] = $post['parent_id'];
        }

        if ($ret === false) {
            // fail
            return result(-1, '', '分类添加失败');
        }
        // success

        return result(0, $data, '分类添加成功');
    }

    public function editBrand(Request $request)
    {
        $id = $request->get('id', 0);
        $this->sublink($this->edit_links, 'edit-brand');

        $info = $this->category->getById($id);
        $extra = '?id='.$id;
        if ($info->is_parent) {
            $this->sublink($this->edit_links, 'edit-brand', '', $extra, 'edit-other');
        } else {
            $this->sublink($this->edit_links, 'edit-brand', '', $extra, 'edit-filter');
        }

        // 关联品牌
//        $brand_ids = Brand::whereIn('brand_id', explode(',',$info->brand_ids))->pluck('brand_id')->toArray();
        $brand_ids = BrandCategory::where('cat_id', $id)->pluck('brand_id')->toArray();
//        dd($relatedBrands);
        $title = '编辑【'.$info->cat_name.'】';
        $fixed_title = '分类管理 - '.$title;
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品分类列表'
            ]
        ];
        $explain_panel = [
            '左侧品牌选择框中展示的是商城全部品牌',
            '为商品分类绑定品牌后，在发布商品和编辑商品的页面中将会根据商品所属分类调用分类所绑定的品牌列表'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $brand_ids = $request->post('brand_ids');
            $insertAll = [];
            $brand_ids = explode(',', $brand_ids);
            foreach ($brand_ids as $brand_id) {
                $insertAll[] = [
                    'brand_id' => $brand_id,
                    'cat_id' => $id
                ];
            }
            BrandCategory::where('cat_id', $id)->delete();
            $ret = BrandCategory::insert($insertAll);

            if ($ret === false) {
                return result(-1, null, '设置失败');
            }

            return result(0, null, '设置成功');
        }

        $condition = [
            'where' => [],
            'limit' => 0, // 不分页
            'sortname' => 'brand_id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->brand->getList($condition);
//        dd($list);
        return view('goods.category.edit_brand', compact('title', 'list', 'id', 'brand_ids'));
    }

    /**
     * 设置筛选属性
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editFilter(Request $request)
    {
        $id = $request->get('id', 0);
        $extra = '?id='.$id;
        $info = $this->category->getById($id);
        view()->share('info', $info);
        $title = '编辑【'.$info->cat_name.'】';
        if ($info->is_parent) {
            $this->sublink($this->edit_links, 'edit-filter', '', $extra, 'edit-other');
        } else {
            $this->sublink($this->edit_links, 'edit-other', '', $extra, 'edit-filter');
        }

        $fixed_title = '分类管理 - '.$title;
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品分类列表'
            ]
        ];
        $explain_panel = [
            '您可以在当前页面为非末级商品分类设置用于前台商品列表页面展示的筛选条件，您可以自定义可用于用户浏览时可能用到的筛选的属性或者规格'  ,
            '品牌属性已默认为筛选属性，您还可以为多选属性、单选属性设置其是否用于前台商品列表页的筛选条件，文本属性不能作为筛选条件'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 根据分类id TODO 获取该分类下所有分类（包括子分类）关联的属性列表
        $cat_attr_list = CatAttribute::where([['cat_id', $id], ['is_spec', 0]])->orderBy('sort', 'asc')->get();
        if (!empty($cat_attr_list)) {
            foreach ($cat_attr_list as $item) {
                $item->attr_name = Attribute::where('attr_id', $item->attr_id)->value('attr_name');
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
                $item->cat_name = $this->category->getById($item->cat_id)['cat_name'];
            }
        }
        // 根据分类id TODO 获取该分类下所有分类（包括子分类）关联的规格列表
        $cat_spec_list = CatAttribute::where([['cat_id', $id], ['is_spec', 1]])->orderBy('sort', 'asc')->get();
        if (!empty($cat_spec_list)) {
            foreach ($cat_spec_list as $item) {
                $item->attr_name = Attribute::where('attr_id', $item->attr_id)->value('attr_name');
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
                $item->cat_name = $this->category->getById($item->cat_id)['cat_name'];
            }
        }

        if ($request->method() == 'POST') {
            $postData = $request->post('data');

            $ret = $this->category->storeCatSpec($postData);
            if ($ret === false) {
                return result(-1, '', '操作失败');
            }

            return result(0, '', '操作成功');
        }

        return view('goods.category.edit_filter', compact('title', 'info', 'cat_attr_list', 'cat_spec_list'));
    }

    /**
     * 关联属性、规格
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editOther(Request $request)
    {
        $id = $request->get('id', 0);
        $extra = '?id='.$id;
        $info = $this->category->getById($id);
        view()->share('info', $info);
        $title = '编辑【'.$info->cat_name.'】';
        if ($info->is_parent) {
            $this->sublink($this->edit_links, 'edit-filter', '', $extra, 'edit-other');
        } else {
            $this->sublink($this->edit_links, 'edit-other', '', $extra, 'edit-filter');
        }

        $fixed_title = '分类管理 - '.$title;
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品分类列表'
            ]
        ];
        $explain_panel = [
            '只能为末级商品分类设置属性与规格',
            '当分类为禁止新增下级分类时，意味着这个分类为子分类，您可以设置此分类关联的规格、属性，设置成功后，在此分类下发布新商品时将会看 到分类所关联的规格、属性，如果此分类下已经存在了商品，并且分类关联的规格、属性发生变化后，那么这些存在的商品在重新编辑商品时，商品规格、属性会变化，如果未编辑商品，则商品的原有属性和规格不会有影响。所以为了不影响商家的正常销售，请您谨慎编辑分类下的属性、规格，编辑属性、规格后请在系统里发布公告告知商家，以免对商家造成不必要的损失',
            '显示：勾选后此属性会在商家添加商品属性时展示<br>
	必填：勾选后此属性，店铺在发布商品选择商品属性时，此项是必填项<br>
	允许输入：勾选此项后，商家发布商品时可以输入平台方未提供的规格<br>
	备注：勾选此项后，店铺在编辑此规格时即可以为规格添加备注，前台鼠标经过规格时展示该备注<br>
	筛选：勾选后此属性、规格会作为筛选条件展示在前台的商品列表页的筛选区域<br>
	别名：勾选此项后，此规格的名称就可以被店铺修改，例如：平台方此规格是颜色，店铺在自己编辑时把颜色改为版本，其他店铺依旧是颜色'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取分类关联的属性列表
        $cat_attr_list = CatAttribute::where([['cat_id', $id], ['is_spec', 0]])->orderBy('sort', 'asc')->get();
        if (!empty($cat_attr_list)) {
            foreach ($cat_attr_list as $item) {
                $item->attr_name = Attribute::where('attr_id', $item->attr_id)->value('attr_name');
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
            }
        }
        // 获取分类关联的规格列表
        $cat_spec_list = CatAttribute::where([['cat_id', $id], ['is_spec', 1]])->orderBy('sort', 'asc')->get();
        if (!empty($cat_spec_list)) {
            foreach ($cat_spec_list as $item) {
                $item->attr_name = Attribute::where('attr_id', $item->attr_id)->value('attr_name');
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
            }
        }


        if ($request->method() == 'POST') {
            $postData = $request->post('data');

            $ret = $this->category->storeCatAttr($postData);
            if ($ret === false) {
                return result(-1, '', '操作失败');
            }

            return result(0, '', '操作成功');
        }

//        dd($cat_spec_list);
        return view('goods.category.edit_other', compact('title','info', 'cat_attr_list', 'cat_spec_list'));
    }

    public function attrTable(Request $request)
    {
        $type_id = $request->get('type_id', null);
        $keywords = $request->get('keywords', '');
        $not_attr_ids = $request->get('not_attr_ids', null);
        $where[] = ['is_spec', 0]; // 是否是规格 查询属性

        // 根据类型id筛选
        if (!empty($type_id)) {
            $where[] = ['type_id', $type_id];
        }
        // 根据关键词搜索
        if (!empty($keywords)) {
            // attr_name or attr_remark
            $where[] = ['attr_name', 'like', "%{$keywords}%"];
        }

        // 排除店铺规格
        $where[] = ['shop_id',0];

        $condition = [
            'where' => $where,
            'sortname' => 'attr_id',
            'sortorder' => 'asc',
        ];

        // 排除attr_ids
        if (!empty($not_attr_ids)) {
            $condition['not_in'] = [
                'field' => 'attr_id',
                'condition' => is_array($not_attr_ids) ? $not_attr_ids : [$not_attr_ids]
            ];
        }
        list($list, $total) = $this->attribute->getList($condition);
        $pageHtml = pagination($total);
        if (!empty($list)) {
            foreach ($list as &$item)
            {
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
            }
        }
        $render = view('goods.category.attr_table', compact('list', 'pageHtml'))->render();

        return result(0, $render);
    }

    public function specTable(Request $request)
    {
        $type_id = $request->get('type_id', null);
        $keywords = $request->get('keywords', '');
        $not_attr_ids = $request->get('not_attr_ids', null);
        $where[] = ['is_spec', 1]; // 是否是规格 查询属性

        // 根据类型id筛选
        if (!empty($type_id)) {
            $where[] = ['type_id', $type_id];
        }
        // 根据关键词搜索
        if (!empty($keywords)) {
            // attr_name or attr_remark
            $where[] = ['attr_name', 'like', "%{$keywords}%"];
        }

        // 排除店铺规格
        $where[] = ['shop_id',0];

//        dd($condition);
        $condition = [
            'where' => $where,
            'sortname' => 'attr_id',
            'sortorder' => 'asc',
        ];

        // 排除attr_ids
        if (!empty($not_attr_ids)) {
            $condition['not_in'] = [
                'field' => 'attr_id',
                'condition' => is_array($not_attr_ids) ? $not_attr_ids : [$not_attr_ids]
            ];
        }
        list($list, $total) = $this->attribute->getList($condition);
        $pageHtml = pagination($total);
        if (!empty($list)) {
            foreach ($list as &$item)
            {
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
            }
        }
        $render = view('goods.category.spec_table', compact('list', 'pageHtml'))->render();

        return result(0, $render);
    }


    public function setShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->category->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editCategory(Request $request)
    {
        $id = $request->post('cat_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'cat_sort') {
            $value = intval($value);
        } elseif ($title == 'take_rate') {
            $value = str_replace('%', '', $value);
        }

        $ret = $this->category->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function getTypeList(Request $request)
    {
        $nav_type = $request->get('link_type', 0); // 链接类型
        $nav_link = $request->get('cat_link', ''); // 分类链接
        $link_data = $this->linkType->getLinkTypeData($nav_type);

        $render = view('design.navigation.partials._get_type_list', compact('nav_type', 'nav_link', 'link_data'))->render();

        return result(0, $render);
    }

    public function uploadCatImage(Request $request)
    {
        $id = $request->post('id');

        $filename = $request->post('filename', 'name');
        $storePath = 'goods/category';
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->category->update($id, ['cat_image' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置失败！');
        }

        return result(0, $uploadRes['data'], '设置成功', ['count' => $uploadRes['count']]);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->category->del($id);
        if ($ret === false) {
            // Log
            admin_log('商品分类删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('商品分类删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->category->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('商品分类批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('商品分类批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 商品分类选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $id = $request->get('id', 0); // 商品分类id
//        $is_show = $request->get('is_show', 0);

        // 商品分类列表
        $where[] = ['is_show', 1];
        $where[] = ['parent_id', $id]; // 根据父id查询商品分类
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->category->getList($condition);

        $tpl = 'picker';
        if (empty($params['output']) && $id > 0) {
            $tpl = 'partials._picker_by_cat_id';
        }
        $render = view('goods.category.'.$tpl, compact('page_id', 'list', 'total'))->render();
        return result(0, $render);
    }
}