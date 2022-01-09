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
// | Date:2018-08-11
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\ShopContract;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ContractRepository;
use App\Repositories\ShopContractRepository;
use Illuminate\Http\Request;

class ContractController extends Seller
{
    private $links = [];

    protected $contract;
    protected $shopContract;

    public function __construct()
    {
        parent::__construct();

        $this->contract = new ContractRepository();
        $this->shopContract = new ShopContractRepository();

        $this->set_menu_select('shop', 'contract');
    }

    public function lists(Request $request)
    {
        $fixed_title = $title = '保障服务';

        $action_span = [];

        $explain_panel = [
            '保障服务流程：卖家申请->平台方审核->审核通过->成功加入',
            '成功加入之后，在发布或编辑商品时，可设置商品享受哪些服务保障；设置成功之后，在店铺商品详情页、订单详情等页面就会展示对应服务承诺',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $contract_list = $this->contract->getSellerShopContract(seller_shop_info()->shop_id);

        return view('shop.contract.list', compact('title', 'contract_list'));
    }

    /**
     * 申请加入
     *
     * @param Request $request
     * @return array
     */
    public function audit(Request $request)
    {
        $contract_id = $request->post('contract_id', 0);
        if (!$contract_id) {
            return result(-1, null, '参数错误');
        }
        // 检查是否存在
        $condition = [['contract_id', $contract_id],['shop_id', seller_shop_info()->shop_id]];
        if (ShopContract::where($condition)->count()) {
            // 存在 更新
            $ret = ShopContract::where($condition)->update(['status'=>1]);
        } else {
            // 不存在 新增
            $insert = [
                'contract_id' => $contract_id,
                'shop_id' => seller_shop_info()->shop_id,
            ];
            $ret = $this->shopContract->store($insert);
        }

        if ($ret === false) {
            return result(-1, null, '加入失败');
        }
        return result(0, null, '');
    }

    /**
     * 审核未通过 查看审核信息
     *
     * @param Request $request
     * @return array
     */
    public function auditInfo(Request $request)
    {
        $contract_id = $request->post('contract_id',0);
        $contract_info = ShopContract::where([['shop_id',seller_shop_info()->shop_id],['contract_id', $contract_id]])->first();
        $msg = $contract_info->remark;
        if (empty($contract_info->remark)) {
            $msg = '平台方未填写审核意见。';
        }

        return result(0, null, $msg);
    }

    /**
     * 退出保障服务
     *
     * @param Request $request
     * @return array
     */
    public function exit(Request $request)
    {
        $contract_id = $request->post('contract_id',0);
        $ret = ShopContract::where([['shop_id',seller_shop_info()->shop_id],['contract_id', $contract_id]])->delete();
        if ($ret === false) {
            return result(-1, null, '退出失败');
        }
        return result(0, null, '退出成功');
    }

}