{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
    <style type="text/css">
        #map_canvas {
            width: 100%;
            height: 440px;
        }
        #result {
            width: 100%
        }
    </style>
@stop

{{--content--}}
@section('content')

    <!--第一步-->
    <div class="step-title">
        <em>第一步</em>
        确认收货信息及交易详情
    </div>
    <div class="table-responsive deliver">
        <table class="table table-bordered">
            <colgroup>
                <!--商品信息-->
                <col class="w500">
                </col>
                <!--备注信息-->
                <col class="w500">
                </col>
            </colgroup>
            <thead>
            <!--订单编号-->
            <tr class="order-hd">
                <th colspan="20">
                    <div class="basic-info">
                        <span class="order-num m-l-10">订单编号：{{ $order_info['order_sn'] }}</span>
                        <span class="deal-time">下单时间：{{ format_time($order_info['add_time']) }}</span>
                        <span class="order-source">订单来源：{{ $order_info['order_from_format'] }}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <!--订单内容-->
            @foreach($delivery_info['goods_list'] as $item)
            <tr class="order-item">
                <td class="item">
                    <div class="pic-info">
                        <a href="{{ route('pc_show_sku_goods', ['sku_id'=>$item['sku_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                            <img src="{{ $item['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情"/>
                        </a>
                    </div>
                    <div class="txt-info">
                        <div class="desc">
                            <a class="goods-name" href="{{ route('pc_show_goods', ['goods_id'=>$item['goods_id']]) }}" target="_blank" title="查看商品详情">
                                {{ $item['goods_name'] }}
                            </a>
                        </div>
                        <div class="props">
                                <span>
                                    <strong>{{ $item['goods_price'] }}</strong>
                                    x {{ $item['goods_number'] }}
                                </span>
                        </div>
                    </div>
                </td>
                <td class="remark" rowspan="1">
                    <dl>
                        <dt>买家选择：</dt>
                        <dd>{{ $order_info['shipping_type'] }} （免邮）</dd>
                    </dl>
                    <dl style="display: none">
                        <dt>备忘信息：</dt>
                        <dd>
                            <textarea class="form-control" rows="2" placeholder="您可以在此输入备忘信息（仅卖家自己可见）。"></textarea>
                        </dd>
                    </dl>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="messageBox address">
        <div class="address-info pull-left">
            <p class="m-b-5">
                <strong>买家收货信息：</strong>
                <span>{{ $order_info['region_name'] }} {{ $order_info['address'] }} ，{{ $order_info['consignee'] }}，{{ $order_info['tel'] }}</span>
            </p>
            <p>
                <strong>买家配送时间：</strong>
                <span>{{ $order_info['best_time'] }}</span>
            </p>
        </div>
        <a class="pull-right btn btn-primary btn-xs m-t-10 edit-order" data-id="{{ $delivery_info['delivery_id'] }}" data-type="address">
            <i class="fa fa-edit"></i>
            修改
        </a>
    </div>
    <!--第二步-->
    <div class="step-title m-t-30">
        <em>第二步</em>
        确认发货信息
    </div>
    <div class="messageBox">
        <div class="deliver-sell-info">
            <strong>我的发货信息：</strong>
            <span> {{ $delivery_info['region_name'] }} {{ $delivery_info['address'] }}， {{ $delivery_info['name'] }}， {{ $delivery_info['tel'] }} </span>
            <a class="pull-right btn btn-primary btn-xs edit-order" data-id="{{ $delivery_info['delivery_id'] }}" data-type="seller_address">
                <i class="fa fa-edit"></i>
                修改
            </a>
        </div>
    </div>
    <!--第三步-->
    <div class="step-title m-t-30">
        <em>第三步</em>
        选择物流服务
    </div>
    <div class="alert alert-info br-0">商城与物流系统成功对接后，您可以使用众包抢单和指派配送进行配送，如果未对接物流系统，您可选择无需物流和第三方物流进行配送。</div>
    <div id="logistics" class="tabmenu" >
        <ul class="tab">
            <li >
                <a href="#texpress3" data-toggle="tab">无需物流</a>
            </li>
            <li  class="active">
                <a href="#texpress4" data-toggle="tab">第三方物流</a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <!-- 众包 -->
        <!-- 未绑定跑腿公司 -->
        <!-- 众包 -->
        <div id="texpress1" class="tab-pane fade">
            <div class="explanation m-b-10">
                <div class="title explain-checkZoom" title="点击此处展开或收起">
                    <i class="fa fa-bullhorn"></i>
                    <h4>温馨提示</h4>
                </div>
                <ul class="explain-panel">
                    <li>
                        <span>使用众包，您需要确保您对接的物流系统中的商家账户余额中有足够的余额支付运费，如果余额不足，则无法使用众包。</span>
                    </li>
                    <li>
                        <span>运费走向：卖家在对接的物流系统中的商家账户中充值，或由商城平台方为卖家充值，快递员送达货品后，由物流方将运费快递员快递员</span>
                    </li>
                </ul>
            </div>
            <div class="table-content m-t-30">
                <form class="form-horizontal" onsubmit="return false;">
                    <h5 class="crowd_status" style="display: none;">
                        订单已众包，等待快递员抢单中！
                        <button class="btn btn-primary" onclick="_cancelCrowd('{{ $delivery_info['delivery_id'] }}')">取消众包</button>
                    </h5>
                    <h5 class="crowd_none" style="display: none;">sorry，您众包的订单未有快递员抢单，您需要重新众包！</h5>
                    <h5 class="crowd_none" style="display: none;">sorry，您众包的订单取货异常，您需要重新众包！</h5>
                    <div class="crowd_main" >
                        <div class="simple-form-field p-b-10 ">
                            <div class="form-group">
                                <label for="text4" class="col-sm-3 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">运费：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                        <input id="price2" class=" form-control ipt m-r-10" type="text" placeholder="" value="" >
                                        元
                                    </div>
                                    <div class="help-block help-block-t">运费需要根据货物实际情况设置</div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label for="text4" class="col-sm-3 control-label">
                                    <span class="ng-binding crowd_label">众包范围：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                    </div>
                                    <div class="help-block help-block-t">
                                        附近快递员：对接物流系统中，附近已通过实名认证的系统快递员以及允许对外接单的我的快递员
                                        </br>
                                        常用快递员：对接物流系统中，商家自行设置的经常使用的快递员
                                        </br>
                                        我的快递员：对接物流系统中，商家自己添加的快递员
                                        </br>
                                        跑腿公司：对接物流系统中申请的跑腿公司，跑腿公司接单后可指派给自己的快递员进行配送
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-form-field p-t-15 p-b-30">
                            <div class="form-group">
                                <label for="text4" class="col-sm-3 control-label"></label>
                                <div class="col-xs-9">
                                    <button class="btn btn-primary btn-lg" onclick="_send('{{ $delivery_info['delivery_id'] }}',2)">确认众包</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- 指派 -->
        <!-- 指派 -->
        <div id="texpress2" class="tab-pane fade">
            <div class="explanation m-b-10">
                <div class="title explain-checkZoom" title="点击此处展开或收起">
                    <i class="fa fa-bullhorn"></i>
                    <h4>温馨提示</h4>
                </div>
                <ul class="explain-panel">
                    <li>
                        <span>使用指派配送，您需要确保您对接的物流系统中的商家账户余额中有足够的余额支付运费，如果余额不足，则无法使用同城快递进行配送。</span>
                    </li>
                    <li>
                        <span>运费走向：卖家在对接的物流系统中的商家账户中充值，或由商城平台方为卖家充值，快递员送达货品后，由物流方将运费支付给快递员</span>
                    </li>
                </ul>
            </div>
            <div class="table-content m-t-30">
                <form class="form-horizontal" onsubmit="return false;">
                    <h5 class="assign_status" style="display: none;">
                        订单已指派快递员，等待接单中！
                        <button class="btn btn-primary" onclick="_cancelAssign('{{ $delivery_info['delivery_id'] }}')">取消指派</button>
                    </h5>
                    <h5 class="assign_none"  style="display: none;">sorry，您指派的快递员未接单，您需要重新指派！</h5>
                    <h5 class="assign_none"  style="display: none;">sorry，您指派的订单取货异常，您需要重新指派！</h5>
                    <div class="assign_main" >
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label for="text4" class="col-sm-3 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">运费：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                        <input id="price1" class="form-control ipt m-r-10" type="text" placeholder="" value="" >
                                        元
                                    </div>
                                    <div class="help-block help-block-t">运费需要根据货物实际情况设置</div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">快递员：</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                        <a class="btn btn-warning m-t-5 assign-delivery  btn-sm edit-order" data-id="{{ $delivery_info['delivery_id'] }}" data-type="postman">选择快递员</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="deliver_ids" name="deliver_ids" value="" />
                                    <input type="hidden" id="is_company" name="is_company" value="0" />
                                    <!--选中btn-warning current-->
                                    <div class="form-control-box">
                                        <div id="postmen_people" class="selector-set">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-form-field  p-t-15 p-b-30">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> </label>
                                <div class="col-sm-9">
                                    <div class="form-control-box">
                                        <button class="btn btn-primary btn-lg" onclick="_send('{{ $delivery_info['delivery_id'] }}',1)">确认指派</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- 绑定跑腿公司 -->
        <!-- 无需物流/自行派送 -->
        <!-- 自行配送/无需物流 -->
        <div id="texpress3" class="tab-pane fade">
            <div class="messageBox p-15">
                如果订单中的商品无需物流运送，您可以直接点击确认发货！
                <a class="btn btn-primary btn-sm m-l-20" onclick="_send('{{ $delivery_info['delivery_id'] }}',3)">确认发货</a>
            </div>
        </div>
        <!-- 三方快递 -->
        <!-- 三方快递 -->
        <div id="texpress4" class="table-responsive tab-pane fade in active">
            <div class="m-b-10 search-box">
                <div class="btn-group switch pull-left" data-toggle="buttons">
                    <label class="btn btn-default theme-style active general" title="普通快递">
                        <input type="radio">
                        普通快递
                        </input>
                    </label>
                    <label class="btn btn-default theme-style sheet" title="电子面单">
                        <input type="radio">
                        电子面单
                        </input>
                    </label>
                </div>
                <form class="pull-right" onsubmit="return false">
                    <input type="hidden" id="is_sheet" value="0">
                    <input id="search_express_input" class="form-control w200 m-r-10" type="text" value="" placeholder="请输入物流公司名称">
                    <a class="btn btn-primary" href="javascript:search_express();">搜索</a>
                </form>
                <div class="clear"></div>
            </div>
            <div id="express_table" class="collapse-panel pos-r on"></div>
            <div class="col-sm-12 text-c m-b-30">
                <a id="collapse-btn" class="btn btn-primary">
                    点击展开更多
                    <i class="fa fa-long-arrow-down m-l-5 m-r-0"></i>
                </a>
            </div>
        </div>
        <!-- 达达物流 -->
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        search_express();
        $().ready(function() {
            // 点击指定快递员弹出窗口
            $("body").on("click", ".edit-order", function() {
                // 加载
                $.loading.start();
                var type = $(this).data("type");
                var id = $(this).data("id");
                title = width = '';
                if (type == 'address') {
                    title = "收货人信息";
                    width = '680px';
                    height = '430px';
                }
                if (type == 'seller_address') {
                    title = "发货人信息";
                    width = '800px';
                    height = 'auto';
                }
                if (type == 'postman') {
                    title = "选择快递员";
                    width = '800px';
                    height = '550px';
                }
                $.open({
                    // 标题
                    type: 1,
                    title: title,
                    width: width,
                    height: height,
                    btn: false,
                    // ajax加载的设置
                    ajax: {
                        url: '/trade/delivery/edit-order.html',
                        data: {
                            type: type,
                            id: id
                        }
                    },
                }).always(function() {
                    $.loading.stop();
                });
            });
        });
        // 获取电子面单
        $("body").on("click", ".logistic_code", function() {
            var delivery_id = $(this).data("id");
            var shipping_code = $(this).data("code");
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/trade/delivery/get-sheet.html',
                data: {
                    delivery_id: delivery_id,
                    shipping_code: shipping_code
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0) {
                        $("#express_sn_" + result.shipping_id).val(result.data.Order.LogisticCode);
                    } else {
                        $.msg(result.message);
                    }
                }
            }).always(function() {
                $.loading.stop();
            });
        });
        $("body").on("click", ".print", function() {
            var delivery_id = $(this).data("id");
            var shipping_code = $(this).data("code");
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/trade/delivery/check-print.html',
                data: {
                    delivery_id: delivery_id,
                    shipping_code: shipping_code
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0) {
                        $.go('/trade/delivery/print-sheet.html?did=' + delivery_id + '&code=' + shipping_code, '_blank');
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            }).always(function() {
                $.loading.stop();
            });
        });
        // 移除快递员的按钮并修改deliver_ids
        function _close(deliver_id) {
            var deliver_ids_string = $("#deliver_ids").val();
            deliver_ids_string = ',' + deliver_ids_string + ',';
            deliver_ids_string = deliver_ids_string.replace(',' + deliver_id + ',', ',');
            deliver_ids_string = deliver_ids_string.substr(1, deliver_ids_string.length - 2);
            $("#deliver_ids").val(deliver_ids_string);
            $("#postmen_div_" + deliver_id).remove();
        }
        // 三方物流发货
        function _go(shipping_id) {
            // 运单号码
            var express_sn = $.trim($("#express_sn_" + shipping_id).val());
            if (express_sn == '') {
                $.msg('请输入运单号码！');
                return false;
            }
            // 发起请求
            $.ajax({
                type: 'GET',
                url: '/trade/delivery/to-shipping.html',
                data: {
                    id: '{{ $delivery_info['delivery_id'] }}',
                    shipping_id: shipping_id,
                    express_sn: express_sn,
                    type: 3
                },
                dataType: 'json',
                success: function(result) {
                    $.msg(result.message, function() {
                        if (result.code == 0) {
                            // $.go("/trade/delivery/info.html?id=" + '{{ $delivery_info['delivery_id'] }}');
                            history.go(-1);
                        }
                    });
                }
            });
        }
        // 设为默认
        function _default(shipping_id) {
            $.post('/trade/delivery/shipping-default.html', {
                id: shipping_id,
            }, function(result) {
                $.msg(result.message, function() {
                    if (result.code == 0) {
                        $.go("/trade/delivery/to-shipping.html?id=" + '{{ $delivery_info['delivery_id'] }}');
                    }
                });
            }, 'json');
        }
        // 确认众包,指派 1 指派配送 2 众包抢单
        function _send(delivery_id, type) {
            // 提示标题
            var title = '';
            switch (type) {
                case 1:
                    title = '确认指派么?';
                    break;
                case 2:
                    title = '确认众包么?';
                    break;
                case 3:
                    title = '确认发货么?';
                    break;
                case 4:
                    title = '确定使用达达物流么?'
                    break;
            }
            /* 校验必须填写收货地址 */
            // 发货信息的父盒子
            $oInfo = $('.deliver-sell-info');
            // 提示框类
            var $oBox = $oInfo.children('strong');
            // 发货信息内容
            var info = $.trim($oInfo.children('span').text());
            if ('' == info) {
                // 为了防止屏幕不够高,看不见提示信息
                $.msg('请填写发货信息');
                $.tips('请填写发货信息', $oBox);
                return false;
            }
            if (type == 1) {
                // 运费
                var $oPrice = $("#price1");
                var price = $.trim($oPrice.val());
                // 校验price
                var reg = /^(\d+|\d+\.\d+)$/; // 10.02 或者 是 10
                if ('' == price || !reg.test(price)) {
                    $.tips('请输入正确的费用', $oPrice);
                    return false;
                }
                // 快递员
                var $oDeliver = $("#deliver_ids");
                // 快递员的ids
                var deliver_ids = $oDeliver.val();
                if ('' == deliver_ids) {
                    $.tips('请选择快递员', '.assign-delivery');
                    return false;
                }
                // 是否是跑腿公司
                var crowd_type = $.trim($('#is_company').val());
                // 查找当前选中的tab是为绑定跑腿公司的方式
                var $texpress6 = $('.tab-content').find('#texpress6');
                // 是否为绑定跑腿公司方式
                var is_publish_relation_seller = $texpress6.hasClass('active')? 1 : 0;
                $.confirm(title, function() {
                    $.loading.start();
                    $.post('/trade/delivery/send-logistics.html', {
                        id: delivery_id,
                        price: price,
                        deliver_ids: deliver_ids,
                        type: type,
                        is_company: crowd_type,
                        delivery_sn: '20191224055703323',
                        is_publish_relation_seller: is_publish_relation_seller
                    }, function(result) {
                        if (result.code == 0) {
                            // 清除运费, ids,company为0,清空显示内容
                            // 运费暂不清除
                            // $oPrice.val('');
                            $oDeliver.val('');
                            $('#postmen_people').html('');
                            // 隐藏主区域
                            $('.assign_main').hide();
                            // 显示提示信息
                            $('.assign_status').show();
                            // 隐藏所有修改按钮
                            $('.edit-order').hide();
                            // 隐藏提示未接单
                            $('.assign_none').hide();
                            // 隐藏tab选项卡
                            $('.tabmenu').hide();
                            $.msg(result.message, {
                                time: 2000
                            }, function(){
                                history.go(-1);
                            });
                        }else{
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json').always(function() {
                        $.loading.stop();
                    });
                });
                return;
            }
            // 确认众包
            if (type == 2) {
                // 运费
                var $oPrice = $("#price2");
                var price = $.trim($oPrice.val());
                // 校验price
                var reg = /^(\d+|\d+\.\d+)$/; // 10.02 或者 是 10
                if (!reg.test(price)) {
                    $.tips('请输入正确的费用', $oPrice);
                    return false;
                }
                // 获取众包范围
                var $oRange = $('input:radio[name="crowd_type"]:checked');
                var crowd_type = $oRange.val();
                // 校验众包范围
                if (!crowd_type) {
                    $.tips('请选择众包范围', '.crowd_label');
                    return false;
                }
                $.confirm(title, function() {
                    $.loading.start();
                    $.post('/trade/delivery/send-logistics.html', {
                        // 发货单id
                        id: delivery_id,
                        // 运费
                        price: price,
                        // type是众包
                        type: type,
                        // 传递给物流的众包类型
                        task_crowd_type: crowd_type,
                        delivery_sn: '20191224055703323'
                    }, function(result) {
                        // 清除运费
                        // 运费暂不清除
                        // $oPrice.val('');
                        // 第一个被选中
                        $('input:radio[name="crowd_type"]:first').prop('checked', 'true');
                        // 将众包提示显示出来
                        if (result.code == 0) {
                            // 显示提示信息
                            $('.crowd_status').show();
                            // 隐藏主区域
                            $('.crowd_main').hide();
                            // 隐藏未接单
                            $('.crowd_none').hide();
                            // 隐藏所有修改按钮
                            $('.edit-order').hide();
                            // 隐藏tab选项卡
                            $('.tabmenu').hide();
                            // 更新状态
                            $.msg(result.message, {
                                time: 2000
                            }, function(){
                                history.go(-1);
                            });
                        }else{
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json').always(function() {
                        $.loading.stop();
                    });
                });
                return;
            }
            // 无需物流
            if (type == 3) {
                $.confirm(title, function() {
                    $.loading.start();
                    $.ajax({
                        type: 'GET',
                        url: '/trade/delivery/to-shipping.html',
                        data: {
                            id: delivery_id,
                            shipping_id: 0,
                            express_sn: 0
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 2000
                                }, function(){
                                    history.go(-1);
                                });
                            }else{
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }
                    }).always(function() {
                        $.loading.stop();
                    });
                });
                return;
            }
            // 达达物流
            if (type == 4) {
                /** 校验运费 **/
                var $oPrice = $('#dada_fee');
                var vPrice = $.trim($oPrice.val());
                var priceReg = /^(\d+|\d+\.\d+)$/;
                if (!priceReg.test(vPrice))
                {
                    $.tips('请输入正确的运费', $oPrice);
                    return false;
                }
                // 平台的唯一订单号
                var delivery_no = $.trim($('#dada_fee').data('no'));
                // 请求接口
                function sendLogistics()
                {
                    $.loading.start();
                    $.post('/trade/delivery/dada-pre-order.html', {
                        delivery_no: delivery_no,
                        delivery_id: delivery_id
                    }, function(result) {
                        if (0 == result.code)
                        {
                            // 将取消按钮显示出来
                            $('.tabmenu').hide();
                            $('.dada_main').hide();
                            $('.dada_status').show();
                            $.msg(result.message, {
                                time: 2000
                            }, function(){
                                history.go(-1);
                            });
                        }else{
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json').always(function() {
                        $.loading.stop();
                    });
                }
                // 如果运费高于预期的运费则发货
                $.confirm(title, function() {
                    sendLogistics();
                });
                return;
            }
        }
        /**
         * 查看快递员位置
         */
        function task_map() {
            //单号
            var delivery_sn = '20191224055703323';
            var index = $.open({
                title: "当前位置",
                type: 2,
                content: '/trade/delivery/deliver-map?order_sn=' + delivery_sn,
                area: ['80%', '500px'],
                fix: false, //不固定
                scrollbar: false,
                maxmin: true
            });
        }
        /**
         达达查看物流
         **/
        function dada_map()
        {
            var delivery_sn = '20191224055703323';
            var index = $.open({
                title: "当前位置",
                type: 2,
                content: 'dada-map?order_sn=' + delivery_sn,
                area: ['80%', '500px'],
                fix: false, //不固定
                scrollbar: false,
                maxmin: true
            });
        }
        // 输入框触发搜索事件
        $('#search_express_input').keydown(function(ev) {
            // 如果非回车事件则不触发
            if (ev.keyCode == "13") {
                search_express();
            }
        })
        $("body").on("click", ".general", function() {
            $("#is_sheet").val(0);
            search_express();
        });
        $("body").on("click", ".sheet", function() {
            $("#is_sheet").val(1);
            search_express();
        });
        // 搜索物流
        function search_express() {
            var express_keyword = $("#search_express_input").val();
            var is_sheet = $("#is_sheet").val();
            var delivery_id = "{{ $delivery_info['delivery_id'] }}";
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/trade/delivery/search-express.html',
                data: {
                    express_keyword: express_keyword,
                    is_sheet: is_sheet,
                    delivery_id: delivery_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0) {
                        $("#express_table").html(result.data);
                    }
                }
            }).always(function() {
                $.loading.stop();
            });
        }
        // 收缩加载第三方物流
        $('#collapse-btn').click(function() {
            if ($('.collapse-panel').hasClass('on')) {
                $('.collapse-panel').removeClass('on');
                $('#collapse-btn').html('点击收起更多<i class="fa fa-long-arrow-up m-l-5 m-r-0"></i>');
            } else {
                $('.collapse-panel').scrollTop(0);
                $('.collapse-panel').addClass('on');
                $('#collapse-btn').html('点击展开更多<i class="fa fa-long-arrow-down m-l-5 m-r-0"></i>');
            }
        });
        /**
         * 取消delivery_id发货单在物流系统中的状态
         * @param integer id delivery_id 发货单id
         */
        function _cancelCrowd(id) {
            $.confirm('确定取消众包么?', function() {
                $.loading.start();
                // 取消众包的操作
                $.post('/trade/delivery/cancel-shipping.html', {
                    id: id
                }, function(data) {
                    $.loading.stop();
                    if (0 == data.code) {
                        $.msg(data.message);
                        // 隐藏当前的区域
                        $('.crowd_status').hide();
                        // 重新显示主区域
                        $('.crowd_main').show();
                        // 显示tab选项卡
                        $('.tabmenu').show();
                        // 显示修改按钮
                        $('.edit-order').show();
                    } else {
                        $.msg(data.message, function() {
                            $.go("/trade/delivery/info.html?id=" + id);
                        });
                    }
                }, 'JSON');
            });
        }
        // 取消指派
        function _cancelAssign(id) {
            $.confirm('确定取消指派么?', function() {
                $.loading.start();
                // 取消指派的操作
                $.post('/trade/delivery/cancel-shipping.html', {
                    id: id
                }, function(data) {
                    $.loading.stop();
                    if (0 == data.code) {
                        $.msg(data.message);
                        // 隐藏当前的区域
                        $('.assign_status').hide();
                        // 重新显示主区域
                        $('.assign_main').show();
                        // 显示tab选项卡
                        $('.tabmenu').show();
                        // 显示修改按钮
                        $('.edit-order').show();
                    } else {
                        $.msg(data.message, function() {
                            $.go("/trade/delivery/info.html?id=" + id);
                        });
                    }
                }, 'JSON');
            });
        }
        /**
         取消达达
         @param integer id 发货单id
         **/
        function _cancelDada(id)
        {
            $.loading.start();
            $.open({
                // 标题
                type: 1,
                title: '取消原因',
                width: 500,
                height: 300,
                btn: ['确认', '取消'],
                btn1: function() {
                    // 取消订单的原因id
                    var $reasonId = $('.cancel-id');
                    var vRId = $reasonId.val();
                    // 取消订单的具体内容
                    var $cancelContent = $('.cancel-content');
                    var vContent = $.trim($cancelContent.val());
                    // 是否存在取消订单的原因
                    if (vRId == '')
                    {
                        $.tips('请选择取消原因', $reasonId);
                        return false;
                    }
                    // 如果订单为其他原因 必须填写取消的具体内容
                    if (vRId == 10000)
                    {
                        if (vContent == '')
                        {
                            $.tips('请填写取消原因的具体内容', $cancelContent);
                            return false;
                        }
                    }
                    // 请求数据
                    $.loading.start();
                    $.post('/trade/delivery/cancel-dada.html', {
                        cancel_id: vRId,
                        cancel_content: vContent,
                        id: id
                    }, function(data) {
                        layer.closeAll();
                        $.msg(data.message);
                        // 取消成功
                        if ( 0 == data.code)
                        {
                            // 将取消按钮显示出来
                            $('.tabmenu').show();
                            $('.dada_main').show();
                            $('.dada_status').hide();
                        }
                    }, 'JSON').always(function() {
                        $.loading.stop();
                    });
                },
                btn2: function() {
                },
                // ajax加载的设置
                ajax: {
                    url: '/trade/delivery/cancel-dada.html',
                    data: {
                        type: 'get',
                        id: id
                    }
                },
            }).always(function () {
                $.loading.stop();
            });
        }
        // 阻止表单元素
        $.stopEnterEvent('form');
        // 更改物品重量需要重新计算费用
        $('#dada_weight').keyup(function() {
            var self = $(this);
            var $sendBtn = $('#dada_send_btn');
            var val = self.val();
            var origin = self.data('val');
            if (val != origin)
            {
                $sendBtn.attr('disabled', true);
            }
            else
            {
                $sendBtn.attr('disabled', false);
            }
        });
        // 计算费用
        $('.dada-compute-fee').click(function() {
            var $weight = $('#dada_weight');
            var kg = $.trim($weight.val());
            var reg = /^(\d+|\d+\.\d+)$/;
            if(!reg.test(kg))
            {
                $.tips('请输入正确的重量', $weight);
                return false;
            }
            getFee(kg);
        });
        
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop