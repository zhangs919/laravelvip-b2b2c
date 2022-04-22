<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\GoodsCommentRepository;
use Illuminate\Http\Request;

class EvaluateController extends UserCenter
{

    protected $goodsComment;

    public function __construct()
    {
        parent::__construct();

        $this->goodsComment = new GoodsCommentRepository();
    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();


        // 获取数据
        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['comment_level', 'comment_content'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'comment_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->goodsComment->getList($condition);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $integral = null;
        $review = 1;
        $nav_default = 'evaluate';
        $comment_count = [
            'all' => '0',
            'praise' => '0',
            'medium' => '0',
            'bad' => '0',
        ];

        $compact = compact('seo_title','pageHtml', 'list', 'page_json',
            'integral', 'review', 'nav_default', 'comment_count');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.evaluate.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'integral' => $integral,
                'review' => $review,
                'nav_default' => $nav_default,
                'comment_count' => $comment_count
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.evaluate.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');


        // 获取数据

        $info = $this->goodsComment->getById($id);
        if (empty($info)) {
            abort(200, '评价id无效');
        }

        $compact = compact('seo_title','info');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [

            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.evaluate.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


}