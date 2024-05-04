{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180428"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix  pull-left col-sm-8 p-l-0">
        <form id="ShopModel" class="form-horizontal" name="ShopModel" action="/shop/shop/edit?id={{ $info->shop_id }}&shop_type={{ $info->shop_type }}&is_supply={{ $info->is_supply }}" method="post" novalidate="novalidate">
            @csrf

            <input type="hidden" id="shopmodel-is_supply" class="form-control" name="ShopModel[is_supply]" value="{{ $info->is_supply }}">


            <!-- 店铺ID -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-shop_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺ID：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-shop_id" class="form-control" name="ShopModel[shop_id]" value="{{ $info->shop_id }}" disabled="">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 店铺名称  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-shop_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-shop_name" class="form-control" name="ShopModel[shop_name]" value="{{ $info->shop_name }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-shop_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shopmodel-shop_type" class="form-control" name="ShopModel[shop_type]" disabled="">
                                <option value="">-- 请选择 --</option>
                                <option value="1" @if($info->shop_type == 1) selected="" @endif>个人店铺</option>
                                <option value="2" @if($info->shop_type == 2) selected="" @endif>企业店铺</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 结算周期 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-clearing_cycle" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">结算周期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shopmodel-clearing_cycle" class="form-control" name="ShopModel[clearing_cycle]">
                                <option value="">-- 请选择 --</option>
                                <option value="0" @if($info->clearing_cycle == 0) selected="" @endif>1个月</option>
                                <option value="1" @if($info->clearing_cycle == 1) selected="" @endif>1周</option>
                                <option value="2" @if($info->clearing_cycle == 2) selected="" @endif>1天</option>
                                <option value="3" @if($info->clearing_cycle == 3) selected="" @endif>3天</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">商家与平台方资金进行结算的周期，线下协商，后台请勿随意修改</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺所属分类 -->
            <div class="simple-form-field">
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


                                @foreach($shop_bind_class as $bind_class)
                                <div class="choosen-select-item other-cat">
                                    <select id="cat_ids" class="form-control chosen-select" name="cat_ids[]" style="display: none;">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($cat_list as $cat)

                                            <option value="{{ $cat['cls_id'] }}" @if($cat['cls_id'] == $bind_class->cls_id) selected @endif>{{ $cat['level_show'] }}{{ $cat['cls_name'] }}</option>

                                        @endforeach

                                    </select>
                                    <a class="choosen-select-delete other-cat-delete">×</a>
                                </div>
                                @endforeach


                            </div>
                            <input type="hidden" id="shopmodel-cat_id" class="form-control" name="ShopModel[cat_id]" value="">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 佣金比例 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-take_rate" class="col-sm-4 control-label">

                        <span class="ng-binding">佣金比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-take_rate" class="form-control ipt m-r-10" name="ShopModel[take_rate]" value="{{ $info->take_rate }}"> %


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置为空，则店铺佣金按商品分类的佣金比例计算，如果设置大于等于0的数字，则按店铺佣金比例进行计算佣金</div></div>
                    </div>
                </div>
            </div>
            <!-- 神码佣金比例 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-qrcode_take_rate" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">神码佣金比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-qrcode_take_rate" class="form-control ipt m-r-10" name="ShopModel[qrcode_take_rate]" value="{{ $info->qrcode_take_rate }}"> %


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺状态： -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-shop_status" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[shop_status]" value="0">
                                    <label>
                                        <input type="checkbox" id="shopmodel-shop_status" class="form-control b-n" name="ShopModel[shop_status]" value="1" @if($info->shop_status == 1) checked="" @endif data-on-text="开启" data-off-text="关闭">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺状态修改备注 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-close_info" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺状态修改备注：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopmodel-close_info" class="form-control" name="ShopModel[close_info]" rows="5">{!! $info->close_info !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">关闭店铺：买家无法访问该店铺和该店铺下的商品，但卖家仍然可以登录卖家中心</div></div>
                    </div>
                </div>
            </div>
            <!-- 商品是否需要审核 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-goods_status" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺商品是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label cur-p m-r-20">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="0" @if($info->goods_status == 0) checked="" @endif> 系统默认
                            </label>

                            <label class="control-label cur-p m-r-20">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="1" @if($info->goods_status == 1) checked="" @endif> 必须审核
                            </label>

                            <label class="control-label cur-p">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="2" @if($info->goods_status == 2) checked="" @endif> 无需审核
                            </label>

                            <label class="control-label cur-p">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="3" @if($info->goods_status == 3) checked="" @endif> 仅第一次上架时需要审核
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认执行平台统一设置的审核机制，也可单独设置该店铺商品是否需要审核；<br>必须审核：店铺发布商品后需管理员审核后方可上架销售；<br>无需审核：店铺发布商品后自动上架销售</div></div>
                    </div>
                </div>
            </div>
            <!--店铺信誉是否显示-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-show_credit" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示店铺信誉：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[show_credit]" value="0">
                                    <label>
                                        <input type="checkbox" id="shopmodel-show_credit" class="form-control b-n" name="ShopModel[show_credit]" value="1" @if($info->show_credit == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是：则店铺的信誉、评分将在商城前台展示；否：则店铺的信誉、评分将不在前台展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺控制价格显示 -->
            <div class="simple-form-field" style="display: none">
                <div class="form-group ng-scope">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺控制价格显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-switch-state"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary">是</span><span class="bootstrap-switch-label">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default">否</span><input name="collapsemenu" class="onoffswitch-checkbox" type="checkbox" id="switch-state" data-on-text="是" data-off-text="否"></div></div>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t">是：店铺可以控制店铺商品是否在前台显示价格；否：则店铺无设置价商品格是否显示权限</div>
                    </div>
                </div>
            </div>
            <!-- 是否允许登录卖家中心 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-login_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否允许登录卖家中心：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[login_status]" value="0">
                                    <label>
                                        <input type="checkbox" id="shopmodel-login_status" class="form-control b-n" name="ShopModel[login_status]" value="1" @if($info->login_status == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制商家是否允许登录卖家中心</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺商品能否在商城展示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-goods_is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺商品能否在商城展示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[goods_is_show]" value="0">
                                    <label>
                                        <input type="checkbox" id="shopmodel-goods_is_show" class="form-control b-n" name="ShopModel[goods_is_show]" value="1" @if($info->goods_is_show == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制店铺商品能否在商城展示，否：表示在商城商品列表、搜索结果页都不展示店铺商品</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺是否在店铺街展示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-show_in_street" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺能否在商城展示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopModel[show_in_street]" value="0">
                                    <label>
                                        <input type="checkbox" id="shopmodel-show_in_street" class="form-control b-n" name="ShopModel[show_in_street]" value="1" @if($info->show_in_street == 1) checked="" @endif data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制店铺能否在商城展示，否：表示店铺无法在店铺街展示，搜索店铺无法搜索到</div></div>
                    </div>
                </div>
            </div>
            <!-- 推荐排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-shop_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-shop_sort" class="form-control small" name="ShopModel[shop_sort]" value="{{ $info->shop_sort ?? 255 }}">


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
            <dt>店主帐号：</dt>
            <dd>
                {{ $info->user->user_name ?? '' }}

                <span class="tool m-l-10">

					<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=123456s&amp;site=qq&amp;menu=yes">
						<img border="0" src="http://wpa.qq.com/pa?p=2:2697138383:51" alt="点击这里给我发消息" title="点击这里给我发消息">
					</a>

				</span>

            </dd>
        </dl>
        <dl>
            <dt>认证手机：</dt>
            <dd>{{ $info->user->mobile ?? '' }}</dd>
        </dl>
        <dl>
            <dt>认证邮箱：</dt>
            <dd>{{ $info->user->email ?? '' }}</dd>
        </dl>
        <dl>
            <dt>申请时间：</dt>
            <dd>{{ $info->created_at }}</dd>
        </dl>

        <dl>
            <dt>开店时间：</dt>
            <dd>{{ format_time($info->open_time) }}</dd>
        </dl>
        <dl>
            <dt>到期时间：</dt>
            <dd>{{ format_time($info->end_time) }}</dd>
        </dl>
        <dl>
            <dt>平台保证金：</dt>
            <dd>

                <font class="c-red m-r-5">{{ $info->insure_fee }}</font>
                元

            </dd>
        </dl>
        <dl>
            <dt>平台使用费：</dt>
            <dd>

                <font class="c-red m-r-5">{{ $info->system_fee }}</font>
                元

            </dd>
        </dl>
        <dl>
            <dt>会员数量：</dt>
            <dd>
                <font class="c-red m-r-5">{{ $info->member_count ?? 0 }}</font>
            </dd>
        </dl>
        <dl>
            <dt>订单数量：</dt>
            <dd>
                <font class="c-red m-r-5">{{ $info->order_info_count ?? 0 }}</font>
            </dd>
        </dl>
        <dl>
            <dt>店铺余额：</dt>
            <dd>
                <font class="c-red m-r-5">{{ $info->user->user_money + $info->user->user_money_limit }}</font>
                元
            </dd>
        </dl>
        <dl>
            <dt>店铺信誉：</dt>
            <dd>

				<span>
					<img src="{{ get_image_url($info->credit_img) }}" class="rank" title="" data-toggle="tooltip" data-placement="auto bottom" height="16" data-original-title="{{ $info->credit_name }}">
				</span>

                <span class="m-l-10">{{ $info->credit }} 分</span>
            </dd>
        </dl>
        <dl>
            <dt>店铺评分：</dt>
            <dd>
                <div class="ng-binding">
					<span>
						综合：
						<font class="c-red m-r-5">{{ $info->score }}</font>
						分
					</span>
                    <span>
						描述：
						<font class="c-red m-r-5">{{ $info->desc_score }}</font>
						分
					</span>
                    <span>
						服务：
						<font class="c-red m-r-5">{{ $info->service_score }}</font>
						分
					</span>
                    <span>
						发货：
						<font class="c-red m-r-5">{{ $info->send_score }}</font>
						分
					</span>
                    <span>
						物流：
						<font class="c-red m-r-5">{{ $info->logistics_score }}</font>
						分
					</span>
                </div>
            </dd>
        </dl>

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
    <script id="other_cat_template" type="text">
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
    [{"id": "shopmodel-shop_id", "name": "ShopModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "shopmodel-goods_status", "name": "ShopModel[goods_status]", "attribute": "goods_status", "rules": {"required":true,"messages":{"required":"店铺商品是否需要审核不能为空。"}}},{"id": "shopmodel-shop_sort", "name": "ShopModel[shop_sort]", "attribute": "shop_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopmodel-user_id", "name": "ShopModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"绑定店主帐号不能为空。"}}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"required":true,"messages":{"required":"店铺名称不能为空。"}}},{"id": "shopmodel-shop_type", "name": "ShopModel[shop_type]", "attribute": "shop_type", "rules": {"required":true,"messages":{"required":"店铺类型不能为空。"}}},{"id": "shopmodel-cat_id", "name": "ShopModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"店铺所属分类不能为空。"}}},{"id": "shopmodel-clearing_cycle", "name": "ShopModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "shopmodel-qrcode_take_rate", "name": "ShopModel[qrcode_take_rate]", "attribute": "qrcode_take_rate", "rules": {"required":true,"messages":{"required":"神码佣金比例不能为空。"}}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"string":true,"messages":{"string":"店铺名称必须是一条字符串。","maxlength":"店铺名称只能包含至多20个字符。"},"maxlength":20}},{"id": "shopmodel-region_code", "name": "ShopModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"Region Code必须是一条字符串。","maxlength":"Region Code只能包含至多60个字符。"},"maxlength":60}},{"id": "shopmodel-close_info", "name": "ShopModel[close_info]", "attribute": "close_info", "rules": {"string":true,"messages":{"string":"店铺状态修改备注必须是一条字符串。","maxlength":"店铺状态修改备注只能包含至多500个字符。"},"maxlength":500}},{"id": "shopmodel-fail_info", "name": "ShopModel[fail_info]", "attribute": "fail_info", "rules": {"string":true,"messages":{"string":"审核失败原因必须是一条字符串。","maxlength":"审核失败原因只能包含至多500个字符。"},"maxlength":500}},{"id": "shopmodel-shop_sort", "name": "ShopModel[shop_sort]", "attribute": "shop_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"ajax":{"url":"/shop/shop/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2hvcE1vZGVs","attribute":"shop_name","params":["ShopModel[shop_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "shopmodel-take_rate", "name": "ShopModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例必须是一个数字。","min":"佣金比例必须不小于0。","max":"佣金比例必须不大于100。"},"min":0,"max":100}},{"id": "shopmodel-qrcode_take_rate", "name": "ShopModel[qrcode_take_rate]", "attribute": "qrcode_take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"神码佣金比例必须是一个数字。","min":"神码佣金比例必须不小于0。","max":"神码佣金比例必须不大于100。"},"min":0,"max":100}},]
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
            var validator = $("#ShopModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                $("#shopmodel-cat_id").val($("#cat_ids").val());
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopModel").submit();
            });

            // 开店时长选择事件
            $("#shopmodel-duration").change(function() {
                // 平台使用费
                var payment = 0;
                if ($(this).val() != "") {
                    var array = $(this).val().split("-");
                    payment = parseFloat(array[2]);
                }
                $("#shopmodel-system_fee").val(payment.toFixed(2));
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
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop