<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Brand;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CollectRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ShopContractRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class SearchController extends Frontend
{

	protected $goods;
	protected $collect;
	protected $shop;
	protected $shopCredit;
	protected $customer;
	protected $shopContract;


	public function __construct(
		GoodsRepository          $goods
		, CollectRepository      $collect
		, ShopRepository         $shop
		, ShopCreditRepository   $shopCredit
		, CustomerRepository     $customer
		, ShopContractRepository $shopContract
	)
	{
		parent::__construct();

		$this->goods = $goods;
		$this->collect = $collect;
		$this->shop = $shop;
		$this->shopCredit = $shopCredit;
		$this->customer = $customer;
		$this->shopContract = $shopContract;
	}

	public function index(Request $request)
	{
		// 获取数据
		$params = $request->all();

		$keyword = $request->get('keyword', '');
		$type = $request->get('type', 0); // 搜索类型 0商品 1店铺
		$params['style'] = $request->get('style', 'grid'); // 空-大图模式  list-列表模式
		$sort_type = $request->get('sort', 'shop_sort');
		$order_type = $request->get('order', 'DESC');

		$search_record = !empty($_COOKIE['search_records']) ? unserialize($_COOKIE['search_records']) : [];

		if (!empty($search_record)) {
			// cookie不为空
			if (!in_array($keyword, $search_record)) {
				array_push($search_record, $keyword);
			}
		} else {
			// 没有cookie 写入
			$search_record = [$keyword];
		}

		// 将搜索词写入cookie
		setcookie('search_records', serialize($search_record), null, '/');

		if ($type == 1) {
			// 搜索店铺
			$tpl = 'search_shop';
			$where[] = ['shop_status', 1];
			$where[] = ['shop_audit', 1];
			$where[] = ['shop_name', 'like', "%{$keyword}%"];
			$condition = [
				'where' => $where,
				'with' => ['goods' => function ($query) {
					$query->limit(4);
				}, 'user', 'shopContract'],
				'sortname' => 'shop_sort',
				'sortorder' => 'desc'
			];
			list($list, $total) = $this->shop->getList($condition);
			$pageHtml = frontend_pagination($total);
			$list = $list->toArray();
			if (!empty($list)) {
				foreach ($list as &$item) {
					// 店铺信誉
					$creditInfo = $this->shopCredit->getCreditInfoByScore($item['credit']);
					// 店铺主客服信息
					$customer_main = $this->customer->getCustomerMain($item['shop_id']);

					$item['comstore_number'] = '0';
					$item['comstore_allow_number'] = '0';
					$item['freight_settlement_enable'] = '0';
					$item['close_image'] = null;
					$item['shop_sale_status'] = '0';
					$item['update_desc'] = null;
					$item['update_img_pc'] = null;
					$item['update_img_mobile'] = null;
					$item['close_desc'] = null;
					$item['close_img_pc'] = null;
					$item['close_img_mobile'] = null;
					$item['out_openhour_order_enable'] = "1";
					$item['shop_trade_type'] = '0';
					$item['shop_group_id'] = '0';
					$item['wx_barcode'] = '';
					$item['shop_tag'] = get_shop_code($item['shop_id']);
					$item['shop_index_link'] = '/pagesDesign/shop/index?shop_tag='.$item['shop_tag'];
					$item['evaluate'] = 100;
					$item['user_name'] = $item['user']['user_name'];
					$item['sale_num'] = '0';
					$item['count_goods'] = '0';

					$item['shop_contract'] = $this->shopContract->getShopContract($item['shop_id']);

					$item['is_open'] = true;
					$item['credit_img'] = $creditInfo['credit_img'];
					$item['credit_name'] = $creditInfo['credit_name'];
					$item['main_customer'] = $customer_main;
					$item['aliim_enable'] = '';
					$item['system_aliim_enable'] = '';
					$item['yikf_url'] = '';
				}
			}

			// 分页
			$page_array = frontend_pagination($total, true);
			$page_json = json_encode($page_array);
			if ($request->ajax()) {
				$render = view('goods.partials._goods_list', compact('list', 'page_json', 'page_array'))->render();

				return result(0, $render);
			}

			$seo_title = $keyword . ' - ' . sysconf('site_name');
			$seo_keywords = $keyword . ',' . sysconf('site_name');
			$seo_discription = $keyword . ',' . sysconf('site_name');
			$seo_info = [
				1 => $seo_title,
				2 => $seo_keywords,
				3 => $seo_discription,
			];

			$this->show_seo($seo_info, ['name' => $keyword]); // SEO
			$credit = "search.html?sort=credit&amp;order=ASC&amp;keyword=$keyword";
			$sale_num = "search.html?sort=sale_num&amp;order=ASC&amp;keyword=$keyword&type=$type";
			$shop_sort = "search.html?sort=shop_sort&amp;order=ASC&amp;keyword=$keyword&type=$type";
			$compact = compact('params', 'keyword', 'list', 'page_array', 'total', 'pageHtml', 'page_json',
				'credit', 'sale_num', 'shop_sort');
			$app_prefix_data = [
				'page' => $page_array,
				'list' => $list,
				'sort_type' => $sort_type,
				'order_type' => $order_type,
				'credit' => $credit,
				'sale_num' => $sale_num,
				'shop_sort' => $shop_sort,
				'search_record' => $search_record,
				'search_type' => $type,
				'keyword' => $keyword,
				'default_shop_image' => get_image_url(sysconf('default_shop_image')),
				'cls_level' => $cls_level ?? '',
				'cls_id' => $cls_id ?? null,
				'sel_cls_id' => $sel_cls_id ?? null,
				'parent_id' => $parent_id ?? null,
				'cls_id_old' => $cls_id_old ?? '',
				'cls_list_1' => $cls_list_1 ?? [],
			];
		} else {
			// 默认搜索商品
			$tpl = 'search_goods';
			$where[] = ['goods_status', 1]; // 商品状态 已发布
			$where[] = ['goods_audit', 1]; // 审核通过
			$where[] = ['goods_name', 'like', "%{$keyword}%"];
			$condition = [
				'where' => $where,
				'sortname' => 'goods_id',
				'sortorder' => 'desc'
			];
			list($list, $total) = $this->goods->getList($condition, '', $this->user_id);
			$list = $list->toArray();
			$pageHtml = frontend_pagination($total);
			if (!empty($list)) {
				foreach ($list as &$v) {
					$shop_info = Shop::where('shop_id', $v['shop_id'])
						->select(['shop_name', 'shop_type', 'is_supply', 'show_price', 'show_content', 'button_content', 'button_url', 'is_own_shop'])
						->first()->toArray();
					$brand_name = Brand::where('brand_id', $v['brand_id'])->value('brand_name');
					$isCollected = 0;
					if ($this->collect->checkIsCollected($this->user_id, 0, 0, $v['goods_id'])) {
						// 已收藏
						$isCollected = 1;
					}
					$v = array_merge($v, $shop_info);
					$v['is_free'] = $v['goods_freight_fee'] > 0 ? 0 : 1;
					$v['brand_name'] = $brand_name;
					$v['act_type'] = null;
					$v['default_spec_id'] = null;
					$v['goods_gift'] = 0;
					$v['price_show'] = ['code' => 1];
					$v['goods_price_format'] = '￥' . $v['goods_price'];
					$v['market_price_format'] = '￥' . $v['market_price'];
					$v['buy_enable'] = [ // 判断是否登录
						'code' => 1,
						'button_content' => '请登录'
					];
					$v['is_collected'] = $isCollected; // 判断是否收藏商品
					$v['cart_num'] = 0; // 该商品购物车数量
				}
			}
			// 分页
			$page_array = frontend_pagination($total, true);
			$page_json = json_encode($page_array);
//        dd(Goods::search("中茶")->get()->toArray());
			if ($request->ajax()) {
				$render = view('goods.partials._goods_list', compact('list', 'page_json', 'page_array'))->render();

				return result(0, $render);
			}

			$seo_title = $keyword . ' - ' . sysconf('site_name');
			$seo_keywords = $keyword . ',' . sysconf('site_name');
			$seo_discription = $keyword . ',' . sysconf('site_name');
			$seo_info = [
				1 => $seo_title,
				2 => $seo_keywords,
				3 => $seo_discription,
			];

			// 新品推荐
			$new_goods = $this->goods->getNewGoods([], 4);

			// 排行榜-销售量
			$sale_top_list = $this->goods->getTopGoods('sale_num', [], 4);

			// 销量排行榜
//        $sale_rank_goods = $this->goods->getSaleRankGoods([], 4);

			// 浏览历史
			list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory([], 6);

			$this->show_seo($seo_info, ['name' => $keyword]); // SEO

			$compact = compact('params', 'keyword', 'list', 'page_array', 'total', 'pageHtml', 'page_json', 'new_goods', 'sale_top_list', 'goods_history');
			$app_prefix_data = [ // todo 数据还差 后期补
				'page' => $page_array,
				'list' => $list,
				'keyword' => $keyword,
			];
		}


//        return view('search.'.$tpl, $compact);

		$webData = []; // web端（pc、mobile）数据对象
		$data = [
			'app_prefix_data' => $app_prefix_data,
			'app_suffix_data' => [],
			'web_data' => $webData,
			'compact_data' => $compact,
			'tpl_view' => 'search.' . $tpl
		];
		$this->setData($data); // 设置数据
		return $this->displayData(); // 模板渲染及APP客户端返回数据
	}

	/**
	 * 删除关键词搜索记录
	 *
	 * @param Request $request
	 * @return array
	 */
	public function deleteRecord(Request $request)
	{
		$key = $request->input('data', 0);
		$search_record = !empty($_COOKIE['search_records']) ? unserialize($_COOKIE['search_records']) : [];
		unset($search_record[$key]); // 删除cookie中的第几个
		// 将搜索词写入cookie
		setcookie('search_records', serialize(array_values($search_record)), null, '/');
		return result(0);
	}


}
