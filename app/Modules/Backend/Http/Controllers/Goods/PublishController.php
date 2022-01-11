<?php

namespace app\Modules\Backend\Http\Controllers\Goods;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublishController extends Backend
{

    private $links = [];

    protected $goods;

    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();


    }

    public function IsNew(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->goods->changeState($id, 'is_new');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function IsBest(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->goods->changeState($id, 'is_best');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function IsHot(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->goods->changeState($id, 'is_hot');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 商品违规下架
     * goods_status -> 2 违规下架
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function illegal(Request $request)
    {
        $id = $request->get('id',0);
        $uuid = make_uuid();
        $goods_info = $this->goods->getById($id);


        if ($request->method() == 'POST') {
            $update = [
                'goods_reason' => $request->post('reason'),
                'goods_audit' => 2, // 审核不通过
                'goods_status' => 2 // 违规下架
            ];
            $ret = $this->goods->update($id, $update);
            if ($ret === false) {
                // 失败
                return result(-1, null, '商品下架失败');
            }
            // 成功
            admin_log('下架商品。ID：'.$id);
            return result(0, null, '商品下架成功！');
        }

        $render = view('goods.publish.illegal', compact('goods_info', 'uuid'))->render();
        return result(0, $render);
    }

    /**
     * 批量设置商品违规下架
     * goods_status -> 2 违规下架
     *
     * @param Request $request
     * @return array
     */
    public function batchIllegal(Request $request)
    {
        $ids = $request->get('ids');
        $update = [
            'goods_audit' => 2, // 审核不通过
            'goods_status' => 2 // 违规下架
        ];
        $ret = $this->goods->batchUpdate('goods_id', $ids, $update);
        if ($ret === false) {
            // 失败
            return result(-1, null, '商品批量下架失败');
        }
        // 成功
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        admin_log('批量下架商品。ID：'.$ids);
        return result(0, null, '商品批量下架成功！');
    }

    /**
     * 上架商品
     *
     * @param Request $request
     * @return array
     */
    public function onsale(Request $request)
    {
        $id = $request->get('id',0);
        $update = [
            'goods_audit' => 1, // 审核通过
            'goods_status' => 1 // 商品状态 已上架
        ];
        $ret = $this->goods->update($id, $update);
        if ($ret === false) {
            // 失败
            return result(-1, null, '商品上架失败');
        }
        // 成功
        admin_log('上架商品。ID：'.$id);
        return result(0, null, '商品上架成功！');
    }

    /**
     * 批量上架商品
     *
     * @param Request $request
     * @return array
     */
    public function batchOnsale(Request $request)
    {
        $ids = $request->get('ids');
        $update = [
            'goods_audit' => 1, // 审核通过
            'goods_status' => 1 // 商品状态 已上架
        ];
        $ret = $this->goods->batchUpdate('goods_id', $ids, $update);
        if ($ret === false) {
            // 失败
            return result(-1, null, '商品批量上架失败');
        }
        // 成功
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        admin_log('批量上架商品。ID：'.$ids);
        return result(0, null, '商品批量上架成功！');
    }

    /**
     * 审核商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function audit(Request $request)
    {
        $ids = $request->get('ids', '');
        $uuid = make_uuid();

        if ($request->method() == 'POST') {
            $is_pass = $request->post('is_pass');
            $reason = $request->post('reason');
            $ids = $request->post('ids');
            $ids = explode(',', $ids);
            $update = [];
            if ($is_pass == 1) {
                $update = [
                    'goods_audit' => 1 // 审核通过
                ];
            } elseif ($is_pass == 0) {
                $update = [
                    'goods_audit' => 2, // 审核不通过
                    'goods_reason' => $reason
                ];
            }

            $ret = $this->goods->batchUpdate('goods_id', $ids, $update);
            if ($ret === false) {
                // 失败
                return result(-1, null, '批量审核失败');
            }
            // 成功
            if (is_array($ids)) {
                $ids = implode(',', $ids);
            }
            admin_log('批量审核商品。ID：'.$ids);
            return result(0, null, '批量审核成功！');
        }


        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        $render = view('goods.publish.audit', compact('ids', 'uuid'))->render();
        return result(0, $render);
    }
}