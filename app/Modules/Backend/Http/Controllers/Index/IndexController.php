<?php

namespace App\Modules\Backend\Http\Controllers\index;

use App\Models\Goods;
use App\Models\Store;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopRepository;
use App\Repositories\UpgradeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IndexController extends Backend
{
    private $links = [
        ['url' => 'index/index/operation-flow?type=role', 'text' => '商城角色'],
        ['url' => 'index/index/operation-flow?type=user', 'text' => '会员申请'],
        ['url' => 'index/index/operation-flow?type=shop', 'text' => '店铺入驻'],
        ['url' => 'index/index/operation-flow?type=goods', 'text' => '商品维护'],
        ['url' => 'index/index/operation-flow?type=trade', 'text' => '交易管理'],
        ['url' => 'index/index/operation-flow?type=bill', 'text' => '账单管理'],
        ['url' => 'index/index/operation-flow?type=deposit', 'text' => '提现'],
        ['url' => 'index/index/operation-flow?type=distrib', 'text' => '分销'],
        ['url' => 'index/index/operation-flow?type=logistics', 'text' => '对接物流'],
        ['url' => 'index/index/operation-flow?type=cash', 'text' => '对接收银台'],
        ['url' => 'index/index/operation-flow?type=guide', 'text' => '新手向导'],
    ];

    protected $shop;

    public function __construct()
    {
        parent::__construct();

        $this->shop = new ShopRepository();
    }

    /**
     * 欢迎页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $title = '欢迎页';
        $page_style = 'background: #f5f5f5; padding: 20px 25px 80px 25px;';

        $system_info = [
            'php_os' => PHP_OS,
            'service_software' => getenv('SERVER_SOFTWARE'),
            'php_version' => PHP_VERSION,
            'mysql_version' => DB::select('SELECT VERSION() as version')[0]->version,
            'gd_version' => GD_VERSION,
            'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone",
            'fileupload' => @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown',
            'default_charset' => ini_get('default_charset'),
            'version' => config('version.version'), // 当前系统版本
            'update_time' =>  config('version.release')// '2018-04-10' // 当前系统更新时间
        ];
//        dd($system_info);
        return view('index.index.index', compact('title', 'page_style', 'system_info'));
    }

    public function showMessage()
    {

        return result(0, '1');

    }

    /**
     * 版本升级提示
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update()
    {
        $upgrade = new UpgradeRepository();
        $res = $upgrade->checkVersion();
        if ($res['code'] == -1) { // 已经是最新版本
            return response(['update' => "<font color='green'>当前已是最新版本！</font>（".config('version.release')."）"]);
        }

        // 不是最新版本
        return response(['update' => "<font color='red'>当前最新版本：".$res['data']['version']."</font>（".config('version.release')."）<a style='border-radius: 5px; border: 2px solid grey; padding: 10px;' href='javascript:;' id='one_key_upgrade'>一键升级</a>"]);
//        return response(['update' => "（<font color='red'>当前最新版本：".$res['data']['version']."</font>&nbsp;<a href='javascript:;' id='one_key_upgrade'>一键升级</a>）"]);
//        return response(['update' => $res['data']['prompt1']]);
    }

    public function OneKeyUpgrade(){
        // sleep(3);
        $upgrade = new UpgradeRepository();
        $msg = $upgrade->OneKeyUpgrade(); //升级包消息

        return result(0, '', $msg);
//        exit("$msg");
    }

    public function getData()
    {
        return response([
            "today_gains" => "0.00",
            "today_orders" => "0",
            "today_shops" => "0",
            "today_users" => "0",
            "order_count" => [
                "all" => "1",
                "unpayed" => "0",
                "unshipped" => "0",
                "assign" => "1",
                "shipped" => "0",
                "backing" => "0",
                "unevaluate" => "1",
                "finished" => "0",
                "closed" => "1",
                "cancel" => "1"
            ]
        ]);
    }

    public function guideShow()
    {
        return [];
    }

    /**
     * 新手向导
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function operationFlow()
    {
        $title = $fixed_title = '新手向导';
        $type = request('type', 'role');
        list($fixed_bar, $title_bar)= $this->sublink($this->links, $type, 'type');

        return view('index.index.operation-flow', compact('title', 'type', 'fixed_title', 'fixed_bar', 'title_bar'));
    }

    /**
     * 控制面板
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function controlPanel(Request $request)
    {
        $title = '控制面板';
        $page_style = 'background: #f5f5f5; padding: 20px 25px 80px 25px;';

        $store_total = Store::count();
        $user_total = User::count();

        $where = [];
        $condition = [
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'asc'
        ];
        list($list, $shop_total) = $this->shop->getList($condition);
        if (!empty($list)) {
            foreach ($list as $v) {
                $v->today_orders = 0;
                $v->order_count = 12;
                $v->goods_count = Goods::where('shop_id', $v->shop_id)->count();
                $v->image_total_size = null;
            }
        }
        $pageHtml = pagination($shop_total);
        $compact = compact('title', 'list', 'shop_total', 'pageHtml', 'page_style', 'store_total', 'user_total');
        if ($request->ajax()) {
            $render = view('index.index.partials._store_list', $compact)->render();
            return result(0, $render);
        }

        return view('index.index.control-panel', $compact);
    }

    public function commitDomain(Request $request)
    {
        $json = '{"code":-1,"data":[{"host":"www.aaa.com","class":"IN","ttl":900,"type":"SOA","mname":"ns-1509.awsdns-60.org","rname":"awsdns-hostmaster.amazon.com","serial":1,"refresh":7200,"retry":900,"expire":1209600,"minimum-ttl":86400},{"host":"www.aaa.com","class":"IN","ttl":60,"type":"A","ip":"209.82.215.211"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-1605.awsdns-08.co.uk"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-383.awsdns-47.com"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-666.awsdns-19.net"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-1509.awsdns-60.org"}],"message":"系统检测到域名[<b>www.aaa.com<\/b>]尚未CNAME解析到域名[<b>www.b2b2c.yunmall.68mall.com<\/b>]下！<br\/>赶快去修改吧！"}';
        $data = json_decode($json, true);


        return result(-1, $data, '系统检测到域名[<b>www.aaa.com</b>]尚未CNAME解析到域名[<b>www.b2b2c.yunmall.68mall.com</b>]下！<br/>赶快去修改吧！');
    }
}