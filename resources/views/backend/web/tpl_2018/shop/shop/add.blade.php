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

    <div class="table-content m-t-30 clearfix ">
        <form id="ShopModel" class="form-horizontal" name="ShopModel" action="/shop/shop/add?is_supply=0" method="post" novalidate="novalidate">
            @csrf

            <input type="hidden" id="shopmodel-is_supply" class="form-control" name="ShopModel[is_supply]" value="0">


            <!-- 店铺名称  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-shop_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-shop_name" class="form-control" name="ShopModel[shop_name]">


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


                            <select id="shopmodel-shop_type" class="form-control" name="ShopModel[shop_type]">
                                <option value="">-- 请选择 --</option>
                                <option value="1">个人店铺</option>
                                <option value="2">企业店铺</option>
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
                                <option value="0">1个月</option>
                                <option value="1">1周</option>
                                <option value="2">1天</option>
                                <option value="3">3天</option>
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

                                <div class="choosen-select-item other-cat">

                                    <select id="cat_ids" class="form-control chosen-select" name="cat_ids[]" style="display: none;">
                                        <option value="">-- 请选择 --</option>
                                        @foreach($cat_list as $cat)

                                            <option value="{{ $cat['cls_id'] }}">{!! $cat['level_show'] !!}{{ $cat['cls_name'] }}</option>

                                        @endforeach

                                    </select>
                                    <a class="choosen-select-delete other-cat-delete">×</a>
                                </div>

                            </div>
                            <input type="hidden" id="shopmodel-cat_id" class="form-control" name="ShopModel[cat_id]" value="">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 绑定店主账号 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopmodel-user_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">绑定店主帐号：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="keyword" class="form-control w150" name="keyword" placeholder="会员帐号/手机号码/邮箱">

                            <input type="button" id="btn_search_user" value="搜索" class="btn btn-primary" />

                            <select id="shopmodel-user_id" class="form-control chosen-select" name="ShopModel[user_id]">
                                <option value="">--请输入条件搜索会员--</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请选择指定的会员，该会员将成为该店铺店主</div></div>
                    </div>
                </div>
            </div>
            <!-- 开店时长 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-duration" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">开店时长：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shopmodel-duration" class="form-control" name="ShopModel[duration]">
                                <option value="">-- 请选择 --</option>
                                @if(!empty($use_fee_value))
                                    @foreach($use_fee_value['number'] as $k=>$item)
                                        @php $f_value = $use_fee_value['number'][$k].'-'.$use_fee_value['unit'][$k].'-'.$use_fee_value['fee'][$k]; @endphp
                                        <option value="{{ $f_value }}" @if(@$info->duration == $f_value) selected @endif>{{ $use_fee_value['number'][$k] }}{{ format_unit($use_fee_value['unit'][$k]) }}</option>
                                    @endforeach
                                @endif
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 平台使用费 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-system_fee" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">平台使用费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-system_fee" class="form-control ipt m-r-5" name="ShopModel[system_fee]"> 元


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 平台保证金 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-insure_fee" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">平台保证金：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopmodel-insure_fee" class="form-control ipt m-r-10" name="ShopModel[insure_fee]" value="{{ sysconf('base_fee') }}"> 元


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


                            <input type="text" id="shopmodel-take_rate" class="form-control ipt m-r-10" name="ShopModel[take_rate]" value="0"> %


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


                            <input type="text" id="shopmodel-qrcode_take_rate" class="form-control ipt m-r-10" name="ShopModel[qrcode_take_rate]" value="0"> %


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


                            <label class="control-label">关闭</label>


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


                            <textarea id="shopmodel-close_info" class="form-control" name="ShopModel[close_info]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">关闭店铺：买家无法访问该店铺和该店铺下的商品，但卖家仍然可以登录卖家中心</div></div>
                    </div>
                </div>
            </div>
            <!-- 商品是否需要审核 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopmodel-goods_status" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺商品是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label cur-p m-r-20">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="0" checked=""> 系统默认
                            </label>

                            <label class="control-label cur-p m-r-20">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="1"> 必须审核
                            </label>

                            <label class="control-label cur-p">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="2"> 无需审核
                            </label>

                            <label class="control-label cur-p">
                                <input type="radio" id="shopmodel-goods_status" class="" name="ShopModel[goods_status]" value="3"> 仅第一次上架时需要审核
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
                                        <input type="checkbox"
                                               id="shopmodel-show_credit"
                                               class="form-control b-n"
                                               name="ShopModel[show_credit]"
                                               value="1" checked=""
                                               data-on-text="是" data-off-text="否"></label>
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
                                        <input type="checkbox"
                                               id="shopmodel-login_status"
                                               class="form-control b-n"
                                               name="ShopModel[login_status]"
                                               value="1" checked=""
                                               data-on-text="是" data-off-text="否"></label>
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
                                        <input type="checkbox"
                                               id="shopmodel-goods_is_show"
                                               class="form-control b-n"
                                               name="ShopModel[goods_is_show]"
                                               value="1" checked=""
                                               data-on-text="是" data-off-text="否"></label>
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
                                        <input type="checkbox"
                                               id="shopmodel-show_in_street"
                                               class="form-control b-n"
                                               name="ShopModel[show_in_street]"
                                               value="1" checked=""
                                               data-on-text="是" data-off-text="否"></label>
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


                            <input type="text" id="shopmodel-shop_sort" class="form-control small" name="ShopModel[shop_sort]" value="255">


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
[{"id": "shopmodel-shop_sort", "name": "ShopModel[shop_sort]", "attribute": "shop_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopmodel-duration", "name": "ShopModel[duration]", "attribute": "duration", "rules": {"required":true,"messages":{"required":"开店时长不能为空。"}}},{"id": "shopmodel-system_fee", "name": "ShopModel[system_fee]", "attribute": "system_fee", "rules": {"required":true,"messages":{"required":"平台使用费不能为空。"}}},{"id": "shopmodel-insure_fee", "name": "ShopModel[insure_fee]", "attribute": "insure_fee", "rules": {"required":true,"messages":{"required":"平台保证金不能为空。"}}},{"id": "shopmodel-duration", "name": "ShopModel[duration]", "attribute": "duration", "rules": {"required":true,"messages":{"required":"开店时长不能为空。"}}},{"id": "shopmodel-system_fee", "name": "ShopModel[system_fee]", "attribute": "system_fee", "rules": {"required":true,"messages":{"required":"平台使用费不能为空。"}}},{"id": "shopmodel-insure_fee", "name": "ShopModel[insure_fee]", "attribute": "insure_fee", "rules": {"required":true,"messages":{"required":"平台保证金不能为空。"}}},{"id": "shopmodel-system_fee", "name": "ShopModel[system_fee]", "attribute": "system_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台使用费必须是一个数字。"}}},{"id": "shopmodel-insure_fee", "name": "ShopModel[insure_fee]", "attribute": "insure_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"平台保证金必须是一个数字。"}}},{"id": "shopmodel-user_id", "name": "ShopModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"绑定店主帐号不能为空。"}}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"required":true,"messages":{"required":"店铺名称不能为空。"}}},{"id": "shopmodel-shop_type", "name": "ShopModel[shop_type]", "attribute": "shop_type", "rules": {"required":true,"messages":{"required":"店铺类型不能为空。"}}},{"id": "shopmodel-cat_id", "name": "ShopModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"店铺所属分类不能为空。"}}},{"id": "shopmodel-clearing_cycle", "name": "ShopModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "shopmodel-qrcode_take_rate", "name": "ShopModel[qrcode_take_rate]", "attribute": "qrcode_take_rate", "rules": {"required":true,"messages":{"required":"神码佣金比例不能为空。"}}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"string":true,"messages":{"string":"店铺名称必须是一条字符串。","maxlength":"店铺名称只能包含至多20个字符。"},"maxlength":20}},{"id": "shopmodel-region_code", "name": "ShopModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"Region Code必须是一条字符串。","maxlength":"Region Code只能包含至多60个字符。"},"maxlength":60}},{"id": "shopmodel-close_info", "name": "ShopModel[close_info]", "attribute": "close_info", "rules": {"string":true,"messages":{"string":"店铺状态修改备注必须是一条字符串。","maxlength":"店铺状态修改备注只能包含至多500个字符。"},"maxlength":500}},{"id": "shopmodel-fail_info", "name": "ShopModel[fail_info]", "attribute": "fail_info", "rules": {"string":true,"messages":{"string":"审核失败原因必须是一条字符串。","maxlength":"审核失败原因只能包含至多500个字符。"},"maxlength":500}},{"id": "shopmodel-shop_sort", "name": "ShopModel[shop_sort]", "attribute": "shop_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "shopmodel-shop_name", "name": "ShopModel[shop_name]", "attribute": "shop_name", "rules": {"ajax":{"url":"/shop/shop/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2hvcE1vZGVs","attribute":"shop_name","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "shopmodel-take_rate", "name": "ShopModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例必须是一个数字。","min":"佣金比例必须不小于0。","max":"佣金比例必须不大于100。"},"min":0,"max":100}},{"id": "shopmodel-qrcode_take_rate", "name": "ShopModel[qrcode_take_rate]", "attribute": "qrcode_take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"神码佣金比例必须是一个数字。","min":"神码佣金比例必须不小于0。","max":"神码佣金比例必须不大于100。"},"min":0,"max":100}},]
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
                var rebate_enable = $('input[name="ShopModel[rebate_enable]"]:checked').val();

                if (rebate_enable == 1) {
                    var err_msg = '';
                    var rebate_days = $("#shopmodel-rebate_days").val();
                    if (rebate_days <= 0) {
                        err_msg = '店铺返利周期必须大于0<br>';
                    }
                    $("#values_select input[name='ShopModel[rebate_setting][amount][]']").each(function() {
                        var val = $(this).val();
                        if (!isPositiveNum(val)) {
                            err_msg += '店铺返利交易额最多保留两位小数<br>';
                            return false;
                        }
                    });
                    $("#values_select input[name='ShopModel[rebate_setting][rate][]']").each(function() {
                        var val = $(this).val();
                        if (!isPositiveNum(val)) {
                            err_msg += '店铺返利奖励金比例最多保留两位小数';
                            return false;
                        }
                        if (val <= 0 || val >= 100) {
                            err_msg += '店铺返利奖励金比例必须大于0且小于100';
                            return false;
                        }
                    });
                    if (err_msg != '') {
                        $.msg(err_msg);
                        return;
                    }
                }
                //加载提示
                $.loading.start();
                $("#ShopModel").submit();
            });

            <!-- -->
            // 判断是否为正整数
            function isPositiveNum(s) {
                var re = /^\d+(\.\d{1,2})?$/;
                return re.test(s);
            }
            <!-- -->

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

                            html += "<option value='" + item.user_id + "' title='" + title + "'>" + label + "</option>"
                        }

                        $("#shopmodel-user_id").html(html);

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

            $("#shopmodel-user_id").change(function() {
                $(this).valid();
            });

            $('input[name="ShopModel[rebate_enable]"]').change(function() {
                var val = $('input[name="ShopModel[rebate_enable]"]:checked').val();
                if (val > 0) {
                    $(".rebate").show();
                } else {
                    $(".rebate").hide();
                }
            });

            // 模板
            var html = $("#attr_value_tpl").html();

            if ($(".new-attr-value").size() == 1) {
                $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
            }

            $("#add_record").click(function() {
                var element = $($.parseHTML(html));
                $(".attr-values").append(element);
                if ($(".new-attr-value").size() > 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", false);
                }
            });

            $('body').on("click", ".del-attr-value", function() {
                $(this).parents(".new-attr-value").remove();
                if ($(".new-attr-value").size() == 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
                }
            });
        });
    </script>
    <script id="attr_value_tpl" type="text">
<li class="m-b-10 new-attr-value">
	交易额 <input class="form-control ipt m-r-10" name="ShopModel[rebate_setting][amount][]" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onafterpaste="this.value=this.value.replace(/[^\d.]/g,'')" type="text"> 元及以上，奖励金比例 <input class="form-control ipt m-r-10" name="ShopModel[rebate_setting][rate][]" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onafterpaste="this.value=this.value.replace(/[^\d.]/g,'')" type="text"> %
	<input value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value" type="button">
</li>
</script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop