<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-10-22
// | Description: 操作日志
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Shop;


use App\Models\ShopLog;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopLogRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Seller
{

    private $links = [
        ['url' => 'shop/log/list', 'text' => '列表'],
    ];

    protected $shopLog;


    public function __construct(ShopLogRepository $shopLog)
    {
        parent::__construct();

        $this->shopLog = $shopLog;

        $this->set_menu_select('account', 'shop-log-list');
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '操作日志 - '.$title;
        $this->sublink($this->links, 'list');

        $explain_panel = [
            '操作日志开启与关闭由平台方控制，平台方开启操作日志后，店铺管理员的所有关键操作会被记录到操作日志中',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['user_id', 'content', 'start_time', 'end_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'content') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopLog->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.log.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.log.list', $compact);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopLog->del($id);
        if ($ret === false) {
            // Log
            shop_log('操作日志删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('操作日志删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->shopLog->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('操作日志批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('操作日志批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 删除六个月前的操作日志
     *
     * @return mixed
     */
    public function deleteOldLog()
    {
        // 六个月前的时间
        $time = Carbon::parse('-6 months', 'Asia/Shanghai');
        $ret = ShopLog::where('created_at', '<', $time)->delete();

        if ($ret === false) {
            // Log
            shop_log('六个月前的操作日志删除失败。');
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('六个月前的操作日志删除成功。');
        return result(0, '', '删除成功');
    }
}