{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190116"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=integral_mall_set" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="group" value="integral_mall_set">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-integral_model" class="col-sm-4 control-label">

                        <span class="ng-binding">积分商城模式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="hidden" name="SystemConfigModel[integral_model]" value="0">
                            <div id="systemconfigmodel-integral_model" class="" name="SystemConfigModel[integral_model]">
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="SystemConfigModel[integral_model]"
                                           value="0" @if($config_info['integral_model']->value == 0){{ 'checked' }}@endif> 系统统一积分</label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="SystemConfigModel[integral_model]"
                                           value="1" @if($config_info['integral_model']->value == 1){{ 'checked' }}@endif> 店铺独立积分</label>
                            </div>





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">系统统一积分：积分属于平台方，开启系统统一积分，店铺积分商城功能将变为不可使用。 <br/>店铺独立积分：积分属于各个店铺，每个店铺的积分独立使用</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-integral_validity" class="col-sm-4 control-label">

                        <span class="ng-binding">积分有效期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-integral_validity" class="form-control ipt m-r-10" name="SystemConfigModel[integral_validity]" value="{{ $config_info['integral_validity']->value }}"> 年





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">“0”表示无限制，积分获得日期开始计算，到超过积分有效期，会员积分自动清零</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-give_integral_confirm" class="col-sm-4 control-label">

                        <span class="ng-binding">主动确认收货送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-give_integral_confirm" class="form-control ipt m-r-10" name="SystemConfigModel[give_integral_confirm]" value="{{ $config_info['give_integral_confirm']->value }}"> 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">消费者主动点击确认收货后赠送积分</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-give_integral_comment" class="col-sm-4 control-label">

                        <span class="ng-binding">评价好评送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-give_integral_comment" class="form-control ipt m-r-10" name="SystemConfigModel[give_integral_comment]" value="{{ $config_info['give_integral_comment']->value }}"> 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">消费者对宝贝与描述项设置好评后赠送积分</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-give_integral_register" class="col-sm-4 control-label">

                        <span class="ng-binding">会员注册送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-give_integral_register" class="form-control ipt m-r-10" name="SystemConfigModel[give_integral_register]" value="{{ $config_info['give_integral_register']->value }}"> 积分





                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-give_integral_recharge" class="col-sm-4 control-label">

                        <span class="ng-binding">平台储值卡充值送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-give_integral_recharge" class="form-control ipt m-r-10" name="SystemConfigModel[give_integral_recharge]" value="{{ $config_info['give_integral_recharge']->value }}"> 元，送 1 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">例：设置充1元送1积分，则消费者储值卡充值100元，则送100积分</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-give_integral_consume" class="col-sm-4 control-label">

                        <span class="ng-binding">消费金额送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-give_integral_consume" class="form-control ipt m-r-10" name="SystemConfigModel[give_integral_consume]" value="{{ $config_info['give_integral_consume']->value }}"> 元 = 1 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">比如：设置1元=1积分，则会员消费101元，确认收货后则赠送101积分，按消费金额中的整数部分进行赠送积分，不考虑四舍五入。</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-give_integral_out_line_balance" class="col-sm-4 control-label">

                        <span class="ng-binding">线下消费余额是否累计积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[give_integral_out_line_balance]" value="0">
                                    <label><input type="checkbox" id="systemconfigmodel-give_integral_out_line_balance" class="form-control b-n"
                                                  name="SystemConfigModel[give_integral_out_line_balance]"
                                                  value="1" @if($config_info['give_integral_out_line_balance']->value == 1)checked=""@endif unselect="0" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制会员线下消费使用会员余额支付，是否可获取积分，获取的积分规则与线上一致</br>线下消费余额：通过商家APP扫描消费者付款码，或消费者扫描商家APP收款码</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-integral_shipping" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">积分兑换配送方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="hidden" name="SystemConfigModel[integral_shipping]" value="0">
                            <div id="systemconfigmodel-integral_shipping" class="" name="SystemConfigModel[integral_shipping]">
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[integral_shipping][]" value="0" @if(in_array('0', $config_info['integral_shipping']->value)){{ 'checked' }}@endif> 物流配送</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[integral_shipping][]" value="1" @if(in_array('1', $config_info['integral_shipping']->value)){{ 'checked' }}@endif> 上门自提</label>
                            </div>





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">积分兑换配送方式将影响消费者积分兑换提交页面是否展示物流配送以及上门自提选项。 <a class="c-blue" href="/mall/self-pickup/list" target="_Blank">设置自提点</a></div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-integral_qrcode" class="col-sm-4 control-label">

                        <span class="ng-binding">平台积分收款码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-integral_qrcode" class="form-control valid hidden" name="SystemConfigModel[integral_qrcode]" value="{{ $config_info['integral_qrcode']->value }}">




                            <div class="goods-message">
                                <div class="active m-t-5">
                                    <div class="QR-code popover-box">
                                        <a href="javascript:;" class="qrcode">
                                            <i class="fa fa-qrcode"></i>
                                        </a>
                                        <div class="code-info popover-info" style="display: none;">
                                            <i class="fa fa-caret-left"></i>
                                            <a href="/dashboard/integral-mall/download-qrcode">点击下载</a>
                                            <p>
                                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="{{ $config_info['integral_qrcode']->value }}" />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">积分收款码应用于消费者线下扫码进行消费积分和余额，该余额不累计积分</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-integral_image" class="col-sm-4 control-label">

                        <span class="ng-binding">积分商城头像：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <!-- 图片组 start -->


                            <div id="integral_image_imagegroup_container" class="szy-imagegroup" data-id="systemconfigmodel-integral_image" data-size="1"></div>
                            <input type="hidden" id="systemconfigmodel-integral_image" class="form-control" name="SystemConfigModel[integral_image]" value="{{ $config_info['integral_image']->value }}">
                            <!-- 图片组 end -->





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">该图片应用于开启平台积分时积分商城线下消费积分页面的logo，图片建议上传160*160</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="systemconfigmodel-integral_bg_image" class="col-sm-4 control-label">

                        <span class="ng-binding">积分商城背景图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <!-- 图片组 start -->


                            <div id="integral_bg_image_imagegroup_container" class="szy-imagegroup" data-id="systemconfigmodel-integral_bg_image" data-size="1"></div>
                            <input type="hidden" id="systemconfigmodel-integral_bg_image" class="form-control" name="SystemConfigModel[integral_bg_image]" value="{{ $config_info['integral_bg_image']->value }}">
                            <!-- 图片组 end -->





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">该图片应用于积分商城线下消费积分页面的背景图，图片建议上传640*260</div></div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
            </div>
    	</div>
    </form>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "systemconfigmodel-integral_model", "name": "SystemConfigModel[integral_model]", "attribute": "integral_model", "rules": {"string":true,"messages":{"string":"积分商城模式必须是一条字符串。"}}},{"id": "systemconfigmodel-integral_validity", "name": "SystemConfigModel[integral_validity]", "attribute": "integral_validity", "rules": {"string":true,"messages":{"string":"积分有效期必须是一条字符串。"}}},{"id": "systemconfigmodel-integral_validity", "name": "SystemConfigModel[integral_validity]", "attribute": "integral_validity", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"积分有效期必须是整数。","min":"积分有效期必须不小于0。","max":"积分有效期必须不大于100。"},"min":0,"max":100}},{"id": "systemconfigmodel-give_integral_confirm", "name": "SystemConfigModel[give_integral_confirm]", "attribute": "give_integral_confirm", "rules": {"string":true,"messages":{"string":"主动确认收货送积分必须是一条字符串。"}}},{"id": "systemconfigmodel-give_integral_confirm", "name": "SystemConfigModel[give_integral_confirm]", "attribute": "give_integral_confirm", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"主动确认收货送积分必须是整数。","min":"主动确认收货送积分必须不小于0。","max":"主动确认收货送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "systemconfigmodel-give_integral_comment", "name": "SystemConfigModel[give_integral_comment]", "attribute": "give_integral_comment", "rules": {"string":true,"messages":{"string":"评价好评送积分必须是一条字符串。"}}},{"id": "systemconfigmodel-give_integral_comment", "name": "SystemConfigModel[give_integral_comment]", "attribute": "give_integral_comment", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"评价好评送积分必须是整数。","min":"评价好评送积分必须不小于0。","max":"评价好评送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "systemconfigmodel-give_integral_register", "name": "SystemConfigModel[give_integral_register]", "attribute": "give_integral_register", "rules": {"string":true,"messages":{"string":"会员注册送积分必须是一条字符串。"}}},{"id": "systemconfigmodel-give_integral_register", "name": "SystemConfigModel[give_integral_register]", "attribute": "give_integral_register", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员注册送积分必须是整数。","min":"会员注册送积分必须不小于0。","max":"会员注册送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "systemconfigmodel-give_integral_recharge", "name": "SystemConfigModel[give_integral_recharge]", "attribute": "give_integral_recharge", "rules": {"string":true,"messages":{"string":"平台储值卡充值送积分必须是一条字符串。"}}},{"id": "systemconfigmodel-give_integral_recharge", "name": "SystemConfigModel[give_integral_recharge]", "attribute": "give_integral_recharge", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"平台储值卡充值送积分必须是整数。","min":"平台储值卡充值送积分必须不小于0。","max":"平台储值卡充值送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "systemconfigmodel-give_integral_consume", "name": "SystemConfigModel[give_integral_consume]", "attribute": "give_integral_consume", "rules": {"string":true,"messages":{"string":"消费金额送积分必须是一条字符串。"}}},{"id": "systemconfigmodel-give_integral_consume", "name": "SystemConfigModel[give_integral_consume]", "attribute": "give_integral_consume", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"消费金额送积分必须是整数。","min":"消费金额送积分必须不小于0。","max":"消费金额送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "systemconfigmodel-give_integral_out_line_balance", "name": "SystemConfigModel[give_integral_out_line_balance]", "attribute": "give_integral_out_line_balance", "rules": {"string":true,"messages":{"string":"线下消费余额是否累计积分必须是一条字符串。"}}},{"id": "systemconfigmodel-integral_shipping", "name": "SystemConfigModel[integral_shipping]", "attribute": "integral_shipping", "rules": {"required":true,"messages":{"required":"积分兑换配送方式不能为空。"}}},{"id": "systemconfigmodel-integral_qrcode", "name": "SystemConfigModel[integral_qrcode]", "attribute": "integral_qrcode", "rules": {"string":true,"messages":{"string":"平台积分收款码必须是一条字符串。"}}},{"id": "systemconfigmodel-integral_image", "name": "SystemConfigModel[integral_image]", "attribute": "integral_image", "rules": {"string":true,"messages":{"string":"积分商城头像必须是一条字符串。"}}},{"id": "systemconfigmodel-integral_bg_image", "name": "SystemConfigModel[integral_bg_image]", "attribute": "integral_bg_image", "rules": {"string":true,"messages":{"string":"积分商城背景图必须是一条字符串。"}}},]
</script>

    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
    <script type="text/javascript">
        @if($config_info['integral_model']->value == 1)
            $('#systemconfigmodel-integral_validity').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_follow').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_confirm').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_comment').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_register').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_recharge').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_consume').parents('.simple-form-field').hide();
            $('#systemconfigmodel-give_integral_out_line_balance').parents('.simple-form-field').hide();
            $('#systemconfigmodel-integral_shipping').parents('.simple-form-field').hide();
            $('#systemconfigmodel-integral_qrcode').parents('.simple-form-field').hide();
            $('#integral_image_imagegroup_container').parents('.simple-form-field').hide();
        @endif

        $().ready(function() {

            $(".szy-imagegroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");

                var target = $("#" + id);
                var value = $(target).val();

                $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: size,
                    values: value.split("|"),
                    // 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    },
                    // 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };

            var integral_shipping_valid = true;
            if ($("input[name='SystemConfigModel[integral_shipping][]']").is(':checked') == false) {
                integral_shipping_valid = false;
            }
            $("input[name='SystemConfigModel[integral_shipping][]']").change(function() {
                if ($("input[name='SystemConfigModel[integral_shipping][]']").is(':checked') == false) {
                    integral_shipping_valid = false;
                    $.validator.showError($("#systemconfigmodel-integral_shipping"), '请选择一个积分兑换配送方式');
                } else {
                    integral_shipping_valid = true;
                    $.validator.clearError($("#systemconfigmodel-integral_shipping"));
                }
            });
            var validator = $("#SystemConfigModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                validator.form();
                if (!validator.form()) {
                    return false;
                }

                if (integral_shipping_valid == false) {
                    return false
                }
                $.loading.start();
                $("#SystemConfigModel").submit();
            });

            $("body").on("mouseover", ".QR-code", function() {
                if ($(this).data("loading")) {
                    return;
                }
                var target = $(this).find("img");
                var src = $(target).data("src");
                var img = new Image();
                img.src = src;
                img.onload = function() {
                    $(target).attr("src", src);
                };
                $(this).data("loading", true);
            });

            $('body').on('change', '#systemconfigmodel-integral_model input', function() {
                if ($(this).val() == 0) {
                    $('#systemconfigmodel-integral_validity').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_follow').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_confirm').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_comment').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_register').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_recharge').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_consume').parents('.simple-form-field').show();
                    $('#systemconfigmodel-give_integral_out_line_balance').parents('.simple-form-field').show();
                    $('#systemconfigmodel-integral_shipping').parents('.simple-form-field').show();
                    $('#systemconfigmodel-integral_qrcode').parents('.simple-form-field').show();
                    $('#integral_image_imagegroup_container').parents('.simple-form-field').show();
                } else {
                    $('#systemconfigmodel-integral_validity').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_follow').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_confirm').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_comment').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_register').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_recharge').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_consume').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-give_integral_out_line_balance').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-integral_shipping').parents('.simple-form-field').hide();
                    $('#systemconfigmodel-integral_qrcode').parents('.simple-form-field').hide();
                    $('#integral_image_imagegroup_container').parents('.simple-form-field').hide();
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop