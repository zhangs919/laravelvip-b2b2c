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

namespace App\Modules\Seller\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttrValue;
use App\Models\PrintSpec;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\TplBackup;
use App\Modules\Base\Http\Controllers\Foundation;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ImageDirRepository;
use App\Repositories\ImageRepository;
use App\Repositories\LinkTypeRepository;
use App\Repositories\MultiStoreGoodsRepository;
use App\Repositories\RegionRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ToolsRepository;
use App\Repositories\TplBackupRepository;
use App\Repositories\UploadVideoRepository;
use App\Repositories\VideoDirRepository;
use App\Repositories\VideoRepository;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * Class SiteController
 * @package App\Modules\Seller\Http\Controllers
 */
class SiteController extends Foundation
{

    protected $tools; // 工具类 如：图片上传

    protected $uploadVideo; // 上传视频

    protected $regions;

    protected $category;

    protected $shopCategory; // 店铺内分类

    protected $tplBackup; // 模板备份

    protected $imageDir;

    protected $image;

    protected $videoDir;

    protected $video;
    protected $goods;

    protected $linkType; // 链接类型



    public function __construct(
        ToolsRepository $tools
        ,UploadVideoRepository $uploadVideoRepository
        ,RegionRepository $regionRepository
        ,CategoryRepository $categoryRepository
        ,ShopCategoryRepository $shopCategoryRepository
        ,TplBackupRepository $tplBackupRepository
        ,ImageDirRepository $imageDirRepository
        ,ImageRepository $imageRepository
        ,VideoDirRepository $videoDirRepository
        ,VideoRepository $videoRepository
        ,GoodsRepository $goods
        ,LinkTypeRepository $linkType
    )
    {
        parent::__construct();

        $this->tools = $tools;
        $this->uploadVideo = $uploadVideoRepository;
        $this->regions = $regionRepository;
        $this->category = $categoryRepository;
        $this->shopCategory = $shopCategoryRepository;
        $this->tplBackup = $tplBackupRepository;
        $this->imageDir = $imageDirRepository;
        $this->image = $imageRepository;
        $this->videoDir = $videoDirRepository;
        $this->video = $videoRepository;
        $this->goods = $goods;
        $this->linkType = $linkType;
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
        $page_id = $params['page_id'] ?? '';
        $render = view('site.'.$tpl, compact('page_id', 'size', 'image_dir_list', 'image_list', 'pageHtml', 'uuid', 'dir_id'))->render();
        return result(0, $render);
    }

    public function videoGallery(Request $request)
    {
        // 检查是否有上传视频的权限
//        return result(-1, '', '您没有权限上传视频，请先开通OSS！');

        $params = $request->all();
        $uuid = make_uuid();
        $sort_name = $request->get('sort_name', '');
        $dir_id = $request->get('dir_id', 0);
        $sortname = 'created_at';
        $sortorder = 'desc';
        $video_name = $request->get('video_name', ''); // 视频名称
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
        list($video_dir_list, $total) = $this->videoDir->getList($condition);

        if (!$dir_id) {
            $dir_id = $video_dir_list[0]->dir_id;
        }
        $where = [];
        $where[] = ['dir_id', $dir_id];
        $where[] = ['is_delete', 0];
        if (!empty($video_name)) {
            $where[] = ['name', 'like', "%{$video_name}%"];
        }
        $videoCondition = [
            'where' => $where,
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];

        list($video_list, $video_total)= $this->video->getList($videoCondition);
        $pageHtml = short_pagination($video_total); // 分页

        $size = $request->post('size', 1);
        $tpl = 'video_gallery';
        if (!isset($params['output'])) {
            $tpl = 'partials._video_gallery_list';
        }
        if ($request->method() == 'POST') {
            // 上传图片
            $dir_id = $request->post('dir_id', 0); // 相册id
            $filename = $request->post('filename', 'name');
            $storePath = 'videos/shop/'.seller_shop_info()->shop_id.'/gallery'; // 店铺相册
            $uploadRes = $this->uploadVideo->uploadVideo($request, $filename, $storePath);

            if (isset($uploadRes['error'])) {
                // 上传出错
                return result(-1, '', $uploadRes['error']);
            }

            // 记录日志
            shop_log('上传视频，成功：'.$uploadRes['count'].'个。视频相册ID：'.$dir_id);

            return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
        }

        $params = $request->get('page');
        $page_id = $params['page_id'] ?? '';
        $render = view('site.'.$tpl, compact('page_id', 'size', 'video_dir_list', 'video_list', 'pageHtml', 'uuid', 'dir_id'))->render();
        return result(0, $render);
    }

    public function uploadImage(Request $request)
    {
        $filename = $request->post('filename', 'name');
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/image';
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
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
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
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
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
        $storePath = 'shop/'.seller_shop_info()->shop_id.'/gallery'; // 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        return result(0, $uploadRes['data'], '上传成功！', ['count' => $uploadRes['count']]);
    }

    /**
     * 视频选择器
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function videoSelector(Request $request)
    {
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
        list($video_dir_list, $total) = $this->videoDir->getList($condition);

        if (!$dir_id) {
            $dir_id = $video_dir_list[0]->dir_id;
        }
        $videoCondition = [
            'where' => [['dir_id', '=', $dir_id]],
            'sortname' => $sortname,
            'sortorder' => $sortorder
        ];
        list($video_list, $video_total)= $this->video->getList($videoCondition);
        $pageHtml = short_pagination($video_total); // 分页

        $size = 1;
        $tpl = 'partials._video_selector_list';
        if ($request->method() == 'POST') {
            $size = $request->post('size', 1);
            $tpl = 'video_selector';
        }

        $render = view('site.'.$tpl, compact('size', 'video_dir_list', 'video_list', 'pageHtml', 'uuid', 'dir_id'))->render();
        return result(0, $render);
    }

    /**
     * 图片选择器
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
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
     * 生成图形验证码
     *
     * @param Request $request
     * @return false|string
     */
    public function captcha(Request $request)
    {

//        return json_encode(['hash1' => 438,'hash2' => '438', 'url' => '/site/captcha.html?v='.uniqid()]);
        $phraseBuilder = new PhraseBuilder(4, '0123456789'); // 只生成4位数字

        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder(null, $phraseBuilder); // 只生成4位数字

        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 设置干扰线
        $builder->setMaxBehindLines(0);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('captcha', $phrase);

        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');

        if ($request->get('refresh')) { // 刷新验证码
            $data = $builder->inline();
            return json_encode(['hash1' => 447,'hash2' => '447', 'url' => $data]);
        }

        // 直接输出验证码
        $builder->output();
    }

    /**
     * 异步加载地区
     *
     * @param Request $request
     * @return mixed
     */
    public function regionList(Request $request)
    {

        return $this->regions->ajaxLoadRegions($request);
    }

    /**
     * ajax返回商品分类树形结构
     *
     * @param Request $request
     * @return array
     */
    public function catList(Request $request)
    {
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
            $name_pinyin = $name.' '.pinyin_permalink($name, '');
            $cat_list[] = [
                'cat_id' => $value['cat_id'],
                'name' => $name,
                'parent_id' => $value['parent_id'],
                'isParent' => $value['has_children'] ? true : false,
                'cat_level' => $value['level'] + 1,
                'keywords' => $name_pinyin
            ];
        }
        if ($format == 'ztree' && $deep == 3) {
//            $cat_list = array_chunk($cat_list, 100);
        }

        return result(0, $cat_list);
    }

    /**
     * ajax返回店铺内商品分类树形结构
     *
     * @param Request $request
     * @return array
     */
    public function shopCatList(Request $request)
    {
        $format = $request->get('format', 'ztree');
        $deep = $request->get('deep', 2);

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'parent_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->shopCategory->getList($condition);
        if (empty($list)){
            return result(-1, '', '获取数据异常');
        }
        $cat_list = [];
        foreach ($list as $value)
        {
            $hasChildren = ShopCategory::where('parent_id', $value->cat_id)->count();
            $name = $value->cat_name;
            $name_pinyin = $name.' '.pinyin_permalink($value->cat_name, '');
            $cat_list[] = [
                'cat_id' => $value->cat_id,
                'name' => $name,
                'parent_id' => $value->parent_id,
                'isParent' => $hasChildren > 0 ? true : false,
                'cat_level' => $value->parent_id == 0 ? 1 : 2,
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
            // 使用模板/取消使用模板
            $id = $request->get('id');
            $topic_id = $request->get('topic_id', 0);
            $page = $request->get('page','m_shop');

            // todo 如何使用模板
            $tpl_backup_info = TplBackup::where('back_id', $id)->first();
            $shop_back_ids = Shop::where('shop_id', seller_shop_info()->shop_id)->select(['back_id','m_back_id','app_back_id'])->first();
            $update = [];
            if ($page == 'm_shop') {
                $update = [
                    'm_back_id' => $id
                ];
                if ($tpl_backup_info->is_theme && $id == $shop_back_ids->m_back_id) {
                    // 主题风格 // 取消主题
                    $update = [
                        'm_back_id' => 0
                    ];
                }
            } elseif ($page == 'app_shop') {
                $update = [
                    'app_back_id' => $id
                ];
                if ($tpl_backup_info->is_theme && $id == $shop_back_ids->app_back_id) {
                    // 主题风格 // 取消主题
                    $update = [
                        'app_back_id' => 0
                    ];
                }
            }

            $ret = Shop::where('shop_id', seller_shop_info()->shop_id)->update($update);
            if ($ret === false) {
                return result(-1, null, '设置失败');
            }

            return result(0, null, '设置成功！');

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

    /**
     * ajax渲染模板数据
     *
     * @param Request $request
     * @return array
     */
    public function tplData(Request $request)
    {
        $tpl_code = $request->get('tpl_code', '');

        // 滚动商品
        $goods_ids = $request->get('goods_ids', 0);
        $output = $request->get('output', 0); // 是否渲染输出html
        $shop_id = $request->get('shop_id', '');
        $is_last = $request->get('is_last', '');

        // 附近店铺
        $lat = $request->get('lat', 0); // 经度
        $lng = $request->get('lng', 0); // 纬度


        // 列表
        $compact = [];
        if ($tpl_code == 'm_goods_list') {
            // 滚动商品
            $where = [];
            $where[] = ['goods_status',1]; // 商品状态 已发布
            $where[] = ['goods_audit',1]; // 审核通过
            $where[] = ['shop_id',seller_info()->shop_id];
            $condition = [
                'where' => $where,
                'sortname' => 'goods_sort',
                'sortorder' => 'asc'
            ];

            if (!empty($goods_ids)) {
                $condition['in'] = [
                    'field' => 'goods_id',
                    'condition' => explode(',', $goods_ids)
                ];
            }

            list($m_goods_list, $m_goods_total) = $this->goods->getList($condition);
            $compact = compact('m_goods_list');
        }
        $render = view('backend::site.'.$tpl_code, $compact)->render();
        return result(0, $render);
    }

    /**
     * 获取二维码登录信息
     *
     * @param Request $request
     * @return array
     */
    public function getQrcodeLoginKey(Request $request)
    {
        $data = [
            'user_id' => 'h7ci760hmcg3um28bmsv4o00us', // 26位 相当于token 用户标识
            'key' => 'F79FA86071C0DD4CBEE63415ED1090DE' // 32位 // 每隔一段时间刷新该值
        ];
        return result(0, $data);
    }

    /**
     * 二维码登录
     * 移动端页面（微信端、App客户端）授权登录页面
     *
     * @param Request $request
     */
    public function qrcodeLogin(Request $request)
    {
        $key = $request->get('k');

        // 验证k是否有效

        if ($request->method() == 'POST') {
            // 执行登录
            $user_id = $request->post('user_id');
            $key = $request->post('key');
            $handle = $request->post('handle'); // login-登录 cancel-取消

            //二维码已失效
            $qrcodeInvalid = true;
            if ($qrcodeInvalid) {
                $APIs = ["onMenuShareTimeline", "scanQRCode"];
                $wx_share_data = get_wx_share_data($APIs);
                $errCode = 0;
                if (!$wx_share_data) {
                    $errCode = -1;
                }
//                dd($wx_share_data);
                return view('site.qrcode_login_error', compact('wx_share_data', 'errCode'));
            }


        }


        return view('site.qrcode_login', compact('key'));
    }

    public function updateMessage(Request $request)
    {
        $order_payed_count = 0; // 订单付款成功
        $back_goods_count = 0; // 退货退款申请
        $group_buy_audit_count = 0; // 团购审核结果
        $contract_audit_count = 0; // 消费保障审核结果

        $messageCount = $order_payed_count + $back_goods_count
            + $group_buy_audit_count + $contract_audit_count; // 消息数量

        $messageList = []; // 消息列表
        if ($order_payed_count > 0) {
            $messageList['order_payed'] = [
                'icon'=>"fa-user",
                'count'=>$order_payed_count,
                'title'=>'订单付款成功',
                'content'=>"{$order_payed_count}个订单付款成功",
            ];
        }
        if ($back_goods_count > 0) {
            $messageList['back_goods'] = [
                'icon'=>"fa-institution",
                'count'=>$back_goods_count,
                'title'=>'退货退款申请',
                'content'=>"{$back_goods_count}个退货退款需要处理",
            ];
        }
        if ($group_buy_audit_count > 0) {
            $messageList['group_buy_audit'] = [
                'icon'=>"fa-thumbs-o-up",
                'count'=>$group_buy_audit_count,
                'title'=>'团购审核结果',
                'content'=>"{$group_buy_audit_count}个团购审核结果",
            ];
        }
        if ($contract_audit_count > 0) {
            $messageList['contract_audit'] = [
                'icon'=>"fa-users",
                'count'=>$contract_audit_count,
                'title'=>'消费保障审核结果',
                'content'=>"{$contract_audit_count}个消费保障审核结果",
            ];
        }

        $render = view('seller::site.update_message', compact('messageCount', 'messageList'))->render();
        return result(0, $render);
    }

    public function messageUpdate(Request $request)
    {
        $object_type = $request->post('object_type'); // order_payed
        $data = [
            'message_logo_count' => 10,
            'url' => '/trade/order/list'
        ];

        return result(0, $data);
    }

    /**
     * 清理缓存
     *
     * @param Request $request
     * @return array
     */
    public function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('clear-compiled');

        return result(0, null, '清理缓存成功！');
    }

    public function imageHotLink(Request $request)
    {
        $uuid = make_uuid();
        $link_type = $request->get('link_type');
        $link = $request->get('link');
        $style = $request->get('style');

        if (is_array($link_type)) {
            $link_type = 0;
        }

        $link_data = $this->linkType->getLinkTypeData($link_type);

        $render = view('site.image_hot_link', compact('uuid','link_type','link','style','link_data'))->render();

        return result(0,$render);
    }

    /**
     * 自动打印
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function autoPrint(Request $request)
    {
        $order_id = $request->get('order_id');

        //lodop_print_html(result.print_title, result.data, result.printer, {
        //                        width: result.print_spec_width,
        //                        height: result.print_spec_height
        //                    });
        $printer = PrintSpec::where('shop_id', seller_shop_info()->shop_id)->where('is_default', 1)->first();
        if (empty($printer)) {
            return result(-1, null, '未配置打印规格');
        }
        if (str_contains($printer->print_spec, '*')) {
            $spec_arr = explode('*', $printer->print_spec);
            $width = (int)$spec_arr[0];
            $height = (int)$spec_arr[1];
        } else {
            $width = $height = (int)$printer->print_spec;
        }
        $extra = [
            'print_title' => '自动打印',
            'printer' => $printer->printer,
            'print_spec_width' => $width,
            'print_spec_height' => $height,
        ];
        return result(0, $printer, '', $extra);
    }

    public function specList(Request $request)
    {
        $format = $request->get('format', 'ztree');
        $cat_id = $request->get('cat_id', 0);
        $shop_id = seller_shop_info()->shop_id;

        $list = Attribute::where('shop_id', $shop_id)->orderBy('attr_id', 'desc')->get()->toArray();

        return result(0, $list);
    }

    public function propList(Request $request)
    {
        $format = $request->get('format', 'ztree');
        $goods_id = $request->get('goods_id', 0);


        return result(0, []);
    }

    public function specValueList(Request $request)
    {
        $format = $request->get('format', 'ztree');
        $attr_id = $request->get('attr_id', 0);
        $goods_id = $request->get('goods_id', 0);

        $list = AttrValue::where('attr_id', $attr_id)->get()->toArray();

        return result(0, $list);
    }

    /**
     * 导入数据执行进度
     * todo 待研究怎么运行
     *
     * @param Request $request
     * @return array
     */
    public function progress(Request $request)
    {
        // key: batchedit:multistore:goods:price:stock:396 门店商品库存、价格设置
        // key: update:multistore:goods:relation:396 门店关联商品
        $key = $request->get('key', '');
        $post = cache()->get($key);
        $index = 0; // 已执行完成的数量
        $count = 0; // 总的需要执行的数量
        $multiStoreGoodsRep = new MultiStoreGoodsRepository();
        switch ($key) {
            case Str::contains($key, 'batchedit:multistore:goods:price:stock'):
                // 门店商品库存、价格设置
                $multiStoreGoodsRep->batchEditGoods($post, $index, $count);
                break;
            case Str::contains($key, 'update:multistore:goods:relation'):
                // 门店关联商品
                $multiStoreGoodsRep->storeRelatedGoods($post, $index, $count);
                break;
        }
        $progress = (round($index/$count, 4)*100)."%"; // 当前进度百分比
        $data = [
            'index' => $index,
            'count' => $count,
            'progress' => $progress
        ];
        return result(0, $data);
    }
}
