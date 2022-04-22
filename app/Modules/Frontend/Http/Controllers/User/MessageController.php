<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\ArticleRepository;
use App\Repositories\MessageRepository;
use App\Repositories\UserMessageRepository;
use Illuminate\Http\Request;

class MessageController extends UserCenter
{

    protected $message; // 消息
    protected $userMessage; // 用户消息
    protected $article; // 文章


    public function __construct()
    {
        parent::__construct();

        $this->message = new MessageRepository();
        $this->userMessage = new UserMessageRepository();
        $this->article = new ArticleRepository();


    }

    /**
     * 站内信
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function internal(Request $request)
    {
        $seo_title = '用户中心';


        // 获取数据
        // 列表
        $where[] = ['receiver', $this->user_id];
        $where[] = ['type', 1]; // 会员消息

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
            'field' => [
                'user_message.*','message.*']
        ];
        list($list, $total) = $this->userMessage->getList($condition);
        $pageHtml = frontend_pagination($total);

        $pageArr = frontend_pagination($total, true);
        $page_count = $pageArr['page_count'];
        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);

        $list = $list->toArray();

        $compact = compact('seo_title', 'list', 'total', 'pageHtml', 'page_count','cur_page', 'page_json');
        if ($request->ajax()) {
            $render = view('user.message.partials._internal_message_list', $compact)->render();
            return result(0, $render);
        }
//        dd($list);
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page_json,
                'nav_default' => 'message'
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.message.internal'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

    }

    /**
     * 系统公告
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function message(Request $request)
    {
        $seo_title = '用户中心';


        // 获取数据
        // 列表
        $where[] = ['status',1];
        $where[] = ['cat_id',21]; // 用户公告
        // 列表
        $condition = [
            'where' => $where,
            'field' => ['article_id','title','add_time','link'],
        ];
        list($list, $total) = $this->article->getList($condition);
        $pageHtml = frontend_pagination($total);

        $pageArr = frontend_pagination($total, true);
        $page_count = $pageArr['page_count'];
        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);

        $list = $list->toArray();

        $compact = compact('seo_title', 'list', 'total', 'pageHtml', 'page_count','cur_page');
        if ($request->ajax()) {
            $render = view('user.message.partials._message_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page_json,
                'nav_default' => 'message'
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.message.message'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

    }

    /**
     * 查看消息（mobile端）
     * @param Request $request
     * @return array
     */
    public function messageInfo(Request $request)
    {
        $id = $request->get('id');

        $data = $this->message->getById($id);

        return result(0, $data);
    }
}