@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
@stop

@section('header_js')
    <script src="/assets/d2eace91/js/yii.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180027"></script>
    <script src="/js/common.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180027"></script>
    <script src="/js/user.js?v=20180027"></script>
    <script src="/js/address.js?v=20180027"></script>
    <script src="/js/center.js?v=20180027"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20180027"></script>
@stop

@section('content')

    <header>
        <div class="tab_nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
                </div>
                <div class="header-middle">退款申请</div>
                <div class="header-right">
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0)"></a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </header>


    <div class="con">

        <form id="BackOrder" class="form-horizontal" name="BackOrder" action="/user/back/apply.html?id={{ $order_info['order_id'] }}&amp;record_id={{ $record_id }}&amp;gid={{ $gid }}&amp;sid={{ $sid }}" method="post">
            @csrf
            <input type="hidden" id="backorder-back_type" class="form-control" name="BackOrder[back_type]" value="{{ $back_type }}">
            <ul class="back-box">
                <li class="ub">
                    <div class="back-li-l">
                        <em class="color">*</em>
                        申请服务
                    </div>
                    <div class="ub-f1 back-li-r down-arrow SZY-BACK-TYPE">仅退款</div>
                </li>

                <li class="ub hide" id="con_back_number">
                    <div class="back-li-l">
                        <em class="color">*</em>
                        退款数量
                    </div>
                    <div class="ub-f1 back-li-r">


                        {{ $goods_info['goods_number'] }} <input type="hidden" id="backorder-back_number" class="form-control" name="BackOrder[back_number]" value="{{ $goods_info['goods_number'] }}">


                    </div>
                </li>

                <li class="ub">
                    <div class="back-li-l">
                        <em class="color">*</em>
                        退款原因
                    </div>
                    <input type="hidden" id="backorder-back_reason" class="form-control" name="BackOrder[back_reason]">
                    <div class="ub-f1 back-li-r down-arrow SZY-BACK-REASON">请选择退款原因</div>
                </li>
                <li class="ub">
                    <div class="back-li-l">
                        <em class="color">*</em>
                        退款金额
                    </div>
                    <div class="ub-f1 back-li-r">



                        <input type="text" id="backorder-refund_money" class="form-control" name="BackOrder[refund_money]" value="{{ $goods_info['refund_amount'] }}" readonly>



                    </div>
                </li>
                <li class="ub">
                    <div class="back-li-l">
                        <em class="color">*</em>
                        退款方式
                    </div>
                    <div class="ub-f1 back-li-r down-arrow SZY-REFUND-TYPE">

                        退回原支付方式

                    </div>
                    <input type="hidden" id="backorder-refund_type" class="form-control" name="BackOrder[refund_type]" value="1">
                </li>
                <li class="ub">
                    <div class="back-li-l">
                        <em class="color">*</em>
                        退款说明
                    </div>
                    <div class="ub-f1 back-li-r"><textarea id="backorder-back_desc" class="form-control" name="BackOrder[back_desc]" rows="3" placeholder="建议您如实填写..."></textarea></div>
                </li>

                <li class="back-imgs clearfix">
                    <div class="image-container">
                    </div>
                    <input type="hidden" id="img_path_" name="img_path" value="">

                    <div class="img-uploading-list img-uploading " data-sku-id="">
                        <h4>
                            <i class="iconfont">&#xe635;</i>
                        </h4>
                        <p>上传凭证</p>
                        <p>（最多三张）</p>
                    </div>
                </li>
            </ul>
        </form>

    </div>
    <div style=" height:50px; line-height:50px;"></div>
    <div class="list-footer">
        <a href="javascript:void(0)" id="btn_submit">提交申请</a>
    </div>

    <div class="mask-div"></div>
    <!--服务类型选择弹出层-->
    <div class="prompt-choose hide back-type-con">
        <div class="prompt-choose-title">请选择服务类型</div>
        <ul class="prompt-choose-reason">
            <li class="seleted" data-url="/user/back/apply.html?id={{ $order_info['order_id'] }}&record_id={{ $record_id }}&gid={{ $gid }}&sid={{ $sid }}&back_type=1">仅退款</li>
        </ul>
        <div class="prompt-choose-bottom pos-r">
            <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
            <button type="button" class="btn btn-primary" id="btn_submit1">确定</button>
        </div>
    </div>

    <!--退款方式弹出层-->
    <div class="prompt-choose hide back-refund-con">
        <div class="prompt-choose-title">请选择退款方式</div>
        <ul class="prompt-choose-reason">
            <li data-val='0' class="">退回账户余额</li>
            <li data-val='1' class="seleted">退回原支付方式</li>
        </ul>
        <div class="prompt-choose-bottom pos-r">
            <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
            <button type="button" class="btn btn-primary" id="btn_submit2">确定</button>
        </div>
    </div>


    <!--退款理由弹出层-->
    <div class="prompt-choose hide back-reason-con">
        <div class="prompt-choose-title">请选择退款原因</div>
        <ul class="prompt-choose-reason">
            @foreach($refund_reason_list as $key=>$item)
                <li data-val='{{ $key }}' class="">{{ $item }}</li>
            @endforeach
        </ul>
        <div class="prompt-choose-bottom pos-r">
            <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
            <button type="button" class="btn btn-primary" id="btn_submit3">确定</button>
        </div>
    </div>

    <!--换货原因-->
    <div class="prompt-choose hide back-exchange-con">
        <div class="prompt-choose-title">请选择换货原因</div>
        <ul class="prompt-choose-reason">
            @foreach($exchange_reason_list as $item)
                <li data-val='{{ $item }}' class="">{{ $item }}</li>
            @endforeach
        </ul>
        <div class="prompt-choose-bottom pos-r">
            <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
            <button type="button" class="btn btn-primary" id="btn_submit4">确定</button>
        </div>
    </div>

    <!--维修原因-->
    <div class="prompt-choose hide back-repair-con">
        <div class="prompt-choose-title">请选择维修原因</div>
        <ul class="prompt-choose-reason">
            @foreach($format_repair_reason as $item)
                <li data-val='{{ $item }}' class="">{{ $item }}</li>
            @endforeach
        </ul>
        <div class="prompt-choose-bottom pos-r">
            <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
            <button type="button" class="btn btn-primary" id="btn_submit5">确定</button>
        </div>
    </div>

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <script src="/js/image_upload/lrz.all.bundle.js?v=20180027"></script>
    <script type="text/javascript">
        var scrollheight = 0;
        function close_choose() {
            $(".mask-div").hide();
            $('.prompt-choose').addClass('hide');
            $("body").css("top","auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);

        }
        $().ready(function() {

            var validator = $("#BackOrder").validate();
            $.validator.addRules([{"id": "backorder-back_sn", "name": "BackOrder[back_sn]", "attribute": "back_sn", "rules": {"required":true,"messages":{"required":"Back Sn不能为空。"}}},{"id": "backorder-site_id", "name": "BackOrder[site_id]", "attribute": "site_id", "rules": {"required":true,"messages":{"required":"站点ID不能为空。"}}},{"id": "backorder-shop_id", "name": "BackOrder[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "backorder-user_id", "name": "BackOrder[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"用户ID不能为空。"}}},{"id": "backorder-order_id", "name": "BackOrder[order_id]", "attribute": "order_id", "rules": {"required":true,"messages":{"required":"订单ID不能为空。"}}},{"id": "backorder-delivery_id", "name": "BackOrder[delivery_id]", "attribute": "delivery_id", "rules": {"required":true,"messages":{"required":"发货单ID不能为空。"}}},{"id": "backorder-record_id", "name": "BackOrder[record_id]", "attribute": "record_id", "rules": {"required":true,"messages":{"required":"订单商品记录编号不能为空。"}}},{"id": "backorder-goods_id", "name": "BackOrder[goods_id]", "attribute": "goods_id", "rules": {"required":true,"messages":{"required":"商品ID不能为空。"}}},{"id": "backorder-sku_id", "name": "BackOrder[sku_id]", "attribute": "sku_id", "rules": {"required":true,"messages":{"required":"商品属性ID不能为空。"}}},{"id": "backorder-back_number", "name": "BackOrder[back_number]", "attribute": "back_number", "rules": {"required":true,"messages":{"required":"退货数量不能为空。"}}},{"id": "backorder-add_time", "name": "BackOrder[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"添加时间不能为空。"}}},{"id": "backorder-refund_money", "name": "BackOrder[refund_money]", "attribute": "refund_money", "rules": {"required":true,"messages":{"required":"退款金额不能为空。"}}},{"id": "backorder-refund_type", "name": "BackOrder[refund_type]", "attribute": "refund_type", "rules": {"required":true,"messages":{"required":"退款方式不能为空。"}}},{"id": "backorder-back_type", "name": "BackOrder[back_type]", "attribute": "back_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Back Type必须是整数。"}}},{"id": "backorder-user_address", "name": "BackOrder[user_address]", "attribute": "user_address", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"User Address必须是整数。"}}},{"id": "backorder-site_id", "name": "BackOrder[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点ID必须是整数。"}}},{"id": "backorder-shop_id", "name": "BackOrder[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "backorder-user_id", "name": "BackOrder[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户ID必须是整数。"}}},{"id": "backorder-order_id", "name": "BackOrder[order_id]", "attribute": "order_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"订单ID必须是整数。"}}},{"id": "backorder-delivery_id", "name": "BackOrder[delivery_id]", "attribute": "delivery_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发货单ID必须是整数。"}}},{"id": "backorder-record_id", "name": "BackOrder[record_id]", "attribute": "record_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"订单商品记录编号必须是整数。"}}},{"id": "backorder-goods_id", "name": "BackOrder[goods_id]", "attribute": "goods_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品ID必须是整数。"}}},{"id": "backorder-sku_id", "name": "BackOrder[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品属性ID必须是整数。"}}},{"id": "backorder-back_number", "name": "BackOrder[back_number]", "attribute": "back_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退货数量必须是整数。"}}},{"id": "backorder-add_time", "name": "BackOrder[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"添加时间必须是整数。"}}},{"id": "backorder-last_time", "name": "BackOrder[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"买家最后修改时间必须是整数。"}}},{"id": "backorder-dismiss_time", "name": "BackOrder[dismiss_time]", "attribute": "dismiss_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Dismiss Time必须是整数。"}}},{"id": "backorder-disabled_time", "name": "BackOrder[disabled_time]", "attribute": "disabled_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Disabled Time必须是整数。"}}},{"id": "backorder-back_status", "name": "BackOrder[back_status]", "attribute": "back_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Back Status必须是整数。"}}},{"id": "backorder-back_reason", "name": "BackOrder[back_reason]", "attribute": "back_reason", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退款原因必须是整数。"}}},{"id": "backorder-refund_type", "name": "BackOrder[refund_type]", "attribute": "refund_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"退款方式必须是整数。"}}},{"id": "backorder-refund_status", "name": "BackOrder[refund_status]", "attribute": "refund_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Refund Status必须是整数。"}}},{"id": "backorder-send_time", "name": "BackOrder[send_time]", "attribute": "send_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Send Time必须是整数。"}}},{"id": "backorder-shipping_id", "name": "BackOrder[shipping_id]", "attribute": "shipping_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shipping ID必须是整数。"}}},{"id": "backorder-seller_reason", "name": "BackOrder[seller_reason]", "attribute": "seller_reason", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Seller Reason必须是整数。"}}},{"id": "backorder-seller_address", "name": "BackOrder[seller_address]", "attribute": "seller_address", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"卖家收货地址必须是整数。"}}},{"id": "backorder-is_after_sale", "name": "BackOrder[is_after_sale]", "attribute": "is_after_sale", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is After Sale必须是整数。"}}},{"id": "backorder-refund_money", "name": "BackOrder[refund_money]", "attribute": "refund_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"退款金额必须是一个数字。","decimal":"退款金额必须是一个不大于2位小数的数字。","min":"退款金额必须不小于0。"},"decimal":2,"min":0}},{"id": "backorder-back_sn", "name": "BackOrder[back_sn]", "attribute": "back_sn", "rules": {"string":true,"messages":{"string":"Back Sn必须是一条字符串。","maxlength":"Back Sn只能包含至多20个字符。"},"maxlength":20}},{"id": "backorder-back_desc", "name": "BackOrder[back_desc]", "attribute": "back_desc", "rules": {"string":true,"messages":{"string":"退款说明必须是一条字符串。","maxlength":"退款说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_img1", "name": "BackOrder[back_img1]", "attribute": "back_img1", "rules": {"string":true,"messages":{"string":"Back Img1必须是一条字符串。","maxlength":"Back Img1只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_img2", "name": "BackOrder[back_img2]", "attribute": "back_img2", "rules": {"string":true,"messages":{"string":"Back Img2必须是一条字符串。","maxlength":"Back Img2只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_img3", "name": "BackOrder[back_img3]", "attribute": "back_img3", "rules": {"string":true,"messages":{"string":"Back Img3必须是一条字符串。","maxlength":"Back Img3只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-shipping_code", "name": "BackOrder[shipping_code]", "attribute": "shipping_code", "rules": {"string":true,"messages":{"string":"Shipping Code必须是一条字符串。","maxlength":"Shipping Code只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-shipping_name", "name": "BackOrder[shipping_name]", "attribute": "shipping_name", "rules": {"string":true,"messages":{"string":"Shipping Name必须是一条字符串。","maxlength":"Shipping Name只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-shipping_sn", "name": "BackOrder[shipping_sn]", "attribute": "shipping_sn", "rules": {"string":true,"messages":{"string":"Shipping Sn必须是一条字符串。","maxlength":"Shipping Sn只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_desc", "name": "BackOrder[seller_desc]", "attribute": "seller_desc", "rules": {"string":true,"messages":{"string":"退货说明必须是一条字符串。","maxlength":"退货说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_img1", "name": "BackOrder[seller_img1]", "attribute": "seller_img1", "rules": {"string":true,"messages":{"string":"Seller Img1必须是一条字符串。","maxlength":"Seller Img1只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_img2", "name": "BackOrder[seller_img2]", "attribute": "seller_img2", "rules": {"string":true,"messages":{"string":"Seller Img2必须是一条字符串。","maxlength":"Seller Img2只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-seller_img3", "name": "BackOrder[seller_img3]", "attribute": "seller_img3", "rules": {"string":true,"messages":{"string":"Seller Img3必须是一条字符串。","maxlength":"Seller Img3只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-exchange_desc", "name": "BackOrder[exchange_desc]", "attribute": "exchange_desc", "rules": {"string":true,"messages":{"string":"换货说明必须是一条字符串。","maxlength":"换货说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-repair_desc", "name": "BackOrder[repair_desc]", "attribute": "repair_desc", "rules": {"string":true,"messages":{"string":"维修说明必须是一条字符串。","maxlength":"维修说明只能包含至多255个字符。"},"maxlength":255}},{"id": "backorder-back_reason", "name": "BackOrder[back_reason]", "attribute": "back_reason", "rules": {"required":true,"messages":{"required":"退款原因不能为空。"}}},{"id": "backorder-back_desc", "name": "BackOrder[back_desc]", "attribute": "back_desc", "rules": {"required":true,"messages":{"required":"退款说明不能为空。"}}},{"id": "backorder-back_number", "name": "BackOrder[back_number]", "attribute": "back_number", "rules": {"compare":{"operator":"<=","type":"string","compareValue":1,"skipOnEmpty":1},"messages":{"compare":"退货数量的值必须小于或等于\"1\"。"}}},{"id": "backorder-refund_money", "name": "BackOrder[refund_money]", "attribute": "refund_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"退款金额必须是一个数字。","min":"退款金额必须不小于0。","max":"本次退款金额最多为￥{{ $goods_info['refund_amount'] }}"},"min":0,"max":{{ $goods_info['refund_amount'] }} }},]);
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    $.msg($.trim(validator.errorList[0].message));
                    return;
                }
                //加载提示
                $.loading.start();
                $("#BackOrder").submit();
            });



            $(".mask-div").click(function(){
                close_choose();
            });
            $('.SZY-REFUND-TYPE').click(function(){
                $(".mask-div").show();
                $('.back-refund-con').removeClass('hide');
                var h = $('.back-refund-con').height(), top = $('.back-refund-con .prompt-choose-title').height(),bottom=$('.back-reason-con .prompt-choose-bottom').height();
                $('.back-refund-con .prompt-choose-reason').height(h-top-bottom-20 + 'px');
                $('.back-refund-con').css('margin-top',"-" + h/2+"px");
                scrollheight = $(document).scrollTop();
                var yScroll = $(document).scrollTop()-103;
                $("body").css("top", "-" + scrollheight + "px");
                $('.pop-up-content').css('margin-top',yScroll);
                $("body").css("top","-" + scrollheight+"px");
                $("body").addClass("visibly");
            });

            $('.SZY-EXCHANGE-REASON').click(function(){
                $(".mask-div").show();
                $('.back-exchange-con').removeClass('hide');
                var h = $('.back-exchange-con').height(), top = $('.back-exchange-con .prompt-choose-title').height(),bottom=$('.back-exchange-con .prompt-choose-bottom').height();
                $('.back-exchange-con .prompt-choose-reason').height(h-top-bottom-20 + 'px');
                $('.back-exchange-con').css('margin-top',"-" + h/2+"px");
                scrollheight = $(document).scrollTop();
                var yScroll = $(document).scrollTop()-103;
                $("body").css("top", "-" + scrollheight + "px");
                $('.pop-up-content').css('margin-top',yScroll);
                $("body").css("top","-" + scrollheight+"px");
                $("body").addClass("visibly");
            });

            $('.SZY-REPAIR-REASON').click(function(){
                $(".mask-div").show();
                $('.back-repair-con').removeClass('hide');
                var h = $('.back-repair-con').height(), top = $('.back-repair-con .prompt-choose-title').height(),bottom=$('.back-repair-con .prompt-choose-bottom').height();
                $('.back-repair-con .prompt-choose-reason').height(h-top-bottom-20 + 'px');
                $('.back-repair-con').css('margin-top',"-" + h/2+"px");
                scrollheight = $(document).scrollTop();
                var yScroll = $(document).scrollTop()-103;
                $("body").css("top", "-" + scrollheight + "px");
                $('.pop-up-content').css('margin-top',yScroll);
                $("body").css("top","-" + scrollheight+"px");
                $("body").addClass("visibly");
            });

            $('.SZY-BACK-REASON').click(function(){
                $(".mask-div").show();
                $('.back-reason-con').removeClass('hide');
                var h = $('.back-reason-con').height(), top = $('.back-reason-con .prompt-choose-title').height(),bottom=$('.back-reason-con .prompt-choose-bottom').height();
                $('.back-reason-con .prompt-choose-reason').height(h-top-bottom-20 + 'px');
                $('.back-reason-con').css('margin-top',"-" + h/2+"px");
                scrollheight = $(document).scrollTop();
                var yScroll = $(document).scrollTop()-103;
                $("body").css("top", "-" + scrollheight + "px");
                $('.pop-up-content').css('margin-top',yScroll);
                $("body").css("top","-" + scrollheight+"px");
                $("body").addClass("visibly");
            });

            $('.SZY-BACK-TYPE').click(function(){
                $(".mask-div").show();
                $('.back-type-con').removeClass('hide');
                var h = $('.back-type-con').height(), top = $('.back-type-con .prompt-choose-title').height(),bottom=$('.back-type-con .prompt-choose-bottom').height();
                $('.back-type-con').css('height','auto');
                var t=$('.prompt-choose-reason li').height();
                $('.back-type-con .prompt-choose-reason').css({
                    'min-height':+2*t+'px',
                    'overflow':'hidden'
                });
                $('.back-type-con').css('margin-top',"-" + h/2+"px");
                scrollheight = $(document).scrollTop();
                var yScroll = $(document).scrollTop()-103;
                $("body").css("top", "-" + scrollheight + "px");
                $('.pop-up-content').css('margin-top',yScroll);
                $("body").css("top","-" + scrollheight+"px");
                $("body").addClass("visibly");
            });

            $('.SZY-EXCHANGE-REASON')


            $('.back-type-con li').click(function(){
                $(this).addClass('seleted').siblings().removeClass('seleted');
            });

            $('.back-type-con').find('#btn_submit1').click(function(){
                if(!$('.back-type-con li').hasClass('seleted')){
                    $.msg('请选择服务类型');
                    return;
                }
                $.each($('.back-type-con li'),function(i,v){
                    if($(v).hasClass('seleted')){
                        if($(v).data('url') != ''){
                            $.go($(v).data('url'));
                        }
                    }
                });
                close_choose();
            });


            $('.back-reason-con li').click(function(){
                $(this).addClass('seleted').siblings().removeClass('seleted');
            });
            $('.back-reason-con').find('#btn_submit3').click(function(){
                if(!$('.back-reason-con li').hasClass('seleted')){
                    $.msg('请选择退款原因');
                    return;
                }
                $.each($('.back-reason-con li'),function(i,v){
                    if($(v).hasClass('seleted')){
                        $('#backorder-back_reason').val($(v).data('val'));
                        $('.SZY-BACK-REASON').text($(v).text());
                    }
                });
                close_choose();
            });


            $('.back-exchange-con li').click(function(){
                $(this).addClass('seleted').siblings().removeClass('seleted');
            });

            $('.back-exchange-con').find('#btn_submit4').click(function(){
                if(!$('.back-exchange-con li').hasClass('seleted')){
                    $.msg('请选择换货原因');
                    return;
                }
                $.each($('.back-exchange-con li'),function(i,v){
                    if($(v).hasClass('seleted')){
                        $('#backorder-exchange_reason').val($(v).data('val'));
                        $('.SZY-EXCHANGE-REASON').text($(v).text());
                    }
                });
                close_choose();
            });


            $('.back-repair-con li').click(function(){
                $(this).addClass('seleted').siblings().removeClass('seleted');
            });
            $('.back-repair-con').find('#btn_submit5').click(function(){
                if(!$('.back-repair-con li').hasClass('seleted')){
                    $.msg('请选择维修原因');
                    return;
                }
                $.each($('.back-repair-con li'),function(i,v){
                    if($(v).hasClass('seleted')){
                        $('#backorder-repair_reason').val($(v).data('val'));
                        $('.SZY-REPAIR-REASON').text($(v).text());
                    }
                });
                close_choose();
            });

            $('.back-refund-con li').click(function(){
                $(this).addClass('seleted').siblings().removeClass('seleted');
            });

            $('.back-refund-con').find('#btn_submit2').click(function(){
                if(!$('.back-refund-con li').hasClass('seleted')){
                    $.msg('请选择退款方式');
                    return;
                }
                $.each($('.back-refund-con li'),function(i,v){
                    if($(v).hasClass('seleted')){
                        $('#backorder-refund_type').val($(v).data('val'));
                        $('.SZY-REFUND-TYPE').text($(v).text());
                    }
                });
                close_choose();
            });


            //图片上传
            $("body").on('click', '.img-uploading', function() {
                var obj = $(this);
                var sku_id = obj.data('sku-id');
                var image_show = obj.parent('li').find('.image-container');
                $.localResizeIMG({
                    callback: function(image) {
                        image_show.append("<div class='img-uploading-list'><img src='"+image.data.url+"'><span class='img-del'></span><input type='hidden' value='"+image.data.path+"'></div>");
                        var imgpath = [];
                        $.each(image_show.find('input'), function(i, v) {
                            imgpath.push(v.value);
                        });
                        $("#img_path_"+sku_id).val(imgpath.join(','));
                        $.msg(image.message);
                        if (image_show.find('img').size() >= 3) {
                            obj.addClass('hide');
                        }
                    }
                });
            });

            $('body').on('click','.img-del',function(){
                var $this = $(this);
                $this.parent().remove();
                var imgpath = [];
                $.each($('.image-container').find('input'), function(i, v) {
                    imgpath.push(v.value);
                });
                $("#img_path_").val(imgpath.join(','));
                if($('.image-container').find('img').size() < 3){
                    $('.img-uploading').removeClass('hide');
                }
            });

        });
    </script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180027"></script>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
  
@stop
