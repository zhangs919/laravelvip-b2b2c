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
// | Date:2018-07-28
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Store\Http\Controllers;

use App\Modules\Base\Http\Controllers\Foundation;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageDirRepository;
use App\Repositories\ImageRepository;
use App\Repositories\RegionRepository;
use App\Repositories\ToolsRepository;
use App\Repositories\TplBackupRepository;
use Illuminate\Http\Request;

/**
 * Class SiteController
 * @package App\Modules\Store\Http\Controllers
 */
class SiteController extends Foundation
{

    protected $tools; // 工具类 如：图片上传

    protected $regions;

    protected $category;

    protected $imageDir;

    protected $tplBackup; // 模板备份

    protected $image;

    /**
     * SiteController constructor.
     * @param ToolsRepository $tools
     * @param RegionRepository $regionRepository
     * @param CategoryRepository $categoryRepository
     * @param ImageDirRepository $imageDirRepository
     * @param ImageRepository $imageRepository
     * @param TplBackupRepository $tplBackupRepository
     */
    public function __construct(
        ToolsRepository $tools
        ,RegionRepository $regionRepository
        ,CategoryRepository $categoryRepository
        ,ImageDirRepository $imageDirRepository
        ,ImageRepository $imageRepository
        ,TplBackupRepository $tplBackupRepository
    )
    {
        parent::__construct();

        $this->tools = $tools;
        $this->regions = $regionRepository;
        $this->category = $categoryRepository;
        $this->imageDir = $imageDirRepository;
        $this->image = $imageRepository;
        $this->tplBackup = $tplBackupRepository;
    }


    public function imageGallery(Request $request)
    {
        $params = $request->all();
        $uuid = make_uuid();
        $sort_name = $request->get('sort_name', '');
        $dir_id = $request->get('dir_id', 0);
        $sortname = 'created_at';
        $sortorder = 'desc';
        $image_name = $request->get('image_name', ''); // 图片名称

        if ($sort_name != '') {
            $sortArr = explode('-', $sort_name);
            $sortname = $sortArr[0];
            $sortorder = $sortArr[1];
        }

        $condition = [
            'where' => [
                ['dir_group', 'shop'],
                ['shop_id', seller_shop_info()->shop_id],
            ],
            'limit' => 0,
            'sortname' => 'dir_sort',
            'sortorder' => 'asc'
        ];
        list($image_dir_list, $total) = $this->imageDir->getList($condition);

        if (!$dir_id) {
            $dir_id = $image_dir_list[0]->dir_id;
        }
        $where = [];
        $where[] = ['dir_id', $dir_id];
        $where[] = ['is_delete', 0];
        if (!empty($image_name)) {
            $where[] = ['name', 'like', "%{$image_name}%"];
        }
        $imageCondition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];

        list($image_list, $image_total)= $this->image->getList($imageCondition);
        $pageHtml = short_pagination($image_total); // 分页

        $size = $request->post('size', 1);
        $tpl = 'image_gallery';
        if (!isset($params['output'])) {
            $tpl = 'partials._image_gallery_list';
        }
        if ($request->method() == 'POST') {
            // 上传图片
            $dir_id = $request->post('dir_id', 0); // 相册id
            $filename = $request->post('filename', 'name');
            $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // 店铺相册
            $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

            if (isset($uploadRes['error'])) {
                // 上传出错
                return result(-1, '', $uploadRes['error']);
            }

            // 记录日志
            shop_log('上传图片，成功：'.$uploadRes['count'].'张。相册ID：'.$dir_id);

            return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
        }

        $params = $request->get('page');
        $page_id = $params['page_id'];
        $render = view('site.'.$tpl, compact('page_id', 'size', 'image_dir_list', 'image_list', 'pageHtml', 'uuid', 'dir_id'))->render();
        return result(0, $render);
    }

    public function videoGallery(Request $request)
    {

        if ($request->method() == 'POST') {

            // 检查是否有上传视频的权限
            return result(-1, '', '您没有权限上传视频，请先开通OSS！');

//            $filename = $request->post('filename', 'name');
//            $storePath = 'backend/gallery'; // 需要判断是平台方 还是店铺 站点
////            dd($request->post());
//            $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);
//
//            if (isset($uploadRes['error'])) {
//                // 上传出错
//                return result(-1, '', $uploadRes['error']);
//            }
//
//            return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
        }

//        $params = $request->all();
//
//        $tpl = 'video_gallery';
//        if (!isset($params['output'])) {
//            $tpl = 'video_gallery_list';
//        }
//        $render = view('site.'.$tpl, $params)->render();
//        return result(0, $render);
    }

    public function uploadImage(Request $request)
    {
        $filename = $request->post('filename', 'name');
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/image'; // todo
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    public function uploadGoodsImage(Request $request)
    {
        $filename = $request->post('filename', 'name');
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // todo 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    public function uploadMobileImage(Request $request)
    {
        $filename = $request->post('filename', 'name');
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // todo 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    public function uploadGoodsDescImage(Request $request)
    {
        $filename = $request->post('filename', 'name');
        // 获取商品
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // todo 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    public function videoSelector(Request $request)
    {
        $params = $request->all();
        $uuid = make_uuid();
        if ($request->method() == 'POST') {
            $size = $request->post('size', 0);
            $condition = [
                'where' => [['dir_group', '=', 'backend']]
            ];
            list($video_dir_list, $total)= $this->imageDir->getList($condition); // todo
            $render = view('site.video_selector', compact('size', 'video_dir_list', 'uuid'))->render();
            return result(0, $render);
        }
//        $tpl = 'image_selector';
//        $render = view('site.'.$tpl, $params)->render();

        if (isset($params['output'])) {
            $tpl = 'video_selector_list';
        }
        $render = view('site.'.$tpl)->render();
        return result(0, $render);
    }

    public function imageSelector(Request $request)
    {
        $params = $request->all();
        $uuid = make_uuid();
        $sort_name = $request->get('sort_name', '');
        $dir_id = $request->get('dir_id', 0);
        $sortname = 'created_at';
        $sortorder = 'desc';
        if ($sort_name != '') {
            $sortArr = explode('-', $sort_name);
            $sortname = $sortArr[0];
            $sortorder = $sortArr[1];
        }

        $condition = [
            'where' => [
                ['dir_group', 'shop'],
                ['shop_id', seller_shop_info()->shop_id],
            ],
            'sortname' => 'dir_sort',
            'sortorder' => 'asc'
        ];
        list($image_dir_list, $total) = $this->imageDir->getList($condition);

        if (!$dir_id) {
            $dir_id = $image_dir_list[0]->dir_id;
        }
        $imageCondition = [
            'where' => [['dir_id', '=', $dir_id]],
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($image_list, $image_total)= $this->image->getList($imageCondition);
        $pageHtml = short_pagination($image_total); // 分页

        $size = 1;
        $tpl = 'partials._image_selector_list';
        if ($request->method() == 'POST') {
            $size = $request->post('size', 1);
            $tpl = 'image_selector';
        }

        $render = view('site.'.$tpl, compact('size', 'image_dir_list', 'image_list', 'pageHtml', 'uuid', 'dir_id'))->render();
        return result(0, $render);
    }

    /**
     * 异步加载地区
     *
     * @param Request $request
     * @return mixed
     */
    public function regionList(Request $request)
    {

        // 判断传入的值是parent_code 还是 region_code
        $parent_code = !is_null($request->get('parent_code')) ? $request->get('parent_code') : 0;
        $field = 'parent_code';
        $params = $request->all();

        $level_names = [
            0 => "",
            1 => '省',
            2 => '市',
            3 => '区/县',
            4 => '镇',
            5 => '街道/村'
        ];
        $extras = [
            'level_names' => $level_names,
        ];

        if (isset($params['region_code'])) {
            // 查询region_names
            $region_names = [];
            if ($params['region_code'] > 0) {
                $region_names = array_reverse(get_parent_region_list($params['region_code']));
                $region_names = array_column($region_names, 'region_name', 'region_code');
                $rr = array_keys($region_names);
                if (is_int($rr[0])) {
                    array_unshift($rr, 0);
                    if (count($rr) > 3) {
                        array_pop($rr); // 移除最后一个
                    }
                }
                $data = [];
                foreach ($rr as $key=>$p_code) {
                    $condition = [
                        'where' => [[$field, strval($p_code)]],
                        'limit' => 0,
                        'field' => [
                            'center', 'city_code', 'is_enable', 'is_scope', 'level',
                            'parent_code', 'region_code', 'region_id', 'region_name', 'region_type', 'sort'
                        ],
                        'sortname' => 'region_id',
                        'sortorder' => 'asc'
                    ];
                    list($region_list, $total) = $this->regions->getList($condition);
                    $data[$key] = $region_list;
                }
            } else {
                $condition = [
                    'where' => [[$field, 0]],
                    'limit' => 0,
                    'field' => [
                        'center', 'city_code', 'is_enable', 'is_scope', 'level',
                        'parent_code', 'region_code', 'region_id', 'region_name', 'region_type', 'sort'
                    ],
                    'sortname' => 'region_id',
                    'sortorder' => 'asc'
                ];
                list($region_list, $total) = $this->regions->getList($condition);
                $data[] = $region_list;
            }


            $extras['region_names'] = $region_names;

            return result(0, $data, '', $extras);
        } else {
            $field = 'parent_code';
            $condition = [
                'where' => [[$field, $parent_code]],
                'limit' => 0,
                'field' => [
                    'center', 'city_code', 'is_enable', 'is_scope', 'level',
                    'parent_code', 'region_code', 'region_id', 'region_name', 'region_type', 'sort'
                ],
                'sortname' => 'region_id',
                'sortorder' => 'asc'
            ];
            list($region_list, $total) = $this->regions->getList($condition);

            $data[0] = $region_list;
            return result(0, $data, '', $extras);
        }

    }

    public function catList(Request $request)
    {
        /*
         * {“id”:”123”,”isHidden”:false,”open”:true,”parentId”:”“,”ext1”:”“,”name”:”1xxx”,”uuid”:”xxxxx”,”checked”:false},{“id”:”456”,”isHidden”:false,”open”:true,”parentId”:”123”,”ext1”:”“,”name”:”1.1xxxx”,”uuid”:”xxxxx”,”checked”:false}
         */
        $format = $request->get('format', 'ztree');
        $deep = $request->get('deep', 3);

        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'parent_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->category->getList($condition);
        if (empty($list)){
            return result(-1, '', '获取数据异常');
        }
        $list = cat_list(0, 0, false);

        $cat_list = [];
        foreach ($list as &$value)
        {
            $name = $value['cat_name'];
            $name_pinyin = $name.' '.pinyin_permalink($name);
            $cat_list[] = [
                'cat_id' => $value['cat_id'],
                'name' => $name,
                'parent_id' => $value['parent_id'],
                'isParent' => $value['has_children'] ? true : false,
                'cat_level' => $value['level'],
                'keywords' => $name_pinyin
            ];
        }

        return result(0, $cat_list);
    }

    /**
     * 模板备份
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function tplBackup(Request $request)
    {
        $uuid = make_uuid();
        $action = $request->get('action');
        $output = $request->get('output');
        $design_page = $request->get('design_page');

        // 模板备份
        if ($request->method() == 'POST') {
            // post 请求
            $action = $request->post('action');
            if ($action == 'backup') {
                // 模板备份
                $tplBackupData = $request->post('TplBackup');

                $ret = $this->tplBackup->store($tplBackupData);
                if ($ret === false) {
                    return result(-1, '', '备份失败');
                }

                return result(0, null, '备份成功');
            }

        }

        if ($action == 'add') {

            $render = view('site.tpl_backup', compact('uuid'))->render();

        } elseif ($action == 'usetpl') {
            // 使用模板
            $id = $request->get('id');
            $topic_id = $request->get('topic_id', 0);

            // todo 如何使用模板

            return result(0, null, '设置成功');

        } elseif ($action == 'delete') {
            // 删除模板
            $id = $request->post('id');
            $ret = $this->tplBackup->del($id);
            if ($ret === false) {
                return result(-1, null, '删除失败');
            }
            return result(0, null, '删除成功');

        } elseif ($action == 'list') {
            // 模板备份列表
            $search_id = $request->get('search_id', 0); // 搜索id
            if (!empty($request->get('name'))) {
                $where[] = ['name', 'like', "%{$request->get('name')}%"];
            }
            $where[] = ['page', $design_page];
            $tplBackupCondition = [
                'where' => $where,
                'sortname' => 'created_at',
                'sortorder' => 'desc'
            ];

            list($tplBackup, $total) = $this->tplBackup->getList($tplBackupCondition);
            $pageHtml = pagination($total);
            $view = 'site.tpl_backup_list';
            if (!$output) {
                $view = 'site.partials._tpl_backup_list';
            }
            $render = view($view, compact('tplBackup', 'pageHtml', 'design_page', 'uuid', 'output'))->render();
        }



        return result(0, $render);
    }


    public function updateMessage(Request $request)
    {
        $messageCount = 0; // 消息数量
        $messageList = [1]; // 消息列表

        $render = view('site.update_message', compact('messageCount', 'messageList'))->render();
        return result(0, $render);

    }

    public function messageUpdate(Request $request)
    {
        $object_type = $request->post('object_type'); // goods_apply
        $data = [
            'message_logo_count' => 0,
            'url' => '/goods/default/wait-audit'
        ];

        return result(0, $data);

    }
}