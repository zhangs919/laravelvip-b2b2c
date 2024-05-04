<?php

namespace App\Modules\Backend\Http\Controllers\Index;

use App\Extensions\Http;
use App\Models\Goods;
use App\Models\OrderInfo;
use App\Models\Shop;
use App\Models\Store;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\OrderInfoRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UpgradeRepository;
use App\Services\Statistics\UserStat;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    protected $upgrade;
    protected $orderInfo;

    public function __construct(
        ShopRepository $shop,
        UpgradeRepository $upgrade,
        OrderInfoRepository $orderInfo
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->upgrade = $upgrade;
        $this->orderInfo = $orderInfo;
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

        $version = sysconf('lrw_version');
        $latest_version = get_version_info();
        $latest_version_str = "<h1 style='border-bottom: 3px solid #0F7BFF;max-width: 120px;color: #0F7BFF;margin-bottom: 10px;'>{$latest_version['version']}</h1>";
        foreach ($latest_version['pub_content'] as $v){
            $latest_version_str .= "<div style='float:left;'>[".str_replace([1,2,3],['新增','修复','优化'],$v['type'])."] ".$v['content']."</div>";
        }

        $system_info = [
            'php_os' => PHP_OS,
            'service_software' => getenv('SERVER_SOFTWARE'),
            'php_version' => PHP_VERSION,
            'mysql_version' => DB::select('SELECT VERSION() as version')[0]->version,
            'gd_version' => GD_VERSION,
            'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone",
            'fileupload' => @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown',
            'default_charset' => ini_get('default_charset'),
            'version' => $version, // 当前系统版本
            'update_time' => get_release(), // 当前系统更新时间
            'latest_version_str' => $latest_version_str // 最新版本
        ];
        $recent_ten_days = UserStat::getRecentTenDays();
        return view('index.index.index', compact('title', 'page_style', 'system_info', 'recent_ten_days'));
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
        $last_version = $this->upgrade->checkVersion();
        if (!$last_version) { // 已经是最新版本
            return response(['update' => "<font color='green'>当前已是最新版本！</font>（".get_release()."）"]);
        }

        // 不是最新版本
        return response(['update' => "<font color='red'>当前最新版本：".$last_version."</font> <a class='btn btn-primary btn-sm' href='/upgrade'>开始升级</a>"]);
    }

    public function getData()
    {
        $today_gains = OrderInfo::whereDate('created_at', today())
            ->selectRaw('SUM(money_paid + surplus) as total_fee')->value('total_fee');
        $today_orders = OrderInfo::whereDate('created_at', today())
            ->distinct('order_id')->count();
        $today_shops = Shop::whereDate('created_at', today())->count();
        $today_users = User::whereDate('created_at', today())->count();
        $order_counts = $this->orderInfo->getOrderCounts();

        return response([
            "today_gains" => $today_gains, // 今日销售总额
            "today_orders" => $today_orders, // 今日订单量
            "today_shops" => $today_shops, // 今日入驻商家
            "today_users" => $today_users, // 今日注册会员
            "order_count" => $order_counts,
        ]);
    }

    public function guideShow()
    {
        return [];
    }

    /**
     * 新手向导
     *
     * @return mixed
     */
    public function operationFlow()
    {
        $title = $fixed_title = '新手向导';
        $type = request('type', 'role');
        $this->sublink($this->links, $type, 'type');

        return view('index.index.operation-flow', compact('title', 'type', 'fixed_title'));
    }

    /**
     * 控制面板
     *
     * @param Request $request
     * @return mixed
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

        // 系统授权信息
        $cache_id = CACHE_KEY_MALL_AUTH[0];
        $auth_info = cache()->get($cache_id);
        if (!empty($auth_info)) {
            $auth_info['remaining_days'] =(new Carbon($auth_info['valid_at']))->diffInDays($auth_info['created_at']);
            $auth_info['valid_at'] = format_time(strtotime($auth_info['valid_at']), 'Y-m-d');
            $auth_info['created_at'] = format_time(strtotime($auth_info['created_at']), 'Y-m-d');
        }
        $compact = compact('title', 'list', 'shop_total', 'pageHtml', 'page_style', 'store_total', 'user_total', 'auth_info');
        if ($request->ajax()) {
            $render = view('index.index.partials._store_list', $compact)->render();
            return result(0, $render);
        }

        return view('index.index.control-panel', $compact);
    }

    public function commitDomain(Request $request)
    {
        $json = '{"code":-1,"data":[{"host":"www.aaa.com","class":"IN","ttl":900,"type":"SOA","mname":"ns-1509.awsdns-60.org","rname":"awsdns-hostmaster.amazon.com","serial":1,"refresh":7200,"retry":900,"expire":1209600,"minimum-ttl":86400},{"host":"www.aaa.com","class":"IN","ttl":60,"type":"A","ip":"209.82.215.211"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-1605.awsdns-08.co.uk"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-383.awsdns-47.com"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-666.awsdns-19.net"},{"host":"www.aaa.com","class":"IN","ttl":180,"type":"NS","target":"ns-1509.awsdns-60.org"}],"message":"系统检测到域名[<b>www.aaa.com<\/b>]尚未CNAME解析到域名[<b>www.mall.laravelvip.com<\/b>]下！<br\/>赶快去修改吧！"}';
        $data = json_decode($json, true);


        return result(-1, $data, '系统检测到域名[<b>www.aaa.com</b>]尚未CNAME解析到域名[<b>www.mall.laravelvip.com</b>]下！<br/>赶快去修改吧！');
    }
}