<?php

namespace App\Modules\Backend\Http\Controllers\Shop;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendShopController extends Backend
{

    private $links = [
        ['url' => 'shop/recommend-shop/list', 'text' => '列表'],

    ];


    public function __construct(
    )
    {
        parent::__construct();

    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '推荐开店 - '.$title;

        $this->sublink($this->links, 'list');

        $action_span = [];

        $explain_panel = [
            '推荐开店：商城会员帮助商城招商入驻，拉取线下实体店线上开店，作为回报，平台方可为推荐成功开店的会员发放奖励',
            '推荐开店的店铺审核通过后，前台即可展示推荐开店的店铺宣传海报',
            '未通过审核的推荐开店的店铺，可以修改信息重新发起申请',
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
        $search_arr = ['keywords', 'status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
//                    $where[] = ['auth_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = [[],0];
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.recommend-shop.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.recommend-shop.list', $compact);
    }

    /**
     * 店铺删除
     *
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $shop_id = $request->post('id');
        $ret = true; //$this->shop->shopDelete($shop_id);

        // 判断是否删除出错
        if (isset($ret['code'])) {
            // Log
            admin_log('推荐店铺删除失败。ID：'.$shop_id);
            return result($ret['code'], $ret['data'], $ret['message']);
        }

//        if ($ret === false) {
//            // Log
//            admin_log('店铺删除失败。ID：'.$shop_id);
//            return result(-1, '', '删除失败');
//        }

        // Log
        admin_log('推荐店铺删除成功。ID：'.$shop_id);
        return result(0, null, '删除成功');
    }

    public function remark(Request $request)
    {
        $id = $request->get('id');

        if ($request->method() == 'POST') {
            $remark = $request->post('remark');
            if (empty($remark)) {
                return result(-1, '备注内容不能为空');
            }
//            $order_mall_remark = OrderInfo::where('order_id', $id)->value('mall_remark');
//            if (!empty($order_mall_remark)) {
//                $order_mall_remark = unserialize($order_mall_remark);
//            } else {
//                $order_mall_remark = [];
//            }
//            $mall_remark_data[] = [
//                'user_id' => $this->admin_id,
//                'user_name' => $this->admin_info->user_name,
//                'remark' => $remark,
//                'add_time' => time()
//            ];
//            $remark_data = array_merge($order_mall_remark, $mall_remark_data);
//            $remark_data = serialize($remark_data);
            $ret = true; //$this->orderInfo->update($id, ['mall_remark'=>$remark_data]);
            if ($ret === false) {
                return result(-1, null, '数据保存失败');
            }

            return result(0, null, '数据保存成功');
        }

        $render = view('shop.recommend-shop.remark', compact('id'))->render();

        return result(0, $render);
    }

}