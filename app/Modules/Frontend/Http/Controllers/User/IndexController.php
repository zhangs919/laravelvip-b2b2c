<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\Article;
use App\Models\GoodsComment;
use App\Models\User;
use App\Models\UserCollect;
use App\Models\UserFollow;
use App\Models\UserMessage;
use App\Models\UserPraise;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\CartRepository;
use App\Repositories\CollectRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserBonusRepository;
use App\Repositories\UserCollectRepository;
use App\Repositories\UserFollowRepository;
use App\Repositories\UserMessageRepository;
use App\Repositories\UserPraiseRepository;
use Illuminate\Http\Request;

class IndexController extends UserCenter
{

    protected $cart;
    protected $goods;
    protected $orderInfo;
    protected $shop;
    protected $userBonus;
    protected $collect;

    public function __construct(
        CartRepository $cart
        , GoodsRepository $goods
        , OrderInfoRepository $orderInfo
        , ShopRepository $shop
        , UserBonusRepository $userBonus
        , CollectRepository $collect)
    {
        parent::__construct();

        $this->cart = $cart;
        $this->goods = $goods;
        $this->orderInfo = $orderInfo;
        $this->shop = $shop;
        $this->userBonus = $userBonus;
        $this->collect = $collect;

    }

    public function center(Request $request)
    {
        $seo_title = '用户中心';

        // 购物车列表
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        $user_cart_list = $this->cart->getCartGoodsList(); // 购物车数据
        $user_cart_num = 0;
        foreach ($user_cart_list as $cart) {
            $user_cart_num += $cart['goods_number'];
        }

        // 我的足迹
        list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory([], 6, [['user_id', $this->user_id]]);



        // 获取数据
        $user_info = $this->user->toArray();
        $user_info['headimg'] = get_image_url($user_info['headimg'], 'headimg');

        $info = [
            'money_all' => 0,
            'money_all_format'=>'0元',
            'is_surplus' => 0,
            'person_info_style' => 0,
            'real_info_style' => 0,
            'pay_point_format' => '分',
            'birthday_format' => $this->user['birthday'],
            'rank_next_distance' => $this->user_rank_info['less_exppoints'],
            'rank_info' => '100+',
            'rank_next' => $this->user_rank_info['downrank_name'],
            'rank_image' => get_image_url($this->user_rank_info['rank_img']),
            'user_money_format' => '￥'.$this->user['user_money'],
            'user_info' => $user_info,
            'safe_info' => [
                'safe_grade' => $this->user['security_level'],
                'safe_grade_format' => str_replace([1,2,3,4], ['危险','低','中','安全'], $this->user['security_level']) // 1-危险 2-低 3-中 4-安全
            ],
            'rank_is_special' => $this->user_rank_info['is_special'],
            'pay_point' => '0',
        ];
        $user_rank = [
            'min_points' => $this->user_rank_info['min_points'],
            'max_points' => $this->user_rank_info['max_points'],
            'is_special' => $this->user_rank_info['is_special'],
            'type' => $this->user_rank_info['type'],
            'rank_id' => $this->user_rank_info['rank_id'],
            'level' => $this->user_rank_info['level'],
            'rank_name' => $this->user_rank_info['rank_name'],
            'rank_img' => $this->user_rank_info['rank_img'],
        ];
        $userMessage = new UserMessageRepository();
        $no_read_count = $userMessage->getMessageCount(1, $this->user_id);

        $system_bonus_count = $this->userBonus->getBonusCount([['bonus_type', 0],['bonus_status', 0],['user_id', $this->user_id]]);
        $shop_bonus_count = $this->userBonus->getBonusCount([['bonus_type', 1],['bonus_status', 0],['user_id', $this->user_id]]);

        $bonus_count = $system_bonus_count + $shop_bonus_count;

        $order_counts = $this->orderInfo->getOrderCounts($this->user_id);
		// 格式化订单数量数据
		$order_counts_data = [];
		$order_state_format = $this->orderInfo->getOrderStateFormat();
		foreach ($order_counts as $key=>$item) {
			if (isset($order_state_format[$key]) && in_array($key, ['unpayed','unshipped','shipped','unevaluate'])) {
				$order_counts_data[] = [
					'key' => $key,
					'label' => $order_state_format[$key],
					'value' => $item
				];
			}
		}
        $app_distrib = [
            'distrib_text' => '公享会员',
            'getDistributorText' => '公享会员2',
            'is_distrib' => '1',
            'is_recommend_reg' => '1',
        ];
        $shop_info = $this->shop->getShopInfo($this->user['shop_id']); // 如果是商家 则有值

        $goods_collect_count = $this->collect->getUserCollectCount($this->user_id, 0);
        $shop_collect_count = $this->collect->getUserCollectCount($this->user_id, 1);
        $goods_comment_count = GoodsComment::where('user_id', $this->user_id)->count();

        $praise_count = (new UserPraiseRepository())->getUserPraiseCount($this->user_id,0, 1);
        $collect_count = (new UserCollectRepository())->getUserCollectCount($this->user_id,0, 1);
        $follow_count = (new UserFollowRepository())->getUserFollowCount($this->user_id, 1);
        $fans_count = (new UserFollowRepository())->getUserFansCount($this->user_id, 1);
        $live_status = Article::where([['user_id', $this->user_id],['status', 1], ['article_type', 3]])
            ->orderBy('article_id', 'desc')
            ->value('live_status'); // 直播状态 0-未开始 1-直播总 2-已结束
        $live_verified = $this->user['live_verified'] ?? 0;

        $compact = compact('seo_title',
            'info','user_rank','no_read_count','bonus_count','order_counts','order_counts_data','shop_info',

            'user_cart_list','user_cart_num', 'goods_history', 'goods_history_total',
            'goods_collect_count','shop_collect_count','goods_comment_count');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'info' => $info,
                'user_rank' => $user_rank,
                'no_read_count' => $no_read_count,
                'order_counts' => $order_counts,
                'order_counts_data' => $order_counts_data,
                'freebuy_order_counts' => "0",
                'reachbuy_order_counts' => "0",
                'progress' => 5,
                'bonus_count' => $bonus_count,
                'app_distrib' => $app_distrib,
                'shop_info' => $shop_info,
                'is_distrib' => '1',
                'is_recommend_reg' => '1',
                'user_center_bgimage' => sysconf('m_user_center_bgimage'),
                'praise_count' => $praise_count,
                'collect_count' => $collect_count,
                'follow_count' => $follow_count,
                'fans_count' => $fans_count,
                'live_status' => $live_status ?? 0,
                'live_verified' => $live_verified,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.index.center'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 获取余额
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getSurplus(Request $request)
    {
        $surplus = $this->user->user_money + $this->user->user_money_limit + $this->user->frozen_money;
        $surplus = format_price($surplus).'元';
        return result(0, $surplus);
    }

    /**
     * 获取用户信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function userInfo(Request $request)
    {
        $user_info = $this->user->toArray();
        $user_info['headimg'] = get_image_url($user_info['headimg'], 'headimg');
        $user_info['is_promoter'] = 0; // 是否推广员
        $user_info['extension_status'] = 0;

        $user_rank = [
            'min_points' => $this->user_rank_info['min_points'],
            'max_points' => $this->user_rank_info['max_points'],
            'is_special' => $this->user_rank_info['is_special'],
            'type' => $this->user_rank_info['type'],
            'rank_id' => $this->user_rank_info['rank_id'],
            'level' => $this->user_rank_info['level'],
            'rank_name' => $this->user_rank_info['rank_name'],
            'rank_img' => $this->user_rank_info['rank_img'],
        ];
        $user_info['user_rank'] = $user_rank;

        $goods_collect_count = $this->collect->getUserCollectCount($this->user_id, 0);
        $shop_collect_count = $this->collect->getUserCollectCount($this->user_id, 1);
        $goods_comment_count = GoodsComment::where('user_id', $this->user_id)->count();

        $praise_count = (new UserPraiseRepository())->getUserPraiseCount($this->user_id,0, 1);
        $collect_count = (new UserCollectRepository())->getUserCollectCount($this->user_id,0, 1);
        $follow_count = (new UserFollowRepository())->getUserFollowCount($this->user_id, 1);
        $fans_count = (new UserFollowRepository())->getUserFansCount($this->user_id, 1);
        $live_status = Article::where([['user_id', $this->user_id],['status', 1], ['article_type', 3]])
            ->orderBy('article_id', 'desc')
            ->value('live_status'); // 直播状态 0-未开始 1-直播总 2-已结束
        $live_verified = $this->user['live_verified'] ?? 0;

        $user_info['goods_collect_count'] = $goods_collect_count;
        $user_info['shop_collect_count'] = $shop_collect_count;
        $user_info['goods_comment_count'] = $goods_comment_count;
        $user_info['praise_count'] = $praise_count;
        $user_info['collect_count'] = $collect_count;
        $user_info['follow_count'] = $follow_count;
        $user_info['fans_count'] = $fans_count;
        $user_info['live_status'] = $live_status;
        $user_info['live_verified'] = $live_verified;
        list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory([], 6, [['user_id', $this->user_id]]);
        $user_info['goods_history_total'] = $goods_history_total;
        $userMessage = new UserMessageRepository();
        $no_read_count = $userMessage->getMessageCount(1, $this->user_id);
        $user_info['no_read_count'] = $no_read_count;

        return result(0, $user_info);
    }

}
