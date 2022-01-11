<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\ShopMessageTpl;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ArticleRepository;
use App\Repositories\MessageRepository;
use App\Repositories\MessageTemplateRepository;
use App\Repositories\UserMessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Seller
{

    private $links = [
        ['url' => 'shop/message/internal-message-list', 'text' => '站内信'],
        ['url' => 'shop/message/system-message-list', 'text' => '系统公告'],
        ['url' => 'shop/message/message-set', 'text' => '消息接收设置'],
    ];

    protected $message; // 消息
    protected $userMessage; // 用户消息
    protected $article; // 文章
    protected $messageTemplate; // 消息模板

    public function __construct()
    {
        parent::__construct();

        $this->message = new MessageRepository();
        $this->userMessage = new UserMessageRepository();
        $this->article = new ArticleRepository();
        $this->messageTemplate = new MessageTemplateRepository();

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


        // 获取数据
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
        $where[] = ['receiver', $this->seller_id];
        $where[] = ['type', 2]; // 店铺消息
        $condition = [
            'join' => [
                'join_table' => 'message',
                'join_first' => 'user_message.msg_id',
                'join_operator' => '=',
                'join_second' => 'message.msg_id',
                'join_type' => 'left',
                'join_where' => false,
            ],
            'where' => $where,
//            'sortname' => 'rec_id',
//            'sortorder' => 'desc',
            'field' => ['user_message.rec_id','user_message.msg_id','user_message.status','user_message.read_time','message.send_time','message.content']
        ];
        list($list, $total) = $this->userMessage->getList($condition);
        $pageHtml = pagination($total);
        $pageJson = frontend_pagination($total, true);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.message.partials._internal_message_list', $compact)->render();
            return result(0, $render);
        }
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list->toArray(),
                'page' => $pageJson,
                'is_shop_keeper' => 1, // 是否店主
                'sys_msg_cnt' => 0, // 系统公告
                'int_msg_cnt' => 0, // 站内信消息
                'unread_msg_cnt' => 0 // 未读消息
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.message.internal_message_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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
        $this->sublink($this->links, 'system-message-list');

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block



        // 获取数据
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
        $where[] = ['status',1];
        $where[] = ['cat_id',20]; // 商家公告
        // 列表
        $condition = [
            'where' => $where,
            'field' => ['article_id','title','add_time','link'],
        ];
        list($list, $total) = $this->article->getList($condition);

        $pageHtml = pagination($total);
        $pageJson = frontend_pagination($total, true);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.message.partials._system_message_list', $compact)->render();
            return result(0, $render);
        }
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list->toArray(),
                'page' => $pageJson,
                'sys_msg_cnt' => 0, // 系统公告
                'int_msg_cnt' => 0, // 站内信消息
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.message.system_message_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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

        // 获取数据
        $where = [];
        $where[] = ['type', 0]; // 店铺消息模板
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
            'field' => ['id','name','code','sys_open','sms_open','email_open','wx_open']
        ];
        list($list, $total) = $this->messageTemplate->getList($condition);
        $list = $list->toArray();
        foreach ($list as &$v) {
            $shop_tpl_info = ShopMessageTpl::where([['shop_id',seller_shop_info()->shop_id],['msg_tpl_id',$v['id']]])->first();
            $receive_type = [];
            if ($v['sys_open']) {
                $receive_type[] = '站内信';
            }
            if ($v['sms_open']) {
                $receive_type[] = '短信接收';
            }
            if ($v['email_open']) {
                $receive_type[] = '邮件接收';
            }
            $receive_type = !empty($receive_type) ? implode('、', $receive_type) : '';
            $v['shop_tpl_id'] = isset($shop_tpl_info->shop_tpl_id) ? $shop_tpl_info->shop_tpl_id : null;
            $v['receive_type'] = $receive_type;
            $v['is_open'] = isset($shop_tpl_info->is_open) ? $shop_tpl_info->is_open : 1;
            $v['mobile'] = isset($shop_tpl_info->mobile) ? $shop_tpl_info->mobile : null;
            $v['email'] = isset($shop_tpl_info->mobile) ? $shop_tpl_info->mobile : null;
            $v['wx_id'] = isset($shop_tpl_info->wx_id) ? $shop_tpl_info->wx_id : null;
        }

        $pageHtml = pagination($total);
        $pageJson = frontend_pagination($total, true);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.message.partials._message_set', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'page' => $pageJson,
                'list' => $list
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.message.message_set'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 删除单个站内信
     *
     * @param Request $request
     * @return array
     */
    public function internalMessageDelete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->userMessage->del($id);
        if ($ret === false) {
            // Log
            shop_log('系统消息删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('系统消息删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    /**
     * 批量删除站内信
     *
     * @param Request $request
     * @return array
     */
    public function internalMessageBatchDelete(Request $request)
    {
        $ids = $request->post('data');
        $ret = $this->userMessage->batchDel($ids);

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

    /**
     * 查看消息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function view(Request $request)
    {
        $msg_id = $request->get('msg_id', 0);
        $msg_info = $this->message->getById($msg_id);
        $render = view('shop.message.view', compact('msg_info'))->render();
        return result(0, $render);
    }

    /**
     * 设置是否启用
     *
     * @param Request $request
     * @return array
     */
    public function setIsOpen(Request $request)
    {
        $id = $request->get('id'); // 店铺消息模板id
        $tpl_id = $request->get('tpl_id'); // 消息模板id

        // 检查店铺消息模板表是否存在记录
        $tplInfo = ShopMessageTpl::where([['shop_id',seller_shop_info()->shop_id],['msg_tpl_id',$tpl_id]])->first();
        if (!empty($tplInfo)) {
            // 存在记录 更新
            $is_open = $tplInfo->is_open == 1 ? 0 : 1;
            $ret = ShopMessageTpl::where([['shop_id',seller_shop_info()->shop_id],['msg_tpl_id',$tpl_id]])->update(['is_open'=>$is_open]);
            $id = $tplInfo->shop_tpl_id;
        } else {
            $insert = [
                'is_open' => 0,
                'msg_tpl_id' => $tpl_id,
                'shop_id' => seller_shop_info()->shop_id
            ];
            $ret = DB::table('shop_message_tpl')->insertGetId($insert);
            $is_open = 0;
            $id = $ret;
        }

        if (!$ret) {
            // Log
            shop_log('设置消息接收模板是否启用失败。ID：'.$id);
            return result(-1, '', '设置失败');
        }

        // Log
        shop_log('设置消息接收模板是否启用。ID：'.$id);
        return result(0, $is_open, $is_open);
    }
}