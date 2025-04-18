<?php

namespace App\Repositories;


use App\Models\Freight;
use App\Models\GoodsActivity;
use App\Services\Enum\ActTypeEnum;

class GoodsActivityRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new GoodsActivity();
    }

    public function getList($condition = [], $column = '')
    {
        //
        $condition['with'] = ['goods'=>function($query) {
            $query->select(['goods_id','sku_open','goods_price','goods_number','goods_name','goods_image','goods_status']);
        }, 'goodsSku' => function($query) {
            $query->select(['goods_id', 'sku_id','goods_price','goods_number','goods_barcode','goods_sn','sku_image','spec_names','checked']);
        }, 'activity' => function($query){
            $query->select(['act_id', 'act_type']);
        }];
        $data = $this->model->getList($condition, $column);

        if (!$data[0]->isEmpty()) {

            foreach ($data[0] as $key=>$value) {
                $goods = $value->goods;
                $goods_sku = $value->goodsSku;
                $value->goods_price = $goods_sku->goods_price;
                $value->goods_number = $goods_sku->goods_number;
                $value->goods_status = $goods->goods_status;
                $value->goods_image = get_image_url($goods->goods_image);
                $value->goods_barcode = $goods_sku->goods_barcode ?? '--';
                $value->goods_sn = $goods_sku->goods_sn ?? '--';
                $value->goods_name = $goods->goods_name;
                $value->sku_image = get_image_url($goods_sku->sku_image);
                $value->spec_names = $goods_sku->spec_names ?? '无';
                $value->sku_enable = $goods_sku->checked;
                $value->shop_tag = '';
                $value->status_format = $value->is_enable ? '有效' : '已取消';

                $this->fetchExtInfo($value);

                unset($value->goods,$value->goodsSku,$value->activity);
            }
        }
        return $data;
    }

    private function fetchExtInfo(&$value)
    {
        switch ($value->activity->act_type) {
            case ActTypeEnum::ACT_TYPE_BARGAIN: // 砍价
                $value->goods_url = route('mobile_show_goods', ['goods_id' => $value->goods_id]).'?show_sku='.$value->sku_id;
                $value->act_stock_editable = "<a class=\"edit-activity-goods\" href=\"javascript:void(0);\" data-id=\"{$value->id}\" data-name=\"act_stock\" data-title=\"活动库存\">{$value->act_stock}</a>";
                $value->buttons = [];
                $value->original_price = $value->ext_info['original_price'];
                $value->freight_id = $value->ext_info['freight_id'];
                $value->self_bargain_ratio = $value->ext_info['self_bargain_ratio'];
                $freight_name = '店铺统一运费';
                if ($value->freight_id > 0) {
                    $freight_name = Freight::where('freight_id', $value->freight_id)->value('title');
                }
                $value->freight_name = $freight_name;
                break;
            case ActTypeEnum::ACT_TYPE_LIMIT_DISCOUNT: // 限时折扣

                $value->discount_mode = $value->ext_info['discount_mode'];
                $value->discount_num = $value->ext_info['discount_num'];
                if ($value->discount_mode == 2) { // 折扣价
                    $discount_mode_format = '折扣价';
                    $act_price_format = "{$value->act_price}<em class=\"m-l-5 act-type seckill\" title=\"{$discount_mode_format}\">{$discount_mode_format}</em>";
                } elseif ($value->discount_mode == 1) { // 减价
                    $discount_mode_format = '减'.$value->discount_num.'元';
                    $act_price_format = "{$value->act_price}<em class=\"m-l-5 act-type group-buy\" title=\"{$discount_mode_format}\">{$discount_mode_format}</em>";
                } else { // 打折
                    $discount_mode_format = $value->discount_num.'折';
                    $act_price_format = "{$value->act_price}<em class=\"m-l-5 act-type\" title=\"{$discount_mode_format}\">{$discount_mode_format}</em>";
                }
                $value->discount_mode_format = $discount_mode_format;
                $value->act_price_format = $act_price_format;

                break;

            default:

                break;
        }

    }

}