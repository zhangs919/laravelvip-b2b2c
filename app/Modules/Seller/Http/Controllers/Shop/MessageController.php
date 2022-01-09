<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends Seller
{

    private $links = [
        ['url' => 'shop/message/internal-message-list', 'text' => '站内信'],
        ['url' => 'shop/message/system-message-list', 'text' => '系统公告'],
        ['url' => 'shop/message/message-set', 'text' => '消息接收设置'],
    ];

    protected $message;

    public function __construct()
    {
        parent::__construct();

        $this->message = new MessageRepository();

        $this->set_menu_select('account', 'shop-message');
    }

    /**
     * 站内信
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function internalMessageList(Request $request)
    {
        $title = '站内信';
        $fixed_title = '系统消息 - '.$title;
        $this->sublink($this->links, 'internal-message-list');

        $explain_panel = [
            '店铺超级管理员可看全部消息',
            '只有店铺超级管理员可删除消息，删除后，其它子账号管理员的该条消息也将被删除'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['content'];
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
        list($list, $total) = $this->message->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.message.partials._internal_message_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.message.internal_message_list', $compact);
    }

    /**
     * 系统公告
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function systemMessageList(Request $request)
    {
        $title = '系统公告';
        $fixed_title = '系统消息 - '.$title;
        $this->sublink($this->links, 'internal-message-list');

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['title'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'title') {
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
        list($list, $total) = $this->message->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.message.partials._system_message_list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.message.system_message_list', $compact);
    }

    /**
     * 消息接收设置
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function messageSet(Request $request)
    {
        $title = '消息接收设置';
        $fixed_title = '系统消息 - '.$title;
        $this->sublink($this->links, 'message-set');

        $explain_panel = [
            '子账号接收消息权限请到账号权限中设置'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['title'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'title') {
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
        list($list, $total) = [[], 0]; // todo

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.message.partials._message_set', $compact)->render();
            return result(0, $render);
        }
        return view('shop.message.message_set', $compact);
    }

    public function internalMessageDelete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->message->del($id);
        if ($ret === false) {
            // Log
            shop_log('系统消息删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('系统消息删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function internalMessageBatchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->message->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('系统消息批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('系统消息批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function view(Request $request)
    {
        $msg_id = $request->get('msg_id', 0);

        $render = view('shop.message.view')->render();
        return result(0, $render);
    }
}