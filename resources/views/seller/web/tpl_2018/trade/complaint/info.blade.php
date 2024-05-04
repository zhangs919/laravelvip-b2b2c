{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/highslide.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')


    <div class="order-info">
        <div class="order-left">
            <h3>相关商品交易信息</h3>
            <div class="order-goods">
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="{{ route('pc_show_goods',['goods_id'=>$complaint_info['goods_id']]) }}" target="_blank">
                        <img src="{{ $complaint_info['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"/>
                    </a>
                </div>
                <div class="ng-binding refund-message w200">
                    <div class="name">
                        <a href="{{ route('pc_show_goods',['goods_id'=>$complaint_info['goods_id']]) }}" target="_blank"
                           data-toggle="tooltip" data-placement="auto bottom" title="{{ $complaint_info['goods_name'] }}" class="c-blue">{{ $complaint_info['goods_name'] }}</a>
                    </div>
                    <div class="goods-attr">
                        @if(!empty($complaint_info['spec_info']))
                            @foreach(explode(' ', $complaint_info['spec_info']) as $spec)
                                <span>{{ $spec }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="refund-info">
                <dl>
                    <dt>
                        <span class="letter-spacing">{{ str_replace([0,1,2],['买家','卖家','平台'], $complaint_info['role_type']) }}</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['user_name'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>订单编号</span>
                        ：
                    </dt>
                    <dd>
                        <span>
                            <a href="/trade/order/info?id={{ $complaint_info['order_id'] }}" target="_blank"
                               data-toggle="tooltip" data-placement="auto bottom" title="点击进入订单详情" class="c-blue">{{ $complaint_info['order_sn'] }}</a>
                        </span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">单价</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['goods_price'] }}元 * {{ $complaint_info['goods_number'] }}（数量）</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">快递</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['shipping_fee'] }} 元</span>
                    </dd>
                </dl>
            </div>
            <div class="refund-info border-none">
                <dl>
                    <dt>
                        <span>投诉编号</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['complaint_sn'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>投诉原因</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ format_complaint_type($complaint_info['complaint_type']) }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>货物状态</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['cargo_status']['seller'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">说明</span>
                        ：
                    </dt>
                    <dd>
                        <span>{!! $complaint_info['complaint_desc'] !!}</span>
                        <div class="refund-img">
                            @if(!empty($complaint_info['images']))
                                @foreach($complaint_info['images'] as $image)
                                    <a href="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" class="highslide" onclick="return hs.expand(this)">
                                        <img src="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="order-right">
            <h3>投诉服务</h3>
            <!--   -->
            <div class="refund-operate">
                <ul>
                    <li class="operate-steps">
                        <i class="fa fa-check-circle-o"></i>
                        <span>投诉状态：{{ format_complaint_status($complaint_info['complaint_status'],1) }}</span>
                    </li>
                    <li class="operate-prompt">
                        买家提起了投诉，请及时联系买家友好协商处理，如买家撤销了本次投诉，将不会影响您的店铺纠纷数据
                        <span id="counter_98">
                            <i class="fa fa-clock-o"></i>
                        </span>
                        <script type="text/javascript">
                            //
                        </script>
                        后如您没有处理本次投诉或者买家不满意协商结果，买家可申请“平台方介入处理”，平台方介入会影响您的店铺纠纷数据，影响店铺评分。
                    </li>
                    <li>
                        <div class="table-content mt10 clearfix">
                            <form id="ComplaintModel" class="form-horizontal" name="ComplaintModel" action="/trade/complaint/info.html?complaint_id={{ $complaint_info['complaint_id'] }}" method="post">
                                @csrf
                                <div class="simple-form-field" >
                                    <div class="form-group">
                                        <label for="complaintmodel-complaint_desc" class="col-sm-4 control-label">
                                            <span class="text-danger ng-binding">*</span>
                                            <span class="ng-binding">回复内容：</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="form-control-box">
                                                <textarea id="complaintmodel-complaint_desc" class="form-control" name="ComplaintModel[complaint_desc]" rows="5" placeholder="请输入处理信息，该信息为公开信息，平台方与买家均可见"></textarea>
                                            </div>
                                            <div class="help-block help-block-t"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simple-form-field">
                                    <div class="form-group">
                                        <label for="text4" class="col-sm-4 control-label">
                                            <span class="text-danger ng-binding">*</span>
                                            <span class="ng-binding">上传凭证：</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="imagegroup_container pull-left"></div>
                                            <input type="hidden" id="imgpath" class="form-control" name="ComplaintModel[complaint_images]" placeholder="">
                                            <span class="help-block help-block-t">每张图片大小不超过4096KiB，最多上传6张图片，支持gif、jpg、png格式</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="simple-form-field p-b-30">
                                    <div class="form-group">
                                        <label for="text4" class="col-sm-4 control-label"></label>
                                        <div class="col-sm-8">
                                            <input class="btn btn-primary sub_complaint" type="button" id="btn_validate" value="提交协商处理" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <h3>协商记录</h3>
            <div class="order-message">
                <ul>
                    @foreach($complaint_reply as $key=>$item)
                    <li @if($key == 0)class="b-n"@endif>
                        <div class="buyer-head">
                            <img src="{{ get_image_url($item['headimg']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"/>
                        </div>
                        <div class="message-content">
                            <div class="message-info">
                                <p>
                                    <span class="name">{{ $item['user_name'] }} - {{ str_replace([0,1,2],['买家','卖家','平台'], $item['role_type']) }}</span>
                                    <span class="time">{{ format_time($item['add_time']) }}</span>
                                </p>
                                <p>{!! $item['complaint_desc'] !!}</p>
                                <div class="voucher">
                                    @if(!empty($item['images']))
                                        @foreach($item['images'] as $image)
                                            <a href="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" class="highslide" onclick="return hs.expand(this)">
                                                <img src="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                                <!--<p class="message-answer"><a href="" class="c-blue">回复</a></p>-->
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">确认收货</h4>
                </div>
                <div class="modal-body">
                    <p class="prompt m-b-15">您确认收到了买家发出的货物？确认后本笔退款信息将自动推送至平台方且不可更改，平台方将有权处理退款，请谨慎操作！</p>
                    <div class="content">
                        <textarea class="form-control" placeholder="请输入留言内容，该留言为公开信息，买家和平台方均可见" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">确认收货</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="client_rules" type="text">
[{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"required":true,"messages":{"required":"投诉原因不能为空。"}}},{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"required":true,"messages":{"required":"回复内容不能为空。"}}},{"id": "complaintmodel-complaint_images", "name": "ComplaintModel[complaint_images]", "attribute": "complaint_images", "rules": {"required":true,"messages":{"required":"上传投诉凭证图片不能为空。"}}},{"id": "complaintmodel-complaint_id", "name": "ComplaintModel[complaint_id]", "attribute": "complaint_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉ID必须是整数。"}}},{"id": "complaintmodel-order_id", "name": "ComplaintModel[order_id]", "attribute": "order_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的订单ID必须是整数。"}}},{"id": "complaintmodel-goods_id", "name": "ComplaintModel[goods_id]", "attribute": "goods_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的商品ID必须是整数。"}}},{"id": "complaintmodel-sku_id", "name": "ComplaintModel[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku ID必须是整数。"}}},{"id": "complaintmodel-shop_id", "name": "ComplaintModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的店铺ID必须是整数。"}}},{"id": "complaintmodel-user_id", "name": "ComplaintModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉的用户ID必须是整数。"}}},{"id": "complaintmodel-parent_id", "name": "ComplaintModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级投诉ID必须是整数。"}}},{"id": "complaintmodel-role_type", "name": "ComplaintModel[role_type]", "attribute": "role_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"角色类型必须是整数。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉原因必须是整数。"}}},{"id": "complaintmodel-complaint_status", "name": "ComplaintModel[complaint_status]", "attribute": "complaint_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉处理状态必须是整数。"}}},{"id": "complaintmodel-add_time", "name": "ComplaintModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"string":true,"messages":{"string":"联系电话必须是一条字符串。","maxlength":"联系电话只能包含至多20个字符。"},"maxlength":20}},{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"string":true,"messages":{"string":"回复内容必须是一条字符串。","maxlength":"回复内容只能包含至多255个字符。"},"maxlength":255}},]
</script>
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
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $(function(){
            //图片弹窗
            hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
            hs.align = 'center';
            hs.transitions = ['expand', 'crossfade'];
            hs.outlineType = 'rounded-white';
            hs.fadeInOut = true;
            hs.addSlideshow({
                interval: 5000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: .75,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
        })
        //
        $(document).ready(function() {
            $("#counter_98").countdown({
                time: "-120727000",
                leadingZero: true,
                onComplete: function(event) {
                    $(this).html("您处理投诉期限已超时！");
                    // 超时事件，预留
                }
            });
        });
        //
        $().ready(function() {
            var validator = $("#ComplaintModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            //$("#btn_validate").click(function() {
            $("body").on('click', '.sub_complaint', function() {
                if (!validator.form()) {
                    return false;
                }
                var data = $("#ComplaintModel").serializeJson();
                var action = $("#ComplaintModel").attr('action');
                $.loading.start();
                $.post(action, data, function(result) {
                    $.msg(result.message, function(){
                        if (result.code == 0) {
                            if (typeof (tablelist) !== 'undefined') {
                                tablelist.load();
                            }else{
                                $.go("/trade/complaint/list");
                            }
                        }
                    });
                }, "json").always(function(){
                    $.loading.stop();
                });
            });
            $(".imagegroup_container").each(function() {
                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 6,
                    callback: function(data) {
                        $("#imgpath").val(this.values);
                    },
                    remove: function(value, values) {
                        $("#imgpath").val(this.values);
                    },
                    change: function(values, type){
                        if (!values) {
                            values = [];
                        }
                        values = values.join(",");
                        $("#imgpath").val(this.values);
                    }
                });
            });
        });
    </script>
@stop
