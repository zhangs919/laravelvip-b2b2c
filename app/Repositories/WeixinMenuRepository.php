<?php

namespace App\Repositories;

use App\Models\WeixinMenu;
use App\Services\Tree;
use App\Services\WechatService;
use EasyWeChat\Factory;
use EasyWeChatComposer\EasyWeChat;

class WeixinMenuRepository
{
    use BaseRepository;

    protected $model;

    protected $tree;


    public function __construct()
    {
        $this->model = new WeixinMenu();
        $this->tree = new Tree();
    }

    public function getList($condition = [], $column = '', $toTree = false, $toFormatTree = false)
    {
        $data = $this->model->getList($condition, $column);

        if (!empty($data[0]) && $toTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->list_to_tree($list, 'id', 'parent_id');
        }

        if (!empty($data[0]) && $toFormatTree) {
            // 是否转换为树形结构
            $list = [];
            foreach ($data[0] as $key=>$value) {
                $list[$key] = $value->toArray();
            }
            $data[0] = $this->tree->toFormatTree($list, 'menu_name', 'id', 'parent_id');
        }
        return $data;
    }

    /**
     * 同步自定义菜单到微信
     *
     * @param $shop_id
     * @return mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function syncToWeixin($shop_id = 0)
    {
        $where = [];
        if ($shop_id) { // 店铺
            $where[] = ['shop_id', $shop_id];
        } else { // 平台端
            $where[] = ['shop_id', 0];
        }
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->getList($condition,'',true);

        $buttons = [];
        foreach ($list as $item) {
            $sub_button = [];
            if (!empty($item['_child'])) {
                // 二级菜单
                foreach ($item['_child'] as $child) {
                    $sub_button[] = [
                        'type' => 'view', // 菜单的响应动作类型，view表示网页类型，click表示点击类型，miniprogram表示小程序类型
                        'name' => $child['menu_name'],
                        'url' => $child['menu_link']
                    ];
                }
                $buttons[] = [
                    'name' => $item['menu_name'],
                    'sub_button' => $sub_button
                ];
            } else {
                // 一级菜单
                $buttons[] = [
                    'type' => 'view', // 菜单的响应动作类型，view表示网页类型，click表示点击类型，miniprogram表示小程序类型
                    'name' => $item['menu_name'],
                    'key' => $item['menu_link']
                ];
            }
        }

        // 获取微信sdk实例
        $app = WechatService::app($shop_id);

//        $buttons = [
//            [
//                "type" => "click",
//                "name" => "今日歌曲",
//                "key"  => "V1001_TODAY_MUSIC"
//            ],
//            [
//                "name"       => "菜单",
//                "sub_button" => [
//                    [
//                        "type" => "view",
//                        "name" => "搜索",
//                        "url"  => "http://www.soso.com/"
//                    ],
//                    [
//                        "type" => "view",
//                        "name" => "视频",
//                        "url"  => "http://v.qq.com/"
//                    ],
//                    [
//                        "type" => "click",
//                        "name" => "赞一下我们",
//                        "key" => "V1001_GOOD"
//                    ],
//                ],
//            ],
//        ];


        $ret = $app->menu->create($buttons);

        return $ret;
    }
}