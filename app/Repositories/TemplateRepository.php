<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Support\Facades\Cache;


class TemplateRepository extends Template
{

    protected $navigation; // 商城导航
    protected $shopNavigation; // 店铺导航
    protected $navCategory;
    protected $navWords;
    protected $navAd;
    protected $navBrand;
    protected $navBanner;

    public function __construct()
    {
        parent::__construct();

        $this->navigation = new NavigationRepository();
        $this->shopNavigation = new ShopNavigationRepository();
        $this->navCategory = new NavCategoryRepository();
        $this->navWords = new NavWordsRepository();
        $this->navAd = new NavAdRepository();
        $this->navBrand = new NavBrandRepository();
        $this->navBanner = new NavBannerRepository();
    }

    public function detail($condition)
    {
        $data = Template::where($condition)->first();
        return $data;
    }

    public function getTplList($tpl_client = 1, $tpl_type = '', $column = '')
    {
        $where[] = ['tpl_client', $tpl_client];
        if (!empty($tpl_type)) {
            $where[] = ['type', $tpl_type];
        }
        $tplList = Template::select('code')->where($where)->get();
        if ($column != '') {
            $data = [];
            foreach ($tplList as $item) {
                $data[] = $item->code;
            }
            return $data;
        }
        return $tplList;
    }

    /**
     * 获取首页装修或前端导航数据
     *
     * @param string $nav_page
     * @param int $limit
     * @param int $nav_position 显示位置 默认2 1头部 2中间 3底部
     * @return mixed
     */
    public function getNavigationData($nav_page = 'site', $limit = 13, $nav_position = 2)
    {
        // 获取商城导航
        $cache_id = CACHE_KEY_NAVIGATION[0].'_'.$nav_page.'_'.$nav_position; // 缓存id
        if ($navigation = cache()->get($cache_id)) {
            return $navigation;
        }
        $navigationCondition = [
            'where' => [
                ['nav_page', $nav_page],
                ['nav_position', $nav_position], // 获取中间位置的商城导航
                ['is_show', 1]
            ],
            'limit' => $limit, // 只取$limit个
            'sortname' => 'nav_sort',
            'sortorder' => 'asc'
        ];
        list($navigation, $total) = $this->navigation->getList($navigationCondition);
        $navigation = $navigation->toArray();
        cache()->put($cache_id, $navigation, CACHE_KEY_NAVIGATION[1]);

        return $navigation;
    }

    /**
     * 获取首页装修或前端分类导航相关数据
     *
     * @param string $nav_page
     * @param int $limit
     * @return mixed
     */
    public function getNavCategoryData($nav_page = 'site', $limit = 13)
    {
        $cache_id = CACHE_KEY_NAV_CATEGORY[0].'_'.$nav_page;
        if ($nav_category = cache()->get($cache_id)) {
            return $nav_category;
        }

        // 分类导航
        $navCategoryCondition = [
            'where' => [
                ['nav_page', $nav_page],
                ['is_show', 1]
            ],
            'limit' => $limit, // 只取$limit个
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($nav_category, $total) = $this->navCategory->getList($navCategoryCondition);


//        $relateCatIds = [];
//        $relateCatLeft = [];
//        $relateCatRight = [];
        $relateRightCatIds = [];
        foreach ($nav_category as $item) {
            $relateCatIds = [];

            $item->nav_json = json_decode($item->nav_json);

            // 关联分类

            if (!empty($item->nav_json)) {
                foreach ($item->nav_json as $relate_category) {
                    // 分类导航类型 0自定义链接 1关联分类 2搜索推荐词
                    if ($relate_category->type == 1) {
                        // 关联分类类型
                        $relateCatIds[] = $relate_category->link;
                    }
                }
            }
            $relateCatLeft = Category::where('is_show', 1)->whereIn('parent_id', $relateCatIds)->select(['cat_id','cat_name'])->limit(2)->get();
            $item->nav_relate_cat_left = $relateCatLeft;

            // 分类推荐词
            $navWordsCondition = [
                'where' => [
                    ['category_id', $item->id],
                    ['is_show', 1]
                ],
                'limit' => 5, // 建议取5个
                'sortname' => 'words_sort',
                'sortorder' => 'asc'
            ];
            list($nav_words, $total) = $this->navWords->getList($navWordsCondition);
            $item->nav_words = $nav_words;

            // 分类推荐品牌
            $navBrandCondition = [
                'where' => [
                    ['category_id', $item->id],
                    ['is_show', 1]
                ],
                'limit' => 6, // 建议取6个
                'sortname' => 'brand_sort',
                'sortorder' => 'asc'
            ];
            list($nav_brand, $total) = $this->navBrand->getList($navBrandCondition);

            if (count($nav_brand) > 0) {
                foreach ($nav_brand as $nb) {
                    $nb->brand_name = $nb->brand->brand_name;
                    $nb->brand_logo = $nb->brand->brand_logo ? get_image_url($nb->brand->brand_logo) : get_image_url();
                }
            }

            $item->nav_brand = $nav_brand;

            // 分类推荐广告
            $navAdCondition = [
                'where' => [
                    ['category_id', $item->id],
                    ['is_show', 1]
                ],
                'limit' => 1, // 建议取1个
                'sortname' => 'ad_sort',
                'sortorder' => 'asc'
            ];
            list($nav_ad, $total) = $this->navAd->getList($navAdCondition);
            foreach ($nav_ad as &$nad) {
                $nad->ad_image = get_image_url($nad->ad_image);
            }
            $item->nav_ad = $nav_ad;

//            $relateRightCatIds[] = $relateCatIds;
//            $relateRightCatIds = array_collapse($relateCatIds);
            $relateCatRight = Category::where('is_show', 1)->whereIn('parent_id', $relateCatIds)->select(['cat_id','cat_name'])->limit(12)->get();
//            if (!empty($relateCatRight)) {
//                foreach ($relateCatRight as $v) {
//                    $child = Category::where('is_show', 1)->where('parent_id', $v->cat_id)->select(['cat_id','cat_name'])->limit(24)->get();
//                    $v->child = $child;
//                }
//            }
            $item->nav_relate_cat_right = $relateCatRight;
        }

        cache()->put($cache_id, $nav_category, CACHE_KEY_NAV_CATEGORY[1]);

        return $nav_category;
    }

    public function getNavBannerData($nav_page = 'site', $limit = 5)
    {
        $navBannerCondition = [
            'where' => [
                ['nav_page', $nav_page],
                ['is_show', 1]
            ],
            'limit' => $limit, // 只取$limit个
            'sortname' => 'banner_sort',
            'sortorder' => 'asc'
        ];
        list($nav_banner, $total) = $this->navBanner->getList($navBannerCondition);

        return $nav_banner;
    }

    /**
     * 获取店铺首页装修或前端导航数据
     *
     * @param int $shop_id 店铺id
     * @param int $limit 数据数量
     * @return mixed
     */
    public function getShopNavigationData($shop_id, $limit = 13)
    {
        // 获取商城导航
        $navigationCondition = [
            'where' => [
                ['shop_id', $shop_id],
                ['is_show', 1]
            ],
            'limit' => $limit, // 只取$limit个
            'sortname' => 'nav_sort',
            'sortorder' => 'asc'
        ];
        list($navigation, $total) = $this->shopNavigation->getList($navigationCondition);

        return $navigation;
    }
}