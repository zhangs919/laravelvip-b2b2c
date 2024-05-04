<?php

namespace App\Modules\Seller\Http\Controllers\Store;

use App\Models\StoreGroup;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class DefaultController extends Seller
{

	private $links = [
		['url' => 'store/default/list', 'text' => '列表'],
		['url' => 'store/default/add', 'text' => '添加'],
		['url' => 'store/default/edit', 'text' => '编辑'],
	];

	protected $store;


	public function __construct(StoreRepository $store)
	{
		parent::__construct();

		$this->store = $store;

		$this->set_menu_select('store', 'store-list');

	}

	public function lists(Request $request)
	{
		$title = '列表';
		$fixed_title = '线下网点管理 - ' . $title;

		$this->sublink($this->links, 'list', '', '', 'add,edit');

		$action_span = [
			[
				'url' => 'add',
				'icon' => 'fa-plus',
				'text' => '添加线下网点'
			],
		];

		$explain_panel = [
			'网站为您提供了线下网点模块，您可以创建线下网点，实现线上购物，派单至线下网点送货',
			'网点区域设置：线下网点需先设置区域，区域就是网点的配送区域，订单在此区域内才可接单',
			'网点关联商品：线下网点关联店铺商品，用于标记网点有哪些商品，能够及时配送',
			'网点订单：指派单至该网点的所有订单，网点自主抢单；店铺管理员抛出的订单，符合配送区域的网点即可进行抢单',
		];
		$blocks = [
			'explain_panel' => $explain_panel,
			'fixed_title' => $fixed_title,
			'action_span' => $action_span
		];

		$this->setLayoutBlock($blocks); // 设置block

		$params = $request->all();

		$where = [];
		$where[] = ['shop_id', seller_shop_info()->shop_id];
		// 搜索条件
		$search_arr = ['key_word'];
		foreach ($search_arr as $v) {
			if (isset($params[$v]) && !empty($params[$v])) {

				if ($v == 'key_word') {
					$where[] = ['store_name', 'like', "%{$params[$v]}%"];
				} else {
					$where[] = [$v, $params[$v]];
				}
			}
		}
		// 列表
		$condition = [
			'where' => $where,
			'sortname' => 'store_id',
			'sortorder' => 'asc',
		];
		list($list, $total) = $this->store->getList($condition);

		$pageHtml = pagination($total);

		if ($request->ajax()) {
			$render = view('store.default.partials._list', compact('list', 'total', 'pageHtml'))->render();
			return result(0, $render);
		}
		return view('store.default.list', compact('title', 'list', 'pageHtml'));
	}

	public function add(Request $request)
	{
		$title = '添加';

		$id = $request->get('id', 0);

		$store_regions = [];
		if ($id) {
			// 更新操作
			$info = $this->store->getById($id);
			view()->share('info', $info);
			// 获取销售/配送范围
			// 全国配送
			$store_regions = [
				[
					'region_code' => 11,
					'region_name' => '北京市'
				]
			];
			// 同城模板
			$store_regions = [[
				"region_code" => "11,01,01",
				"region_name" => "区域1",
				"region_path" => "116.38914,39.907256|116.42914,39.907256|116.42914,39.937256|116.38914,39.937256",
				"region_desc" => "北京市东城区东华门街道东厂胡同东厂北巷小区1号院",
				"region_color" => "blue",
			], [
				"region_code" => "11,01,02",
				"region_name" => "区域2",
				"region_path" => "116.365107,39.909231|116.405107,39.909231|116.405107,39.93923|116.365107,39.93923",
				"region_desc" => "北京市西城区什刹海街道弘文堂北平图书馆旧址",
				"region_color" => "red"
			]];
			$store_regions = [];

			$title = '编辑';
		}

		$fixed_title = '线下网点管理 - ' . $title;

		$action_span = [
			[
				'url' => 'list',
				'icon' => 'fa-reply',
				'text' => '返回线下网点列表'
			],
		];

		$explain_panel = [];
		$blocks = [
			'explain_panel' => $explain_panel,
			'fixed_title' => $fixed_title,
			'action_span' => $action_span
		];

		$this->setLayoutBlock($blocks); // 设置block

		// 店铺管理员列表
		$user_list = $this->userList($request);
		// 网点分组
		$group_list = [0 => '--请选择--'];
		$groupList = StoreGroup::orderBy('group_sort', 'asc')->get();
		if (!empty($groupList)) {
			foreach ($groupList as $item) {
				$group_list[$item->group_id] = $item->group_name;
			}
		}

		return view('store.default.add', compact('title', 'user_list', 'group_list', 'store_regions'));
	}

	public function edit(Request $request)
	{
		return $this->add($request);
	}

	/**
	 * 保存信息
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function saveData(Request $request)
	{
		$post = $request->post('StoreModel');

		// todo 销售/配送范围
		$store_regions = $request->post('store_regions', []);

		if (!empty($post['store_id'])) {
			// 编辑
			$ret = $this->store->update($post['store_id'], $post);
			$msg = '线下网点编辑';
		} else {
			// 添加
			$post['shop_id'] = seller_shop_info()->shop_id;
			if ($post['user_type'] == 1) { // 店铺管理员
				// 验证网点管理员不能是店主、网点主账号、门店主账号
				$user = User::where([['shop_id', $post['shop_id']], ['store_id', 0], ['multi_store_id', 0], ['user_id', $post['user_id']]])->first();
				if (empty($user)) {
					return result(-1, null, '网点管理员不存在或者您没有权限操作此账户！');
				}
				if ($user->is_seller == 1) {
					return result(-1, null, '不能绑定店主为网点管理员！');
				}
			} else { // 普通会员
				$user = User::where([['shop_id', 0], ['store_id', 0], ['multi_store_id', 0], ['mobile', $post['user_account']]])->first();
				if (empty($user)) {
					return result(-1, null, '选择的会员无效！');
				}
				$post['user_id'] = $user->user_id;
			}
			$ret = $this->store->store($post);

			User::where('user_id', $post['user_id'])->update(['shop_id' => $post['shop_id'], 'store_id' => $ret->store_id]);
			$msg = '线下网点添加';
		}

		if ($ret === false) {
			// fail
			return result(-1, null, $msg . '失败');
		}
		// success
		return result(0, null, $msg . '成功');
	}

	/**
	 * 删除
	 * @param Request $request
	 * @return mixed
	 */
	public function delete(Request $request)
	{
		$id = $request->post('id');
		$ret = $this->store->del($id);

		if ($ret === false) {
			// Log
			return result(-1, null, '删除失败');
		}

		// Log
		return result(0, null, '删除成功');
	}

	public function batchDelete(Request $request)
	{
		$ids = $request->post('ids');
		$ret = $this->store->batchDel($ids);

		$ids = implode(',', $ids);
		if ($ret === false) {
			// Log
			admin_log('网点删除失败。ID：' . $ids);
			return result(-1, '', '删除失败');
		}
		// Log
		admin_log('删除了多个网点。ID：' . $ids);
		return result(0, '', '删除成功');
	}

	/**
	 * 异步加载网点分组列表
	 *
	 * @return array
	 */
	public function groupList()
	{
		$list = [0 => '--请选择--'];
		$groupList = StoreGroup::orderBy('group_sort', 'asc')->get();
		if (!empty($groupList)) {
			foreach ($groupList as $item) {
				$list[$item->group_id] = $item->group_name;
			}
		}

		return result(0, $list);
	}

	/**
	 * 管理员列表
	 * @param Request $request
	 * @return array
	 */
	public function userList(Request $request)
	{
		$format = $request->get('format', 'array');
		$userList = User::where([['shop_id', seller_shop_info()->shop_id], ['is_seller', 1], ['store_id', 0], ['multi_store_id', 0]])
			->select(['email', 'mobile', 'user_id', 'user_name'])->get()->toArray();
		if ($format == 'json') {
			return result(0, $userList);
		}
		return $userList;
	}

	public function regionPicker()
	{
		$uuid = make_uuid();

		$render = view('store.default.region_picker', compact('uuid'))->render();

		return result(0, $render);
	}

	public function setIsEnable(Request $request)
	{
		$id = $request->get('id');
		$ret = $this->store->changeState($id, 'store_status');
		if ($ret === false) {
			return result(-1, '', '设置失败');
		}
		return result(0, $ret, '设置成功');
	}
}
