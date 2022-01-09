{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="m-t-20">
        <div class="table-content m-t-10 clearfix  pull-left col-sm-8 p-l-0">
            <form id="SelfShopModel" class="form-horizontal" name="SelfShopModel" action="/shop/self-shop/edit?id={{ $info->shop_id }}&amp;is_supply=0" method="post">
                {{ csrf_field() }}

                <input type="hidden" id="selfshopmodel-is_supply" class="form-control" name="SelfShopModel[is_supply]" value="0">


                <!-- 店铺ID -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-shop_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">店铺ID：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="selfshopmodel-shop_id" class="form-control" name="SelfShopModel[shop_id]" value="{{ $info->shop_id }}" disabled="true">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <!-- 店铺名称  -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-shop_name" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">店铺名称：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="selfshopmodel-shop_name" class="form-control" name="SelfShopModel[shop_name]" value="{{ $info->shop_name }}">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 店铺所属分类 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">店铺所属分类：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">

                                <div class="form-control-box choosen-select-box">
                                    <a id="btn_add_other_cat" class="btn btn-primary pull-left m-2">
                                        <i class="fa fa-plus"></i>
                                        添加
                                    </a>


                                    @foreach($info->cat_ids as $cat_id)
                                        <div class="choosen-select-item other-cat">
                                            <select id="cat_ids" class="form-control chosen-select" name="cat_ids[]" style="display: none;">
                                                <option value="">-- 请选择 --</option>
                                                @foreach($cat_list as $cat)

                                                    <option value="{{ $cat['cls_id'] }}" @if($cat['cls_id'] == $cat_id) selected @endif>{{ $cat['level_show'] }}{{ $cat['cls_name'] }}</option>

                                                @endforeach

                                            </select>
                                            <a class="choosen-select-delete other-cat-delete">×</a>
                                        </div>
                                    @endforeach

                                </div>
                                <input type="hidden" id="selfshopmodel-cat_id" class="form-control" name="SelfShopModel[cat_id]" value="">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 结算周期 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-clearing_cycle" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">结算周期：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="selfshopmodel-clearing_cycle" class="form-control" name="SelfShopModel[clearing_cycle]">
                                    <option value="">-- 请选择 --</option>
                                    <option value="0" @if($info->clearing_cycle == 0) selected @endif>1个月</option>
                                    <option value="1" @if($info->clearing_cycle == 1) selected @endif>1周</option>
                                    <option value="2" @if($info->clearing_cycle == 2) selected @endif>1天</option>
                                    <option value="3" @if($info->clearing_cycle == 3) selected @endif>3天</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">商家与平台方资金进行结算的周期，线下协商，后台请勿随意修改</div></div>
                        </div>
                    </div>
                </div>
                <!-- 绑定店主账号 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-user_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">绑定店主帐号：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="keyword" class="form-control w150" name="keyword" placeholder="会员帐号/手机号码/邮箱">

                                <input type="button" id="btn_search_user" value="搜索" class="btn btn-primary" />

                                <select id="selfshopmodel-user_id" class="form-control chosen-select" name="SelfShopModel[user_id]">
                                    <option value="">--请输入条件搜索会员--</option>
                                    <option value="{{ $info->user_id }}" selected>{{ $info->user_name }} / {{ $info->user_name }}</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">请选择指定的会员，该会员将成为该店铺店主</div></div>
                        </div>
                    </div>
                </div>

                <!-- 企业法人营业执照 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="shopfieldvaluemodel-license" class="col-sm-4 control-label">
                            <span class="ng-binding">企业法人营业执照：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <div class="form-control-box w400">
                                    <div id="license_imagegroup_container" class="szy-imagegroup" data-id="shopfieldvaluemodel-license" data-size="1"></div>

                                    <div class="example-image">
                                        <span>参考示例：</span>
                                        <ul class="image-group">
                                            <li>
                                                <a href="javascript:void(0);" class="highslide">
                                                    <img src="{{ get_image_url(sysconf('company_demo_image')) }}" />
                                                </a>
                                                <img class="enlarge-image" src="{{ get_image_url(sysconf('company_demo_image')) }}" />
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <input type="hidden" id="shopfieldvaluemodel-license" class="form-control" name="ShopFieldValueModel[license]" value="{{ $info->shopFieldValue->license }}">
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">请使用595*842像素jpg、gif、png格式的图片，并且图片大小不得超过2M。</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 特殊行业资质 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="shopfieldvaluemodel-special_aptitude" class="col-sm-4 control-label">
                            <span class="ng-binding">特殊行业资质：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <div class="form-control-box w400">
                                    <div id="special_aptitude_imagegroup_container" class="szy-imagegroup" data-id="shopfieldvaluemodel-special_aptitude" data-size="3"></div>
                                </div>
                                <input type="hidden" id="shopfieldvaluemodel-special_aptitude" class="form-control" name="ShopFieldValueModel[special_aptitude]" value="{{ $info->shopFieldValue->special_aptitude }}">
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">请使用595*842像素jpg、gif、png格式的图片，并且图片大小不得超过2M。</div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- 商品是否需要审核 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-goods_status" class="col-sm-4 control-label">

                            <span class="ng-binding">店铺商品是否需要审核：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label cur-p m-r-20">
                                    <input type="radio" id="selfshopmodel-goods_status" class="" name="SelfShopModel[goods_status]" value="0" @if($info->goods_status == 0) checked="" @endif> 系统默认
                                </label>

                                <label class="control-label cur-p m-r-20">
                                    <input type="radio" id="selfshopmodel-goods_status" class="" name="SelfShopModel[goods_status]" value="1" @if($info->goods_status == 1) checked="" @endif> 必须审核
                                </label>

                                <label class="control-label cur-p">
                                    <input type="radio" id="selfshopmodel-goods_status" class="" name="SelfShopModel[goods_status]" value="2" @if($info->goods_status == 2) checked="" @endif> 无需审核
                                </label>

                                <label class="control-label cur-p">
                                    <input type="radio" id="selfshopmodel-goods_status" class="" name="SelfShopModel[goods_status]" value="3" @if($info->goods_status == 3) checked="" @endif> 仅第一次上架时需要审核
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">默认执行平台统一设置的审核机制，也可单独设置该店铺商品是否需要审核；<br/>必须审核：店铺发布商品后需管理员审核后方可上架销售；</br>无需审核：店铺发布商品后自动上架销售</div></div>
                        </div>
                    </div>
                </div>
                <!--店铺信誉是否显示-->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-show_credit" class="col-sm-4 control-label">

                            <span class="ng-binding">是否显示店铺信誉：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="SelfShopModel[show_credit]" value="0">
                                        <label><input type="checkbox" id="selfshopmodel-show_credit" class="form-control b-n" name="SelfShopModel[show_credit]" value="1" @if($info->show_credit == 1) checked="" @endif data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">是：则店铺的信誉、评分将在商城前台展示；否：则店铺的信誉、评分将不在前台展示</div></div>
                        </div>
                    </div>
                </div>
                <!-- 是否允许登录卖家中心 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-login_status" class="col-sm-4 control-label">

                            <span class="ng-binding">是否允许登录卖家中心：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="SelfShopModel[login_status]" value="0">
                                        <label><input type="checkbox" id="selfshopmodel-login_status" class="form-control b-n" name="SelfShopModel[login_status]" value="1" @if($info->login_status == 1) checked="" @endif data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">控制商家是否允许登录卖家中心</div></div>
                        </div>
                    </div>
                </div>
                <!-- 店铺商品能否在商城展示 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-goods_is_show" class="col-sm-4 control-label">

                            <span class="ng-binding">店铺商品能否在商城展示：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="SelfShopModel[goods_is_show]" value="0">
                                        <label><input type="checkbox" id="selfshopmodel-goods_is_show" class="form-control b-n" name="SelfShopModel[goods_is_show]" value="1" @if($info->goods_is_show == 1) checked="" @endif data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">控制店铺商品能否在商城展示，否：表示在商城商品列表、搜索结果页都不展示店铺商品</div></div>
                        </div>
                    </div>
                </div>
                <!-- 是否在店铺街展示 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-show_in_street" class="col-sm-4 control-label">

                            <span class="ng-binding">店铺能否在商城展示：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <label class="control-label control-label-switch">
                                    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                        <input type="hidden" name="SelfShopModel[show_in_street]" value="0">
                                        <label><input type="checkbox" id="selfshopmodel-show_in_street" class="form-control b-n" name="SelfShopModel[show_in_street]" value="1" @if($info->show_in_street == 1) checked="" @endif data-on-text="是" data-off-text="否"> </label>
                                    </div>
                                </label>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">控制店铺能否在商城展示，否：表示店铺无法在店铺街展示，搜索店铺无法搜索到</div></div>
                        </div>
                    </div>
                </div>
                <!-- 推荐排序 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="selfshopmodel-shop_sort" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">排序：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="selfshopmodel-shop_sort" class="form-control small" name="SelfShopModel[shop_sort]" value="{{ $info->shop_sort }}">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">默认排序255，数字越小店铺排序越靠前</div></div>
                        </div>
                    </div>
                </div>

                <div class="bottom-btn p-b-30">
                    <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
                </div>

            </form>
        </div>

        <div class="detail pull-left col-sm-4">
            <dl>
                <dt>店主账号：</dt>
                <dd>
                    {{ $info->user_name }}

                </dd>
            </dl>
            <dl>
                <dt>认证手机：</dt>
                <dd></dd>
            </dl>
            <dl>
                <dt>认证邮箱：</dt>
                <dd></dd>
            </dl>
            <dl>
                <dt>开店时间：</dt>
                <dd>{{ $info->created_at }}</dd>
            </dl>
            <dl>
                <dt>会员数量：</dt>
                <dd>
                    <font class="c-red m-r-5">0</font>
                </dd>
            </dl>
            <dl>
                <dt>订单数量：</dt>
                <dd>
                    <font class="c-red m-r-5">0</font>
                </dd>
            </dl>
            <dl>
                <dt>店铺信誉：</dt>
                <dd>
					<span>
						<img src="" class="rank" title="" data-toggle="tooltip" data-placement="auto bottom" height="16" />
					</span>
                    <span class="m-l-10">0 分</span>
                </dd>
            </dl>
            <dl>
                <dt>店铺评分：</dt>
                <dd>
                    <div class="ng-binding">
						<span>
							综合：
							<font class="c-red m-r-5">5.00</font>
							分
						</span>
                        <span>
							描述：
							<font class="c-red m-r-5">5.00</font>
							分
						</span>
                        <span>
							服务：
							<font class="c-red m-r-5">5.00</font>
							分
						</span>
                        <span>
							发货：
							<font class="c-red m-r-5">5.00</font>
							分
						</span>
                        <span>
							物流：
							<font class="c-red m-r-5">5.00</font>
							分
						</span>
                    </div>
                </dd>
            </dl>
        </div>

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>

    <script id="other_cat_template" type='text'>
<div class="choosen-select-item other-cat">
	<select id="cat_ids" class="form-control chosen-select" name="cat_ids[]">
<option value="">-- 请选择 --</option>
@foreach($cat_list as $cat)
            <option value="{{ $cat['cls_id'] }}">{{ $cat['level_show'] }}{{ $cat['cls_name'] }}</option>
                @endforeach
</select>
	<a class="choosen-select-delete other-cat-delete">×</a>
</div>
</script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "selfshopmodel-shop_sort", "name": "SelfShopModel[shop_sort]", "attribute": "shop_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "selfshopmodel-shop_id", "name": "SelfShopModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "selfshopmodel-clearing_cycle", "name": "SelfShopModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "selfshopmodel-clearing_cycle", "name": "SelfShopModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "selfshopmodel-user_id", "name": "SelfShopModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"绑定店主帐号不能为空。"}}},{"id": "selfshopmodel-shop_name", "name": "SelfShopModel[shop_name]", "attribute": "shop_name", "rules": {"required":true,"messages":{"required":"店铺名称不能为空。"}}},{"id": "selfshopmodel-cat_id", "name": "SelfShopModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"店铺所属分类不能为空。"}}},{"id": "selfshopmodel-shop_name", "name": "SelfShopModel[shop_name]", "attribute": "shop_name", "rules": {"string":true,"messages":{"string":"店铺名称必须是一条字符串。","maxlength":"店铺名称只能包含至多20个字符。"},"maxlength":20}},{"id": "selfshopmodel-region_code", "name": "SelfShopModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"Region Code必须是一条字符串。","maxlength":"Region Code只能包含至多60个字符。"},"maxlength":60}},{"id": "selfshopmodel-close_info", "name": "SelfShopModel[close_info]", "attribute": "close_info", "rules": {"string":true,"messages":{"string":"店铺状态修改备注必须是一条字符串。","maxlength":"店铺状态修改备注只能包含至多500个字符。"},"maxlength":500}},{"id": "selfshopmodel-shop_sort", "name": "SelfShopModel[shop_sort]", "attribute": "shop_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "selfshopmodel-shop_name", "name": "SelfShopModel[shop_name]", "attribute": "shop_name", "rules": {"ajax":{"url":"/shop/self-shop/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2VsZlNob3BNb2RlbA==","attribute":"shop_name","params":["SelfShopModel[shop_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
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
            var validator = $("#SelfShopModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                $("#selfshopmodel-cat_id").val($("#cat_ids").val());
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#SelfShopModel").submit();
            });

            // 添加扩展分类
            $("#btn_add_other_cat").click(function() {
                var template = $("#other_cat_template").html();
                var element = $($.parseHTML(template));
                $(this).after(element);
                $(element).find('.chosen-select').chosen();
            });

            // 删除扩展分类
            $("body").on("click", ".other-cat-delete", function() {
                $(this).parents(".other-cat").remove();
            });

            // 搜索会员
            $("#btn_search_user").click(function() {
                var keyword = $("#keyword").val();

                if ($.trim(keyword) == "") {
                    $("#keyword").focus();
                    $.msg("请输入搜索会员的关键词！");
                    return;
                }

                $.loading.start();

                $.get("search-user", {
                    keyword: keyword
                }, function(result) {
                    if (result.code == 0) {

                        var users = [];

                        if (result.data && result.data.users) {
                            users = result.data.users;
                        }

                        if (users.length == 0) {
                            $("#keyword").focus();
                            $.msg("没有搜索到任何会员信息！");
                        }

                        var html = "<option value=''>--请选择绑定的会员--</option>";

                        for (var i = 0; i < users.length; i++) {
                            var item = users[i];

                            var label = item.user_name;
                            var title = item.user_name;

                            if ($.trim(item.mobile) != "") {
                                label += " / " + item.mobile;
                                title += " / " + item.mobile;
                            }

                            if ($.trim(item.email) != "") {
                                title += " / " + item.email;
                            }

                            if ($.trim(item.nickname) != "" && item.nickname != item.user_name) {
                                title += " / " + item.nickname;
                            }

                            if (item.user_id == "12") {
                                selected = "selected='selected'";
                            } else {
                                selected = "";
                            }

                            html += "<option value='" + item.user_id + "' " + selected + " title='" + title + "'>" + label + "</option>"
                        }

                        $("#selfshopmodel-user_id").html(html);

                        $(".chosen-select").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });

            $("#selfshopmodel-user_id").change(function() {
                $(this).valid();
            })
        });
    </script>
    <script type="text/javascript">
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
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop