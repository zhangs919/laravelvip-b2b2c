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
// | Date:2020-10-01
// | Description:推广
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Goods;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\LiveCategoryRepository;
use App\Repositories\LiveRepository;
use App\Repositories\ToolsRepository;
use App\Services\WechatService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class PromoteController
 * @package App\Modules\Seller\Http\Controllers\Dashboard
 */
class PromoteController extends Seller
{

    private $links = [
    ];



    protected $live;
    protected $liveCategory;

    public function __construct(
        LiveRepository $live
        ,LiveCategoryRepository $liveCategory
    )
    {
        parent::__construct();

        $this->live = $live;
        $this->liveCategory = $liveCategory;
        
        $this->set_menu_select('dashboard', 'dashboard-center');
    }

    public function view(Request $request)
    {
        $url = $request->get('url');
        if ($url == 'live') { // 直播
            $push_url = route('live.live');
        } else { // 在线课堂
            $push_url = 'http://m.lrw.com/online-course-108.html';
        }

        $render = view('dashboard.promote.view', compact('url','push_url'))->render();

        return result(0, $render);
    }

    public function viewBig(Request $request)
    {
        $uuid = uuid();
        $url = $request->get('url');
        $title = $request->get('title');
        $sub_title = $request->get('sub_title');

        $render = view('dashboard.promote.view_big', compact('url', 'uuid', 'title','sub_title'))->render();

        return result(0, $render);
    }

    /**
     * 二维码
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function qrcode(Request $request)
    {
        $push_url = $request->get('push_url');

        return $this->makeQrcode($push_url);
    }

    /**
     * 小程序码
     *
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     */
    public function miniProgram()
    {
        // 调用微信接口 生成小程序码
        $app = WechatService::miniProgram();

        $response = $app->app_code->getUnlimit('scene-value', [
            'page'  => '/pages/index/index/index', // 由于小程序未发布 这里不能正常生成小程序码
            'width' => 600,
        ]);
// $response 成功时为 EasyWeChat\Kernel\Http\StreamResponse 实例，失败为数组或你指定的 API 返回类型

// 保存小程序码到文件
//        if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
//
//            $filename = $response->save('/path/to/directory');
//        }
//// 或
//        if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
//            $filename = $response->saveAs('/path/to/directory', 'appcode.png');
//        }

        return $response;
    }

    /**
     * 下载二维码/小程序码
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadQcode(Request $request)
    {
        $url = $request->get('url');
        $filename = $request->get('filename');
        $qrCode = $this->makeQrcode($url);
        return response()->download($qrCode, $filename);
    }

    public function makeQrcode($url)
    {

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(180)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }
}