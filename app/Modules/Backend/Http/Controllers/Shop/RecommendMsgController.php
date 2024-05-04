<?php

namespace App\Modules\Backend\Http\Controllers\Shop;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendMsgController extends Backend
{

    private $links = [
        ['url' => 'shop/recommend-msg/list', 'text' => '列表'],

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
            '列表展示所有对预上线店铺的留言信息',
            '平台方管理员可控制预上线店铺的留言是否显示，显示为是的留言方可在前台展示给所有访问预上线店铺的会员查看',
            '前台会员留言默认显示为否，平台方需要审核是否显示',
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
        $search_arr = ['is_show', 'shop_id'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == '') {
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
            $render = view('shop.recommend-msg.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.recommend-msg.list', $compact);
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