<?php

namespace App\Repositories;


use App\Models\AttrValue;
use App\Models\Goods;
use App\Models\GoodsImage;
use App\Models\GoodsSku;
use App\Models\GoodsSpec;
use App\Models\GoodsUnit;
use App\Services\Enum\ActTypeEnum;

class GoodsSkuRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new GoodsSku();
    }

    /**
     * 根据商品id获取sku列表 以字段key为下标返回结果
     * 适用于商家中心
     *
     * @param $goods_id
     * @return mixed
     */
    public function getSellerSkuList($goods_id)
    {
        $where[] = ['goods_id',$goods_id];
        $condition = [
            'where' => $where,
            'limit'=>0,
        ];
        $resData = [];
        list($data, $total) = $this->getList($condition);
        if (!empty($data)) {
            foreach ($data as $k=>$v) {

                $item = [
                    'checked' => $v->checked == 1 ? 'true' : 'false',
                    'goods_barcode' => $v->goods_barcode,
                    'goods_number' => $v->goods_number,
                    'goods_price' => $v->goods_price,
                    'goods_sn' => $v->goods_sn,
                    'market_price' => $v->market_price,
                    'mobile_price' => $v->mobile_price,
                    'warn_number' => $v->warn_number,
                    'goods_stockcode' => $v->goods_stockcode,
                    'goods_weight' => $v->goods_weight,
                    'goods_volume' => $v->goods_volume,
                ];

                if (!empty($v->spec_ids)) {
                    // 有规格

                    $spec_ids = explode('|', $v->spec_ids); // 商品规格表主键id 12|21
                    $atrr_vids = [];
                    foreach ($spec_ids as $sid) {
                        $atrr_vids[] = GoodsSpec::where('spec_id', $sid)->value('attr_vid');
                    }
                    $atrr_vids = implode('|', $atrr_vids);
                    $resData[$atrr_vids] = $item;
                } else {
                    // 无规格
                    $resData[""] = $item;
                }
            }
        }
        return $resData;
    }

    public function getCartGoodsSkuInfo($skuId)
    {

        $info = $this->getById($skuId,['sku_id','goods_id','spec_ids','spec_names','goods_price',
            'cost_price','sku_image','goods_number']);
        if (empty($info)) {
            return null;
        }
        // 默认sku
        $spec_ids = !empty($info->spec_ids) ? explode('|', $info->spec_ids) : null;

        $where[] = ['goods_id', $info->goods_id];
        if (!empty($spec_ids)) {
            $where[] = ['spec_id', $info->spec_ids];
        } else {
            $where[] = ['spec_id', 0];
        }
        $goods_images = GoodsImage::where($where)->orderBy('is_default', 'desc')->orderBy('sort', 'asc')->get();

        // 商品图片相册
        $goods_images = array_column($goods_images->toArray(), 'path');
        $sku_image = current($goods_images);

        $info = $info->toArray();
        $info['spec_ids'] = !empty($info['spec_ids']) ? explode('|', $info['spec_ids']) : [];
        $info['cart_step'] = 1;
        $info['sku_image'] = get_image_url($sku_image);
        $info['sku_image_thumb'] = $info['sku_image']."?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220";
        $info['original_price'] = 0.00;

        return $info;
    }

    /**
     * 商品详情 获取商品SKU信息
     *
     * @param $skuId
     * @param $goods_info
     * @param $shop_info
     * @return array|null
     */
    public function getGoodsSkuInfo($skuId, $goods_info, $shop_info, $user_id = 0)
    {
        if (empty($skuId)) {
            return [];
        }
        $info = $this->getById($skuId);

        // 默认sku
//        $spec_ids = !empty($info->spec_ids) ? explode('|', $info->spec_ids) : null;

//        $where[] = ['goods_id', $goods_info->goods_id];
//        if (!empty($spec_ids)) {
//            $where[] = ['spec_id', $info->spec_ids];
//        } else {
//            $where[] = ['spec_id', 0];
//        }
//        $goods_images = GoodsImage::where($where)->orderBy('is_default', 'desc')->orderBy('sort', 'asc')->get();

        // 商品图片相册
        $sku_images = [];
        $goods_images = [];
        foreach ($info->sku_images as $image) {
            $sku_images[] = [
                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_80,w_80',
                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
                get_image_url($image)
            ];
            $goods_images[] = get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450';
        }
//        $goods_images = array_column($goods_images->toArray(), 'path');
//        $goods_images_list = [];
//        foreach ($goods_images as $image) {
//            $goods_images_list[] = [
//                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_80,w_80',
//                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
//                get_image_url($image)
//            ];
//        }
//        $sku_image = current($goods_images);
//        $sku_images = $goods_images_list;

        $spec_attr_value = '';
//        $sku_name = $goods_info->goods_name; // 商品SKU名称
        if (!empty($info->spec_vids)) {
            $spec_vids = explode('|', $info->spec_vids);
            $spec_attr_value = AttrValue::whereIn('attr_vid', $spec_vids)->pluck('attr_vname')->toArray();
            $spec_attr_value = implode(' ', $spec_attr_value);
//            $sku_name = $sku_name.' '.$spec_attr_value;
        }

        $activity = (new ActivityRepository())->getActivityInfo($goods_info->goods_id, $skuId, $goods_info->act_id, $user_id);
//        dd($activity);
        $goods_price = !empty($activity) ? $activity['act_price'] : $info->goods_price;
        $original_price = !empty($activity) ? $activity['goods_price'] : $info->goods_price;
        $sku_number = !empty($activity) ? $activity['act_stock'] : $info->goods_number;

        $sku = [
            'sku_id' => $info->sku_id,
            'goods_id' => $info->goods_id,
            'sku_name' => $info->sku_name,
            'sku_image' => $info->sku_image,
            'goods_price' => $goods_price,
            'original_price' => $original_price,
            'market_price' => $info->market_price,
            'goods_number' => $sku_number,
            'original_number' => !empty($activity) ? $activity['goods_number'] : $info->goods_number,
            'spec_ids' => !empty($info->spec_ids) ? explode('|', $info->spec_ids) : null,
            'is_enable' => $info->checked,
            'cart_step' => 1,
            'goods_image' => $goods_info->goods_image,
            'goods_images' => $goods_images,
            'shop_id' => $goods_info->shop_id,
            'goods_status' => $goods_info->goods_status,
            'goods_audit' => $goods_info->goods_audit,
            'act_id' => $goods_info->act_id,
            'order_act_id' => $goods_info->order_act_id,
            'goods_moq' => $goods_info->goods_moq,
            'user_discount' => $goods_info->user_discount,
            'freight_id' => $goods_info->freight_id,
            'unit_name' => GoodsUnit::where('unit_id',$goods_info->unit_id)->value('unit_name'),
            'is_supply' => $shop_info['is_supply'],
            'show_price' => $shop_info['show_price'],
            'show_content' => $shop_info['show_content'],
            'button_content' => $shop_info['button_content'],
            'button_url' => $shop_info['button_url'],
            'start_price' => $shop_info['start_price'],
            'sales_model' => $goods_info->sales_model,
            'goods_mix' => null, // todo
            'market_price_format' => '￥'.$goods_info->market_price,
            'sku_images' => $sku_images,
            'spec_attr_value' => $spec_attr_value,
            'gift_list' => null, // todo
            'act_type' => $activity['act_type'] ?? '',
            'purchase_num' => 0, // todo
            'activity' => $activity,
            'order_activity' => null, // todo
            'prices' => [
                'is_original_price' => !empty($activity) ? 0 : 1,
                'price_type' => !empty($activity) ? 'activity_price' : 'original_price',
                'original_price' => $original_price,
                'original_price_format' => '￥'.$original_price,
                'activity_price' => !empty($activity) ? $activity['act_price'] : 0,
                'member_price' => 0,
                'member_price_type' => '',
                'goods_price' => $goods_price,
                'activity_enable' => !empty($activity) ? 1 : 0,
            ],
            'original_price_format' => "￥".$original_price,
            'goods_price_format' => '￥'.$goods_price,
            'price_show' => [
                'code' => 1 // todo
            ],
            'buy_enable' => [
                'code' => 1 // todo
            ]
        ];
        if (!empty($activity) && $activity['act_type'] == ActTypeEnum::ACT_TYPE_BARGAIN) {
            // 砍价活动商品
            $sk['floor_price_init'] = true;
            $sk['floor_price_label'] = '原价';
            $sk['floor_price'] = $activity['act_price'];
            $sk['floor_price_format'] = "￥".$activity['act_price'];
        }

        return $sku;
    }

}
