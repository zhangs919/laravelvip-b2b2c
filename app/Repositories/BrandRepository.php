<?php

namespace App\Repositories;



use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;

class BrandRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Brand();
    }


    /**
     * 获取品牌列表
     * 以分类分组返回品牌列表
     *
     * @return mixed
     */
    public function getBrandListWithCategory()
    {
        $cat_list = Category::where('is_show', 1)->select(['cat_id','cat_name'])->orderBy('cat_sort', 'asc')->get()->toArray();
        if (!empty($cat_list)) {
            foreach ($cat_list as $key =>$value) {
                $cat_list[$key]['cat_url'] = '/list.html?cat_id='.$value['cat_id'];

                $brand_ids = BrandCategory::where('cat_id', $value['cat_id'])
                    ->select(['brand_id'])->pluck('brand_id')->toArray();
                $brand_list = Brand::where([['is_show',1]])->whereIn('brand_id', $brand_ids)
                    ->select(['brand_id','brand_name','brand_logo','brand_banner','promotion_image','brand_desc','is_recommend'])
                    ->orderBy('brand_sort', 'asc')
                    ->get()->toArray();
                if (!empty($brand_list)) {
                    foreach ($brand_list as &$bv) {
                        $bv['cat_id'] = $value['cat_id'];
                        $bv['cat_name'] = $value['cat_name'];
                        $bv['brand_logo'] = get_image_url($bv['brand_logo']);
                        $bv['brand_banner'] = get_image_url($bv['brand_banner']);
                        $bv['promotion_image'] = get_image_url($bv['promotion_image']);
                        $bv['brand_url'] = '/list.html?cat_id='.$value['cat_id'].'&amp;brand_id='.$bv['brand_id'];
                    }
                    $cat_list[$key]['brand_list'] = $brand_list;
                } else {
                    unset($cat_list[$key]);
                    continue;
                }
            }
        }

        return array_values($cat_list);
    }

    /**
     * 获取推荐品牌列表
     * 以品牌id为下标
     *
     * @param $cat_info
     * @param int $size
     * @return array
     */
    public function getRecommendBrandList($cat_info, $size = 20)
    {
        if (empty($cat_info)) {
            return [];
        }

        $brand_ids = BrandCategory::where('cat_id', $cat_info['cat_id'])
            ->select(['brand_id'])->pluck('brand_id')->toArray();
        $brand_list = Brand::where([['is_show',1]])->whereIn('brand_id', $brand_ids)
            ->select(['brand_id','brand_name','brand_logo','brand_banner','promotion_image','brand_desc','is_recommend'])
            ->orderBy('brand_sort', 'asc')
            ->get()->toArray();

        $banner_list = [];
        if (!empty($brand_list)) {
            foreach ($brand_list as $bv) {
                if ($bv['is_recommend'] == 1) {
                    $bv['cat_id'] = $cat_info['cat_id'];
                    $bv['cat_name'] = $cat_info['cat_name'];
                    $bv['brand_logo'] = get_image_url($bv['brand_logo']);
                    $bv['brand_banner'] = get_image_url($bv['brand_banner']);
                    $bv['promotion_image'] = get_image_url($bv['promotion_image']);
                    $bv['brand_url'] = '/list.html?cat_id='.$cat_info['cat_id'].'&amp;brand_id='.$bv['brand_id'];
                    $banner_list[$bv['brand_id']] = $bv;
                }
            }
        }

        return $banner_list;
    }
}