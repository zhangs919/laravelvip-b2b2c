<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCat;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\NavQuickService;
use App\Models\Shop;
use App\Models\TemplateItem;
use Illuminate\Support\Facades\DB;

class TemplateItemRepository
{
    use BaseRepository;

    protected $model;

    protected $template;

    public function __construct()
    {
        $this->model = new TemplateItem();
        $this->template = new TemplateRepository();
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
        $result = TemplateItem::where(['uid'=>$uid])->first(['is_valid']); // 查询当前状态
        return $result['is_valid'];
    }

    public function validTpls($uid)
    {
        $isValid = $this->checkIsValid($uid); // 查询当前状态
        if ($isValid) {
            // 当前是显示状态，则设置为隐藏0
            $ret = TemplateItem::where(['uid'=>$uid])->update(['is_valid' => 0]);
        } else {
            // 当前是隐藏状态，则设置为显示1
            $ret = TemplateItem::where(['uid'=>$uid])->update(['is_valid' => 1]);
        }

        if ($ret === false) {
            return false;
        }
        return true;
    }

    public function getTemplateItemHtml($uid, $page, $is_design = false)
    {
        $tplItem = $this->detail(['uid'=>$uid, 'page'=>$page]);

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

        $itemData = !empty($tplItem['data']) ? unserialize($tplItem['data']) : '';
        $extInfo = !empty($tplItem['ext_info']) ? unserialize($tplItem['ext_info']) : '';

        // 对数据做处理 最多cat_id 为20 todo
        // 商品 商品名称相关信息
        for ($i = 1; $i <= 20; $i++) {

            // 文章 文章标题相关信息
            if (!empty($itemData['1-'.$i])) {
                foreach ($itemData['1-'.$i] as &$item) {
                    $articleInfo = Article::where('article_id', $item['article_id'])->first();
                    $articleCatInfo = ArticleCat::where('cat_id', $articleInfo->cat_id)->first();
                    $item['title'] = $articleInfo->title;
                    $item['article_thumb'] = $articleInfo->article_thumb;
                    $item['summary'] = $articleInfo->summary;
                    $item['link'] = $articleInfo->link;
                    $item['source'] = $articleInfo->source;
                    $item['created_at'] = $articleInfo->created_at;
                    $item['click_number'] = $articleInfo->click_number;
                    $item['cat_id'] = $articleInfo->cat_id;
                    $item['cat_name'] = $articleCatInfo->cat_name;
                }
            }

            // 商品 商品名称相关信息
            if (!empty($itemData['2-'.$i])) {
                foreach ($itemData['2-'.$i] as $key=>$item) {
                    $goodsInfo = Goods::where('goods_id', $item['goods_id'])->first();
                    // todo 需要优化
                    if (empty($goodsInfo) || (!empty($goodsInfo) && ($goodsInfo->goods_audit != 1) || $goodsInfo->goods_status !=1)) {
                        unset($itemData['2-'.$i][$key]);
                        continue;
                    }

                    $itemData['2-'.$i][$key]['goods_name'] = $goodsInfo->goods_name;
                    $itemData['2-'.$i][$key]['goods_image'] = $goodsInfo->goods_image;
                    $itemData['2-'.$i][$key]['goods_price'] = $goodsInfo->goods_price;
                }
            }

            // 广告模板信息
//            if (!empty($itemData['3-'.$i])) {
//
//            }

            // 品牌 品牌名称相关信息
            if (!empty($itemData['5-'.$i])) {
                foreach ($itemData['5-'.$i] as &$item) {
                    $brandInfo = Brand::where('brand_id', $item['brand_id'])->first();
                    $item['brand_name'] = $brandInfo->brand_name;
                    $item['brand_logo'] = $brandInfo->brand_logo;
                }
            }

            // 商品分类 分类名称
            if (!empty($itemData['6-'.$i])) {
                foreach ($itemData['6-'.$i] as $k6=>$item) {
                    $itemData['6-'.$i][$k6]['cat_name'] = Category::where('cat_id', $item['cat_id'])->value('cat_name');
                }
            }

            // TODO 营销活动
            if (!empty($itemData['7-'.$i])) {
                foreach ($itemData['7-'.$i] as &$item) {
                    // todo 查询活动商品信息 等活动做的差不多了再完善此处
                    $act_goods_id = $item['id']; // 活动商品表主键id


                }
            }

            // 店铺 店铺名称相关信息 todo
            if (!empty($itemData['9-'.$i])) {
                foreach ($itemData['9-'.$i] as &$item) {
                    $shopInfo = Shop::where('shop_id', $item['shop_id'])->first();
                    $item['shop_name'] = $shopInfo->shop_name;
                    $item['shop_logo'] = get_image_url($shopInfo->shop_logo, 'shop_logo');
                }
            }



        }


        $templateRep = new TemplateRepository();
        $tplInfo = $templateRep->detail(['code'=>$tplItem['code']]);
        $params = [
            'tpl_name' => $tplInfo['tpl_name'],
            'tpl_type' => design_tpl_type($tplInfo['type']), // 获取模板类型名称 如：广告模板
            'is_valid' => $tplItem['is_valid'],
            'shop_id' => !empty(seller_shop_info()) ? seller_shop_info()->shop_id : '', // 店铺id
            'type' => $tplInfo['selector_type'],
            'uid' => $uid,
            'data' => $itemData,
            'ext_info' => $extInfo, // 扩展信息
            'tpl_info' => $tplInfo,
            'is_design' => $is_design // 是否设计模式
        ];

        // PC端-pc/手机端-mobile/APP端-app
        if (str_contains($page, 'm_')) {
            $tpl_client = 'mobile';
        } elseif ($page == 'app') {
//            $tpl_client = 'app';
            $tpl_client = 'mobile';

        } else {
            $tpl_client = 'pc';
        }
//        if ($uid == '1529151022ZBAENC') {
//
//            dd($params);
//        }

        // todo 此处必须标识是从backend中读取模板
        $render = view('backend::design.templates.'.$tpl_client.'.'.$tplInfo['type'].'.'.$tplItem['code'], $params)->render();

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
        $templateItems = $this->getTplItems($page, $shop_id, $topic_id, false);
        $tplHtml = $navContainerHtml = "";
        foreach ($templateItems as $item)
        {
            // todo PC首页导航 后期再判断其他端
            $navTpl = $this->template->getTplList(1, 5, 'code');
            if (in_array($item['code'], $navTpl)) {
                // 如果是导航模板
                $navContainerHtml .= $item->file;
            }else {
                $tplHtml .= $item->file;
            }
        }

        return [$tplHtml, $navContainerHtml];
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
        $where[] = ['page', $page];
        $where[] = ['is_valid', 1];
        $where[] = ['shop_id', $shop_id];
        $where[] = ['topic_id', $topic_id];
        $condition = [
            'field' => ['tpl_title','code','data','ext_info','uid','file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->model->getList($condition);

        foreach ($templateItems as &$item)
        {
            $item->data = unserialize($item->data);
            $item->ext_info = unserialize($item->ext_info);

            if ($filter_tpl_file) {// 是否过滤掉模板html file字段
                unset($item->file);
            }
            $item = $item->toArray();
        }

        return $templateItems;
    }


}