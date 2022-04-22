<?php

namespace app\Modules\Backend\Http\Controllers\Mall;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\PaymentRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class PaymentController extends Backend
{
//    private $title;

    private $links = [
        ['url' => 'mall/payment/list', 'text' => '列表'],
        ['url' => 'mall/payment/config-payment', 'text' => '配置支付方式'],
    ];


    protected $payment;
    protected $tools;

    public function __construct()
    {
        parent::__construct();

        $this->payment = new PaymentRepository();
        $this->tools = new ToolsRepository();
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '支付设置 - '.$title;

        $action_span = [];
        $explain_panel = [
            '商品结算时，默认选中的支付方式是第三方支付方式中的其中一个，不包括货到付款和余额支付，货到付款是受商品影响决定是否展示，余额支付受账户是否有余额影响决定是否展示。',
            'pc端支付方式支持：支付宝、银联支付、微信支付、货到付款、余额支付。',
            'wap端支付方式支持：支付宝、银联支付、货到付款、余额支付。',
            '微信端支付方式支持：微信支付、支付宝、银联支付、货到付款、余额支付。',
            'App端支付方式支持：支付宝、银联支付、APP微信支付、货到付款、余额支付。',
            'pc端结算时默认选中的支付方式是排在第一位置的支付方式，此位置受排序影响，排序越小，越优先展示。',
            '微信端默认选中的支付方式是微信支付，如果未开启微信支付，则排在第一位置的支付方式为默认支付方式，此位置受排序影响，排序越小，越优先展示。',
            'wap端默认选中的支付方式是除微信支付外，排在第一位置的支付方式，此位置受排序影响，排序越小，越优先展示。',
            'APP端默认选中的支付方式是微信支付，如果未开启微信支付，则排在第一位置的支付方式是默认支付方式，此位置受排序影响，排序越小，越优先展示。',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block
        $this->sublink($this->links, 'list', '', '', 'config-payment');

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['pay_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'pay_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'limit' => 0
        ];

        list($list, $total) = $this->payment->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('mall.payment.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('mall.payment.list', compact('title', 'list', 'pageHtml'));
    }


    public function configPayment(Request $request)
    {
        $title = '配置支付方式';

        $id = $request->get('pay_id', 0);
        $info = $this->payment->getById($id);
        $info->pay_config = unserialize($info->pay_config);
        view()->share('info', $info);

//        dd($info);
        $this->sublink($this->links, 'config-payment');

        $fixed_title = '支付设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回支付方式列表'
            ]
        ];
        $explain_panel = [
            '前三项为PC端和微商城端配置信息。商家私钥为APP配置信息，未填写情况下不会影响PC端及微商城端支付宝支付功能',
            '商家私钥需根据每个成交客户生成，请向APP售后人员索要该信息',
            'APP端实现支付宝支付，需去支付宝商家后台申请开通“APP支付”，然后配置支付宝秘钥'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block


        return view('mall.payment.config-payment', compact('title'));
    }

    public function saveData(Request $request)
    {
        $post = $request->post();

        $pay_name = $post['pay_name'];
        $pay_type = $post['pay_type'];
        $pay_config = [];
//        dd($post);
        foreach ($pay_name as $key=>$item) {
            if ($pay_type[$key] == 'file-button') {
                // todo 如果是文件上传 处理文件上传
                $filename = $request->post($item, 'name');
                $storePath = 'backend/gallery'; // 需要判断是平台方 还是店铺 站点
                $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

                if (isset($uploadRes['error'])) {
                    // 上传出错
                    return result(-1, '', $uploadRes['error']);
                }
                $post[$item] = $uploadRes['data']['path'];
            }
            $pay_config[] = [
                'pay_name' => $item,
                'pay_type' => $pay_type[$key],
                'config_value' => $post[$item]
            ];
        }

        $update = [
            'pay_id' => $post['pay_id'],
            'pay_code' => $post['pay_code'],
            'pay_config' => serialize($pay_config),
        ];

        // 编辑
        $ret = $this->payment->update($post['pay_id'], $update);
        $msg = '配置支付方式';

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/mall/payment/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/mall/payment/list');
    }

    public function setIsEnable(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->payment->changeEnable($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editPaymentInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'pay_sort') {
            $value = intval($value);
        }
        $ret = $this->payment->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }


}