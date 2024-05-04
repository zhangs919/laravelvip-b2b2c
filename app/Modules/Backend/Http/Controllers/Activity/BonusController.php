<?php


namespace App\Modules\Backend\Http\Controllers\Activity;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\BonusRepository;
use Illuminate\Http\Request;

class BonusController extends Backend
{
    protected $bonus;

    public function __construct(
        BonusRepository $bonus
    )
    {
        parent::__construct();

        $this->bonus = $bonus;
    }

    /**
     * 红包选择器
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->get('page')['page_id'];
        $output = $request->get('output');
        $selected_ids = $request->get('selected_ids', '');
        $selected_ids = explode(',', $selected_ids);

        $params = $request->all();

        // 查询条件
        $where[] = ['shop_id', 0]; // 查询平台红包
        $where[] = ['is_delete', 0]; // 未删除状态
        $whereIn = [];
        // 搜索条件
        $search_arr = ['keywords'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = ['bonus_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $tpl = 'picker';
        if (!$output) {
            // ajax 输出文章列表
            $tpl = 'partials._picker_list';
//            if (!empty($selected_ids)) {
//                $whereIn = [
//                    'field' => 'article_id',
//                    'condition' => $selected_ids
//                ];
//            }
        }

        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'bonus_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->bonus->getList($condition);
        $pageHtml = short_pagination($total);

        $render = view('activity.bonus.'.$tpl, compact('page_id', 'pagination_id', 'list', 'pageHtml', 'selected_ids'))->render();
        return result(0, $render);
    }
}