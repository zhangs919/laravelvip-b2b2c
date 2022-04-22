<?php

namespace App\Repositories;


/**
 * 购买下单逻辑辅助类
 *
 * Class Buy1Repository
 * @package App\Repositories
 */
class Buy1Repository
{
    use BaseRepository;


    /**
     * 商品金额计算（分别对每个商品/优惠套装小计、每个店铺小计）
     *
     * @param array $shop_cart_list 以店铺ID分组的购物车商品信息
     * @return array
     */
    public function calcCartList($shop_cart_list)
    {
        if (empty($shop_cart_list) || !is_array($shop_cart_list)) return [$shop_cart_list, [], 0];

        // 存放每个店铺的商品总金额
        $shop_goods_total = [];
        // 存放本次下单所有店铺商品总金额
        $order_goods_total = 0;

        foreach ($shop_cart_list as $shop_id => $shop_cart) {
            $tmp_amount = 0;
            foreach ($shop_cart as $key=>$cart_info) {
                $shop_cart[$key]['goods_total'] = format_price($cart_info['goods_price'] * $cart_info['number']);
                $tmp_amount += $shop_cart[$key]['goods_total'];
            }
            $shop_cart_list[$shop_id] = $shop_cart;
            $shop_goods_total[$shop_id] = format_price($tmp_amount);
        }

        return [$shop_cart_list, $shop_goods_total];
    }

    /**
     * 取得店铺级优惠 - 根据商品金额返回每个店铺当前妇科的一条活动规则，如果有赠品，则自动追加到购买列表，价格为0
     *
     * @param array $shop_goods_total 店铺商品总金额
     * @param array $shop_activity 店铺优惠活动内容
     * @param string $activity_type 活动类
     * @return mixed
     */
    public function reCalcGoodsTotal($shop_goods_total, $shop_activity, $activity_type)
    {
        $deny = empty($shop_goods_total) || !is_array($shop_goods_total) || empty($shop_activity) || !is_array($shop_activity);
        if ($deny) return $shop_goods_total;
        switch ($activity_type) {
            case 'fullcut':
                // todo

                break;

            case 'freight':
                // todo

                break;

            default:

                break;
        }

        return $shop_goods_total;
    }

    /**
     * 计算每个店铺(所有店铺级优惠活动)总共优惠多少金额,商品金额+运费-最终结算金额=优惠了多少
     *
     * @param array $shop_goods_total 最初店铺商品总金额
     * @param array $shop_freight_total 各店铺运费
     * @param array $shop_final_order_total 去除各种店铺级促销后，最终店铺商品总金额(不含运费)
     * @return array
     */
    public function getShopPromotionTotal($shop_goods_total, $shop_freight_total, $shop_final_order_total)
    {
        if (!is_array($shop_goods_total) || !is_array($shop_freight_total) || !is_array($shop_final_order_total)) return [];
        $shop_promotion_total = [];
        foreach ($shop_goods_total as $shop_id=>$goods_total) {
            $shop_promotion_total[$shop_id] = $goods_total + $shop_freight_total[$shop_id] - $shop_final_order_total[$shop_id];
        }
        return $shop_promotion_total;
    }

    /**
     * 将店铺红包减去运费的余额追加到店铺总优惠里
     *
     * @param $shop_promotion_total
     * @param $shop_freight_total
     * @param $shop_bonus_total
     * @return mixed
     */
    public function reCalcShopPromotionTotal($shop_promotion_total, $shop_freight_total, $shop_bonus_total)
    {
        if (!is_array($shop_bonus_total) || empty($shop_bonus_total)) return $shop_promotion_total;
        foreach ($shop_bonus_total as $shop_id=>$bonus_total) {
            $promotion_total = $bonus_total - $shop_freight_total[$shop_id];
            if ($promotion_total > 0) {
                $shop_promotion_total[$shop_id] += $promotion_total;
            }
        }
        return $shop_promotion_total;
    }

    /**
     * 取得每种商品的购买数量
     *
     * @param array $shop_cart_list 购买列表
     * @return array 商品ID=>购买数量
     */
    public function getEachGoodsBuyQuantity($shop_cart_list)
    {
        if (empty($shop_cart_list) || !is_array($shop_cart_list)) return [];
        $goods_buy_quantity = [];
        foreach ($shop_cart_list as $shop_cart) {
            foreach ($shop_cart as $cart_info) {
                // todo 判断是否是组合购买
                $is_goods_mix = false; // 根据活动类型获取
                if (!$is_goods_mix) {
                    // 正常商品
                    @$goods_buy_quantity[$cart_info['goods_id']] += $cart_info['number'];
                } else {
                    // 组合套餐

                }
            }
        }

        return $goods_buy_quantity;
    }
}