<?php

namespace App\Repositories;


use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Goods;
use App\Models\GoodsActivity;
use App\Models\GoodsSku;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Activity();
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
            $activityRet = $this->store($activityData);

            // 插入活动商品表
            if (!empty($goodsActivityData)) {
                foreach ($goodsActivityData as $v) {
                    $v['act_id'] = $activityRet->act_id;

                    $goodsActivity = new GoodsActivity();
                    $goodsActivity->fill($v);
                    $goodsActivity->save();
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
            echo $e->getMessage();
            echo $e->getCode();
            return false;
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
                    GoodsActivity::where($goodsActivityWhere)->update($v);
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
            echo $e->getMessage();
            echo $e->getCode();
            return false;
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
        $goodsActivityRep = new GoodsActivityRepository();
        list($goods_list, $total) = $goodsActivityRep->getList($condition);
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
        $goods_list = GoodsActivity::where('act_id', $act_id)->get()->toArray();
        $list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $v) {
                $goods_info = Goods::where('goods_id', $v['goods_id'])
                    ->select(['goods_price','goods_number','goods_name'])->first();
                $list[$v['goods_id']] = [
                    'goods_price' => $goods_info->goods_price,
                    'format_goods_price' => $v['act_price'],
                    // 折扣方式不同 只返回对应的字段
                    'goods_reduce' => $v['goods_id'].'-'.($goods_info->goods_price - $v['act_price']), // 减价
//                    'goods_discount' => $v['goods_id'].'-'.($goods_info->goods_price - $v['act_price']), // 折扣

                    'min_goods_price' => $goods_info->goods_price,
                    'max_goods_price' => $goods_info->goods_price,
                    'goods_id' => $v['goods_id'],
                    'sku_id' => $v['sku_id'],
                    'goods_name' => $goods_info->goods_name,
                    'discount_mode' => 0, // 0
                    'discount_num' => ($goods_info->goods_price - $v['act_price']),
                    'goods_number' => $goods_info->goods_number

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
        $where[] = ['act_type', 11]; // 11-限时折扣

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
            }
        }

        return [$list, $total];
    }
}