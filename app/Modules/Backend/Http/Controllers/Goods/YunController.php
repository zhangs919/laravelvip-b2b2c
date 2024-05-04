<?php

namespace App\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\LibCategoryRepository;
use Illuminate\Http\Request;

class YunController extends Backend
{

    private $links = [
        ['url' => 'goods/yun/goods-list', 'text' => '云产品库采集'],
        ['url' => 'goods/collect/show', 'text' => '批量采集'],
    ];

    protected $libCategory;

    public function __construct(LibCategoryRepository $libCategory)
    {
        parent::__construct();

        $this->libCategory = $libCategory;
    }

    /**
     * 云产品库商品列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \Throwable
     */
    public function goodsList(Request $request)
    {
        $title = '云产品库采集';
        $fixed_title = '云端产品库 - '.$title;
        $this->sublink($this->links, 'goods-list');

        $action_span = [
            [
                'id' => 'shopcollectinfo',
                'url' => '',
                'icon' => '',
                'text' => '查看我的采集数量'
            ],
        ];

        $explain_panel = [
            '采集到的商品数据请参考淘宝pc端和客户端（手机端）来对照，优先pc端',
            '为了在线采集稳定、准确、快速，强烈建议每页采集条数控制在20以下'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $render = view('goods.yun.partials._goods_list')->render();
            return result(0, $render);
        }

        // 云产品库商品分类 todo 需要新建云产品库相关数据表 后期远程从商城官网读取云产品库商品分类数据
        $yun_category_format = []; // 格式化输出数据 $this->yunCategory->getFormatCategory();
        $yun_category_format[0] = "选择分类";
        $yun_category_array = []; //

        // 云产品库品牌库 todo 需要新建云产品库相关数据表 后期远程从商城官网读取云产品库数据
        $yun_brand_format = []; // // 格式化输出数据
        $yun_brand_format[0] = "选择品牌";
        $yun_brand_array = [];

        // 云产品库商品列表 todo 需要新建云产品库相关数据表 后期远程从商城官网读取云产品库数据
        $yun_goods = [1];
        $pageHtml = pagination(1);

        return view('goods.yun.goods_list', compact('title', 'yun_category_format','yun_category_array','yun_brand_format', 'yun_brand_array','yun_goods','pageHtml'));
    }

    /**
     * 扫码枪导入
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function ajaxScan(Request $request)
    {
        $render = view('goods.yun.ajax_scan')->render();
        return result(0, $render);
    }

    public function filterBarcodes(Request $request)
    {
        // 失败
//        return result(-1, null, '错误信息');

        // 成功
        return result(0);
    }

    public function ajaxFile(Request $request)
    {
        $render = view('goods.yun.ajax_file')->render();
        return result(0, $render);
    }

    public function download()
    {
    }

    public function ajaxReadExcel()
    {
        // 错误提示：文件 类型不正确!必须为excel格式 上传文件不能为空！
        result(-1, '', '上传文件不能为空！');
    }

    /**
     * 查看我的采集数量
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function ajaxCollectInfo(Request $request)
    {
        $render = view('goods.yun.ajax_collect_info')->render();
        return result(0, $render);
    }

    /**
     * 导入商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function ajaxSetting(Request $request)
    {
        $goods_ids = $request->post('goods_ids', '');

        // 判断是否有采集数量
//        $collect_allow_number = seller_shop_info()->collect_allow_number; // 允许采集商品数量
//        $collected_number = seller_shop_info()->collected_number; // 已采集商品数量
//        $rest_collect_number = $collect_allow_number - $collected_number; // 剩余可采集商品数量
//
//        if ($rest_collect_number <= 0 || count(explode(',', $goods_ids)) > $rest_collect_number) {
//            return result(1, 0, '您已无可抓取数据条数，共抓取了<strong>0</strong>条数据，用了<strong>0</strong>条数据，还有<strong>0</strong>条数据!<br>请联系平台方购买采集条数！');
//        }

        $render = view('goods.yun.ajax_setting')->render();
        return result(0, $render);
    }

}