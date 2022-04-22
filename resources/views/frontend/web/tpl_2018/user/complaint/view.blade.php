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
                <div class="content-con" style="display: block;">
                    <div class="imfor-info complaint-imfor-info">
                        <table class="content-info-table" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="content-imfor">
                                    <div class="imfor-title">
                                        <h3>投诉信息</h3>
                                    </div>
                                    <ul>

                                        <li>
                                            <div class="imfor-dt">投诉原因：</div>
                                            <div class="imfor-dd">未按成交价格进行交易
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">投诉编号：</div>
                                            <div class="imfor-dd">2018111002580558635</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">投诉时间：</div>
                                            <div class="imfor-dd">2018-11-10 10:58:05</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">投诉说明：</div>
                                            <div class="imfor-dd">aaaa</div>
                                        </li>
                                        <li class="separate-top">
                                            <div class="imfor-dt">商家：</div>
                                            <div class="imfor-dd imfor-short-dd imfor-customer-dd">
                                                <a href="/shop/1.html" title="楠丹木业" target="_blank" class="btn-link">楠丹木业</a>

                                                <!--   -->

                                                <!-- s等于1时带文字，等于2时不带文字 -->
                                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                                    <span></span>
                                                </a>


                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">订单编号：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/info?id=262" title="查看订单详情" class="btn-link">20181015081346333410</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">运费：</div>
                                            <div class="imfor-dd">6.00元</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">总计：</div>
                                            <div class="imfor-dd color">339.00元</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">成交时间：</div>
                                            <div class="imfor-dd">2018-10-15 16:13:46</div>
                                        </li>
                                    </ul>
                                </td>
                                <!-- 提交投诉、修改投诉申请后的页面 _start -->

                                <td class="complaint-status">
                                    <dl class="user-status-imfor">
                                        <dt class="imfor-icon">
                                            <img src="/images/common/warning.png">
                                        </dt>
                                        <dd class="imfor-title">
                                            <h3>您已提交了投诉申请，请等待卖家处理</h3>
                                        </dd>
                                    </dl>
                                    <ul class="user-status-prompt">
                                        <li class="li-prompt">

                                            <span class="package-detail">卖家在3日之内未处理，您可以申请平台方介入处理</span>

                                        </li>
                                        <li>
                                            <span>投诉原因：</span>
                                            <div class="user-status-logistic">
											<span class="package-detail">未按成交价格进行交易
</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span>投诉说明：</span>
                                            <div class="user-status-logistic">
                                                <span class="package-detail">aaaa</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <dl class="user-status-operate">
                                        <dt>您可以</dt>
                                        <dd>
                                            <a href="/user/complaint/edit?complaint_id=10" class="complaint-apply">修改投诉申请</a>
                                        </dd>
                                        <dd>
                                            <a href="javascript:;" onclick="delConfirm('10')" class="btn-link">撤销投诉申请</a>
                                        </dd>
                                        <dd>

                                            <a href="/user/complaint/intervention?complaint_id=10" class="btn-link">要求平台方介入处理</a>

                                        </dd>
                                    </dl>
                                </td>

                                <!-- 提交投诉、修改投诉申请后的页面 _end -->

                                <!-- 卖家回复投诉后的页面 _start -->
                                <!-- -->
                                <!-- 卖家回复投诉后的页面 _end -->

                                <!-- 买家撤销投诉后的页面 _start -->
                                <!-- -->
                                <!-- 买家撤销投诉后的页面 _end -->

                                <!-- 买家申请平台仲裁后的页面 _start -->
                                <!-- -->
                                <!-- 买家申请平台仲裁后的页面 _end -->

                                <!-- 仲裁成功后的页面 _start -->
                                <!-- -->
                                <!-- 仲裁成功后的页面 _end -->

                                <!-- 仲裁失败后的页面 _start -->
                                <!-- -->
                                <!-- 仲裁失败后的页面 _end -->

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="consult-record">
                        <div class="tabmenu">
                            <ul class="tab">
                                <li class="active">协商记录</li>
                            </ul>
                        </div>
                        <div class="consult-record-message">
                            <ul>

                                <li>
                                    <div class="message-content">
                                        <div class="message-info">
                                            <p class="message-admin">
										<span class="name btn-link">

											买家

										</span>
                                                <span class="time">2018-11-10 10:58:05</span>
                                            </p>

                                            <p>SZY157FTPJ8849</p>

                                            <ul class="message">
                                                <li>
                                                    <div class="dt">凭证信息：</div>
                                                    <div class="dd">
                                                        <span>aaaa</span>

                                                        <div class="voucher">


                                                            <a href="javascript:void(0);" ref="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418186690723.jpg" class="preview" data-preview-hover="false">
                                                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418186690723.jpg" class="goods-thumb" />
                                                            </a>


                                                            <a href="javascript:void(0);" ref="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418186796623.jpg" class="preview" data-preview-hover="false">
                                                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418186796623.jpg" class="goods-thumb" />
                                                            </a>

                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 点击大图展示 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180027"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>
    <script id="client_rules" type="text">
[{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"required":true,"messages":{"required":"投诉说明不能为空。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"required":true,"messages":{"required":"投诉原因不能为空。"}}},{"id": "complaintmodel-complaint_images", "name": "ComplaintModel[complaint_images]", "attribute": "complaint_images", "rules": {"required":true,"messages":{"required":"上传投诉凭证图片不能为空。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉原因必须是整数。"}}},{"id": "complaintmodel-complaint_status", "name": "ComplaintModel[complaint_status]", "attribute": "complaint_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"0- 等待卖家处理  1 - 卖家已回复  2-买家撤销投诉 3 - 平台方介入 4-平台方仲裁中  5- 仲裁成功  6-仲裁失败必须是整数。"}}},{"id": "complaintmodel-add_time", "name": "ComplaintModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"string":true,"messages":{"string":"联系电话必须是一条字符串。","maxlength":"联系电话只能包含至多20个字符。"},"maxlength":20}},{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"string":true,"messages":{"string":"投诉说明必须是一条字符串。","maxlength":"投诉说明只能包含至多255个字符。"},"maxlength":255}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"联系电话是无效的。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ComplaintModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("body").on('click', '.sub_complaint', function() {
                if (!validator.form()) {
                    return false;
                }
                var data = $("#ComplaintModel").serializeJson();
                var action = "/user/complaint/edit.html?complaint_id=10";
                $(".btn_validate").removeClass('sub_complaint').val("正在提交...");

                $.post(action, data, function(result) {
                    $.msg(result.message);
                    if (result.code == 0) {
                        var url = "/user/complaint/list"
                        $.go(url);
                        if (typeof (tablelist) !== 'undefined') {
                            tablelist.load();
                        }
                    }
                }, "json");
            });

            $("#imagegroup_container").each(function() {
                var imagegorup = $(this).imagegroup({
                    // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
                    host: "{{ get_oss_host() }}",
                    size: 6,
                    values: "",
                    callback: function(data) {
                        $("#imgpath").val(this.values);

                    },
                    remove: function(value, values) {
                        $("#imgpath").val(this.values);
                    }
                });

            });
        });

        //撤销投诉
        function delConfirm(id) {
            $.confirm('撤销后您将不能重新发起投诉申请，是否确认撤销?', {
                btn: ['确定', '取消']
                //按钮
            }, function() {
                $.go("/user/complaint/del?complaint_id=10");
            }, function() {
            })
        }
    </script>

@endsection