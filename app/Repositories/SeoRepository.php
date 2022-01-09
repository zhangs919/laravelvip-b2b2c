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
// | Date:2018-08-15
// | Description:SEO TKD获取封装
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\SystemConfig;


/**
 * SeoRepository
 *
 * Class SeoRepository
 * @package App\Repository
 */
class SeoRepository
{
    use BaseRepository;

    private $seo;

    /**
     * 获取seo tkd
     *
     * 如果是分类或者自定义tkd
     * $type = [1 => 'title', 2 => 'keywords', 3 => discription]
     * $params = ['name' => '关键词或者分类名称']
     *
     * @param string|array $type 如：seo_goods（商品详情页）
     * @return array|bool
     */
    public function type($type, $params = [])
    {
        if (is_array($type)) {
            $this->seo['title'] = $type[1];
            $this->seo['keywords'] = $type[2];
            $this->seo['discription'] = $type[3];
        } else {
            $this->seo = $this->getSeo($type);
        }
        if (!is_array($this->seo)) return $this->seo;
        foreach ($this->seo as $key=>$value) {
            $this->seo[$key] = str_replace(['{site_name}'], [sysconf('site_name')], $value);
        }
        if (!empty($params)) {
            $this->param($params);
        }

        return $this->seo;
    }

    /**
     * 获取某个页面的seo信息
     *
     * @param string|array $type 如：seo_goods（商品详情页）
     * @return array|bool
     */
    public function getSeo($type)
    {
        $condition = [
            ['status', 1],
            ['code', 'like', $type.'%']
        ];
        $list = SystemConfig::where($condition)->select(['code', 'group', 'value'])->get();
        if ($list->isEmpty()) {
            return false;
        }
        $seo_list = [];
        foreach ($list as $k=>$v) {
            $seo_code = str_replace($type.'_', '', $v->code);  // title keywords discription
            $seo_list[$seo_code] = str_replace(['{site_name}'], [sysconf('site_name')], $v->value); // 替换
        }

        return $seo_list;
    }

    /**
     * 传入参数替换SEO中的标签
     *
     * @param null $array
     * @return $this
     */
    public function param($array = null)
    {
        if (!is_array($this->seo)) return $this;
        if (is_array($array)) {
            $array_key = array_keys($array);
            array_walk($array_key, [$this, 'addTag']);
            foreach ($this->seo as $key=>$value) {
                $this->seo[$key] = str_replace($array_key, array_values($array), $value);
            }
        }
        return $this;
    }

    /**
     * 渲染SEO信息到模板
     * todo 后期将此类写成连贯操作
     * SeoRepository::type('seo_goods')->params(['name'=>$goods_info->goods_name])->show();
     */
    public function show()
    {
        $this->seo['title'] = preg_replace("/{.*}/siU",'',$this->seo['title']);
        $this->seo['keywords'] = preg_replace("/{.*}/siU",'',$this->seo['keywords']);
        $this->seo['discription'] = preg_replace("/{.*}/siU",'',$this->seo['discription']);
        if (isset($seoArr['image'])) {
            $seo['image'] = preg_replace("/{.*}/siU",'', $this->seo['image']);
        }

        view()->share('html_title', $this->seo['title'] ? $this->seo['title'] : sysconf('site_name'));
        view()->share('seo_keywords', $this->seo['keywords'] ? $this->seo['keywords'] : sysconf('site_name'));
        view()->share('seo_description', $this->seo['description'] ? $this->seo['discription'] : sysconf('site_name'));
        view()->share('seo_image', isset($seo['image']) ? $seo['image'] : '');
    }

    private function addTag(&$key){
        $key ='{'.$key.'}';
    }
} 
