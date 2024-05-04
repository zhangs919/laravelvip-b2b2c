<?php

namespace App\Models;


class GoodsUnit extends BaseModel
{
    protected $table = 'goods_unit';

    protected $fillable = [
        'shop_id','unit_name'
    ];

    protected $primaryKey = 'unit_id';

    /**
     * 转换商品单位
     *
     * @desc 主要是商品采集用到
     * @param $unit_name
     * @return mixed
     */
    public static function transformUnit($unit_name)
    {
        $res = GoodsUnit::where('unit_name', $unit_name)->first();
        if (empty($res)) {
            $res = GoodsUnit::create([
                'unit_name' => $unit_name
            ]);
        }
        return $res->unit_id;
    }
}
