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
                    <li class="active">投诉详情</li>
                </ul>
            </div>
            <div class="content-info">
                <!-- 提交投诉、修改投诉申请页面 _start -->
                <div class="content-con" style="display: block;">
                    <div class="imfor-info complaint-imfor-info">
                        <table class="content-info-table" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="content-imfor">
                                    <div class="imfor-title">
                                        <h3>订单信息</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt">订单编号：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/info?id={{ $complaint_order['order_id'] }}.html" title="查看订单详情" class="btn-link">{{ $complaint_order['order_sn'] }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">运费：</div>
                                            <div class="imfor-dd">{{ $complaint_order['shipping_fee'] }}元</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">总计：</div>
                                            <div class="imfor-dd color">{{ $complaint_order['order_amount'] }}元</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">成交时间：</div>
                                            <div class="imfor-dd">{{ format_time($complaint_order['add_time']) }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">商家：</div>
                                            <div class="imfor-dd imfor-short-dd imfor-customer-dd">
                                                <a href="/shop/{{ $complaint_order['shop_id'] }}.html" title="{{ $complaint_order['shop_name'] }}" target="_blank" class="btn-link">{{ $complaint_order['shop_name'] }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                <td class="content-status">
                                    <form id="ComplaintModel" class="form-horizontal" name="ComplaintModel" action="/user/complaint/add.html?order_id={{ $complaint_order['order_id'] }}&sku_id={{ $complaint_order['sku_id'] }}" method="post">
                                        @csrf
                                        <div class="form-group complaint-form-group">交易状态为“交易成功”或“交易关闭”后，3天内可以投诉商家</div>
                                        <!-- 投诉原因 -->
                                        <div class="form-group form-group-spe" >
                                            <label for="complaintmodel-complaint_type" class="input-left">
                                                <span class="spark">*</span>
                                                <span>投诉原因：</span>
                                            </label>
                                            <div class="form-control-box">
                                                <span class="select">
                                                    <select id="complaintmodel-complaint_type" class="form-control" name="ComplaintModel[complaint_type]">
                                                        @foreach($complaint_item as $key=>$item)
                                                            <option value="{{ $key+1 }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </div>
                                            <div class="invalid"></div>
                                        </div>
                                        <!-- 投诉说明 -->
                                        <div class="form-group form-group-spe" >
                                            <label for="complaintmodel-complaint_desc" class="input-left">
                                                <span class="spark">*</span>
                                                <span>投诉说明：</span>
                                            </label>
                                            <div class="form-control-box">
                                                <textarea id="complaintmodel-complaint_desc" class="form-control" name="ComplaintModel[complaint_desc]" rows="5" placeholder="建议您如实填写..."></textarea>
                                            </div>
                                            <div class="invalid"></div>
                                        </div>
                                        <!--联系电话 -->
                                        <div class="form-group form-group-spe" >
                                            <label for="complaintmodel-complaint_mobile" class="input-left">
                                                <span>联系电话：</span>
                                            </label>
                                            <div class="form-control-box">
                                                <input type="text" id="complaintmodel-complaint_mobile" class="form-control" name="ComplaintModel[complaint_mobile]" placeholder="">
                                            </div>
                                            <div class="invalid"></div>
                                        </div>
                                        <div class="form-group form-group-spe">
                                            <label class="input-left">
                                                <span class="spark">*</span>
                                                <span>上传凭证：</span>
                                            </label>
                                            <div id="imagegroup_container" class="form-control-box"></div>
                                            <!--上传图片 -->
                                            <input type="hidden" id="imgpath" class="form-control" name="ComplaintModel[complaint_images]" placeholder="">
                                            <span class="hint">每张图片大小不超过4096KiB，最多上传6张图片，支持gif、jpg、png格式</span>
                                        </div>
                                        <div class="act">
                                            <input type="button" class="btn_validate sub_complaint" value="提交投诉申请" />
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- 提交投诉、修改投诉申请页面 _end -->
            </div>
        </div>
        <!-- 表单验证 -->
        <script id="client_rules" type="text">
[{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"required":true,"messages":{"required":"投诉说明不能为空。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"required":true,"messages":{"required":"投诉原因不能为空。"}}},{"id": "complaintmodel-complaint_images", "name": "ComplaintModel[complaint_images]", "attribute": "complaint_images", "rules": {"required":true,"messages":{"required":"上传投诉凭证图片不能为空。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉原因必须是整数。"}}},{"id": "complaintmodel-complaint_status", "name": "ComplaintModel[complaint_status]", "attribute": "complaint_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"0- 等待卖家处理  1 - 卖家已回复  2-买家撤销投诉 3 - 平台方介入 4-平台方仲裁中  5- 仲裁成功  6-仲裁失败必须是整数。"}}},{"id": "complaintmodel-add_time", "name": "ComplaintModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"string":true,"messages":{"string":"联系电话必须是一条字符串。","maxlength":"联系电话只能包含至多20个字符。"},"maxlength":20}},{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"string":true,"messages":{"string":"投诉说明必须是一条字符串。","maxlength":"投诉说明只能包含至多255个字符。"},"maxlength":255}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166|191|167)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"联系电话是无效的。"}}},]
</script>
        <script type="text/javascript">
            // 
        </script>
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
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            var validator = $("#ComplaintModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("body").on('click', '.sub_complaint', function() {
                if (!validator.form()) {
                    return false;
                }
                var data = $("#ComplaintModel").serializeJson();
                var action = $("#ComplaintModel").attr('action');
                $(".btn_validate").removeClass('sub_complaint').val("正在提交...");
                $.post(action, data, function(result) {
                    $.msg(result.message, {
                        time: 3000
                    }, function(){
                        if (result.code == 0) {
                            //var url = "/user/complaint/view?complaint_id="+result.id
                            if (typeof (tablelist) !== 'undefined') {
                                tablelist.load();
                            }else{
                                var url = "/user/complaint.html"
                                $.go(url);
                            }
                        }
                    });
                }, "json");
            });
            $("#imagegroup_container").each(function(){
                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 6,
                    values: [],
                    callback: function(data){
                        $("#imgpath").val(this.values);
                    },
                    remove: function(value, values){
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