<?php

namespace App\Modules\Backend\Http\Controllers;

use App\Models\Goods;
use App\Models\Shipping;
use App\Models\ShopContract;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ImageDirRepository;
use App\Repositories\ImageRepository;
use App\Repositories\LinkTypeRepository;
use App\Repositories\RegionRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ToolsRepository;
use App\Repositories\TplBackupRepository;
use App\Repositories\UploadVideoRepository;
use App\Repositories\VideoDirRepository;
use App\Repositories\VideoRepository;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravelvip\Kdniao\Kdniao;

class SiteController extends Backend
{

    protected $tools; // 工具类 如：图片上传

    protected $uploadVideo; // 上传视频

    protected $regions;

    protected $category;

    protected $imageDir;

    protected $image;

    protected $tplBackup; // 模板备份

    protected $goods;

    protected $shop;

    protected $videoDir;

    protected $video;

    protected $linkType; // 链接类型


    public function __construct(
        ToolsRepository $tools
        ,UploadVideoRepository $uploadVideoRepository
        ,RegionRepository $regionRepository
        ,CategoryRepository $categoryRepository
        ,ImageDirRepository $imageDirRepository
        ,ImageRepository $imageRepository
        ,TplBackupRepository $tplBackupRepository
        ,GoodsRepository $goods
        ,ShopRepository $shop
        ,VideoDirRepository $videoDirRepository
        ,VideoRepository $videoRepository
        ,LinkTypeRepository $linkType


    )
    {
        parent::__construct();

        $this->tools = $tools;
        $this->uploadVideo = $uploadVideoRepository;
        $this->regions = $regionRepository;
        $this->category = $categoryRepository;
        $this->imageDir = $imageDirRepository;
        $this->image = $imageRepository;
        $this->tplBackup = $tplBackupRepository;
        $this->goods = $goods;
        $this->shop = $shop;
        $this->videoDir = $videoDirRepository;
        $this->video = $videoRepository;
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
            'where' => [['dir_group', '=', 'backend']],
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
        if (empty($params['output'])) {
            $tpl = 'partials._image_gallery_list';
        }
        if ($request->method() == 'POST') {
            // 上传图片
            $dir_id = $request->post('dir_id', 0); // 相册id
            $filename = $request->post('filename', 'name');
//            $storePath = 'backend/gallery'; // 需要判断是平台方 还是店铺 站点
            $storePath = 'site/1/images';
            $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

            if (isset($uploadRes['error'])) {
                // 上传出错
                return result(-1, '', $uploadRes['error']);
            }

            // 记录日志
            admin_log('上传图片，成功：'.$uploadRes['count'].'张。相册ID：'.$dir_id);

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
//        dd($params);
        if ($sort_name != '') {
            $sortArr = explode('-', $sort_name);
            $sortname = $sortArr[0];
            $sortorder = $sortArr[1];
        }

        $condition = [
            'where' => [
                ['dir_group', 'backend'],
//                ['site_id', 0], // 站点id
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
//        $tpl = 'partials._video_gallery_list';
        if ($request->method() == 'POST') {
            // 上传图片
            $dir_id = $request->post('dir_id', 0); // 相册id
            $filename = $request->post('filename', 'name');
            $storePath = 'videos/site/1/gallery'; // 平台视频相册
            $uploadRes = $this->uploadVideo->uploadVideo($request, $filename, $storePath);

            if (isset($uploadRes['error'])) {
                // 上传出错
                return result(-1, '', $uploadRes['error']);
            }

            // 记录日志
            admin_log('上传视频，成功：'.$uploadRes['count'].'个。视频相册ID：'.$dir_id);

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
        $storePath = 'backend/1'; // todo 存储路径是动态的
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
        $storePath = 'backend/gallery'; // todo 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
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
        $storePath = 'backend/gallery'; // todo 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
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
        $storePath = 'backend/gallery'; // todo 图片路径 /images/shop/64/gallery/2017/11/29/15119252274524.jpg
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

        // 创建平台默认视频相册
//        $videoDirRep = new VideoDirRepository();
//        $videoDirRep->createDefaultDirs(0, 0, 'backend');die;

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
                ['dir_group', 'backend'],
//                ['site_id', 0], // 站点id
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
            'where' => [['dir_group', '=', 'backend']],
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
            'sortname' => 'cat_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->category->getList($condition);
        if (empty($list)){
            return result(-1, '', '获取数据异常');
        }
        $cat_list = [];

        foreach ($list as &$value)
        {
            $cat_list[] = [
                'cat_id' => $value->cat_id,
                'name' => $value->cat_name,
                'parent_id' => $value->parent_id,
                'isParent' => $value->is_parent ? true : false,
                'cat_level' => $value->cat_level + 1,
                'keywords' => $value->keywords
            ];
//            $value['name'] = $value['cat_name'];
//            $value['isParent'] = $value['is_parent'];
//            $value['cat_level'] = 1;
//            if (!empty($value['_child'])) {
//                //dd($value);
//                foreach ($value['_child'] as &$v) {
//                    $v['name'] = $v['cat_name'];
//                    $v['isParent'] = $v['is_parent'];
//                    $v['cat_level'] = 2;
//
//                    if (!empty($v['_child'])) {
//                        //dd($value);
//                        foreach ($v['_child'] as &$vv) {
//                            $vv['name'] = $vv['cat_name'];
//                            $vv['isParent'] = $vv['is_parent'];
//                            $vv['cat_level'] = 3;
//                        }
//                    }
//                }
//            }
        }

//        if ($format == 'ztree' && $deep == 3) {
//            $cat_list = array_chunk($cat_list, 100);
//        }

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
        } elseif ($tpl_code == 'm_near_shop') {
            // 附近店铺
            $where = [];
            $where[] = ['shop_status',1];
            $where[] = ['show_in_street',1];
            // 根据经纬度查询附近店铺 todo 待完成
            // ...

            // 6378.138 为地球半径
            $earth_radius = 6378.138;
            $condition = [
                'where' => $where,
                'sortname' => 'shop_sort',
                'sortorder' => 'asc',
                // 计算附近店铺 distance（当前位置经纬度与每个店铺的经纬度距离，单位：m）
                'field' => DB::raw("shop.*,({$earth_radius} * 2 * asin(sqrt(pow(sin((shop_lat * pi() / 180 - {$lat} * pi() / 180) / 2),2) + cos(shop_lat * pi() / 180) * cos({$lat} * pi() / 180) * pow(sin((shop_lng * pi() / 180 - {$lng} * pi() / 180) / 2),2))) * 1000) as distance")
            ];
            list($m_near_shop, $total) = $this->shop->getList($condition);
            $compact = compact('m_near_shop');
        }
//dd($m_goods_list);
        $render = view('backend::site.'.$tpl_code, $compact)->render();
        return result(0, $render);
    }


    public function updateMessage(Request $request)
    {
        $goods_apply_count = Goods::where('goods_audit', 0)->count(); // 商品审核
        $customer_apply_count = ShopContract::where('status', 0)->count(); // 消费保障申请

        $messageCount = $goods_apply_count + $customer_apply_count; // 消息数量
        $messageList = []; // 消息列表
        if ($goods_apply_count > 0) {
            $messageList['goods_apply'] = [
                'icon'=>"fa-shopping-cart",
                'count'=>$goods_apply_count,
                'title'=>'商品审核',
                'content'=>"{$goods_apply_count}个商品需要审核",
            ];
        }
        if ($customer_apply_count > 0) {
            $messageList['customer_apply'] = [
                'icon'=>"fa-credit-card",
                'count'=>$customer_apply_count,
                'title'=>'消费保障申请',
                'content'=>"{$customer_apply_count}个店铺保障服务申请需要审核",
            ];
        }

        $render = view('backend::site.update_message', compact('messageCount', 'messageList'))->render();
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

    /**
     * 发送测试邮件
     *
     * @param Request $request
     * @return mixed
     */
    public function sendTestMail(Request $request)
    {

        return result(0,'', '测试邮件发送成功！');
    }

    /**
     * 发送测试短信
     *
     * @param Request $request
     * @return mixed
     */
    public function sendTestSms(Request $request)
    {

        return result(0,'', '测试短信发送成功！');
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
        // build-lib-goods-import  导入店铺商品
        //   build-goods-region-by-freight 重建商品数据关联关系
        $key = $request->get('key', '');


        $index = rand(1,99); // 已执行完成的数量
        $count = 99; // 总的需要执行的数量
        $progress = (round($index/$count, 4)*100)."%"; // 当前进度百分比
        $data = [
            'index' => $index,
            'count' => $count,
            'progress' => $progress
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

    /**
     * 快递鸟 测试物流查询
     *
     * @param Request $request
     * @return mixed
     */
    public function trackQuery(Request $request)
    {
        $title = "物流追踪查询";
        $shipping_list = Shipping::where([['is_open', 1]])
            ->select(['shipping_id','shipping_code','shipping_name'])
            ->get();

        if ($request->method() == 'POST') {
            $tracking_code = $request->post('logistic_code');
            $shipping_code = $request->post('shipping_code');
            $kdniao = new Kdniao();
            $res = $kdniao->track($tracking_code, $shipping_code);
            $data = [
                'list' => [
                    [
                        'time' => '2019-06-06 18:58:39',
                        'msg' => '亲，您的快件投递至丰巢，有疑问请联系'
                    ],[
                        'time' => '2019-06-06 18:58:39',
                        'msg' => '已签收，签收人凭取货码签收。 [数据来源于丰巢智能柜]',
                    ]
                ]
            ];

            return result(0, $data);
        }

        return view('site.track_query', compact('title','shipping_list'));

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
}
