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
// | Date:2018-11-02
// | Description: 云采集
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Jobs\GoodsCollectImage;
use App\Jobs\GoodsCollectImages;
use App\Jobs\GoodsCollectVideo;
use App\Jobs\LibGoodsCollectImage;
use App\Jobs\LibGoodsCollectImages;
use App\Jobs\LibGoodsCollectVideo;
use App\Models\Attribute;
use App\Models\AttrValue;
use App\Models\Goods;
use App\Models\GoodsSku;
use App\Models\GoodsUnit;
use App\Models\LibGoods;
use App\Models\LibGoodsSku;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use QL\QueryList;

class YunCollectRepository
{
    use BaseRepository;


    const OSS_URL = 'https://xxx.oss-cn-beijing.aliyuncs.com/images'; // 采集图片oss地址
    const DOMAIN = 'https://m.xxx.cn'; // 采集域名
    const COLLECT_DIR = 'backend/collect'; // 存储文件夹

//    protected $model;

    protected $libGoods;
    protected $goods;

    protected $tools;

    const COLLECT_PLATFORM = 3;

    const COLLECT_PLATFORMS = [
        1 => '京东',
        2 => '淘宝',
        3 => '说茶网',
    ];

    public function __construct(
        LibGoodsRepository $libGoods
        , GoodsRepository $goods
        , ToolsRepository $tools
    )
    {
//        $this->model = new Collect();

        $this->libGoods = $libGoods;
        $this->goods = $goods;
        $this->tools = $tools;
    }


    /**
     * 采集商品临时数据
     *
     * @param $post
     * @return bool
     */
    public function doCollect($post)
    {
        // 校验采集链接中的商品是否有效
        $url_invalid = false;
        if ($url_invalid) {
            return false;
        }

        // 校验成功

        // 根据商品链接采集商品数据
        $goods_ids = $post['goods_ids'];
        $goods_ids = explode("\r\n", $goods_ids);
        $wait_collect_goods = [];
        foreach ($goods_ids as $item) {
//            $rules = [
//                'goods_name' => ['.tb-detail-hd > h1', 'text'],
//                'goods_price' => ['tm-fcs-panel', 'html'],
//                'tm_count' => ['.tm-count', 'text'],
//                'images' =>['img', 'src'],
//                'reg' => ['TShop.Setup', 'text']
//            ];
            $rules = [
                'goods_name' => ['.tb-main-title', 'text'],
                'goods_price' => ['.tb-rmb-num', 'text'],
                'tm_count' => ['.J_ReviewsCount', 'text'], // https://rate.taobao.com/detailCount.do?_ksTS=1570979207172_130&callback=jsonp131&itemId=558366604871
                'images' => ['#J_ImgBooth', 'src'],
                'attr_list' => ['.attributes-list', 'text']
            ];
            $data = QueryList::get($item)
                ->encoding('utf-8', 'gbk')
                ->rules($rules)->range('')->queryData();

            $attr_list = !empty($data[0]['attr_list']) ? array_values(array_filter(explode("\n", str_replace(["&nbsp;", " "], "", $data[0]['attr_list'])))) : null;

            if (!empty($attr_list)) {
                foreach ($attr_list as &$v) {
                    $v = explode(":", str_replace(["&nbsp;"], "", $v));
                }
            }

            $pa = get_query($item);
            $third_goods_id = $pa['id'];
            $wait_collect_goods[] = [
                'third_goods_id' => $third_goods_id,
                'url' => $item,
                'goods_name' => $data[0]['goods_name'],
                'goods_price' => $data[0]['goods_price'],
                'tm_count' => $data[0]['tm_count'],
                'images' => $data[0]['images'],
                'attr_list' => $attr_list,
            ];
        }

        // 将待采集商品数据缓存起来
        session(['wait_collect_goods' => $wait_collect_goods]);

        return true;

        /**
         * https://item.taobao.com/item.htm?id=558366604871
         * https://item.taobao.com/item.htm?id=555709650511
         * https://item.taobao.com/item.htm?id=567132399868
         */
        /*
         * "goods_ids" => "https://item.taobao.com/item.htm?id=558366604871"
            "is_comment" => "0"
            "is_sale" => "0"
            "price" => array:2 [▼
              "sige" => "1"
              "num" => "0"
            ]
            "stock" => array:2 [▼
              "sige" => "1"
              "num" => "0"
            ]
            "goods_category" => "328"
            "goods_type" => "2"
            "lib_cat_ids" => "0"
            "goods_status" => "0"
         */


    }

    /**
     * 采集商品详细数据并存入数据库
     *
     * @param $third_goods_id
     * @return bool
     */
    public function doCollectDetail($third_goods_id)
    {
        if (!$third_goods_id) {
            return false;
        }

        // 1.执行采集商品信息
        $rules = [
            'goods_name' => ['.tb-main-title', 'text'],
            'goods_price' => ['.tb-rmb-num', 'text'], // 销售价
            'market_price' => [], // 市场价
            'tm_count' => ['.J_ReviewsCount', 'text'], // https://rate.taobao.com/detailCount.do?_ksTS=1570979207172_130&callback=jsonp131&itemId=558366604871
            'images' => ['#J_ImgBooth', 'src'],
        ];
        $url = "https://item.taobao.com/item.htm?id={$third_goods_id}";
//        $url = "https://h5.m.taobao.com/awp/core/detail.htm?id={$third_goods_id}"; // todo 淘宝限制了访问频率 暂不采纳该方法 多次请求同一个URL后，会验证登录
        $data = QueryList::get($url)
            ->encoding('utf-8', 'gbk')
            ->rules($rules)->range('')->queryData();

        // https://h5api.m.taobao.com/h5/mtop.taobao.detail.getdetail/6.0/?jsv=2.5.1&appKey=12574478&t=1571029218579&sign=53d43c0ea4e0a98af03063b95f921883&api=mtop.taobao.detail.getdetail&v=6.0&isSec=0&ecode=0&AntiFlood=true&AntiCreep=true&H5Request=true&ttid=2018%40taobao_h5_9.9.9&type=jsonp&dataType=jsonp&callback=mtopjsonp1&data=%7B%22id%22%3A%22558366604871%22%2C%22itemNumId%22%3A%22558366604871%22%2C%22itemId%22%3A%22558366604871%22%2C%22exParams%22%3A%22%7B%5C%22id%5C%22%3A%5C%22558366604871%5C%22%7D%22%2C%22detail_v%22%3A%228.0.0%22%2C%22utdid%22%3A%221%22%7D
        // https://h5api.m.taobao.com/h5/mtop.taobao.detail.getdetail/6.0/
        // ?jsv=2.5.1&appKey=12574478&t=1571029218579&sign=53d43c0ea4e0a98af03063b95f921883
        // &api=mtop.taobao.detail.getdetail&v=6.0&isSec=0&ecode=0&AntiFlood=true&AntiCreep=true
        // &H5Request=true&ttid=2018@taobao_h5_9.9.9&type=jsonp&dataType=jsonp&callback=mtopjsonp1
        // &data={"id":"558366604871","itemNumId":"558366604871","itemId":"558366604871","exParams":"{\"id\":\"558366604871\"}","detail_v":"8.0.0","utdid":"1"}

        // 采集基本数据：
        // 商品名称、商品价格、商品详情内容
        // 商品图片组
        // 商品规格、商品属性

        // 2.对采集到的商品数据进行处理
        $postData = []; // todo

        // 3.调用本地商品库商品添加方法 将采集到的商品数据保存到数据库
        $ret = $this->libGoods->addGoods($postData);
        if (!$ret) {
            return false;
        }
        return true;
    }


    /**
     * @param $post
     * @param int $source 来源 0-平台方后台 1-商家方后台
     * @return mixed
     */
    public function doCollectSzy($post, $source = 0)
    {

//        dd(parse_url('https://www.xxxx.com/goods-48534.html'));
        // http://www.xxxx.cn/goods-2367.html
        /*
         * // 平台后台采集
         * [▼
              "goods_ids" => "http://www.xxxx.cn/goods-2367.html"
              "is_comment" => "0"
              "is_sale" => "1"
              "price" => array:2 [▼
                "sige" => "1"
                "num" => "10"
              ]
              "stock" => array:2 [▼
                "sige" => "1"
                "num" => "10"
              ]
              "goods_category" => "26"
              "goods_type" => "1"
              "lib_cat_ids" => "2"
              "goods_status" => "1"
            ]
        //店铺后台采集
        CollectModel[goods_ids]: https://www.xxx.cn/goods-3600.html
        CollectModel[is_comment]: 0
        CollectModel[is_sale]: 0
        CollectModel[price][sige]: 1
        CollectModel[price][num]: 0
        CollectModel[stock][sige]: 1
        CollectModel[stock][num]: 0
        CollectModel[goods_category]: 31
        CollectModel[goods_type]: 1
        CollectModel[goods_status]: 0
        CollectModel[goods_status]: 1

        CollectModel[freight_id]: 0
        CollectModel[shop_cat_ids][]: 1
        CollectModel[shop_cat_ids][]: 2
        CollectModel[pricing_mode]:
        CollectModel[pricing_mode]: 1
        CollectModel[sales_model]:
        CollectModel[sales_model]: 1
         */
        // todo 校验采集链接中的商品是否有效
        $url_invalid = false;
        if ($url_invalid) {
            return false;
        }

//        dd($post);

        // 校验成功

        // 根据商品链接采集商品数据
        $goods_ids = $post['goods_ids'];
        $goods_ids = explode("\r\n", $goods_ids);
        $wait_collect_goods = [];
        $third_goods_id = [];
        foreach ($goods_ids as $collect_url) {
            $res = $this->api_get($collect_url);
            if ($res['code'] == -1) {
                continue; // 跳出循环
            }
            $data = $res['data'];
//            dd($res);
//            $attr_list = !empty($data[0]['attr_list']) ? array_values(array_filter(explode("\n", str_replace(["&nbsp;", " "], "", $data[0]['attr_list'])))) : null;
//            if (!empty($attr_list)) {
//                foreach ($attr_list as &$v) {
//                    $v = explode(":", str_replace(["&nbsp;"], "", $v));
//                }
//            }


            $url_arr = parse_url($collect_url);
            $path = $url_arr['path'];
            preg_match('/\d+/', $path, $arr);
            $third_goods_id[] = $arr[0];
            $wait_collect_goods[] = [
                'third_goods_id' => $arr[0],
                'url' => $collect_url,
                'goods_name' => $data['goods']['goods_name'],
                'goods_price' => $data['goods']['goods_price'],
                'tm_count' => $data['goods']['comment_num'], // 评论数
                'images' => $this->getImageUrl($data['goods']['goods_image']),
                'attr_list' => null, //$attr_list,

//                'is_comment' => $post['is_comment'],
//                'is_sale' => $post['is_sale'],
//                'price' => $post['price'],
//                'stock' => $post['stock'],
//                'goods_category' => $post['goods_category'],
//                'goods_type' => $post['goods_type'],
//                'lib_cat_ids' => $post['lib_cat_ids'],
//                'goods_status' => $post['goods_status'],
            ];
        }

//        dd($wait_collect_goods);
        // 将待采集商品数据缓存起来
        session(['wait_collect_goods' => $wait_collect_goods]);
        session(['post_collect_goods' => $post]);

        return arr_result(0, $third_goods_id);
    }

    /**
     * @param $third_goods_id
     * @param int $source 来源 0-平台方后台 1-商家方后台
     * @param int $shop_id 商家id
     * @return mixed
     */
    public function doCollectSzyDetail($third_goods_id, $source = 0, $shop_id = 0, $post = [])
    {

        $collect_url = self::DOMAIN . "/goods-{$third_goods_id}.html";
//        $collect_url = "https://www.xxxx.com/goods-{$third_goods_id}.html";
        $res = $this->api_get($collect_url);
        if ($res['code'] == -1) {
            return false;
        }
        $data = $res['data'];

        // 获取商品详情
        $desc_url = self::DOMAIN . "/goods/desc.html?sku_id={$data['goods']['sku_id']}&is_lib_goods=";
        $desc_res = $this->api_get($desc_url);

        $post_collect_goods = $post ?: session('post_collect_goods');
        $goods = $data['goods'];
//        Log::stack(['api'])->info("222".json_encode($post_collect_goods));

        // 采集基本数据：
        // 商品名称、商品详情内容
        // 商品价格
        $price_num = $post_collect_goods['price']['num'] ?? 0;
        $price_sige = $post_collect_goods['price']['sige'] ?? 0;
        if ($price_num > 0 && $price_sige > 0) {

            if ($price_sige == 1) {
                $goods_price = $goods['goods_price'] + $price_num;
            } elseif ($price_sige == 2) {
                $goods_price = $goods['goods_price'] - $price_num;
            } elseif ($price_sige == 3) {
                $goods_price = $goods['goods_price'] * $price_num;
            } else {
                $goods_price = $goods['goods_price'] / $price_num;
            }
        } else {
            $goods_price = $goods['goods_price'];
        }

        // 商品库存
        $stock_num = $post_collect_goods['stock']['num'];
        $stock_sige = $post_collect_goods['stock']['sige'];
        if ($stock_num > 0 && $stock_sige > 0) {

            if ($stock_sige == 1) {
                $goods_stock = $goods['goods_number'] + $stock_num;
            } elseif ($stock_sige == 2) {
                $goods_stock = $goods['goods_number'] - $stock_num;
            } elseif ($stock_sige == 3) {
                $goods_stock = $goods['goods_number'] * $stock_num;
            } else {
                $goods_stock = $goods['goods_number'] / $stock_num;
            }
        } else {
            $goods_stock = $goods['goods_number'];
        }
        if ($source == 1) {
            // 商家端采集
            $goodModelName = 'GoodsModel';
        } else {
            // 平台端采集
            $goodModelName = 'LibGoodsModel';
        }

        $postData[$goodModelName] = [
            'shop_id' => $shop_id,
            'cat_id' => $post_collect_goods['goods_category'],
            'pc_desc' => $desc_res['pc_desc'],
            'mobile_desc' => $desc_res['mobile_desc'],
            'goods_name' => $goods['goods_name'],
            'goods_subname' => $goods['goods_subname'],
            'goods_price' => $goods_price,
            'market_price' => $goods['market_price'],
            'goods_number' => $goods_stock,
            'warn_number' => $goods['warn_number'],
            'goods_sn' => $goods['goods_sn'],
            'goods_barcode' => $goods['goods_barcode'],
            'goods_video' => $this->getImageUrl($goods['goods_video']),
            'goods_image' => $this->getImageUrl($goods['goods_image']),
            'goods_images' => serialize($goods['goods_images']),
            'keywords' => $goods['keywords'],
            'goods_info' => $goods['goods_info'],
            'comment_num' => $post_collect_goods['is_comment'] ? $goods['comment_num'] : 0,
            'sale_num' => $post_collect_goods['is_sale'] ? $goods['sale_num'] : 0,
            'goods_status' => $post_collect_goods['goods_status'],
            'goods_audit' => $post_collect_goods['goods_status'],
//            'lib_cat_id' => $post_collect_goods['lib_cat_ids'],
            'goods_unit' => GoodsUnit::transformUnit($goods['unit_name']), // 单位转换 unit_name
        ];
        if ($source == 1) {
            // 商家端采集
            $postData[$goodModelName]['shop_cat_ids'] = !empty($post_collect_goods['shop_cat_ids']) ? implode(',', $post_collect_goods['shop_cat_ids']) : '';
            $postData[$goodModelName]['freight_id'] = $post_collect_goods['freight_id'];
            $postData[$goodModelName]['pricing_mode'] = $post_collect_goods['pricing_mode'];
            $postData[$goodModelName]['sales_model'] = $post_collect_goods['sales_model'];
        } else {
            // 平台端采集
            $postData[$goodModelName]['lib_cat_id'] = $post_collect_goods['lib_cat_ids'];
        }

        // 商品属性 自定义属性
        $postData['other_attrs'] = $goods['other_attrs'] ? unserialize($goods['other_attrs']) : '';

        // 商品规格
        $goods_specs = [];
        if (!empty($goods['spec_list'])) {
            foreach ($goods['spec_list'] as $k => $v) {
                // 获取规格名称
                $attr_name = $v['attr_name'];
                $attr_info = Attribute::where('attr_name', $attr_name)
                    ->where('shop_id', $shop_id)
                    ->where('is_spec', 1)
                    ->where('type_id', $post_collect_goods['goods_type'])
                    ->first();
                if (empty($attr_info)) {
                    // 不存在规格名称 新增
                    $attr_info = Attribute::create([
                        'shop_id' => $shop_id,
                        'type_id' => $post_collect_goods['goods_type'],
                        'attr_name' => $attr_name,
                        'attr_remark' => null,
                        'attr_sort' => $v['attr_sort'],
                        'is_spec' => 1
                    ]);
                }

                if (!empty($v['attr_values'])) {
                    foreach ($v['attr_values'] as $vv) {
                        $attr_vinfo = AttrValue::where('attr_vname', $vv['attr_value'])
                            ->where('attr_id', $attr_info->attr_id)
                            ->first();
                        if (empty($attr_vinfo)) {
                            // 不存在规格值名称 新增
                            $attr_vinfo = AttrValue::create([
                                'attr_id' => $attr_info->attr_id,
                                'attr_vname' => $vv['attr_value'],
                            ]);
                        }

                        $goods_specs[] = [
                            'attr_id' => $attr_info->attr_id,
                            'attr_vid' => $attr_vinfo->attr_vid,
                            'cat_id' => $post_collect_goods['goods_category'],
                            'attr_vname' => $vv['attr_value'],
                        ];
                    }
                }
            }
        }
        $postData['goods_specs'] = $goods_specs;

        // 2.对采集到的商品数据进行处理

        // 3.调用本地商品库商品添加方法 将采集到的商品数据保存到数据库
        if ($source == 1) {
            // 商家端采集
            $ret = $this->goods->addGoods($postData, $shop_id, true);
        } else {
            // 平台端采集
            $ret = $this->libGoods->addGoods($postData, 0, true);
        }

        if (!$ret) {
            return false;
        }

        // 商品属性
        $attr_list = [];
        if (!empty($goods['attr_list'])) {
            foreach ($goods['attr_list'] as $v) {
                $attr_name = $v['attr_name'];
                $attr_info = Attribute::where('attr_name', $attr_name)
                    ->where('shop_id', $shop_id)
                    ->where('is_spec', 0)
                    ->where('type_id', $post_collect_goods['goods_type'])
                    ->first();
                if (empty($attr_info)) {
                    // 不存在规格名称 新增
                    $attr_info = Attribute::create([
                        'shop_id' => $shop_id,
                        'type_id' => $post_collect_goods['goods_type'],
                        'attr_name' => $attr_name,
                        'attr_remark' => null,
                        'is_spec' => 0
                    ]);
                }
                $v['attr_values'] = explode(' ', $v['attr_values']);
                if (!empty($v['attr_values'])) {
                    foreach ($v['attr_values'] as $vv) {
                        $attr_vinfo = AttrValue::where('attr_vname', $vv)
                            ->where('attr_id', $attr_info->attr_id)
                            ->first();
                        if (empty($attr_vinfo)) {
                            // 不存在规格值名称 新增
                            $attr_vinfo = AttrValue::create([
                                'attr_id' => $attr_info->attr_id,
                                'attr_vname' => $vv,
                            ]);
                        }

                        $attr_list[] = [
                            'attr_id' => $attr_info->attr_id,
                            'attr_vid' => $attr_vinfo->attr_vid,
                        ];
                    }
                }
            }
        }

        // 商品SKU
        $sku_list = [];
        if (!empty($goods['sku_list'])) {
            foreach ($goods['sku_list'] as $k=>$v) {
                if (!$k) {
                    break;
                }
                $specs = [];
                if (!empty($v['spec_names'])) {
                    // todo 此处如果规格值存在空格 则会匹配错误 暂时不解决
                    $spec_names = explode(' ', $v['spec_names']);
                    foreach ($spec_names as $sv) {
                        $spec_names_value = explode('：', $sv);
                        $attr_name = $spec_names_value[0];
                        $attr_vname = $spec_names_value[1];

                        $attr_id = Attribute::where('attr_name', $attr_name)->where('shop_id', $shop_id)->value('attr_id');
                        $attr_vid = AttrValue::where('attr_id', $attr_id)->where('attr_vname', $attr_vname)->value('attr_vid');
                        $specs[$attr_id] = [
                            'attr_id' => $attr_id,
                            'attr_vid' => $attr_vid,
                            'attr_vname' => $attr_vname
                        ];
                    }
                }

                $sku_list[] = [
                    'specs' => $specs,
                    'goods_price' => $v['goods_price'],
                    'goods_number' => $v['goods_number'],
                ];
            }
        }

        if ($source == 1) {
            // 商家端采集
            $this->goods->createGoodsAttrs($attr_list, $ret);
            $this->goods->createGoodsSku($sku_list, $ret);

            // 设置默认sku_id
            $default_sku_id = GoodsSku::where([['goods_id',$ret->goods_id],['checked',1]])->select(['sku_id','goods_id'])->orderBy('sku_id', 'asc')->value('sku_id');
            // 更新商品表 sku_id 为goods_sku 第一个
            Goods::where('goods_id', $ret->goods_id)->update(['sku_id'=>$default_sku_id]);

            GoodsCollectVideo::dispatch($ret, self::OSS_URL); // 下载商品视频
            GoodsCollectImage::dispatch($ret, self::OSS_URL); // 下载商品图片
            GoodsCollectImages::dispatch($ret, self::OSS_URL); // 下载商品多图
        } else {
            // 平台端采集
            $this->libGoods->createGoodsAttrs($attr_list, $ret);
            $this->libGoods->createGoodsSku($sku_list, $ret);

            // 设置默认sku_id
            $default_sku_id = LibGoodsSku::where([['goods_id',$ret->goods_id],['checked',1]])->select(['sku_id','goods_id'])->orderBy('sku_id', 'asc')->value('sku_id');
            // 更新商品表 sku_id 为goods_sku 第一个
            LibGoods::where('goods_id', $ret->goods_id)->update(['sku_id'=>$default_sku_id]);

            LibGoodsCollectVideo::dispatch($ret, self::OSS_URL); // 下载商品视频
            LibGoodsCollectImage::dispatch($ret, self::OSS_URL); // 下载商品图片
            LibGoodsCollectImages::dispatch($ret, self::OSS_URL); // 下载商品多图
        }





        return true;

    }

    public static function getImageUrl($path)
    {
        if (empty($path)) {
            return '';
        }
        return str_contains($path, 'http') ? $path : self::OSS_URL . $path;
    }

    public function api_get($url)
    {
        $http = new Client();
        $response = $http->get($url, [
            'headers' => [
//                'Accept' => 'application/json',
                'User-Agent' => 'szyapp/android',
            ],
        ]);

        $res = json_decode($response->getBody(), true);

        return $res;
    }

}
