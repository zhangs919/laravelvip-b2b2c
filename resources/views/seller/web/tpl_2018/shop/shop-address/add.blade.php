{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ShopAddressModel" class="form-horizontal" name="ShopAddressModel" action="/shop/shop-address/add" method="post">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="shopaddressmodel-address_id" class="form-control" name="ShopAddressModel[address_id]" value="{{ $info->address_id ?? '' }}">

            <input type="hidden" id="shopaddressmodel-shop_id" class="form-control" name="ShopAddressModel[shop_id]" value="{{ $shop_info->shop_id }}">
            <!-- 收件人 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopaddressmodel-consignee" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">联系人：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopaddressmodel-consignee" class="form-control" name="ShopAddressModel[consignee]" value="{{ $info->consignee ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 所在地区编码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopaddressmodel-region_code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">所在地区：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="region_container"></div>
                            <input type="hidden" id="shopaddressmodel-region_code" class="form-control" name="ShopAddressModel[region_code]" value="{{ $info->region_code ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 详细地址 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopaddressmodel-address_detail" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">详细地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopaddressmodel-address_detail" class="form-control" name="ShopAddressModel[address_detail]" rows="2">{!! $info->address_detail ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">建议您如实填写详细发货地址，例如街道名称、门牌号码、楼层和房间号等信息</div></div>
                    </div>
                </div>
            </div>
            <!-- 手机号码 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopaddressmodel-mobile" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">手机号码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopaddressmodel-mobile" class="form-control" name="ShopAddressModel[mobile]" value="{{ $info->mobile ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 固定电话 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopaddressmodel-tel" class="col-sm-4 control-label">

                        <span class="ng-binding">固定电话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopaddressmodel-tel" class="form-control" name="ShopAddressModel[tel]" value="{{ $info->tel ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">格式：区号-电话，例如：0335-7011111</div></div>
                    </div>
                </div>
            </div>
            <!-- 邮箱 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopaddressmodel-email" class="col-sm-4 control-label">

                        <span class="ng-binding">邮箱：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopaddressmodel-email" class="form-control" name="ShopAddressModel[email]" value="{{ $info->email ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
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
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 地区选择 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "shopaddressmodel-consignee", "name": "ShopAddressModel[consignee]", "attribute": "consignee", "rules": {"required":true,"messages":{"required":"联系人不能为空。"}}},{"id": "shopaddressmodel-region_code", "name": "ShopAddressModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"所在地区不能为空。"}}},{"id": "shopaddressmodel-address_detail", "name": "ShopAddressModel[address_detail]", "attribute": "address_detail", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "shopaddressmodel-mobile", "name": "ShopAddressModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号码不能为空。"}}},{"id": "shopaddressmodel-is_default", "name": "ShopAddressModel[is_default]", "attribute": "is_default", "rules": {"required":true,"messages":{"required":"是否默认不能为空。"}}},{"id": "shopaddressmodel-shop_id", "name": "ShopAddressModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "shopaddressmodel-is_default", "name": "ShopAddressModel[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否默认必须是整数。"}}},{"id": "shopaddressmodel-shop_id", "name": "ShopAddressModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "shopaddressmodel-email", "name": "ShopAddressModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮箱必须是一条字符串。","maxlength":"邮箱只能包含至多60个字符。"},"maxlength":60}},{"id": "shopaddressmodel-consignee", "name": "ShopAddressModel[consignee]", "attribute": "consignee", "rules": {"string":true,"messages":{"string":"联系人必须是一条字符串。","maxlength":"联系人只能包含至多10个字符。"},"maxlength":10}},{"id": "shopaddressmodel-tel", "name": "ShopAddressModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"固定电话必须是一条字符串。","maxlength":"固定电话只能包含至多20个字符。"},"maxlength":20}},{"id": "shopaddressmodel-region_code", "name": "ShopAddressModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"所在地区必须是一条字符串。","maxlength":"所在地区只能包含至多20个字符。"},"maxlength":20}},{"id": "shopaddressmodel-address_detail", "name": "ShopAddressModel[address_detail]", "attribute": "address_detail", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "shopaddressmodel-mobile", "name": "ShopAddressModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|199[0-9]{8}$|198[0-9]{8}$|166[0-9]{8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "shopaddressmodel-email", "name": "ShopAddressModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮箱不是有效的邮箱地址。"}}},{"id": "shopaddressmodel-tel", "name": "ShopAddressModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^0[0-9]{2,3}-[0-9]{7,8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"固定电话是无效的。"}}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopAddressModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopAddressModel").submit();

            });
            // 初始化地区选择器
            $("#region_container").regionselector({
                value: '',
                select_class: 'form-control',
                change: function(value, names, is_last) {
                    $("#shopaddressmodel-region_code").val(value);
                    $("#shopaddressmodel-region_code").data("is_last", is_last);
                    $("#shopaddressmodel-region_code").valid();
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop