<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCat;
use App\Models\Bonus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\NavQuickService;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\TemplateItem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TemplateItemRepository
{
    use BaseRepository;

    protected $model;

    protected $template;

    protected $article;

    public function __construct()
    {
        $this->model = new TemplateItem();
        $this->template = new TemplateRepository();
        $this->article = new ArticleRepository();
    }

    public function detail($condition)
    {
        $data = TemplateItem::where($condition)->first();
        return $data;
    }

    public function count($condition)
    {
        $data = TemplateItem::where($condition)->count();
        return $data;
    }

//    public function create($data)
//    {
//        $ret = TemplateItem::create($data);
//        return $ret;
//    }

    public function checkIsValid($uid)
    {
        $result = TemplateItem::where(['uid' => $uid])->first(['is_valid']); // 查询当前状态
        return $result['is_valid'];
    }

    public function validTpls($uid)
    {
        $isValid = $this->checkIsValid($uid); // 查询当前状态
        if ($isValid) {
            // 当前是显示状态，则设置为隐藏0
            $ret = TemplateItem::where(['uid' => $uid])->update(['is_valid' => 0]);
        } else {
            // 当前是隐藏状态，则设置为显示1
            $ret = TemplateItem::where(['uid' => $uid])->update(['is_valid' => 1]);
        }

        if ($ret === false) {
            return false;
        }
        return true;
    }

    public function getTemplateItemHtml($uid, $page, $is_design = false)
    {
        $tplItem = $this->detail(['uid' => $uid, 'page' => $page]);

        if ($tplItem->code == 'nav_quick_service') {
            // 快捷服务列表
            $nQSCondition = [
                'where' => [['is_show', 1]],
                'sortname' => 'sort',
                'sortorder' => 'asc'
            ];
            $nQSRep = new NavQuickServiceRepository();
            list($quickService, $total) = $nQSRep->getList($nQSCondition);
            view()->share('quickService', $quickService);
        }

        if ($tplItem->code == 'nav_notice_s1' || $tplItem->code == 'nav_notice_s2') {
            // 公告版式一、公告版式二 获取商城公告文章列表
            $cat_type = 2; // 商城公告
            $navNotice = $this->article->getArticlesByCatType($cat_type, 6);
            view()->share('navNotice', $navNotice);
        }

        $itemData = !empty($tplItem['data']) ? unserialize($tplItem['data']) : [];
        $extInfo = !empty($tplItem['ext_info']) ? unserialize($tplItem['ext_info']) : [];

        // 对数据做处理 最多cat_id 为20
        // 商品 商品名称相关信息
        for ($i = 1; $i <= 20; $i++) {

            // 文章 文章标题相关信息
            if (!empty($itemData['1-' . $i])) {
                foreach ($itemData['1-' . $i] as $k1=>$item) {
                    $articleInfo = Article::where('article_id', $item['article_id'])->first();
                    $articleCatInfo = ArticleCat::where('cat_id', $articleInfo->cat_id)->first();
                    $itemData['1-' . $i][$k1]['title'] = $articleInfo->title;
                    $itemData['1-' . $i][$k1]['article_thumb'] = $articleInfo->article_thumb;
                    $itemData['1-' . $i][$k1]['summary'] = $articleInfo->summary;
                    $itemData['1-' . $i][$k1]['link'] = $articleInfo->link;
                    $itemData['1-' . $i][$k1]['source'] = $articleInfo->source;
                    $itemData['1-' . $i][$k1]['created_at'] = $articleInfo->created_at;
                    $itemData['1-' . $i][$k1]['click_number'] = $articleInfo->click_number;
                    $itemData['1-' . $i][$k1]['cat_id'] = $articleInfo->cat_id;
                    $itemData['1-' . $i][$k1]['cat_name'] = $articleCatInfo->cat_name;
                }
            }

            // 商品 商品名称相关信息
            if (!empty($itemData['2-' . $i])) {
                foreach ($itemData['2-' . $i] as $key => $item) {
                    $goodsInfo = Goods::where('goods_id', $item['goods_id'])->first();
                    // todo 需要优化
                    if (empty($goodsInfo) || (!empty($goodsInfo) && ($goodsInfo->goods_audit != 1) || $goodsInfo->goods_status != 1)) {
                        unset($itemData['2-' . $i][$key]);
                        continue;
                    }

                    $itemData['2-' . $i][$key]['goods_name'] = $goodsInfo->goods_name;
                    $itemData['2-' . $i][$key]['goods_image'] = $goodsInfo->goods_image;
                    $itemData['2-' . $i][$key]['goods_price'] = $goodsInfo->goods_price;
                }
            }

            // 广告模板信息
//            if (!empty($itemData['3-'.$i])) {
//
//            }

            // 品牌 品牌名称相关信息
            if (!empty($itemData['5-' . $i])) {
                foreach ($itemData['5-' . $i] as $k5 => $item) {
                    $brandInfo = Brand::where('brand_id', $item['brand_id'])->first();
					$itemData['5-' . $i][$k5]['brand_name'] = $brandInfo->brand_name;
					$itemData['5-' . $i][$k5]['brand_logo'] = $brandInfo->brand_logo;
                }
            }

            // 商品分类 分类名称
            if (!empty($itemData['6-' . $i])) {
				$catModel = Category::class;
				$link_route = 'pc_goods_list';
				if (in_array($page, ['shop', 'm_shop', 'app_shop'])) {
					$catModel = ShopCategory::class;
					$link_route = 'pc_shop_goods_list';
				}
                foreach ($itemData['6-' . $i] as $k6 => $item) {
                    $itemData['6-' . $i][$k6]['cat_name'] = $catModel::where('cat_id', $item['cat_id'])->value('cat_name');
					$itemData['6-' . $i][$k6]['link'] = route($link_route, ['filter_str'=>$tplItem['shop_id'].'-'.$item['cat_id']]);
                }
            }

            // TODO 营销活动
            if (!empty($itemData['7-' . $i])) {
                foreach ($itemData['7-' . $i] as $k7=>$item) {
                    // todo 查询活动商品信息 等活动做的差不多了再完善此处
                    $act_goods_id = $item['id']; // 活动商品表主键id


                }
            }

            // 导航模板
            if (!empty($itemData['8-' . $i])) {
                foreach ($itemData['8-' . $i] as $k8 => $item) {

                }
            }

            // 店铺 店铺名称相关信息
            if (!empty($itemData['9-' . $i])) {
                foreach ($itemData['9-' . $i] as $k9=>$item) {
                    $shopInfo = Shop::where('shop_id', $item['shop_id'])->first();
                    $itemData['9-' . $i][$k9]['shop_name'] = $shopInfo->shop_name;
                    $itemData['9-' . $i][$k9]['shop_logo'] = get_image_url($shopInfo->shop_logo, 'shop_logo');
                }
            }

            // 红包 红包名称相关信息
            if (!empty($itemData['11-' . $i])) {
                foreach ($itemData['11-' . $i] as $k11=>$item) {
                    $bonusInfo = Bonus::where('bonus_id', $item['bonus_id'])->first();
                    $itemData['11-' . $i][$k11]['bonus_name'] = $bonusInfo->bonus_name;
                    $itemData['11-' . $i][$k11]['bonus_amount'] = $bonusInfo->bonus_amount;
                    $itemData['11-' . $i][$k11]['min_goods_amount'] = $bonusInfo->min_goods_amount;
                    $itemData['11-' . $i][$k11]['start_time'] = format_time(strtotime($bonusInfo->start_time), 'Y-m-d');
                    $itemData['11-' . $i][$k11]['end_time'] = format_time(strtotime($bonusInfo->end_time), 'Y-m-d');
                    $itemData['11-' . $i][$k11]['shop_id'] = $bonusInfo->shop_id;
                }
            }

            // 热区模板
            if (!empty($itemData['14-' . $i])) {
                foreach ($itemData['14-' . $i] as $k14=>$item) {
                    $itemData['14-' . $i][$k14]['hot_space'] = json_decode($item['hot_space'],true);
                }
            }


        }

        $video_list = []; // 微商城、APP店铺首页装修 通用模板-视频模板 调取视频列表

        $templateRep = new TemplateRepository();
        $tplInfo = $templateRep->detail(['code' => $tplItem['code']])->toArray();
        $params = [
            'tpl_name' => $tplInfo['tpl_name'],
            'tpl_type' => design_tpl_type($tplInfo['type']), // 获取模板类型名称 如：广告模板
            'is_valid' => $is_design ? $tplItem['is_valid'] : '',
            'shop_id' => !empty(seller_shop_info()) ? seller_shop_info()->shop_id : '', // 店铺id
            'type' => $tplInfo['selector_type'] ?? 0, // todo 无此字段
            'uid' => $uid,
            'data' => $itemData,
            'ext_info' => $extInfo, // 扩展信息
            'tpl_info' => $tplInfo,
            'is_design' => $is_design, // 是否设计模式
            'video_list' => $video_list,
        ];

        // PC端-pc/手机端-mobile/APP端-app
        if (Str::contains($page, 'm_')) {
            $tpl_client = 'mobile';
        } elseif (Str::contains($page, 'app')) {
//            $tpl_client = 'app';
            $tpl_client = 'mobile';

        } else {
            $tpl_client = 'pc';
        }
        if ($uid == '1586081399NTKXMD') {

//            dd($params);
        }

        // todo 此处必须标识是从backend中读取模板
        $render = view('backend::design.templates.' . $tpl_client . '.' . $tplInfo['type'] . '.' . $tplItem['code'], $params)->render();

        return $render;
    }

    /**
     * 获取某个装修页面Html数据
     *
     * @param $page
     * @param int $shop_id
     * @param int $topic_id
     * @return array
     */
    public function getPageTplHtml($page, $shop_id = 0, $topic_id = 0)
    {
        $cache_id = CACHE_KEY_PAGE_TPL_HTML[0]."_{$page}_{$shop_id}_{$topic_id}";

        // todo 后台装修时 需要更新最新数据
//        if ($html = cache()->get($cache_id)) {
//            return $html;
//        }

        $templateItems = $this->getTplItems($page, $shop_id, $topic_id, false);
        $tplHtml = $navContainerHtml = "";
        foreach ($templateItems as $item) {
            // 判断首页静态页面开启状态
            if (request()->routeIs('pc_home')) {
                // PC端首页
                $webStatic = sysconf('site_web_static');
            } elseif (request()->routeIs('pc_shop_home')) {
                // PC端店铺首页
                $webStatic = shopconf('shop_web_static', false, $shop_id);
            } elseif (request()->routeIs('mobile_home')) {
                // 微信端首页
                $webStatic = sysconf('m_site_web_static');
            } elseif (request()->routeIs('mobile_shop_home')) {
                // 微信端店铺首页
                $webStatic = shopconf('m_shop_web_static', false, $shop_id);
            } else {
                // 默认开启静态页面
                $webStatic = 1;
            }

            if ($webStatic == 1) {
                // 开启-同步请求
                // todo PC首页导航 后期再判断其他端
                $navTpl = $this->template->getTplList(1, 5, 'code');
                if (in_array($item['code'], $navTpl)) {
                    // 如果是导航模板
                    $navContainerHtml .= $item->file;
                } else {
                    $tplHtml .= $item->file;
                }
            } else {
                // 关闭-异步加载模板Html数据 ajax加载
                // todo PC首页导航 后期再判断其他端
                $navTpl = $this->template->getTplList(1, 5, 'code');
                if (in_array($item['code'], $navTpl)) {
                    // 如果是导航模板
//                    $navContainerHtml .= $item->file;
                    $is_last = 0; // 是否是最后一个
                    $navContainerHtml .= "<div class='floor-template floor-loading' tpl_file='/0/goods/goods_floor.tpl' id='" . $item->uid . "' style='height:200px;background-image: url(" . get_image_url(sysconf('default_floor_loading')) . ")' is_last='" . $is_last . "'></div>\n";
                } else {
                    $is_last = 0; // 是否是最后一个
                    $tplHtml .= "<div class='floor-template floor-loading' tpl_file='/0/goods/goods_floor.tpl' id='" . $item->uid . "' style='height:200px;background-image: url(" . get_image_url(sysconf('default_floor_loading')) . ")' is_last='" . $is_last . "'></div>\n";
                }
            }


        }
        $html = [$tplHtml, $navContainerHtml];
        cache()->put($cache_id, $html, CACHE_KEY_PAGE_TPL_HTML[1]);

        return $html;
    }

    /**
     * 获取某个装修页面数据
     *
     * @param $page
     * @param int $shop_id
     * @param int $topic_id
     * @param bool $filter_tpl_file
     * @return mixed
     */
    public function getTplItems($page, $shop_id = 0, $topic_id = 0, $filter_tpl_file = true)
    {

        $cache_id = CACHE_KEY_PAGE_TPL_ITEMS[0]."_{$page}_{$shop_id}_{$topic_id}_".($filter_tpl_file ? 'app':'web');

        // todo 后台装修时 需要更新最新数据
//        if ($templateItems = cache()->get($cache_id)) {
//            return $templateItems;
//        }

        $where[] = ['page', $page];
        $where[] = ['is_valid', 1];
        $where[] = ['shop_id', $shop_id];
        $where[] = ['topic_id', $topic_id];
        $condition = [
            'field' => ['tpl_title', 'code', 'data', 'ext_info', 'uid', 'file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->model->getList($condition);

        // 是否过滤掉模板html file字段
        if ($filter_tpl_file) {
            // APP数据封装
            $appTplItems = [];
            foreach ($templateItems as &$item) {
                $item->data = unserialize($item->data);
                $item->ext_info = unserialize($item->ext_info);

                //
                $appTplItem['temp_name'] = $item->tpl_title;
                $appTplItem['temp_code'] = $item->code;


                // 对数据下标做处理
                $tplData = [];
                if (!empty($item->data)) {
                    foreach ($item->data as $dKey => $datum) {
                        $dKeyArr = explode('-', $dKey); // 将key分隔成数组
                        $dKeyType = $dKeyArr[0]; // 模板类型 如：广告模板
                        $dKeyCategory = $dKeyArr[1]; //

                        switch ($dKeyType) {
                            case 1: // 文章
                                foreach ($datum as $kData) {
                                    $articleInfo = Article::where('article_id', $kData['article_id'])->first();
                                    $articleCatInfo = ArticleCat::where('cat_id', $articleInfo->cat_id)->first();

                                    $tplData['article_' . $dKeyCategory][] = [
                                        'article_id' => $kData['article_id'],
                                        'title' => $articleInfo->title,
                                        'add_time' => $articleInfo->created_at,
                                        'article_thumb' => $articleInfo->article_thumb,
                                        'cat_id' => $articleInfo->cat_id,
                                        'cat_name' => $articleCatInfo->cat_name,
                                        'click_number' => $articleInfo->click_number,
                                        'link' => $articleInfo->link,
                                        'source' => $articleInfo->source,
                                        'summary' => $articleInfo->summary,
                                        'sort' => $kData['sort']
                                    ];
                                }

                                break;

                            case 2: // 商品
                                foreach ($datum as $kData) {
                                    $goodsInfo = Goods::where('goods_id', $kData['goods_id'])->first();
                                    $tplData['goods_'.$dKeyCategory][] = [
                                        'goods_id' => $kData['goods_id'],
                                        'sku_id' => $kData['sku_id'],
                                        'goods_price' => $goodsInfo->goods_price,
                                        'goods_image' => $goodsInfo->goods_image,
                                        'goods_name' => $goodsInfo->goods_name,
                                        'is_best' => $goodsInfo->is_best,
                                        'is_new' => $goodsInfo->is_new,
                                        'is_hot' => $goodsInfo->is_hot,
                                        'goods_price_format' => format_price($goodsInfo->goods_price),
                                        'sort' => $kData['sort'],
                                    ];
                                }

                                break;

                            case 3: // 广告图片
                                foreach ($datum as $kData) {
                                    $kData['full_path'] = get_image_url($kData['path']);
                                    $tplData['pic_'.$dKeyCategory][] = $kData;
                                }
                                break;

                            case 4: // 标题
                                $tplData['title_'.$dKeyCategory] = array_first($datum); // 取第0个下标数据
                                break;

                            case 5: // 品牌 todo 不确定
                                foreach ($datum as $kData) {
                                    $brandInfo = Brand::where('brand_id', $kData['brand_id'])->first();
                                    $tplData['brand_'.$dKeyCategory][] = [
                                        'brand_id' => $kData['brand_id'],
                                        'brand_name' => $brandInfo->brand_name,
                                        'brand_logo' => $brandInfo->brand_logo,
                                        'sort' => $kData['sort']
                                    ];
                                }

                                break;

                            case 6: // 商品分类 todo 不确定
                                foreach ($datum as $kData) {
                                    $tplData['category_'.$dKeyCategory][] = [
                                        'cat_id' => $kData['cat_id'],
                                        'cat_name' => Category::where('cat_id', $kData['cat_id'])->value('cat_name'),
                                        'sort' => $kData['sort']
                                    ];
                                }

                                break;

                            case 7: // 营销活动 todo 不确定

                                break;

                            case 8: // 导航模板
                                $tplData['mnav_'.$dKeyCategory] = $datum;
                                break;

                            case 9: // 店铺 todo 不确定
                                foreach ($datum as $kData) {
                                    $shopInfo = Shop::where('shop_id', $kData['shop_id'])->first();
                                    $tplData['shop_'.$dKeyCategory][] = [
                                        'shop_id' => $kData['shop_id'],
                                        'shop_name' => $shopInfo->shop_name,
                                        'shop_logo' => get_image_url($shopInfo->shop_logo, 'shop_logo'),
                                        'sort' => $kData['sort'],
                                    ];
                                }
                                break;

                            case 11: // 红包
                                foreach ($datum as $kData) {
                                    $bonusInfo = Bonus::where('bonus_id', $kData['bonus_id'])->first();
                                    $tplData['bonus_'.$dKeyCategory][] = [
                                        'bonus_name' => $bonusInfo->bonus_name,
                                        'bonus_amount' => $bonusInfo->bonus_amount,
                                        'min_goods_amount' => $bonusInfo->min_goods_amount,
                                        'start_time ' => format_time(strtotime($bonusInfo->start_time), 'Y-m-d'),
                                        'end_time' => format_time(strtotime($bonusInfo->end_time), 'Y-m-d'),
                                        'shop_id' => $bonusInfo->shop_id,
                                    ];
                                }
                                break;

                            case 14: // 热点模板
                                break;

                            case 99: // 样式选择
                                $tplData['style_'.$dKeyCategory] = $datum;
                                break;

                            default: // 默认返回

                        }
                    }
                }
                $appTplItem['data'] = $tplData;
                $appTplItem['ext_info'] = $item->ext_info;
                $appTplItem['uid'] = $item->uid;

                $appTplItems[] = $appTplItem;
            }

            cache()->put($cache_id, $appTplItems, CACHE_KEY_PAGE_TPL_ITEMS[1]);
            return $appTplItems;
        } else {
            // PC Mobile 数据封装
            foreach ($templateItems as &$item) {
                $item->data = unserialize($item->data);
                $item->ext_info = unserialize($item->ext_info);
                $item = $item->toArray();
            }

            cache()->put($cache_id, $templateItems, CACHE_KEY_PAGE_TPL_ITEMS[1]);

            return $templateItems;

        }
    }


}
