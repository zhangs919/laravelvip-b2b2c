<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-10-23
// | Description: 易联云打印机
// +----------------------------------------------------------------------

namespace App\Repositories;



use App\Models\Article;
use App\Models\Brand;
use App\Models\Goods;
use App\Models\Shop;
use App\Models\Topic;

class LinkTypeRepository
{
    use BaseRepository;

//    protected $model;

    protected $category; // 商品分类

    protected $articleCat; // 文章分类

    public function __construct()
    {
        $this->category = new CategoryRepository();
        $this->articleCat = new ArticleCatRepository();
    }

    public function getLinkTypeData($nav_type = 0, $shop_id = 0)
    {
        $link_data = [];
        switch ($nav_type)
        {
            case 0: // 自定义链接
                break;
            case 1: // 常用链接
                $link_data = $this->link_type1_data();
                break;
            case 2: // 选择商品
                $link_data = $this->link_type2_data();
                break;
            case 3: // 店铺主页
                $link_data = $this->link_type3_data();
                break;
            case 4: // 文章详情
                $link_data = $this->link_type4_data();
                break;
            case 5: // 分类商品
                $link_data = $this->link_type5_data();
                break;
            case 6: // 团购活动
                $link_data = $this->link_type6_data();
                break;
            case 7: // 品牌专题
                $link_data = $this->link_type7_data();
                break;
            case 8: // 文章分类
                $link_data = $this->link_type8_data();
                break;
            case 9: // 专题活动
                $link_data = $this->link_type9_data($shop_id);
                break;

            default:


        }

        return $link_data;
    }

    /**
     * 常用链接数据
     * @return array
     */
    private function link_type1_data()
    {
        $data = [
            ['link' => '/', 'title' => '商城首页'],
            ['link' => '/user.html', 'title' => '用户中心'],
            ['link' => '/category.html', 'title' => '分类列表'],
            ['link' => '/shop/class.html', 'title' => '店铺分类列表'],
            ['link' => '/shop/apply.html', 'title' => '商家入驻'],
            ['link' => '/integralmall.html', 'title' => '积分商城'],
            ['link' => '/activity/group-buy.html', 'title' => '团购首页'],
            ['link' => '/groupon.html', 'title' => '拼团活动'],
            ['link' => '/bargain.html', 'title' => '砍价活动'],
            ['link' => '/purchase.html', 'title' => '限购活动'],
            ['link' => '/bill.html', 'title' => '购物清单'],
            ['link' => '/freebuy.html', 'title' => '自由购'],
            ['link' => '/shop/street/index.html', 'title' => '店铺街'],
            ['link' => '/cart.html', 'title' => '购物车'],
            ['link' => '/user/order/list.html', 'title' => '订单列表'],
            ['link' => '/user/scan-code/index.html', 'title' => '电子会员卡'],
            ['link' => '/user/collect/goods.html', 'title' => '我的关注'],
            ['link' => '/user/capital-account.html', 'title' => '我的资金'],
            ['link' => '/news.html', 'title' => '资讯频道'],
            ['link' => '/help/user.html', 'title' => '帮助中心'],
            ['link' => '/help/shop.html', 'title' => '商家指南'],
            ['link' => '/help/article.html', 'title' => '普通文章'],
        ];

        return $data;
    }

    /**
     * 商品数据
     * @return array
     */
    public function link_type2_data()
    {
        $link = request()->get('link', '');
        $goods_id = str_replace(['/goods/','.html'], ['',''], $link);
        $goods_name = Goods::where('goods_id',$goods_id)->value('goods_name');
        return [
            'goods_id' => $goods_id,
            'link' => $link,
            'title' => $goods_name
        ];
    }

    /**
     * 店铺主页数据
     * @return array
     */
    private function link_type3_data()
    {
        $data = [];
        $shop_list = Shop::select(['shop_id', 'shop_name'])->where('shop_status', 1)->orderBy('shop_sort', 'asc')->get();
        if (!$shop_list->isEmpty()) {
            foreach ($shop_list as $v) {
                $data[] = [
                    'link' => route('pc_shop_home', ['shop_id' => $v->shop_id], false),
                    'title' => $v->shop_name
                ];
            }
        }
        return $data;
    }

    /**
     * 文章详情
     * @return array
     */
    private function link_type4_data()
    {
        $data = [];
        $article_list = Article::select(['article_id', 'title'])->where('status', 1)->orderBy('sort', 'asc')->get();
        if (!$article_list->isEmpty()) {
            foreach ($article_list as $v) {
                $data[] = [
                    'link' => route('pc_show_article', ['article_id' => $v->article_id], false),
                    'title' => $v->title
                ];
            }
        }
        return $data;
    }

    /**
     * 分类商品
     * @return array
     */
    private function link_type5_data()
    {
        $data = [];
        $where[] = ['is_show', 1];
        $field = ['cat_id', 'parent_id', 'cat_name','cat_image', 'link_type', 'cat_link'];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
            'field' => $field
        ];
        list($cat_list, $total) = $this->category->getList($condition, '', false, true);
        if (!empty($cat_list)) {
            foreach ($cat_list as $v) {
                $data[] = [
                    'link' => route('pc_goods_list', ['filter_str' => $v['cat_id']], false),
                    'title' => $v['level_show'].$v['cat_name']
                ];
            }
        }
        return $data;
    }

    /**
     * 团购活动 todo
     * @return array
     */
    private function link_type6_data()
    {
        $data = [
            ['link' => '/group-buy-list-1.html', 'title' => '新鲜果蔬，烟台大樱桃'],
            ['link' => '/group-buy-list-2.html', 'title' => '一骑红尘妃子笑'],
        ];
        return $data;
    }

    /**
     * 品牌专题
     * @return array
     */
    private function link_type7_data()
    {
        $data = [];
        $brand_list = Brand::select(['brand_id', 'brand_name'])->where('is_show', 1)->orderBy('brand_sort', 'asc')->get();
        if (!$brand_list->isEmpty()) {
            foreach ($brand_list as $v) {
                $data[] = [
                    'link' => route('pc_goods_list', ['filter_str' => '0-0-0-0-0-0-0-0-0-0-0-'.$v->brand_id], false),
                    'title' => $v->brand_name
                ];
            }
        }
        return $data;
    }

    /**
     * 文章分类
     * @return array
     */
    private function link_type8_data()
    {
        $data = [];
        $condition = [
            'where' => [
                ['is_show', 1],
            ],
            'limit' => 0,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($cat_list, $total) = $this->articleCat->getList($condition, '', false, true);
        if (!empty($cat_list)) {
            foreach ($cat_list as $v) {
                $data[] = [
                    'link' => route('pc_news_list', ['cat_id' => $v['cat_id']], false),
                    'title' => $v['level_show'].$v['cat_name']
                ];
            }
        }
        return $data;
    }

    /**
     * 专题活动
     * @param int $shop_id 店铺id
     * @return array
     */
    private function link_type9_data($shop_id = 0)
    {
        $data = [];

        $where[] = ['is_delete', 0];
        if ($shop_id > 0) {
            // 查询店铺下的专题列表
            $where[] = ['shop_id', $shop_id];
        }
        $topic_list = Topic::select(['topic_id', 'topic_name'])->where($where)->orderBy('topic_id', 'desc')->get();
        if (!empty($topic_list)) {
            foreach ($topic_list as $v) {
                $data[] = [
                    'link' => route('pc_show_topic', ['topic_id' => $v->topic_id], false),
                    'title' => $v->topic_name
                ];
            }
        }
        return $data;
    }

}
