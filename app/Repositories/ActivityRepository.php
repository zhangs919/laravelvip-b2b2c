<?php

namespace App\Repositories;


use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Goods;
use App\Models\GoodsActivity;
use App\Models\GoodsSku;
use App\Models\GrouponLog;
use App\Models\Shop;
use App\Models\User;
use App\Services\Enum\ActTypeEnum;
use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    use BaseRepository;

    protected $model;
    protected $goodsActivity;


    public function __construct()
    {
        $this->model = new Activity();
        $this->goodsActivity = new GoodsActivityRepository();
    }

    public function getActivityInfo($goods_id, $sku_id, $act_id, $user_id = 0)
    {
        if (!$goods_id || !$sku_id || !$act_id) {
            return [];
        }
        $data = $this->model->getById($act_id);
        $data = $data->toArray();
        $this->fetchActivityInfo($goods_id, $sku_id,$data, $user_id);
        return $data;
    }

    private function fetchActivityInfo($goods_id, $sku_id, &$data, $user_id = 0)
    {
        switch ($data['act_type']) {
            case ActTypeEnum::ACT_TYPE_FIGHT_GROUP: // 拼团
                $sku_ids = $data['ext_info']['sku_ids'];
                $sku_id = array_first($sku_ids);
                $sku = GoodsSku::where('sku_id', $sku_id)->first();

                $act_price_arr = array_values($data['ext_info']['act_price']);
                $min_act_price = min($act_price_arr);
                $max_act_price = max($act_price_arr);
                $act_price = $min_act_price != $max_act_price ? $min_act_price.'~'.$max_act_price : $min_act_price;
                $data['act_price'] = $act_price;
                $act_stock_arr = array_values($data['ext_info']['act_stock']);
                $min_act_stock = min($act_stock_arr);
                $max_act_stock = max($act_stock_arr);
                $act_stock = $min_act_stock != $max_act_stock ? $min_act_stock.'~'.$max_act_stock : $min_act_stock;
                $data['act_stock'] = $act_stock;
                $data['goods_price'] = $sku->goods_price;
                $data['goods_number'] = $sku->goods_number;
                $data['market_price'] = $sku->market_price;
                $data['act_code'] = 'fight_group';
                $data['order_goods_number'] = 1;
                $data['groupon_mode'] = $data['act_ext_info']['groupon_mode'];
                $data['fight_num'] = $data['act_ext_info']['fight_num'];
                $data['fight_time'] = $data['act_ext_info']['fight_time'];
                $data['sku_ids'] = $sku_ids;
                $data['act_prices'] = $data['ext_info']['act_price'];
                $data['act_stocks'] = $data['ext_info']['act_stock'];
                $data['first_discounts'] = $data['ext_info']['first_discounts'];
                $data['discount_prices'] = $data['ext_info']['discount_prices'];
                $data['is_gather'] = $data['act_ext_info']['is_gather'];
                $data['is_imitate'] = $data['act_ext_info']['is_imitate'];
                $data['is_commander_discount'] = $data['act_ext_info']['is_commander_discount'];
                $data['discount_over_used'] = $data['act_ext_info']['discount_over_used'];
                $data['groupon_rule'] = $data['act_ext_info']['groupon_rule'];
                $data['act_price_format'] = $min_act_price != $max_act_price ? '￥'.$min_act_price.'~￥'.$max_act_price : '￥'.$min_act_price;
                $data['cutdown_time'] = strtotime($data['end_time']);

                $groupon_log_list = GrouponLog::where('act_id', $data['act_id'])
                    ->where('user_type', 0) // 团长
                    ->where('status', 0) // 拼团中
                    ->where('goods_id', $sku->goods_id)
                    ->with(['orderInfo' => function ($query) {
                        $query->select(['order_id', 'order_sn', 'order_status', 'pay_status','shipping_status','is_cod', 'order_amount']);
                    },'orderInfo.orderGoods','user' => function ($query) {
                        $query->select(['user_id', 'user_name','headimg']);
                    }])->withCount('grouponLog')
                    ->orderBy('user_type', 'asc')
                    ->get()->toArray();

               if (!empty($groupon_log_list)) {
                   foreach ($groupon_log_list as &$item) {
                       $item['user_name'] = $item['user']['user_name'];
                       $item['headimg'] = get_image_url($item['user']['headimg'], 'headimg');
                       $item['act_ext_info'] = $data['act_ext_info'];
                       $item['order_id'] = $item['order_info']['order_id'];
                       $item['diff_num'] = $data['act_ext_info']['fight_num'] - $item['groupon_log_count'];
                       unset($item['order_info'],$item['user'], $item['groupon_log_count']);
                   }
               }
                $data['params'] = [
                    'groupon_log_list' => $groupon_log_list
                ];

                break;

            case ActTypeEnum::ACT_TYPE_BARGAIN: // 砍价
                $act_info = $data;

                $goodsActivity = $this->getGoodsActivityInfo($data['act_id'], $sku_id);

                // 活动价 todo 根据已砍记录计算
                $act_price = '';

                $data['act_ext_info'] = $data['ext_info'];
                $data['ext_info'] = $goodsActivity['ext_info'];

                $data['act_price'] = $act_price;
                $data['act_stock'] = $goodsActivity['act_stock'];
                $data['plat_act_id'] = 0;
                $data['sale_base'] = $goodsActivity['sale_base'];
                $data['is_show_plat'] = 0;
                $data['shop_id'] = $goodsActivity['goods']['shop_id'];
                $data['goods_price'] = $goodsActivity['goods_sku']['goods_price'];
                $data['goods_number'] = $goodsActivity['act_stock'];
                $data['act_code'] = 'bargain';
                $data['order_goods_number'] = 0;
                $data['goods_max_number'] = 1;
                $data['bargain_time'] = $data['act_ext_info']['bargain_time'];
                $data['all_goods_bargain_num'] = $data['act_ext_info']['all_goods_bargain_num'];
                $data['one_goods_bargain_num'] = $data['act_ext_info']['one_goods_bargain_num'];
                $data['original_price_label'] = '价值';
                $data['original_price'] = $goodsActivity['goods_sku']['goods_price'];
                $data['original_price_format'] = '￥'.$data['original_price'];
                $data['bargain_act_price_format'] = '￥'.$goodsActivity['ext_info']['act_price'];
                $user_info = [
                    'headimg' => get_image_url('', 'headimg')
                ];
                if ($user_id) {
                    $user_info = User::where('user_id', $user_id)->first()->toArray();
                }
                $data['user_info'] = $user_info; // 砍价发起人信息
                $data['part_price_label'] = '价值';
                $data['part_status_label'] = '未参与';
                $data['act_price_format'] = '￥'.$data['act_price'];

                // 已帮砍列表
                $help_bargain_list = null;

                $bargain_info = $act_info;
                $goods_count = GoodsActivity::where('act_id', $data['act_id'])->groupBy('goods_id')->count() ?? 0;
                $bargain_info['plat_act_id'] = 0;
                $bargain_info['is_show_plat'] = 0;
                $bargain_info['part_shop_ids'] = null;
                $bargain_info['act_multistore_type'] = 0;
                $bargain_info['act_group_ids'] = null;
                $bargain_info['act_multistore_ids'] = 0;
                $bargain_info['out_code'] = '';
                $bargain_info['first_order_num'] = 0;
                $bargain_info['source_type'] = 'ONLINE';
                $bargain_info['goods_count'] = $goods_count;
                $bargain_info['multistore_count'] = 0;
                $bargain_info['sale_base'] = $goodsActivity['sale_base'];
                $bargain_info['goods_id'] = $goodsActivity['goods_id'];
                $bargain_info['act_price'] = $data['act_price'];
                $bargain_info['act_stock'] = $goodsActivity['act_stock'];
                $bargain_info['goods_name'] = $goodsActivity['goods']['goods_name'];
                $bargain_info['goods_number'] = $goodsActivity['act_stock'];
                $bargain_info['goods_price'] = $goodsActivity['goods_sku']['goods_price'];
                $bargain_info['market_price'] = $goodsActivity['goods_sku']['market_price'];
                $bargain_info['goods_image'] = $goodsActivity['goods']['goods_image'];
                $bargain_info['order_goods_number'] = 0;
                //hero_list:{
                //                                "bar_id": "1",
                //                                "add_time": "1716609909",
                //                                "nickname": null,
                //                                "headimg": null,
                //                                "total_amount": null
                //                            }
                $bargain_info['hero_list'] = null; // 帮砍统计
                $bargain_info['bargain_num'] = 0; // 帮砍数量
                $bargain_info['original_price'] = $goodsActivity['goods_sku']['goods_price']; // 原始价格
                $bargain_info['floor_price'] = $goodsActivity['ext_info']['act_price']; // 底价

                $data['params'] = [
                    'help_bargain_list' => $help_bargain_list, // 帮砍列表
                    'help_bargain_num' => 0,
                    'bargain_info' => $bargain_info
                ];
                $data['cutdown_time'] = strtotime($data['end_time']);

                $data['min_price'] = null;


                break;
            case ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT: // 限时折扣
                $goodsActivity = $this->getGoodsActivityInfo($data['act_id'], $sku_id);

                $data['act_ext_info'] = $data['ext_info'];
                $data['ext_info'] = $goodsActivity['ext_info'];

                $data['act_price'] = $goodsActivity['act_price'];
                $data['act_stock'] = $goodsActivity['act_stock'];
                $data['sale_base'] = $goodsActivity['sale_base'];
                $data['goods_id'] = $goodsActivity['goods_id'];
                $data['sku_id'] = $goodsActivity['sku_id'];
                $data['goods_status'] = $goodsActivity['goods']['goods_status'];
                $data['sku_open'] = $goodsActivity['goods']['sku_open'];
                $data['prop_open'] = $goodsActivity['goods']['prop_open'];
                $data['user_discount'] = $goodsActivity['goods']['user_discount'];
                $data['sales_model'] = $goodsActivity['goods']['sales_model'];
                $data['shop_id'] = $goodsActivity['goods']['shop_id'];
                $data['goods_price'] = $goodsActivity['goods_sku']['goods_price'];
                $data['goods_number'] = $goodsActivity['act_stock'];
                $data['original_number'] = $goodsActivity['goods_sku']['goods_number'];
                $data['original_price'] = $goodsActivity['goods_sku']['goods_price'];
                $data['discount_mode'] = $data['ext_info']['discount_mode'];
                $data['discount_num'] = $data['ext_info']['discount_num'];
                $data['act_repeat'] = $data['act_ext_info']['act_repeat'];
                $data['cycle_data'] = $data['act_ext_info']['cycle_data'];
                $data['act_label'] = $data['act_ext_info']['act_label'] ?? '限时折扣';
                $data['limit_type'] = $data['act_ext_info']['limit_type'];
                $data['limit_num'] = $data['act_ext_info']['limit_num'];
                $data['act_code'] = 'limit_discount';
                $data['act_status'] = $data['is_finish'];
                $data['cutdown_time'] = strtotime($data['end_time']);
                if ($data['discount_mode'] == 2) { // 折扣价
                    $discount_mode_format = '折扣价';
                } elseif ($data['discount_mode'] == 1) { // 减价
                    $discount_mode_format = '减'.$data['discount_num'].'元';
                } else { // 打折
                    $discount_mode_format = $data['discount_num'].'折';
                }

                $data['act_sub_label'] = $discount_mode_format;
                $data['order_goods_number'] = 0;
                $data['user_purchased_num'] = $data['purchase_num'];
                $data['act_hash_code'] = 'bf873808';
                $data['act_price_format'] = '￥'.$data['act_price'];
                $data['params'] = null;
                $data['min_price'] = null;

                break;

            default:

                break;
        }

    }

    private function getGoodsActivityInfo($act_id, $sku_id)
    {
        $data = GoodsActivity::where([['act_id', $act_id], ['sku_id', $sku_id]])
            ->with(['goods'=>function($query) {
                $query->select(['goods_id','sku_open','prop_open','goods_price','goods_number','goods_name','goods_image','goods_status']);
            }, 'goodsSku' => function($query) {
                $query->select(['goods_id', 'sku_id','goods_price','goods_number','goods_barcode','goods_sn','sku_image','spec_names','checked']);
            }])
            ->first()->toArray();

        return $data;
    }

    public function getList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key=>$value) {

                $this->fetchActExtInfo($value);
            }
        }
        return $data;
    }

    private function fetchActExtInfo(&$value)
    {
        switch ($value->act_type) {
            case ActTypeEnum::ACT_TYPE_FIGHT_GROUP: // 拼团
                $goodsActivityList = GoodsActivity::where('act_id', $value->act_id)
                    ->with(['goods'=>function($query) {
                        $query->select(['goods_id','sku_open','goods_price','goods_number','goods_name','goods_image','goods_status']);
                    }, 'goodsSku' => function($query) {
                        $query->select(['goods_id', 'sku_id','goods_price','goods_number','goods_barcode','goods_sn','sku_image','spec_names','checked']);
                    }])
                    ->get();

                $goods_price_arr = [];
                foreach ($goodsActivityList as $item) {
                    $goods_price_arr[] = $item->goodsSku->goods_price;
                }
                $goodsActivity = $goodsActivityList[0];
                $goods = $goodsActivity->goods;
                $goods_sku = $goodsActivity->goodsSku;

                $value->goods_id = $goods->goods_id;
                $value->sku_id = $goods_sku->sku_id;
                $value->goods_image = get_image_url($goods->goods_image);
                $value->goods_name = $goods->goods_name;
                $value->goods_price = $goods_sku->goods_price;

                $act_price_arr = array_values($value->ext_info['act_price']);
                $min_act_price = min($act_price_arr);
                $max_act_price = max($act_price_arr);

                $value->act_price = $min_act_price != $max_act_price ? $min_act_price.'~'.$max_act_price : $min_act_price;

                $min_goods_price = min($goods_price_arr);
                $max_goods_price = max($goods_price_arr);

                // 根据商品规格计算
                $value->min_act_price = $min_act_price;
                $value->max_act_price = $max_act_price;
                $value->act_stock = $goodsActivity->act_stock;
                $value->min_goods_price = $min_goods_price;
                $value->max_goods_price = $max_goods_price;
                $value->fight_num = $value->act_ext_info['fight_num'];
                $value->groupon_mode = $value->act_ext_info['groupon_mode'];
                $value->status_format = str_replace([0,1,2], ['未开始', '进行中', '已结束'], $value->status);

                break;
            case ActTypeEnum::ACT_TYPE_BARGAIN: // 砍价
                $goods_count = GoodsActivity::where('act_id', $value->act_id)->groupBy('goods_id')->count() ?? 0;
                $shop_name = Shop::where('shop_id', $value->shop_id)->value('shop_name');
                $value->plat_act_id = 0;
                $value->is_show_plat = 0;
                $value->part_shop_ids = null;
                $value->act_multistore_type = 0;
                $value->act_group_ids = null;
                $value->act_multistore_ids = null;
                $value->out_code = '';
                $value->first_order_num = 0;
                $value->source_type = 'ONLINE';
                $value->goods_count = $goods_count;
                $value->multistore_count = 0;
                $value->shop_name = $shop_name;
                $value->total_bargain_num = '0'; // 总发起砍价次数
                $value->total_help_bargain_num = '0';//帮砍次数
                $value->total_virtual_num = '0';//虚拟参与人数
                $value->bargain_time = $value->ext_info['bargain_time'];//砍价时限（时）
                $value->status_message = str_replace([0,1,2], ['未开始', '进行中', '已结束'], $value->status);

                break;

            case ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT: // 限时折扣



                break;

            default:

                break;
        }

    }

    /**
     * 新增活动
     *
     * @param $activityData
     * @param array $goodsActivityData
     * @param array $goodsData
     * @return User|bool
     */
    public function addActivity($activityData, $goodsActivityData = [], $goodsData = [])
    {
        DB::beginTransaction();
        try {
            // 插入活动表
            $activityData['purchase_num'] = $activityData['purchase_num'] ?? 0;
            $activityData['status'] = 1; // 默认 审核通过
            $activityData['is_finish'] = 1; // 默认 进行中 todo 需根据开始结束时间进行判断

            $activityRet = $this->store($activityData);

            // 插入活动商品表
            if (!empty($goodsActivityData)) {
                foreach ($goodsActivityData as $v) {
                    $v['act_id'] = $activityRet->act_id;

                    $goodsActivity = new GoodsActivity();
                    $goodsActivity->fill($v);
                    $goodsActivity->save();

                    // 判断商品是否已参与其他活动
                    if (Goods::where('goods_id', $v['goods_id'])->value('act_id')) {
                        throw new \Exception('该商品已参与其他活动');
                    }
                    // 修改商品的活动ID
                    Goods::where('goods_id', $v['goods_id'])->update([
                        'act_id' => $v['act_id'],
                    ]);
                }
            }


            // 更新商品表 todo 此处的 act_id 和 order_act_id 是否有必要存入商品表（goods）?
            // act_type
            // 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动
            /*if (in_array($activityData['act_type'], [3])) {
                // 如果是 团购等活动 则更新 act_id
                $goodsUpdate['act_id'] = $activityRet->act_id;
            } elseif (in_array($activityData['act_type'], [12])) {
                // 如果是 满减/送等活动 则更新 order_act_id
                $goodsUpdate['order_act_id'] = $activityRet->act_id;
            }
            if (!empty($goodsUpdate)) {
                Goods::where('goods_id', $goodsData['goods_id'])->update($goodsUpdate);
            }*/

            DB::commit();
            return $activityRet;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 更新活动
     *
     * @param $activityData
     * @param array $goodsActivityData
     * @param array $goodsData
     * @return bool
     */
    public function modifyActivity($activityData, $goodsActivityData = [], $goodsData = [])
    {
        DB::beginTransaction();
        try {
            // 更新活动表
            $this->update($activityData['act_id'], $activityData);

            // 更新活动商品表
            if (!empty($goodsActivityData)) {
                foreach ($goodsActivityData as $v) {
                    $goodsActivityWhere = [];
                    $goodsActivityWhere[] = ['goods_id', $v['goods_id']];
                    $goodsActivityWhere[] = ['act_id',$activityData['act_id']];
                    if ($v['sku_id']) { // sku_id 有可能为0  赠品：暂时只支持无规格商品
                        $goodsActivityWhere[] = ['sku_id',$v['sku_id']];
                    }
                    if (!empty($v['ext_info'])) {
                        $v['ext_info'] = json_encode($v['ext_info']);
                    }
                    $ga = GoodsActivity::where($goodsActivityWhere)->first();
                    if (!empty($ga)) {
                        $ga->update($v);
                    } else {
                        $v['act_id'] = $activityData['act_id'];
                        $this->goodsActivity->store($v);
                    }
                }
            }

            // 更新商品表
            if (!empty($goodsData)) {
                // act_type
                // 1-拍卖 2-预售 3-团购 5-积分兑换 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动
                if (in_array($activityData['act_type'], [3])) {
                    // 如果是 团购等活动 则更新 act_id
                    $goodsUpdate['act_id'] = $activityData['act_id'];
                } elseif (in_array($activityData['act_type'], [12])) {
                    // 如果是 满减/送等活动 则更新 order_act_id
                    $goodsUpdate['order_act_id'] = $activityData['act_id'];
                }
                if (!empty($goodsUpdate)) {
                    Goods::where('goods_id', $goodsData['goods_id'])->update($goodsUpdate);
                }
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 活动(批量)删除
     *
     * @param int $shop_id 店铺id
     * @param array $act_ids 活动id
     * @return bool
     */
    public function deleteActivity($shop_id = 0, $act_ids = [])
    {
        if (empty($shop_id) && empty($act_ids)) {
            return false;
        }

        DB::beginTransaction();
        try {

            // 活动关联数据
            if (!empty($shop_id)) {
                // 删除店铺所有活动
                $act_ids = Activity::where('shop_id', $shop_id)->select(['act_id'])->pluck('act_id')->toArray();
            }

            Activity::whereIn('act_id', $act_ids)->delete(); // 活动表 activity
            GoodsActivity::whereIn('act_id', $act_ids)->delete(); // 商品活动表 goods_activity

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

    /**
     * 获取赠品活动 活动商品列表
     *
     * @param $act_id
     * @return array
     */
    public function getGiftGoodsActivityList($act_id)
    {
        $act_info = Activity::find($act_id);
        if (empty($act_info)) {
            return [];
        }
        $ext_info = $act_info->ext_info;

        $goods_list = GoodsActivity::where('act_id', $act_id)->get()->toArray();
        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $v) {
                $goods_info = Goods::where('goods_id', $v['goods_id'])
                    ->select(['goods_price','goods_number','goods_name'])->first();
                $list[] = [
                    'id' => $v['id'],
                    'act_id' => $v['act_id'],
                    'shop_id' => $act_info->shop_id,
                    'act_type' => $act_info->act_type,
                    'sku_id' => $v['sku_id'],
                    'goods_id' => $v['goods_id'],
                    'cat_id' => $v['cat_id'],
                    'sale_base' => $v['sale_base'],
                    'act_price' => $v['act_price'],
                    'act_stock' => $v['act_stock'],
                    'ext_info' => $ext_info,
                    'click_count' => $v['click_count'],
                    'sort' => $act_info->sort,
                    'goods_number_max' => $goods_info->goods_number, // 商品库存
                    'goods_price' => $goods_info->goods_price,
                    'goods_name' => $goods_info->goods_name,
                    'valid_data' => $ext_info['valid_data'] ?? null,
                    'gift_limit' => $ext_info['gift_limit'] ?? null,
                    'act_number' => $v['ext_info']['act_number'] ?? null, // 赠送数量
                    'goods_number' => $v['ext_info']['act_number'] ?? null, // 赠送数量
                ];
            }
        }

        return $list;
    }

    /**
     * 获取赠品活动列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getGiftActivityList($where = [])
    {
        $where[] = ['act_type', 13]; // 13-赠品活动

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $ext_info = $item['ext_info'];
                $list[$key]['valid_data'] = $ext_info['valid_data'] ?? 0;
                $list[$key]['gift_limit'] = $ext_info['gift_limit'] ?? 0;
                if (strtotime($item['end_time']) < time()) {
                    // 已结束
                    $status_message = '已结束';
                } elseif (strtotime($item['start_time']) > time()) {
                    // 未开始
                    $status_message = '未开始';
                } elseif (strtotime($item['end_time']) > time()) {
                    // 进行中
                    $status_message = '进行中';
                } else {
                    $status_message = '';
                }
                $list[$key]['status_message'] = $status_message;
                $list[$key]['shop_name'] = Shop::where('shop_id', $item['shop_id'])->value('shop_name');

            }
        }

        return [$list, $total];
    }

    /**
     * 获取团购活动 活动商品列表
     *
     * @param $act_id
     * @return array
     */
    public function getGroupBuyGoodsActivityList($act_id)
    {
        $act_info = Activity::find($act_id);
        if (empty($act_info)) {
            return [];
        }
        $ext_info = $act_info->ext_info;

        $goods_list = GoodsActivity::where('act_id', $act_id)->get()->toArray();
        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $v) {
                $goods_info = Goods::where('goods_id', $v['goods_id'])
                    ->select(['goods_price','goods_number','goods_name'])->first();
                $list[] = [
                    'id' => $v['id'],
                    'act_id' => $v['act_id'],
                    'shop_id' => $act_info->shop_id,
                    'act_type' => $act_info->act_type,
                    'sku_id' => $v['sku_id'],
                    'goods_id' => $v['goods_id'],
                    'cat_id' => $v['cat_id'],
                    'sale_base' => $v['sale_base'],
                    'act_price' => $v['act_price'],
                    'act_stock' => $v['act_stock'],
                    'ext_info' => $ext_info,
                    'click_count' => $v['click_count'],
                    'sort' => $act_info->sort,
                    'goods_name' => $goods_info->goods_name,
                    'goods_price' => $goods_info->goods_price,
                    'goods_image' => get_image_url($goods_info->goods_image),
                    'cost_price' => $goods_info->cost_price,
                    'goods_number' => $goods_info->goods_number,
                ];
            }
        }

        return $list;
    }

    /**
     * 获取团购活动列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getGroupBuyActivityList($where = [])
    {
        $where[] = ['act_type', 3]; // 3-团购活动

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $shop_name = Shop::select('shop_name')->where('shop_id', $item['shop_id'])->value('shop_name');
                $goods_count = GoodsActivity::where('act_id', $item['act_id'])->count();
                $list[$key]['shop_name'] = $shop_name;
                $list[$key]['goods_count'] = $goods_count;
            }
        }

        return [$list, $total];
    }

    /**
     * 获取团购活动详情
     *
     * @param $act_id
     * @return array
     */
    public function getGroupBuyActivityInfo($act_id)
    {
        $act_info = Activity::find($act_id);
        if (empty($act_info)) {
            return [];
        }

        $where[] = ['act_id', $act_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($goods_list, $total) = $this->goodsActivity->getList($condition);
        $goods_list = $goods_list->toArray();

        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $v) {
                $goods_info = Goods::where('goods_id', $v['goods_id'])->first();
                if (empty($goods_info)) {
                    return [];
                }
                $cat_name = ActivityCategory::where('id', $v['cat_id'])->value('cat_name');
                $goods_info = $goods_info->toArray();
                $goods_info['cat_name'] = $cat_name; // 活动分类名称
                $goods_info['id'] = $v['id']; // 活动商品id
                $goods_info['act_price'] = $v['act_price']; // 活动价格
                $goods_info['sale_base'] = $v['sale_base']; // 历史销量
                $goods_info['act_stock'] = $v['act_stock']; // 活动库存
                $list[] = $goods_info;
            }
        }

        return [$list, $total];
    }

    /**
     * 获取搭配套餐活动 活动商品列表
     *
     * @param $act_id
     * @return array
     */
    public function getGoodsMixGoodsActivityList($act_id)
    {
        $act_info = Activity::find($act_id);
        if (empty($act_info)) {
            return [];
        }
        $ext_info = $act_info->ext_info;

        $goods_list = GoodsActivity::where('act_id', $act_id)->get()->toArray();
        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $v) {
                $goods_info = Goods::where('goods_id', $v['goods_id'])
                    ->select(['goods_price','goods_number','goods_name'])->first();
                $goods_sku_list = GoodsSku::where([['goods_id', $v['goods_id']],['checked',1]])
                    ->select(['sku_id','goods_number','goods_price'])->get()->toArray();
                $goods_price = [];
                foreach (array_column($goods_sku_list, 'goods_price') as $gp) {
                    $goods_price[] = '￥'.$gp;
                }
                $goods_price = implode('-', $goods_price);
                $sku_ids = implode(',', array_column($goods_sku_list, 'sku_id'));

                $list[] = [
                    'goods_name' => $goods_info->goods_name,
                    'goods_price' => $goods_price,
                    'goods_id' => $v['goods_id'],
                    'sku_id' => $v['sku_id'],
                    'goods_number' => $goods_info->goods_number,
                    'goods_status' => $goods_info->goods_status,
                    'price_mode' => $ext_info['price_mode'],
                    'sku_ids' => $sku_ids, // 多个sku "871,872",
                    'set_sku' => 1, // 不知道是什么
                ];
            }
        }

        return $list;
    }

    /**
     * 获取搭配套餐活动列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getGoodsMixActivityList($where = [])
    {
        $where[] = ['act_type', 10]; // 10-搭配套餐

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $ext_info = $item['ext_info'];
                $list[$key]['price_mode'] = $ext_info['price_mode'] ?? 0;
                $list[$key]['act_price'] = $ext_info['act_price'] ?? '';
                $list[$key]['discount_show'] = $ext_info['discount_show'] ?? 0;
                if (strtotime($item['end_time']) < time()) {
                    // 已结束
                    $status_message = '已结束';
                } elseif (strtotime($item['start_time']) > time()) {
                    // 未开始
                    $status_message = '未开始';
                } elseif (strtotime($item['end_time']) > time()) {
                    // 进行中
                    $status_message = '进行中';
                } else {
                    $status_message = '';
                }
                $list[$key]['status_message'] = $status_message;

                $list[$key]['shop_name'] = Shop::where('shop_id', $item['shop_id'])->value('shop_name');
            }
        }

        return [$list, $total];
    }

    /**
     * 获取限时折扣活动 活动商品列表
     *
     * @param $act_id
     * @return array
     */
    public function getLimitDiscountGoodsActivityList($act_id)
    {
        $goods_list = GoodsActivity::with(['goods'=>function($query) {
            $query->select(['goods_id','sku_open','goods_price','goods_number','goods_name']);
        }, 'goodsSku' => function($query) {
            $query->select(['goods_id', 'sku_id','goods_price','goods_number']);
        }])->where('act_id', $act_id)->get()->toArray();
        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $item) {
                $goods = $item['goods'];
                $sku_open = $goods['sku_open'];
                $sku = $item['goodsSku'];
                $sku_price_arr = array_column($sku,'goods_price');
                foreach ($sku as $sItem) {
                    if ($item['sku_id'] == $sItem['sku_id']) {
                        $sku_num = $sItem['goods_number'];
                    }
                }
                $list[$item['goods_id']] = [
                    'goods_price' => $goods['goods_price'],
                    'goods_price_format' => $sku_open ? '￥'.min($sku_price_arr).'-￥'.max($sku_price_arr) : '￥'.$goods['goods_price'],
                    'sku_num' => $sku_num ?? 0,
                    'act_stock' => $item['act_stock'],
                    'goods_discount_num' => '8',
                    'act_stock_init' => $item['act_stock'],
                    'discount_val' => '8',
                    'after_price' => $after_price,
                    'goods_discount' => $goods_discount,
                    'goods_reduce' => $goods_reduce,
                    'goods_set' => '',
                    'goods_stock' => $goods_stock,
                    'min_goods_price' => $min_goods_price,
                    'max_goods_price' => $max_goods_price,
                    'goods_id'=>$item['goods_id'],
                    'sku_id'=>$item['sku_id'],
                    'goods_name'=>$goods['goods_name'],
                    'sku_open' => $sku_open,
                    'discount_mode' => 0,
                    'discount_num' => '8',
                    'goods_number' => $goods['goods_number'],

//                    // 折扣方式不同 只返回对应的字段
//                    'goods_reduce' => $v['goods_id'].'-'.($goods_info->goods_price - $v['act_price']), // 减价
////                    'goods_discount' => $v['goods_id'].'-'.($goods_info->goods_price - $v['act_price']), // 折扣
//
//                    'min_goods_price' => $goods_info->goods_price,
//                    'max_goods_price' => $goods_info->goods_price,
//                    'goods_id' => $v['goods_id'],
//                    'sku_id' => $v['sku_id'],
//                    'goods_name' => $goods_info->goods_name,
//                    'discount_mode' => 0, // 0
//                    'discount_num' => ($goods_info->goods_price - $v['act_price']),
//                    'goods_number' => $goods_info->goods_number

                ];
            }
        }

        return $list;
    }


    /**
     * 获取限时折扣活动列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getLimitDiscountActivityList($where = [])
    {
        $where[] = ['act_type', ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT]; // 11-限时折扣

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $ext_info = $item['ext_info'];
                $list[$key]['act_repeat'] = $ext_info['act_repeat'] ?? 0;
                $list[$key]['act_label'] = $ext_info['act_label'] ?? '';
                $list[$key]['limit_type'] = $ext_info['limit_type'] ?? 0;
                $list[$key]['limit_num'] = $ext_info['limit_num'] ?? 0;
                if (strtotime($item['end_time']) < time()) {
                    // 已结束
                    $status_message = '已结束';
                } elseif (strtotime($item['start_time']) > time()) {
                    // 未开始
                    $status_message = '未开始';
                } elseif (strtotime($item['end_time']) > time()) {
                    // 进行中
                    $status_message = '进行中';
                } else {
                    $status_message = '';
                }
                $list[$key]['status_message'] = $status_message;

                $list[$key]['shop_name'] = Shop::where('shop_id', $item['shop_id'])->value('shop_name');

            }
        }

        return [$list, $total];
    }

    /**
     * 获取满减送活动列表
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getFullCutActivityList($where = [])
    {
        $where[] = ['act_type', 12]; // 12-满减/送

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $ext_info = $item['ext_info'];
                $list[$key]['discount'] = $ext_info['discount'] ?? [];
                $list[$key]['bonus_list'] = $ext_info['bonus_list'] ?? null;
                $list[$key]['gift_list'] = $ext_info['gift_list'] ?? null;
                $list[$key]['use_range_check'] = $ext_info['use_range_check'] ?? 0;
                if (strtotime($item['end_time']) < time()) {
                    // 已结束
                    $status_message = '已结束';
                } elseif (strtotime($item['start_time']) > time()) {
                    // 未开始
                    $status_message = '未开始';
                } elseif (strtotime($item['end_time']) > time()) {
                    // 进行中
                    $status_message = '进行中';
                } else {
                    $status_message = '';
                }
                $list[$key]['status_message'] = $status_message;
                $list[$key]['shop_name'] = Shop::where('shop_id', $item['shop_id'])->value('shop_name');

            }
        }

        return [$list, $total];
    }


    /**
     * 获取拼团活动列表
     * 需从goods_activity表中查询数据
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getFightGroupActivityList($where = [])
    {
        $where[] = ['act_type', 6]; // 6-拼团

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $ext_info = $item['ext_info'];

                $shop_name = Shop::select('shop_name')->where('shop_id', $item['shop_id'])->value('shop_name');
                $goods_info = Goods::where('act_id', $item['act_id'])
                    ->select(['goods_name','goods_image','goods_price'])->first();
                $cat_name = ActivityCategory::where('id', $item['cat_id'])->value('cat_name');

                $list[$key]['shop_name'] = $shop_name;
                $list[$key]['goods_name'] = $goods_info->goods_name;
                $list[$key]['goods_image'] = $goods_info->goods_image;
                $list[$key]['goods_price'] = $goods_info->goods_price;
                $list[$key]['cat_name'] = $cat_name;
                $list[$key]['fight_num'] = '3'; // 参与拼团人数


                /*if (strtotime($item['end_time']) < time()) {
                    // 已结束
                    $status_message = '已结束';
                } elseif (strtotime($item['start_time']) > time()) {
                    // 未开始
                    $status_message = '未开始';
                } elseif (strtotime($item['end_time']) > time()) {
                    // 进行中
                    $status_message = '进行中';
                } else {
                    $status_message = '';
                }
                $list[$key]['status_message'] = $status_message;*/
            }
        }

        return [$list, $total];
    }

    /**
     * 获取预售活动列表
     *
     * todo 此方法有问题 后面再完善
     * 需从goods_activity表中查询数据
     *
     * @param array $where 查询条件
     * @return array
     */
    public function getPreSaleGoodsActivityList($where = [])
    {
        $where[] = ['act_type', 2]; // 2-预售

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'act_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as $key=>$item) {
                $ext_info = $item['ext_info'];

                $shop_name = Shop::select('shop_name')->where('shop_id', $item['shop_id'])->value('shop_name');
                $goods_info = Goods::where('act_id', $item['act_id'])
                    ->select(['goods_name','goods_image','goods_price'])->first();

                $list[$key]['shop_name'] = $shop_name;
                $list[$key]['goods_name'] = $goods_info->goods_name;
                $list[$key]['goods_image'] = $goods_info->goods_image;
                $list[$key]['goods_price'] = $goods_info->goods_price;

                $list[$key]['pre_sale_mode'] = $ext_info['pre_sale_mode'];
                $list[$key]['deliver_time_type'] = $ext_info['deliver_time_type'];
                $list[$key]['deliver_time'] = $ext_info['deliver_time'];
                $list[$key]['earnest_money'] = $ext_info['earnest_money'];
                $list[$key]['tail_money'] = $ext_info['tail_money'];

            }
        }

        return [$list, $total];
    }

    /**
     * 获取直播活动商品列表
     *
     * @param $act_id integer 活动id
     * @return array
     */
    public function getLiveGoodsActivityInfo($act_id)
    {
        $act_info = Activity::find($act_id);
        if (empty($act_info)) {
            return [];
        }
        $ext_info = $act_info->ext_info;

        $goods_list = GoodsActivity::where('act_id', $act_id)->get()->toArray();
        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $v) {
                $goods_info = Goods::where('goods_id', $v['goods_id'])
                    ->select(['goods_price','goods_number','goods_name','goods_image'])->first();
                $list[] = [
                    'id' => $v['id'],
                    'act_id' => $v['act_id'],
                    'shop_id' => $act_info->shop_id,
                    'act_type' => $act_info->act_type,
                    'sku_id' => $v['sku_id'],
                    'goods_id' => $v['goods_id'],
                    'cat_id' => $v['cat_id'],
                    'sale_base' => $v['sale_base'],
                    'act_price' => $v['act_price'],
                    'act_stock' => $v['act_stock'],
                    'ext_info' => $ext_info,
                    'click_count' => $v['click_count'],
                    'sort' => $act_info->sort,
                    'goods_name' => $goods_info->goods_name,
                    'goods_price' => $goods_info->goods_price,
                    'goods_image' => get_image_url($goods_info->goods_image),
                    'cost_price' => $goods_info->cost_price,
                    'goods_number' => $goods_info->goods_number,
                ];
            }
        }

        return $list;
    }


}