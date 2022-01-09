<?php

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopQuestionsRepository;
use Illuminate\Http\Request;

class QuestionsController extends Seller
{

    private $links = [
        ['url' => 'goods/goods-set/index', 'text' => '基本设置'],
        ['url' => 'goods/goods-unit/list', 'text' => '商品单位'],
        ['url' => 'goods/layout/list', 'text' => '详情版式'],
        ['url' => 'goods/questions/list', 'text' => '常见问题'],
    ];

    protected $shopQuestions;


    public function __construct()
    {
        parent::__construct();

        $this->shopQuestions = new ShopQuestionsRepository();

        $this->set_menu_select('goods', 'goods-set');

    }

    public function lists(Request $request)
    {
        $title = '常见问题';
        $fixed_title = '商品设置 - '.$title;

        $this->sublink($this->links, 'goods/questions/list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加常见问题'
            ],
        ];

        $explain_panel = [
            '常见问题展示在前台商品详情页，设置自己店铺内的常见问题，仅在自己的店铺前台商品详情页展示；未设置常见问题，前台商品详情页则不展示常见问题模块',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['question_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'question_name') {
                    $where[] = ['question', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->shopQuestions->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('goods.questions.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.questions.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加常见问题';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->shopQuestions->getById($id);
            view()->share('info', $info);
            $title = '编辑常见问题';
        }

        $fixed_title = '商品设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回常见问题列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.questions.add', compact('title', 'info'));
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
        $post = $request->post('ShopQuestions');

        if (!empty($post['questions_id'])) {
            // 编辑
            $ret = $this->shopQuestions->update($post['questions_id'], $post);
            $msg = '常见问题编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->shopQuestions->store($post);
            $msg = '常见问题添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    public function editQuestionInfo(Request $request)
    {
        $ret = $this->shopQuestions->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopQuestions->del($id);

        if ($ret === false) {
            // Log
            return result(-1, null, '删除失败');
        }

        // Log
        return result(0, null, '删除成功');
    }

}