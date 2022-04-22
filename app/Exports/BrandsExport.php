<?php

namespace App\Exports;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BrandsExport implements FromCollection, WithHeadings
{
//    protected $brand;

//    public function __construct(BrandRepository $brandRepository)
//    {
//        $this->brand = $brandRepository;
//    }

    public function collection()
    {

//        dd(Brand::all());
        $brand = new BrandRepository();
        $condition = [
            'limit' => 0,
            'field' => [
                'brand_id','brand_name','brand_letter','brand_logo','promotion_image','brand_desc','is_recommend','brand_sort'
            ]
        ];
        list($brandList,$total) = $brand->getList($condition);
        return $brandList;
    }

    public function headings():array
    {
        return [
            '品牌ID',
            '品牌名称',
            '首字母',
            '品牌Logo',
            '品牌推广图',
            '品牌描述',
            '是否推荐',
            '排序'
        ];
    }
}