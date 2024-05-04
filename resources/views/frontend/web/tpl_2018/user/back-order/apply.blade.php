@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">退款申请</li>
                </ul>
            </div>
            <div class="content-info">
                <div class="content-con">
                    <div class="imfor-info">
                        <table class="content-info-table" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="content-imfor">
                                    <div class="imfor-title">
                                        <h3>退款/退货商品</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt imfor-dt-spe">
                                                <a href="{{ route('pc_show_goods', ['goods_id' => $goods_info['goods_id']]) }}" title="查看商品详情" target="_blank" class="item-img">
                                                    <img src="{{ get_image_url($goods_info['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="" />
                                                </a>
                                            </div>
                                            <div class="imfor-dd color">
                                                <div class="item-name">
                                                    <a href="{{ route('pc_show_goods', ['goods_id' => $goods_info['goods_id']]) }}" title="查看商品详情" target="_blank">
                                                        <span>{{ $goods_info['goods_name'] }}</span>
                                                    </a>
                                                </div>
                                                @if(!empty($goods_info['spec_info']))
                                                    <div class="item-props">
                                                        <span class="sku">
                                                            @foreach(explode(' ', $goods_info['spec_info']) as $spec)
                                                                <span>{{ $spec }}</span>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                @endif

                                            </div>
                                        </li>
                                        <li class="separate-top">
                                            <div class="imfor-dt">单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：</div>
                                            <div class="imfor-dd">￥{{ $goods_info['goods_price'] }} * {{ $goods_info['goods_number'] }} (数量)</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</div>
                                            <div class="imfor-dd color">￥{{ $goods_info['refund_amount'] }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">商&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</div>
                                            <div class="imfor-dd imfor-short-dd imfor-customer-dd">
                                                <a href="{{ route('pc_shop_home', ['shop_id'=>$order_info['shop_id']]) }}" target="_blank" title="{{ $order_info['shop_name'] }}" class="btn-link">{{ $order_info['shop_name'] }}</a>

                                                {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                                                @if($order_info['customer_tool'] == 2)
                                                    <span class="ww-light">
                                                        <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                                                                <!-- s等于1时带文字，等于2时不带文字 -->
                                                        <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $order_info['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                                            <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $order_info['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                                            <span></span>
                                                        </a>

                                                    </span>
                                                @elseif($order_info['customer_tool'] == 1)
                                                <!-- s等于1时带文字，等于2时不带文字 -->
                                                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $order_info['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                                                        <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $order_info['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                                                        <span></span>
                                                    </a>
                                                @else{{--默认 平台客服--}}
                                                <a href='{{ $order_info['yikf_url'] ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                                                    <i class="iconfont">&#xe6ad;</i>
                                                </a>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">物流信息：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/express?id={{ $order_info['order_id'] }}" target="_blank">发货物流信息</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="imfor-title imfor-title-top">
                                        <h3>订单信息</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt">订单编号：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/info?id={{ $order_info['order_id'] }}" title="查看订单详情" class="btn-link" target="_blank">{{ $order_info['order_sn'] }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</div>
                                            <div class="imfor-dd">{{ $order_info['shipping_fee_format'] }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</div>
                                            <div class="imfor-dd color">{{ $order_info['order_amount_format'] }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">成交时间：</div>
                                            <div class="imfor-dd">{{ format_time($order_info['pay_time'])  }}</div>
                                        </li>
                                    </ul>
                                </td>

                                <td class="content-status">
                                    <!-- 填写退货、退款申请 _start -->
                                    <div class="refund-return-info">
                                        <div class="refund-return-tab">

                                            <a class="@if($back_type == 1){{ 'active' }}@endif" href="/user/back/apply.html?id={{ $order_info['order_id'] }}&record_id={{ $record_id }}&gid={{ $gid }}&sid={{ $sid }}&back_type=1">仅退款</a>

                                            <a class="@if($back_type == 2){{ 'active' }}@endif" href="/user/back/apply.html?id={{ $order_info['order_id'] }}&record_id={{ $record_id }}&gid={{ $gid }}&sid={{ $sid }}&back_type=2">退货退款</a>

                                        </div>

                                        <div>
                                            <form id="BackOrder" class="form-horizontal" name="BackOrder" action="/user/back/apply.html?id={{ $order_info['order_id'] }}&amp;record_id={{ $record_id }}&amp;gid={{ $gid }}&amp;sid={{ $sid }}&amp;back_type={{ $back_type }}" method="post">

                                                @csrf
                                                <input type="hidden" id="backorder-back_type" class="form-control" name="BackOrder[back_type]" value="{{ $back_type }}">

                                                <div class="form-group form-group-spe" >
                                                    <label for="backorder-back_reason" class="input-left">
                                                        <span class="spark">*</span>
                                                        <span>退款原因：</span>
                                                    </label>
                                                    <div class="form-control-box">

                                                        <span class="select">
                                                            <select id="backorder-back_reason" class="form-control" name="BackOrder[back_reason]">
                                                                <option value="">请选择退款原因</option>
                                                                @foreach($refund_reason_list as $key=>$item)
                                                                <option value="{{ $key }}">{{ $item }}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>

                                                    </div>

                                                    <div class="invalid"></div>
                                                </div>


                                                <div class="form-group form-group-spe" >
                                                    <label for="backorder-back_number" class="input-left">
                                                        <span class="spark">*</span>
                                                        <span>退货数量：</span>
                                                    </label>
                                                    <div class="form-control-box">


                                                        <label class="control-label">{{ $goods_info['goods_number'] }}</label>
                                                        <input type="hidden" id="backorder-back_number" class="form-control" name="BackOrder[back_number]" value="{{ $goods_info['goods_number'] }}">


                                                    </div>

                                                    <div class="invalid"></div>
                                                </div>


                                                <div class="form-group form-group-spe" >
                                                    <label for="backorder-refund_money" class="input-left">
                                                        <span class="spark">*</span>
                                                        <span>退款金额：</span>
                                                    </label>
                                                    <div class="form-control-box">


                                                        <input type="text" id="backorder-refund_money" class="form-control ipt" name="BackOrder[refund_money]" value="{{ $goods_info['refund_amount'] }}" style="width: 120px;">


                                                    </div>

                                                    <div class="invalid"><span class="hint">本次退款金额最多为￥{{ $goods_info['refund_amount'] }}</span></div>
                                                </div>


                                                <div class="form-group form-group-spe" >
                                                    <label for="backorder-refund_type" class="input-left">
                                                        <span class="spark">*</span>
                                                        <span>退款方式：</span>
                                                    </label>
                                                    <div class="form-control-box">


                                                        <input type="hidden" name="BackOrder[refund_type]" value="0"><div id="backorder-refund_type" class="" name="BackOrder[refund_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="BackOrder[refund_type]" value="0"> 退回账户余额</label>
                                                            <label class="control-label cur-p m-r-10"><input type="radio" name="BackOrder[refund_type]" value="1" checked> 退回原支付方式</label></div>


                                                    </div>

                                                    <div class="invalid"></div>
                                                </div>


                                                <div class="form-group form-group-spe" >
                                                    <label for="backorder-back_desc" class="input-left">
                                                        <span class="spark">*</span>
                                                        <span>退款说明：</span>
                                                    </label>
                                                    <div class="form-control-box">


                                                        <textarea id="backorder-back_desc" class="form-control" name="BackOrder[back_desc]" rows="5" placeholder="建议您如实填写..."></textarea>


                                                    </div>

                                                    <div class="invalid"></div>
                                                </div>

                                                <div class="form-group form-group-spe">
                                                    <label class="input-left">
                                                        <span>上传凭证：</span>
                                                    </label>
                                                    <div id="img_" class="image_group" data-sku-id=""></div>
                                                    <input type="hidden" id="img_path_" name="img_path" value="">
                                                    <span class="hint">每张图片大小不超过2048KiB，最多上传3张图片，支持gif、jpg、png格式</span>
                                                </div>
                                                <div class="act">
                                                    <input id="btn_submit" class="btn" type="button" value="提交申请" />
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <!-- 填写退货、退款申请 _end -->
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 表单验证 -->
                <script type="text/javascript">

                </script>

                <div class="operat-tips">
                    <h2>常见问题</h2>
                    <h4>1.仅退款</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>申请条件：若您未收到货，或已收到货且与卖家达成一致不退货仅退款时，请选择“仅退款”选项</span>
                        </li>
                        <li>
                            <span>退款流程：1.申请退款 > 2.卖家同意退款申请 > 3.退款成功</span>
                        </li>
                    </ul>
                    <h4>2.退货、退款</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>申请条件：若为商品问题，或者不想要了且与卖家达成一致退货时，请选择“退货退款”选项，退货后请保留物流清单</span>
                        </li>
                        <li>
                            <span>退货流程：1.申请退货 > 2.卖家发送退货地址给买家 > 3.买家退货并填写退货物流信息 > 4.卖家确认收货，退货成功</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

{{--底部js--}}
@section('footer_js')
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/assets/d2eace91/js/yii.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>

        $().ready(function() {
            var validator = $("#BackOrder").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules([{"id": "backorder-back_sn", "name": "BackOrder[back_sn]", "attribute": "back_sn", "rules": {"required":true,"messages":{"required":"Back Sn不能为空。"}}},{"id": "backorder-site_id", "name": "BackOrder[site_id]", "attribute": "site_id", "rules": {"required":true,"messages":{"required":"站点ID不能为空。"}}},{"id": "backorder-shop_id", "name": "BackOrder[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "backorder-user_id", "name": "BackOrder[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"用户ID不能为空。"}}},{"id": "backorder-order_id", "name": "BackOrder[order_id]", "attribute": "order_id", "rules": {"required":true,"messages":{"required":"订单ID不能为空。"}}},{"id": "backorder-delivery_id", "name": "BackOrder[delivery_id]", "attribute": "delivery_id", "rules": {"required":true,"messages":{"required":"发货单ID不能为空。"}}},{"id": "backorder-record_id", "name": "BackOrder[record_id]", "attribute": "record_id", "rules": {"required":true,"messages":{"required":"订单商品记录编号不能为空。"}}},{"id": "backorder-goods_id", "name": "BackOrder[goods_id]", "attribute": "goods_id", "rules": {"required":true,"messages":{"required":"商品ID不能为空。"}}},{"id": "backorder-sku_id", "name": "BackOrder[sku_id]", "attribute": "sku_id", "rules": {"required":true,"messages":{"required":"商品属性ID不能为空。"}}},{"id": "backorder-back_number", "name": "BackOrder[back_number]", "attribute": "back_number", "rules": {"required":true,"messages":{"required":"退货数量不能为空。"}}},{"id": "backorder-add_time", "name": "BackOrder[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"添加时间不能为空。"}}},{"id": "backorder-refund_money", "name": "BackOrder[refund_money]", "attribute": "refund_money", "rules": {"required":true,"messages":{"required":"退款金额不能为空。"}}},{"id": "backorder-refund_type", "name": "BackOrder[refund_type]", "attribute": "refund_type", "rules": {"required":true,"messages":{"required":"退款方式不能为空。"}}},{"id": "backorder-back_type", "name": "BackOrder[back_type]", "attribute": "back_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Back Type必须是整数。"}}},{"id": "backorder-user_address", "name": "BackOrder[user_address]", "attribute": "user_address", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Address必须是整数。"}}},{"id": "backorder-site_id", "name": "BackOrder[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点ID必须是整数。"}}},{"id": "backorder-shop_id", "name": "BackOrder[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "backorder-user_id", "name": "BackOrder[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户ID必须是整数。"}}},{"id": "backorder-order_id", "name": "BackOrder[order_id]", "attribute": "order_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"订单ID必须是整数。"}}},{"id": "backorder-delivery_id", "name": "BackOrder[delivery_id]", "attribute": "delivery_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发货单ID必须是整数。"}}},{"id": "backorder-record_id", "name": "BackOrder[record_id]", "attribute": "record_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"订单商品记录编号必须是整数。"}}},{"id": "backorder-goods_id", "name": "BackOrder[goods_id]", "attribute": "goods_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品ID必须是整数。"}}},{"id": "backorder-sku_id", "name": "BackOrder[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品属性ID必须是整数。"}}},{"id": "backorder-back_number", "name": "BackOrder[back_number]", "attribute": "back_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退货数量必须是整数。"}}},{"id": "backorder-add_time", "name": "BackOrder[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "backorder-last_time", "name": "BackOrder[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"买家最后修改时间必须是整数。"}}},{"id": "backorder-dismiss_time", "name": "BackOrder[dismiss_time]", "attribute": "dismiss_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Dismiss Time必须是整数。"}}},{"id": "backorder-disabled_time", "name": "BackOrder[disabled_time]", "attribute": "disabled_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Disabled Time必须是整数。"}}},{"id": "backorder-back_status", "name": "BackOrder[back_status]", "attribute": "back_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Back Status必须是整数。"}}},{"id": "backorder-back_reason", "name": "BackOrder[back_reason]", "attribute": "back_reason", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退款原因必须是整数。"}}},{"id": "backorder-refund_type", "name": "BackOrder[refund_type]", "attribute": "refund_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退款方式必须是整数。"}}},{"id": "backorder-refund_status", "name": "BackOrder[refund_status]", "attribute": "refund_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Refund Status必须是整数。"}}},{"id": "backorder-send_time", "name": "BackOrder[send_time]", "attribute": "send_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Send Time必须是整数。"}}},{"id": "backorder-shipping_id", "name": "BackOrder[shipping_id]", "attribute": "shipping_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shipping ID必须是整数。"}}},{"id": "backorder-seller_reason", "name": "BackOrder[seller_reason]", "attribute": "seller_reason", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Seller Reason必须是整数。"}}},{"id": "backorder-seller_address", "name": "BackOrder[seller_address]", "attribute": "seller_address", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"卖家收货地址必须是整数。"}}},{"id": "backorder-is_after_sale", "name": "BackOrder[is_after_sale]", "attribute": "is_after_sale", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is After Sale必须是整数。"}}},{"id": "backorder-refund_money", "name": "BackOrder[refund_money]", "attribute": "refund_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"退款金额必须是一个数字。","decimal":"退款金额必须是一个不大于2位小数的数字。","min":"退款金额必须不小于0。"},"decimal":2,"min":0}},{"id": "backorder-back_sn", "name": "BackOrder[back_sn]", "attribute": "back_sn", "rules": {"string":true,"messages":{"string":"Back Sn必须是一条字符串。","maxlength":"Back Sn只能包含至多20个字符。"},"maxlength":20}},{"id": "backorder-back_desc", "name": "BackOrder[back_desc]", "attribute": "back_desc", "rules": {"string":true,"messages":{"string":"退款说明必须是一条字符串。","maxlength":"退款说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_img1", "name": "BackOrder[back_img1]", "attribute": "back_img1", "rules": {"string":true,"messages":{"string":"Back Img1必须是一条字符串。","maxlength":"Back Img1只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_img2", "name": "BackOrder[back_img2]", "attribute": "back_img2", "rules": {"string":true,"messages":{"string":"Back Img2必须是一条字符串。","maxlength":"Back Img2只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_img3", "name": "BackOrder[back_img3]", "attribute": "back_img3", "rules": {"string":true,"messages":{"string":"Back Img3必须是一条字符串。","maxlength":"Back Img3只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-shipping_code", "name": "BackOrder[shipping_code]", "attribute": "shipping_code", "rules": {"string":true,"messages":{"string":"Shipping Code必须是一条字符串。","maxlength":"Shipping Code只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-shipping_name", "name": "BackOrder[shipping_name]", "attribute": "shipping_name", "rules": {"string":true,"messages":{"string":"Shipping Name必须是一条字符串。","maxlength":"Shipping Name只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-shipping_sn", "name": "BackOrder[shipping_sn]", "attribute": "shipping_sn", "rules": {"string":true,"messages":{"string":"Shipping Sn必须是一条字符串。","maxlength":"Shipping Sn只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_desc", "name": "BackOrder[seller_desc]", "attribute": "seller_desc", "rules": {"string":true,"messages":{"string":"退货说明必须是一条字符串。","maxlength":"退货说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_img1", "name": "BackOrder[seller_img1]", "attribute": "seller_img1", "rules": {"string":true,"messages":{"string":"Seller Img1必须是一条字符串。","maxlength":"Seller Img1只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_img2", "name": "BackOrder[seller_img2]", "attribute": "seller_img2", "rules": {"string":true,"messages":{"string":"Seller Img2必须是一条字符串。","maxlength":"Seller Img2只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_img3", "name": "BackOrder[seller_img3]", "attribute": "seller_img3", "rules": {"string":true,"messages":{"string":"Seller Img3必须是一条字符串。","maxlength":"Seller Img3只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-exchange_desc", "name": "BackOrder[exchange_desc]", "attribute": "exchange_desc", "rules": {"string":true,"messages":{"string":"换货说明必须是一条字符串。","maxlength":"换货说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-repair_desc", "name": "BackOrder[repair_desc]", "attribute": "repair_desc", "rules": {"string":true,"messages":{"string":"维修说明必须是一条字符串。","maxlength":"维修说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_reason", "name": "BackOrder[back_reason]", "attribute": "back_reason", "rules": {"required":true,"messages":{"required":"退款原因不能为空。"}}},{"id": "backorder-back_desc", "name": "BackOrder[back_desc]", "attribute": "back_desc", "rules": {"required":true,"messages":{"required":"退款说明不能为空。"}}},{"id": "backorder-back_number", "name": "BackOrder[back_number]", "attribute": "back_number", "rules": {"compare":{"operator":"<=","type":"string","compareValue":3,"skipOnEmpty":1},"messages":{"compare":"退货数量的值必须小于或等于\"3\"。"}}},{"id": "backorder-refund_money", "name": "BackOrder[refund_money]", "attribute": "refund_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"退款金额必须是一个数字。","min":"退款金额必须不小于0。","max":"本次退款金额最多为￥{{ $goods_info['refund_amount'] }}"},"min":0,"max":{{ $goods_info['refund_amount'] }}}},]);
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                var text = $("#text").html();
                if (text == '尚未有换货地址') {
                    $.msg('请选择换货收货地址！');
                    return;
                }

                //加载提示
                $.loading.start();
                $("#BackOrder").submit();
            });

            var imgpath="";
            $(".image_group").each(function(){
                var sku_id = $(this).data("sku-id");
                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 3,
                    values: ["","",""],
                    callback: function(data){

                        $("#img_path_"+sku_id).val(this.values);

                    },
                    remove: function(value, values){
                        $("#img_path_"+sku_id).val(this.values);
                    },
                    change: function(value, values){
                        $("#img_path_"+sku_id).val(this.values);
                    }
                });
            });


        });

        function _change(type)
        {
            $("#backorder-back_type").val(type);

            var number = $("#backorder-back_number").val();
            if (type == 1 && number.length == 0)
            {
                $("#backorder-back_number").val(1);
            }
        }

        //
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function() {
        })
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
    </script>
@stop
