{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 col-sm-12 p-l-0">
        <form id="ShopApplyModel" class="form-horizontal" name="ShopApplyModel" action="/shop/shop/apply-edit?id={{ $info->shop_id }}&shop_type={{ $shop_type }}&audit={{ $audit }}&is_supply={{ $is_supply }}" method="post" novalidate="novalidate">
            @csrf
            <input type="hidden" id="shopmodel-shop_id" class="form-control" name="ShopApplyModel[shop_id]" value="{{ $info->shop_id }}">

            <!-- 店铺ID -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopapplymodel-shop_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺ID：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopapplymodel-shop_id" class="form-control" name="ShopApplyModel[shop_id]" value="{{ $info->shop_id }}" disabled="">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺名称  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopapplymodel-shop_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopapplymodel-shop_name" class="form-control" name="ShopApplyModel[shop_name]" value="{{ $info->shop_name }}" disabled="">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 开店申请审核状态 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopapplymodel-audit_status" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">开店申请审核状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            @if($audit == 0)
                                <label class="control-label cur-p m-r-20">
                                    <input type="radio" id="shopapplymodel-audit_status" class="" name="ShopApplyModel[audit_status]" value="0" @if($info->audit_status == 0) checked="" @endif > 待审核
                                </label>
                                <label class="control-label cur-p m-r-20">
                                    <input type="radio" id="shopapplymodel-audit_status" class="" name="ShopApplyModel[audit_status]" value="1" @if($info->audit_status == 1) checked="" @endif > 审核通过
                                </label>
                                <label class="control-label cur-p">
                                    <input type="radio" id="shopapplymodel-audit_status" class="" name="ShopApplyModel[audit_status]" value="2" @if($info->audit_status == 2) checked="" @endif > 拒绝通过
                                </label>
                            @else
                                <label class="control-label cur-p m-r-20">
                                    <input type="radio" id="shopapplymodel-audit_status" class="" name="ShopApplyModel[audit_status]" value="0" @if($audit == 0) checked="" @endif > 待审核
                                </label>
                                <label class="control-label cur-p m-r-20">
                                    <input type="radio" id="shopapplymodel-audit_status" class="" name="ShopApplyModel[audit_status]" value="1" @if($audit == 1) checked="" @endif > 审核通过
                                </label>
                                <label class="control-label cur-p">
                                    <input type="radio" id="shopapplymodel-audit_status" class="" name="ShopApplyModel[audit_status]" value="2" @if($audit == 2) checked="" @endif > 拒绝通过
                                </label>
                            @endif

                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 审核失败原因 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopapplymodel-fail_info" class="col-sm-4 control-label">
                        <span class="ng-binding">审核失败原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <textarea id="shopapplymodel-fail_info" class="form-control" name="ShopApplyModel[fail_info]" rows="5">{!! $info->fail_info !!}</textarea>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
            </div>

        </form>
    </div>

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    [{"id": "shopapplymodel-shop_id", "name": "ShopApplyModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "shopapplymodel-audit_status", "name": "ShopApplyModel[audit_status]", "attribute": "audit_status", "rules": {"required":true,"messages":{"required":"开店申请审核状态不能为空。"}}},{"id": "shopapplymodel-shop_name", "name": "ShopApplyModel[shop_name]", "attribute": "shop_name", "rules": {"required":true,"messages":{"required":"店铺名称不能为空。"}}},{"id": "shopapplymodel-shop_name", "name": "ShopApplyModel[shop_name]", "attribute": "shop_name", "rules": {"string":true,"messages":{"string":"店铺名称必须是一条字符串。","maxlength":"店铺名称只能包含至多20个字符。"},"maxlength":20}},{"id": "shopapplymodel-fail_info", "name": "ShopApplyModel[fail_info]", "attribute": "fail_info", "rules": {"string":true,"messages":{"string":"审核失败原因必须是一条字符串。","maxlength":"审核失败原因只能包含至多500个字符。"},"maxlength":500}},{"id": "shopapplymodel-shop_name", "name": "ShopApplyModel[shop_name]", "attribute": "shop_name", "rules": {"ajax":{"url":"/shop/shop/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2hvcE1vZGVs","attribute":"shop_name","params":["ShopApplyModel[shop_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {

            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".table-content").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            var validator = $("#ShopApplyModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopApplyModel").submit();
            });
            
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop