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
// | Date:2018-08-08
// | Description: 清测试数据
// +----------------------------------------------------------------------

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ClearDataRepository
{
    use BaseRepository;



    public function __construct()
    {

    }


    /**
     * 商城拓展数据：建议清理
     * - goods商品管理 shop店铺 shop_category店铺分类 user会员列表 mall_nav商城导航
     * - nav_banner首页轮播图 quick_service快捷服务 links友情链接
     *
     * 商城基础数据：不建议清理
     * - category分类管理 brand品牌管理 goods_type商品类型
     * - image_space图片空间 cat_nav分类导航 mall_account商城账户
     *
     * @param array $codes 需要清除的数据
     * @return mixed
     */
    public function clearData($codes = [])
    {
        if (empty($codes)) {
            return false;
        }
        foreach ($codes as $code) {
            // 45个表
            switch ($code) {
                case 'goods':
                    // 商品管理
                    // goods goods_attr goods_cat goods_collect goods_history
                    // goods_image goods_layout goods_sku goods_spec goods_unit
                    // spec_alias
                    $table = ['goods', 'goods_activity','goods_attr', 'goods_cat', 'goods_comment', 'goods_history',
                        'goods_image', 'goods_layout', 'goods_sku', 'goods_spec', 'goods_unit',
                        'spec_alias',
                        // 清除装修内容
                        'template_item','topic','tpl_backup'
                        ];
                    break;
                case 'shop':
                    // 店铺
                    // shop shop_apply shop_auth shop_collect shop_config
                    // shop_field_value shop_log shop_navigation shop_questions freight
                    // freight_free_record freight_record self_shop
                    $table = ['shop', 'shop_apply', 'shop_auth', 'shop_collect', 'shop_config',
                        'shop_field_value', 'shop_log', 'shop_navigation', 'shop_questions', 'freight',
                        'freight_free_record', 'freight_record', 'self_shop'];
                    break;
                case 'shop_category':
                    // 店铺分类
                    // shop_category shop_class
                    $table = ['shop_category', 'shop_class'];
                    break;
                case 'user':
                    // 会员列表
                    // user user_address user_real
                    $table = ['user', 'user_address', 'user_real'];

                    break;
                case 'mall_nav':
                    // 商城导航
                    // navigation
                    $table = ['navigation'];

                    break;
                case 'nav_banner':
                    // 首页轮播图
                    // nav_banner
                    $table = ['nav_banner'];

                    break;
                case 'quick_service':
                    // 快捷服务
                    // nav_quick_service
                    $table = ['nav_quick_service'];

                    break;
                case 'links':
                    // 友情链接
                    // links
                    $table = [];

                    break;
                case 'category':
                    // 分类管理
                    // category cat_attribute
                    $table = ['category', 'cat_attribute'];

                    break;
                case 'brand':
                    // 品牌管理
                    // brand brand_collect
                    $table = ['brand', 'brand_collect'];

                    break;
                case 'goods_type':
                    // 商品类型
                    // goods_type attribute attr_value
                    $table = ['goods_type', 'attribute', 'attr_value'];

                    break;
                case 'image_space':
                    // 图片空间
                    // image image_dir todo 相册暂时不让清除
//                    $table = ['image', 'image_dir'];
                    $table = [];

                    break;
                case 'cat_nav':
                    // 分类导航
                    // nav_ad nav_brand nav_category nav_words
                    $table = ['nav_ad', 'nav_brand', 'nav_category', 'nav_words'];

                    break;
                case 'mall_account':
                    // 商城账户
                    $table = [];

                    break;

                default:
                    $table = '';
                    break;
            }
            // 执行清空表数据操作
            $ret = $this->truncateTable($table);

            if ($ret === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * 清空表数据
     *
     * @param string|array $table 表名
     * @return bool
     */
    public function truncateTable($table)
    {
        if (empty($table)) {
            return true;
        }
        DB::beginTransaction();
        try{
            if (is_string($table)) {
                // 清空单个表
                DB::statement('truncate '.$table);
            } elseif (is_array($table)) {
                // 清空多个表
                foreach ($table as $t) {
                    DB::statement('truncate '.$t);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return false;
        }
    }

}